<?php
if(!isset($_SESSION['user'])){
    header("Location: index.php?page=login");
    exit;
}

require_once("models/function.php");
WriteLog($_SESSION['user']->id,"dashboar.php","Edit profile");



$full_name = $_SESSION['user']->full_name;
$email = $_SESSION['user']->email;
$adress = $_SESSION['user']->adress;
$src = $_SESSION['user']->src;
$phones = GetAllPhonesForUser($_SESSION['user']->id);

$prepaid = GetPrepaid($_SESSION['user']->id);

?>


    <?php require_once("profile.php");?>



<div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
				<!-- Edit Personal Info -->
				<div class="widget personal-info">
					<h3 class="widget-header user">Edit profile</h3>



					<form onsubmit="Verification(event)" action="models/edit-profile.php" method="POST" enctype="multipart/form-data">
						<!-- Full Name -->
						<div class="form-group col-12 px-0">
						    <label for="full-name">Full Name <i class="fas fa-star-of-life"></i></label>
						    <input type="text" class="form-control" name="full-name" id="full-name" value="<?=$full_name ?>" />
                            <p id="full-name-error" class="text-danger"></p>
						</div>
						<!-- Email -->
                        <div class="form-group col-12 px-0">
						    <label for="email">Email <i class="fas fa-star-of-life"></i></label>
						    <input type="text" class="form-control" name="email" id="email" value="<?=$email ?>" />
                            <p id="email-error" class="text-danger"></p>
						</div>
						<!-- Adress -->

                        <div class="form-group col-12 px-0">
						    <label for="adress">Adress</Address> <i class="fas fa-star-of-life"></i></label>
						    <input type="text" class="form-control" name="adress" id="adress" value="<?=$adress ?>" />
                            <p id="adress-error" class="text-danger"></p>
                            
						</div>

                       
                        <!-- Picture -->
                        <div class="container my-5" >
                        			<br />
                        			<h5 class="font-18 text-center grey-text" >Crop Image Before Upload (Max 8Mb and 1 photo)</h5>
                        			<br />
                        			<div class="row">
                        				<div class="col-md-3">&nbsp;</div>
                        				<div class="col-md-4 offset-md-1">
                        					<div class="image_area">
                        						
                        							<label for="upload_image">
                        								<img src="user-image/avatar.png" id="uploaded_image" class="w-100 img-circle" />
                        								<div class="overlay">
                        									<div class="text">Change Profile Image</div>
                        								</div>
                        								<input type="file" name="image" class="image" id="upload_image" style="display:none" />
                        							</label>
                        						
                        					</div>
                        			    </div>
                            					
                        		</div>
                        <p class="mt-2">If you do not upload a different imager, the old image is retained</p>

                        <input type="hidden" id="path" name="src" value="<?=$src?>"/>
                         <!--<input type="hidden" id="path "name="path" value=""/>-->
                        <!--END-->
                        <div class="row justify-content-center my-5">
                            <button  name="submit" id="submit" type="submit" class="col-lg-6 col-md-7 col-8 my-5 mx-auto btn btn-primary btn-block mb-4">
                                Save changes
                            </button>
                        </div>
                        <p id='error' class='text-danger'>
                        <?php if(isset($_SESSION['error'])){
                           echo   $_SESSION['error'] ;
                            
                        }else if(isset($_SESSION['success'])) echo ' <div ><p class="text-success" id="success">'.$_SESSION['success'].'</p></div> '?>

                        </p>
					</form>
                    <div ><p id="form-error text-danger"></p></div>
                    <div ><p id="success text-success"></p></div>
				</div>
				
				
				
			</div>
            </section>
<div class="conatiner">
    <div class="col-3 offset-4">
        <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
			  	<div class="modal-dialog modal-lg" role="document">
			    	<div class="modal-content">
			      		<div class="modal-header">
			        		<h5 class="modal-title">Crop Image Before Upload</h5>
			        		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          			<span aria-hidden="true">×</span>
			        		</button>
			      		</div>
			      		<div class="modal-body">
			        		<div class="img-container">
			            		<div class="row">
			                		<div class="col-md-8">
			                    		<img src="" id="sample_image" alt="croping image" />
			                		</div>
			                		<div class="col-md-4">
			                    		<div class="preview"></div>
			                		</div>
			            		</div>
			        		</div>
			      		</div>
			      		<div class="modal-footer">
			      			<button type="button" id="crop" class="btn btn-primary">Crop</button>
			        		<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
			      		</div>
			    	</div>
			  	</div>
			</div>
        </div>
