<?php


  require_once("models/function.php");
  $prepaid = GetPrepaid($_SESSION['user']->id);

WriteLog($_SESSION['user']->id,"dashboar.php","Top up credits");

  require_once("profile.php");
    $request = GetPrepaidRequest($_SESSION['user']->id);

?>


<div class="col-md-12  col-lg-8 offset-lg-0">
				<!-- Edit Personal Info -->
				<div class="widget personal-info">
					<h3 class="widget-header user">Top up Your Credits (You can send a maximum of one request to an administrator)</h3>



					
						<!-- PHONES  -->
                        
                        
                            <div id="num-phone">
                        <?php 
                        if($request):
                            echo '<label id="have class="text-success" "for="phone">You have already sent request</label>
                            <p> The money will be paid into your account immediately upon approval by the administrator</p>';
                        
                        else: ?>
                        
                        

						<div class="form-group col-12 px-0">
						    <label for="phone">Input your request</label>
						    <input type="number" class=" phone form-control" name="prepaid" id="prepaid" placeholder="Currency is RSD" value="" />
                            <p id="phone-error" class="text-danger"></p>
						</div>
						
                      

                        <!--END-->
                        <div class="row justify-content-center my-5">
                            <button  name="submit" id="submit" type="button" class="col-lg-6 col-md-7 col-8 my-5 mx-auto btn btn-primary btn-block mb-4">
                                Send
                            </button>
                        </div>
                        
					
                    <div ><p class="text-danger " id="error"></p></div>
                    <div ><p class="text-success" id="success"></p></div>
				</div>
				
                <?php endif?>
				
			</div>
            </section>


<script type="text/JavaScript">



    document.getElementById("submit").addEventListener("click",function(){
      
        let prepaid = $("#prepaid").val();
        $.ajax({
            method:"POST",
            url:"models/request-credit.php",
            dataType:"JSON",
            data:{
                "prepaid":prepaid
            },
            success:function(data){
               $("#success").html("Your request are successful sent.");
               $("#error").html("");

               $("#submit").attr("disable",true);
               $("#prepaid").attr("disable",true);
               
            },
            error: function(xhr){
               $("#success").html("");

                $("#error").html(xhr.responseText);
            }
        });



    })






</script>