$(document).ready(function(){

		$("#processing").hide();

	//reloadGallery();

	//$("#pimg").attr("src","img/ajax-loader.gif");

//$('#registered_participants').on('click', '.new_participant_form', function()
	//$('.gall').click(function()
	$('.disp').on('click', '.gall', function()
	{	
		//$("#td_id").attr('class', 'newClass');
		//$("#td_id").addClass('newClass');
		//$("#td_id").toggleClass('change_me newClass');
		//alert(name);
    	//alert($(this).attr('src'));

    	//var test = $(this).attr('src').split('\/');
    	//alert(test[test.length-1]);
    	//var name = test[test.length-1];

    	$('#pimg').hide();
    	$('#processing').show();


    	var fullPath =$(this).attr('src');
    	var test=fullPath.split('\/');
    	var path='';
    	var etc='det/';
    	var fname=test[test.length-1];
    	var tmp=fname.split('.');
    	var name=tmp[0];	var ext=tmp[1];
    	for (var i = 0; i <test.length-1; i++) {
    		path+=test[i]+'/';
    	};
    	//$("#pimg").attr("src",fullPath);
    	//alert(path+"->"+fname+"\n"+fullPath);


    	$.ajax({
					type:"POST",
					url:"checkface.php",
					async:true,
					data: {filePath: path, absName: name, exten:ext},
					cache:false,
					success:function(response){

								//alert(response);
								var res=response.split('@@@');

								if(res.length!=2){
									$("#pimg").attr("src",fullPath);
									$('#processing').hide();
									$('#pimg').show();
									alert(response);
								}
								else{
									$("#pimg").attr("src",etc+fname);
									$('#processing').hide();
									$('#pimg').show();
									alert(res[1]+" face(s) Detected !");

									var f='';

									for (var i = 1; i <= res[1]; i++) {
										f+='<img src="faces/'+tmp[0]+'-'+i+'.'+tmp[1]+'" alt="Def Image" class="Division">';
										//alert('<img src="faces/'+tmp[0]+'-'+i+'.'+tmp[1]+'" alt="Def Image" class="Division">');
									}

									$('#single').html(f);
								}
								
				    }
				});


	});

	


});