</div>
<script src="https://unpkg.com/cropperjs"></script>
<script type="text/javascript">



window.onload = () =>{

    $(".images").prepend('<div class="img" style="background-image: url(<?=$src?>);"><span>remove</span></div>')
    $(".pic").css("display","none");


    <?php
    if(isset($_SESSION['error']) || isset($_SESSION['success'])):?>
    $('html, body').animate({
        scrollTop: $('#error').offset().top - 500
    }, 'slow');
    <?php
    unset($_SESSION['error']);
    unset($_SESSION['success']);
    endif ?>




/*

    function uploadImage() {
            var button = $('.images .pic')
            //var uploader = $('<input type="file" accept="image/*" />')
            var uploader = $('#file')
            var images = $('.images')
            
            button.on('click', function () {
                uploader.click()
            })
            
            uploader.on('change', function () {
                var reader = new FileReader()
                reader.onload = function(event) {
                    $(".pic").css("display","none");
                
                    $(".images").prepend('<div class="img" style="background-image: url(\'' + event.target.result + '\');" rel="'+ event.target.result  +'"><span>remove</span></div>')
                
                }
        
                reader.readAsDataURL(uploader[0].files[0]);
                
        
            })
            
            images.on('click', '.img', function () {
                $(this).remove();
                $("#file").val(null);
                $(".pic").css("display","flex");
                
            })
            
    }
            uploadImage();

    */

         var $modal = $('#modal');

    var image = document.getElementById('sample_image');

    var cropper;


   

    $('#upload_image').change(function(event){
        var files = event.target.files;

        var done = function(url){
            image.src = url;

            $modal.modal('show');
        };

        if(files && files.length > 0)
        {
            reader = new FileReader();
            reader.onload = function(event)
            {
                done(reader.result);
            };
            reader.readAsDataURL(files[0]);
        }
    });

    $modal.on('shown.bs.modal', function() {
        cropper = new Cropper(image, {
            aspectRatio: 1,
            viewMode: 1,
            preview:'.preview'
        });
    }).on('hidden.bs.modal', function(){
        cropper.destroy();
        cropper = null;
    });

    $('#crop').click(function(){
        canvas = cropper.getCroppedCanvas({
            width:400,
            height:400
        });

        canvas.toBlob(function(blob){
            url = URL.createObjectURL(blob);
            var reader = new FileReader();
            reader.readAsDataURL(blob);
            reader.onloadend = function(){
                var base64data = reader.result;
                $.ajax({
                    url:'upload-one-image.php',
                    method:'POST',
                    data:{image:base64data},
                    success:function(data)
                    {
                        $modal.modal('hide');
                        $('#uploaded_image').attr('src', data);
                        
                        $("#path").val(data);
                    },error(xhr){
                        console.log(xhr.responseText)
                    }
                });
            };
        });
    });
    
    
    
        $("form").on("click", function(event){
            Verification(event);
        })


}

var regName = new RegExp(/^([a-zA-Z]{2,}(\s[a-zA-Z]{2,})*)$/);
var regAdress = new RegExp(/^([a-zA-Z0-9]{2,}(\s[a-zA-Z0-9]{1,})*)$/)
var regEmail = new RegExp(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/);
var regPhone = new RegExp(/^(\+\d{1,2}\s?)?1?\-?\.?\s?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/);

function Verification(event){
    
    let fullName = $("#full-name").val();
    let email = $("#email").val();
    let adress = $("#adress").val();
    let v = true;



   


    if(!regName.test(fullName)){
        v =false;
        $("#full-name-error").html("Invalid format for Name !");
    }else{
        $("#full-name-error").html("");
    }
    
    if(!regEmail.test(email)){
            v=false;
            $("#email-error").html("Invalid format for Email !");

    }else{
                
        $("#email-error").html("");
    }

    

    

    if(!regAdress.test(adress)){
        v = false;
        $("#adress-error").html("Invalid format for adress !");

    }else{
        $("#adress-error").html("");
    }
   
    if(!v){
                $("#form-error").html("check the data, something is wrong")
                event.preventDefault();
    }else{
                $("#form-error").html("");
    }

}

</script>

<style  type="text/css">

