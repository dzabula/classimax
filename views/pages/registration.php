

<?php

if(isset($_SESSION['user'])){
    header("Location: index.php");
    exit;
}
require_once("models/function.php");

WriteLog("Ghost","registration.php","Registration");


?>
<script src="https://unpkg.com/jcrop"></script>
<section class="text-center">
  <!-- Background image -->
  <div class="p-5 bg-image" id="image"></div>
  <!-- Background image -->

  <div class="card mx-1 mx-md-5 shadow-5-strong mb-5" id="card-form">
    <div class="card-body py-5 px-md-5">

      <div class="row d-flex justify-content-center">
        <div class="col-lg-8">
          <h2 class="fw-bold font-25">Sign up now</h2><h3 class="">Or</h3><a href="index.php?page=login" class=" pointer  text-primary fw-bold mb-5 font-25"> Log in  </a>
          <form action="models/registration.php" method="POST" enctype="multipart/form-data">
            <!-- 2 column grid layout with text inputs for the first and last names -->
            <div class="row">
              <div class="col-md-6 mb-5">
                <div class="form-outline">
                    <label class="form-label" for="first-name">First Name <i class="fas fa-star-of-life"></i></label>
                  <input type="text" id="first-name" name="first-name" class="form-control form-text" />
                  <p id="first-name-error" class="text-danger"></p>
                  
                </div>
              </div>
              <div class="col-md-6 mb-5">
                <div class="form-outline">
                    <label class="form-label" for="last-name">Last Name <i class="fas fa-star-of-life"></i></label>
                  <input type="text" id="last-name" name="last-name" class="form-control form-text" />
                  <p id="last-name-error" class="text-danger"></p>
                </div>
              </div>
            </div>

            <!-- Email input -->
            <div class="form-outline mb-5">
                <label class="form-label"  for="email">Email Address <i class="fas fa-star-of-life"></i></label>
              <input type="email" id="email" name="email" class="form-control form-text" placeholder="example@gmail.com"/>
              <p id="email-error" class="text-danger"></p>
            </div>

            <div class="form-outline mb-5">
                <label class="form-label"  for="phone">Phone Number <i class="fas fa-star-of-life"></i></label>
              <input type="text" id="phone" name="phone" class="form-control form-text" placeholder="example +381611357235"/>
              <p id="phone-error" class="text-danger"></p>
            </div>

            <!-- Location input --> 
            <div class="form-outline mb-5">
              <label  class="form-label" for="city">Choose City   <i class="fas fa-star-of-life"></i></label><br/>
              <select id="city" class="w-100" name="city">
                <option class="" value="1">Belgrade</option>
                <option class="" value="2">Novi Sad</option>
              </select>
            </div>

            <div class="form-outline mb-5"> 
            <label class="form-label " for="adress">Adress <i class="fas fa-star-of-life"></i></label> 
              <input class="form-control form-text" type="text" id="adress" name="adress" />
              <p id="adress-error" class="text-danger"></p>
            </div>

            <!--Date of birth-->
            <div class="form-outline my-5"> 
                <h6 class="mt-4 mb-3 font-18 grey-text"> Your Date Birth <i class="fas fa-star-of-life"></i></h6>
                <div class="row">
                    <div class="col-12 col-lg-5">
                        <label for="year">Year</label>
                        <select class="w-100" id="year" name="year">
                            <option value="2022">2022</option>
                        </select>

                    </div>
                    <div class="col-12 col-lg-4">
                        <label for="month">Month</label>
                        <select class="w-100" id="month" name="month">
                            <option value="1">1</option>
                        </select>

                    </div>
                    <div class="col-12 col-lg-3">
                        <label for="day">Day</label>
                        <select class="w-100" id="day" name="day">
                            <option value="1">1</option>
                        </select>

                    </div>
                </div>

            </div>

            <!--Picture
            
            <div class="form-outline my-5"> 

            <label class="text-center mb-0">Upload Your Profile photo (Max 8 Mb and 1 photo). <small>Oprional</small></label>
            <div class="d-flex justify-content-center">
                <div class="images">
                    <div class="pic">
                    add
                    </div>
                </div>
            </div>
            <input id="file" type="file" name="pic" accept="image/png, image/jpeg" multiple="false"/>
            </div>
            -->

            <!--<label class="form-label" for="adress">Upload your picture (MAX 8 MB)</label> 
                <input class="form-control w-100" type="file" id="picture" name="picutre" />-->
               

        <!--CROPPER START-->        
        <div class="container my-5" >
			<br />
			<h5 class="font-18 text-center grey-text" >Crop Image Before Upload (Max 8Mb and 1 photo)</h5>
			<br />
			<div class="row">
				<div class="col-md-4">&nbsp;</div>
				<div class="col-md-2 offset-md-1">
					<div class="image_area">
						
							<label for="upload_image">
								<img src="user-image/avatar.png" id="uploaded_image" class="img-responsive img-circle" />
								<div class="overlay">
									<div class="text">Change Profile Image</div>
								</div>
								<input type="file" name="image" class="image" id="upload_image" style="display:none" />
							</label>
						
					</div>
			    </div>
    					
		</div>
        <!--CROPER END-->



            <!-- Password input -->
            <div class="form-outline mb-5 mt-5">
                <label class="form-label" for="password">Password <i class="fas fa-star-of-life"></i></label>
              <input  value="" type="password" id="password" name="password" class="form-control" placeholder="Min. 8 character, min. one number and min. one special character "/>
              <p id="password-error" class="text-danger"></p>
            </div>

            

            <div class="form-outline mb-4">
                <label class="form-label" for="confirm-password">Confirm password <i class="fas fa-star-of-life"></i></label>
              <input value=""  type="password" id="confirm-password" name="confirm-password" class="form-control" />
              <p id="confirm-password-error" class="text-danger"></p>
            </div>

            <a class="mb-3 font-16" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            View Privacy Policy
            </a>
            <div class="collapse mb-3" id="collapseExample">
                <div class="card card-body font-14">
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                </div>
            </div>

            <div class="form-outline mb-4">
                <input type="checkbox"  id="agree" name="agree"/>
                <label class="form-label" for="agree" >Agree Privacy Policy <i class="fas fa-star-of-life"></i></label>
            </div>
            <div class="col-12 form-group row my-5 justify-content-center">
                <p class="font-16 text-success ">After registration you get 8000 RSD credit for promotion your products! </p>                
            </div>
            <!-- Submit button -->
            <button name="submit" id="submit" type="submit" class=" w-50 mx-auto btn btn-primary btn-block mb-4">
              Sign up
            </button>
            <p id="form-error" class="text-danger">
            <?php
                if(isset($_SESSION['registration-error'])){
                    echo $_SESSION['registration-error'];
                
                }
            ?>
            </p>
                <input type="hidden" id="path" name="path" />
           
            </form>
      </div>
    </div>
  </div>
