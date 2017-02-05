#include <opencv2/imgproc/imgproc.hpp>
#include <opencv2/objdetect/objdetect.hpp>
#include <opencv2/highgui/highgui.hpp>

#include <iostream>
#include <cstdlib>
#include<sys/stat.h>

 using namespace std;
 using namespace cv;

 const char* keys ={
  //  keys  //
  //  "{short tag|long tag|default value|notification}"  //

  "{i|ipdir||input path}"
  "{o|opdir||output path}"
  "{f|fname||file name}"
  "{e|ext||file extension}"
};


int main(int argc,const char** argv){

        CommandLineParser parser (argc,argv,keys);

        string ip=parser.get<string>("ipdir");
        string op=parser.get<string>("opdir");
        string fn=parser.get<string>("fname");
        string ex=parser.get<string>("ext");

        String face_cascade_file = "haarcascade_frontalface_alt.xml";

        CascadeClassifier face_cascade;
        Mat inputImage,inputImageCopy;

        if(!face_cascade.load(face_cascade_file)){
                cout<<"Error Loading Cascase File!!!"<<endl;
                return -1;
        }

        string ipath=ip+fn+"."+ex;

        //cout<<ipath<<endl;

        //inputImage= imread(ipath,CV_LOAD_IMAGE_UNCHANGED);
        inputImage= imread(ipath);

        if(inputImage.empty()){
            cout<<"Error in Reading Image!!!"<<endl;
            return -1;
        }
            inputImageCopy=inputImage.clone();
            Mat grayImage;

            cvtColor( inputImage, grayImage, COLOR_BGR2GRAY );
            equalizeHist( grayImage, grayImage );

            vector<Rect> faces;

            //detectMultiScale(image,object,scalefactor,minNeighbour,minSize,MaxSize) 1.1,5/1.2,3
            //detectMultiScale(grayImage,faces,1.1,3,0|CASCADE_SCALE_IMAGE, Size(30, 30));
            face_cascade.detectMultiScale(grayImage,faces,1.1,5);



                  //  cout<<"No. of Face Detected= "<<faces.size()<<endl;
                    //String outputfaces;
                    bool f;

                   for(int i=0;i<faces.size();i++){


                            int scale=faces[i].width*0.07;
                            int new_width=faces[i].width-2*(scale);
                            Point tl(faces[i].x+scale,faces[i].y);

                            String outputfaces(format("faces/%s-%d.%s",fn.c_str(),i+1,ex.c_str()));

                            //cout<<outputfaces<<endl;

                            //Rect rec =faces[i];


                            Rect rec = cvRect(tl.x,tl.y,new_width,faces[i].height+1);
                            rectangle(inputImage,rec,Scalar(28,28,255),2,8,0);
                            //rectangle(Mat& img, Rect rec, const Scalar& color, int thickness=1, int lineType=8, int shift=0 )
                            //rectangle(inputImage, rec,Scalar(28,28,255), 2);


                            Mat ff=inputImageCopy(rec);
                            Mat inputResize;

                            inputResize.rows=105;
                            inputResize.cols=90;

                            resize(ff, inputResize, inputResize.size(), 0, 0,INTER_AREA);
                            bool f=imwrite(outputfaces,inputResize);

                            chmod(outputfaces.c_str(), S_IRWXU|S_IRGRP|S_IXGRP|S_IROTH);

                            if(!f){
                                    cout<<"Error: "<<outputfaces<<endl;
                                    return -1;
                            }
                    }

                        ipath=op+fn+"."+ex;
                        bool suc=imwrite(ipath,inputImage);    //detFull Image

                        //string sett(format("chmod 755 %s",ipath.c_str()));
                        //system(sett);
                        chmod(ipath.c_str(), S_IRWXU|S_IRGRP|S_IXGRP|S_IROTH);

                    if(suc){
                        cout<<"Success@@@"<<faces.size()<<endl;
                    }
                    else{
                        cout<<"Error : Couldn't detect faces!!!"<<endl;
                    }

            return 0;
}

/*

    $command="./fd --ipdir=".$filePath." --opdir=".$opdir." --fname=".$fileName." --ext=".$extension."";

    $command="./fd --ipdir=up/ --opdir=det/ --fname=group01-11 --ext=JPG";


*/