/*CROPPER*/

.sample_image{
            width: 100% !important;
        }
        .image_area {
		  position: relative;
		}

		/*img {
		  	display: block;
		  	max-width: 100%;
		}*/

		.preview {
  			overflow: hidden;
  			width: 160px; 
  			height: 160px;
  			margin: 10px;
  			border: 1px solid red;
		}

		.modal-lg{
  			max-width: 1000px !important;
		}

		.overlay {
		  position: absolute;
		  bottom: 10px;
		  left: 0;
		  right: 0;
		  background-color: rgba(255, 255, 255, 0.5);
		  overflow: hidden;
		  height: 0;
		  transition: .5s ease;
		  width: 100%;
		}

		.image_area:hover .overlay {
		  height: 100%;
		  cursor: pointer;
		}

		.text {
		  color: #333;
		  font-size: 20px;
		  position: absolute;
		  top: 50%;
		  left: 50%;
		  -webkit-transform: translate(-50%, -50%);
		  -ms-transform: translate(-50%, -50%);
		  transform: translate(-50%, -50%);
		  text-align: center;
		}



/*END CROP*/



.images {
        display: flex;
        flex-wrap:  wrap;
        margin-top: 20px;
        }
        .images .img,
        .images .pic {
    /* flex-basis: 31%;*/
        margin-bottom: 10px;
        border-radius: 4px;
        }
        .pic{
            display: flex;
            justify-content: center;
            align-items: center;
            width: 150px;
            height: 150px;
            background-color: #111111;
        /* border-radius: 50% !important;*/
        }
        .images .img {
        border-radius: 50% !important;
        
        width: 150px;
        height: 150px;
        background-size: cover;
        margin-right: 10px;
        background-position: center;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        position: relative;
        overflow: hidden;
        }
        .images .img:nth-child(3n) {
        margin-right: 0;
        }
        .images .img span {
        display: none;
        text-transform: capitalize;
        z-index: 2;
        }
        .images .img::after {
        content: '';
        width: 100%;
        height: 100%;
        transition: opacity .1s ease-in;
        border-radius: 4px;
        opacity: 0;
        position: absolute;
        }
        .images .img:hover::after {
        display: block;
        background-color: #000;
        opacity: .5;
        }
        .images .img:hover span {
        display: block;
        color: #fff;
        }
        .images .pic {
        background-color: #c2c2c2;
        align-self: center;
        text-align: center;
        padding: 40px 0;
        text-transform: uppercase;
        color: #848EA1;
        font-size: 12px;
        cursor: pointer;
        }
        .grey-text{
            color:#848484 !important;
        }
        .star, .form-group i{
            background-color: transparent !important;
            font-size: 8px !important;
            color: red !important;
            line-height: none !important;
            height: 0px !important;
            
        }
        .fa-star-of-life{
            color: red;
            font-size: 8px;
        }
        
          .images {
    display: flex;
    flex-wrap:  wrap;
    margin-top: 20px;
    }
    .images .img,
    .images .pic {
   /* flex-basis: 31%;*/
    margin-bottom: 10px;
    border-radius: 4px;
    }
    .pic{
        display: flex;
        justify-content: center;
        align-items: center;
        width: 150px;
        height: 150px;
        background-color: #111111;
        border-radius: 50% !important;
    }
    .images .img {
    border-radius: 50% !important;
    
    width: 150px;
    height: 150px;
    background-size: cover;
    margin-right: 10px;
    background-position: center;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    }
    .images .img:nth-child(3n) {
    margin-right: 0;
    }
    .images .img span {
    display: none;
    text-transform: capitalize;
    z-index: 2;
    }
    .images .img::after {
    content: '';
    width: 100%;
    height: 100%;
    transition: opacity .1s ease-in;
    border-radius: 4px;
    opacity: 0;
    position: absolute;
    }
    .images .img:hover::after {
    display: block;
    background-color: #000;
    opacity: .5;
    }
    .images .img:hover span {
    display: block;
    color: #fff;
    }
    #sample_image{
        width: 300px !important;
    }
    .images .pic {
    background-color: #c2c2c2;
    align-self: center;
    text-align: center;
    padding: 40px 0;
    text-transform: uppercase;
    color: #848EA1;
    font-size: 12px;
    cursor: pointer;
    }
    .grey-text{
        color:#848484 !important;
    }

</style>