</section>
<!--croper-->
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
<!--croper end-->
<!--<script src="https://unpkg.com/dropzone"></script>-->
<script src="https://unpkg.com/cropperjs"></script>
<script>
    window.onload = () => {
    // Handler for .ready() called.
    $('html, body').animate({
        scrollTop: $('#card-form').offset().top - 100
    }, 'slow');
    
    if(document.getElementById("agree").checked){
        $("#submit").removeAttr("disable");
    }
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
          reader.readAsDataURL(uploader[0].files[0])
  
       })
      
      images.on('click', '.img', function () {
        $(this).remove();
        $("#file").val(null);
        $(".pic").css("display","flex");
        
      })
    
    }*/
    //uploadImage()

        var date = new Date();
        let years = []
        for(let i = 1930; i<=date.getFullYear() - 7;i++){
            years.push(i)
        }
        
        let months = [1,2,3,4,5,6,7,8,9,10,11,12];
        let days = [];
        for (let i =1;i<=31;i++){
            days.push(i);
        }
        let html = "";

        years.forEach(e =>{
            html+=`<option value="${e}" >${e}</option>` 
        })
   
        $("#year").html(html);

        html="";
        months.forEach(e =>{
            html+=`<option value="${e}" >${e}</option>` 
        })

        $("#month").html(html);
        html=""
        days.forEach(e =>{
            html+=`<option value="${e}" >${e}</option>` 
        })
   
        $("#day").html(html);


        $("#month").on("change",fillDay);
        $("#year").on("change",fillDay);

        function fillDay(){
            if($("#year").val()%4 == 0 && $("#month").val() == 2){
                html=""
                for (let i =1;i<=29;i++){
                    html+=`<option value="${i}" >${i}</option>`


                }

                $("#day").html(html);

            }
            else{

                var maxD;
                const month = $("#month").val();
                
                switch(month){
                    case "1":{
                         maxD = 31;break;
                    }
                    case "2":{
                         maxD = 28;break;
                    }
                    case "3": maxD = 31;break;
                    case "4": maxD = 30;break;
                    case "5": maxD = 31;break;
                    case "6": maxD = 30;break;
                    case "7": maxD = 31;break;
                    case "8": maxD = 31;break;
                    case "9": maxD = 30;break;
                    case "10": maxD = 31;break;
                    case "11": maxD = 30;break;
                    case "12": maxD = 31;break;

                }


                html=""
                for(let i =1;i<=maxD;i++){
                    html+=`<option value="${i}" >${i}</option>`


                }
           
                $("#day").html(html);
            }
        }
    
        $("#agree").on("change",function(){
            var agree = document.getElementById("agree");
            if(agree.checked == false){
                $("#submit").attr("disabled","true");

            }else{
                $("#submit").removeAttr("disabled");
            }
        })

        $("#submit").on("click", function(){
            Verification();
        })

    /*croper image*/
    <?php
     if(isset($_SESSION['registration-error'])){
       echo" $('html, body').animate({
            scrollTop: $('#form-error').offset().top
        }, 400);";
        unset($_SESSION['registration-error']);
    }
    ?>
    
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

    /*END croper */


    }
    

    var regName = new RegExp(/^([a-zA-Z]{2,}(\s[a-zA-Z]{2,})?)$/);
    var regAdress = new RegExp(/^([a-zA-Z0-9]{2,}(\s[a-zA-Z0-9]{1,})*)$/)
    var regEmail = new RegExp(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/);
    var regPass = new RegExp(/^(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^\.&*-]).{8,}$/)
    var regPhone = new RegExp(/^(\+\d{1,2}\s?)?1?\-?\.?\s?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/)


    function Verification(){
            var agree = document.getElementById("agree");
            var firstName = $("#first-name").val();
            var lastName = $("#last-name").val();
            var email = $("#email").val();
            var adress = $("#adress").val();
            var fiile = $("#file").val();
            var pass = $("#password").val();
            var cPass = $("#confirm-password").val();
            var phone = $("#phone").val();
            let v = true;


       


            if(!regName.test(firstName)){
                v =false;
                $("#first-name-error").html("Invalid format for name !");
            }else{
                $("#first-name-error").html("");
            }

            if(!regName.test(lastName)){
                v =false;
                $("#last-name-error").html("Invalid format for name !");
            }else{
                $("#last-name-error").html("");
            }

            if(!regAdress.test(adress)){
                v = false;
                $("#adress-error").html("Invalid format for adress !");

            }else{
                $("#adress-error").html("");
            }

            

            if(!regEmail.test(email)){
                v=false;
                $("#email-error").html("Invalid format for Email !");

            }else{
                $("#email-error").html("");
            }

            if(!regPhone.test(phone)){
                v=false;
                $("#phone-error").html("Invalid format for phone !");

            }else{
                $("#emaphoneil-error").html("");
            }



            

            if(!regPass.test(pass)){
                v= false
                $("#password-error").html("Password must have a min. 8 character, min. one number and min. one special character !");

            }else{
                $("#password-error").html("");
            }

            if(cPass!=pass){
                v=false;
                $("#confirm-password-error").html("Passwords are not matching! ");
            }else{
                $("#confirm-password-error").html("");
            }

            if(!v){
                $("#form-error").html("check the data, something is wrong")
                event.preventDefault();
            }else{
                $("#form-error").html("");
            }





        }

</script>

<style type="text/css">

        /*CROOPRER */
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


    /*end croper*/

    .fa-star-of-life{
        font-size: 8px;
        color: red;
        
    }
    #image{
        background-image: url('https://mdbootstrap.com/img/new/textures/full/171.jpg') ;
        background-size: cover;
        background-position: 0px;
        height: 300px;
    }
    select{
        padding-top: 10px;
        padding-bottom: 10px;
    }
    #city>option{
        padding-top: 5px;
        padding-bottom: 5px;
    }
    #card-form{
        margin-top: -100px;
        background: hsla(0, 0%, 100%, 0.6);
        backdrop-filter: blur(30px);
    }
    #card-form div div ul{
        width:100%;
    }
    #card-form div div ul li{
        width:100%;
    }

    .font-25{
        font-size: 25px !important;
    }
    .font-18{
        font-size: 18px !important;
    }
    .font-16{
        font-size: 16px !important;
    }
    .font-14{
        font-size: 14px !important;
    }

    .underline{
        text-decoration: underline;
    }
    .pointer{
        cursor: pointer;
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
    @media screen and (max-width: 400px) {
    
    .images .img,
    .images .pic {
       /* flex-basis: 100%;*/
        margin-right: 0;
    }
    }

  


</style>