$(document).ready(function(){


	/*$('#dropzone').ondragover(function{

		$(this).addClass('dropzone dragover');
		return false;

	});*/
	
	function reloadGallery(){
		$(".disp").load("gal.php");

		alert('Image Uploaded !');
		//var display='reload';


	/*	$.ajax({
					type:"POST",
					url:"gal.php",
					async:true,
					data: {stat: display},
					cache:false,
					success:function(response){

								//alert(response);
								if (response[0]=='E') {

								}
								else{
									alert('loading Gallery');
									$('.disp').html(response);
								}
								
				    }
				});
		*/
	}
	

	var dropzone =document.getElementById('dropzone');


	var upload =function(files){

			var formData = new FormData(),
			 	xhr= new XMLHttpRequest(),
			 	x;

			 	//console.log(files);
			 	//alert(files.length);
		for(x=0;x<files.length;x=x+1){

			formData.append('file[]',files[x]);

			//alert(formData['file[]');
		}

		xhr.onload =function (){

			var data = this.responseText;
				//console.log(data);

				var response = $.parseJSON(data);
				//alert("Response:\n"+data);
				//alert("a"+response.status);
				if(response.status=='OK'){
					reloadGallery();
				}
				else{
					alert(response.log);
				}
			

		}


		xhr.open('post','filecheck.php');
		xhr.send(formData);

		//alert(formData);
		
	}

	dropzone.ondragover=function(){
		this.className='dropzone dragover';
		return false;
	};

	dropzone.ondrop=function(e){
			e.preventDefault();
			this.className='dropzone';

			upload(e.dataTransfer.files);

	};

	dropzone.ondragleave=function(){
		this.className='dropzone';
		return false;
	};



});