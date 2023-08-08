

<?php

require_once("models/function.php");
if(isset($_SESSION['user'])){
	$id_user_log = $_SESSION['user']->id;
}else $id_user_log = "Ghost";

WriteLog($id_user_log,"login.php","Login");

?>

<section class="text-center">
  <!-- Background image -->
  <div class="p-5 bg-image" id="image"></div>
  <!-- Background image -->

  <div class="card mx-1 mx-md-5 shadow-5-strong mb-5" id="card-form">
    <div class="card-body py-5 px-md-5">

      <div class="row d-flex justify-content-center">
        <div class="col-lg-8">
         <div class="mb-5">
            <h2 class="fw-bold font-25">Log In Here</h2><h3 class="">Or</h3><a href="index.php?page=registration" class="font-22 pointer  text-primary fw-bold mb-5 "> Sign Up  </a>
         </div>         
          <form action="models/login.php" method="POST">
            <!-- 2 column grid layout with text inputs for the first and last names -->
            

            <!-- Email input -->
            <div class="row">
                <div class="col-12 col-lg-8 offset-lg-2">
                    <div class="form-outline mb-5">
                        <label class="form-label"  for="email">Email address</label>
                    <input type="email" id="email" name="email" class="form-control form-text" value=""/>
                    
                    </div>
                </div>
            </div>
            <div class="row">
              <div class="col-12 col-lg-8 offset-lg-2">
                <div class="form-outline">
                    <label class="form-label" for="password">Password</label>
                  <input type="password" id="password" name="password" class="form-control form-text" value=""/>
              
                  
                </div>
              </div>
            </div>
            <!--<a id="forgot" href="forgot-password.php" class="text-primary">If you forgot password, click here...</a><br/>-->
            <!-- Submit button -->
            <button name="submit" id="submit" type="submit" class="text-light w-50 mx-auto btn btn-primary mb-5 mt-5">
                Log In
            </button>
            <p id="form-error" class="text-danger">

            <?php
                if(isset($_SESSION['error'])){
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                }
            ?>

            </p>

            
          
          </form>
        </div>
      </div>
    </div>
  </div>
</section>

<style type="text/css">
    #image{
        background-image: url('https://mdbootstrap.com/img/new/textures/full/171.jpg') ;
        background-size: cover;
        background-position: 0px;
        height: 300px;
    }
    #card-form{
        margin-top: -100px;
        background: hsla(0, 0%, 100%, 0.6);
        backdrop-filter: blur(30px);
    }
    .font-25{
        font-size: 25px !important;
    }
    .font-22{
        font-size: 22px !important;
    }
    .pointer{
        cursor: pointer;
    }
</style>


<script type="text/javascript">
    <?php
    /*if(isset($_SESSION['notification'])){
        echo ("alert('".$_SESSION['notification']."');");
        unset($_SESSION['notification']);
    }*/

    ?>
    window.onload = () => {
            setTimeout(function(){
            $('html, body').animate({
                scrollTop: $('#card-form').offset().top - 50
            }, 'slow');},200);

            $("#submit").on("click", function(){
            Verification();
        })
        }


        



        var regEmail = new RegExp(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/);
        var regPass = new RegExp(/^(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^\.&*-]).{8,}$/)

        function Verification(){

            var email = $("#email").val();

            var pass = $("#password").val();
 
            let v = true;

            if(!regEmail.test(email)){
                v=false;


            }


            

            if(!regPass.test(pass)){
                v= false
            }

            
            if(!v){
                $("#form-error").html("Incorect email or password !")
                event.preventDefault();
            }else{
                $("#form-error").html("");
            }





        }

      

</script>