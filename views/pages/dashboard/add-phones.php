<?php


  require_once("models/function.php");
  $prepaid = GetPrepaid($_SESSION['user']->id);

  require_once("profile.php");
  $phones = GetAllPhonesForUser($_SESSION['user']->id);
    WriteLog($_SESSION['user']->id,"dashboar.php","Add Phones");
    
?>


<div class="col-md-12  col-lg-8 offset-lg-0">
				<!-- Edit Personal Info -->
				<div class="widget personal-info">
					<h3 class="widget-header user">Add another phones (You can have a maximum of 5 phones)</h3>



					
						<!-- PHONES  -->
                        
                        
                            <div id="num-phone">
                        <?php 
                        if(count($phones) > 0){
                            echo '<label id="have class="text-success" "for="phone">Your Current Phones </label>';
                        }
                        else{
                            echo '<label id="not-have" class="text-danger" for="phone">Your do not have any phones </label>';
                        }
                            echo '</div>';
                            echo '<div id="list-phones">';
                        foreach($phones as $el):?>
                        
                        <div id="input-<?=$el->id?>" class="form-group col-12 px-0 d-flex">
						    
						    <input  disabled type="text"  class="col-10 phone form-control" name="full-name"  value="<?=$el->phone ?>" />
                            <a class="delete  col-2 pointer" id="<?=$el->id?>">
													<i class="fa fa-trash"></i>
												</a>
						</div>



                        <?php endforeach?>
                        </div>

						<div class="form-group col-12 px-0">
						    <label for="phone">Add Phone</label>
						    <input type="text" class=" phone form-control" name="phone" id="phone" placeholder="example +381611357235" value="" />
                            <p id="phone-error" class="text-danger"></p>
						</div>
						
                        

                        <!--END-->
                        <div class="row justify-content-center my-5">
                            <button  name="submit" id="submit" type="submit" class="col-lg-6 col-md-7 col-8 my-5 mx-auto btn btn-primary btn-block mb-4">
                                Add phone
                            </button>
                        </div>
                        <p id='error' class='text-danger'>
                        <?php if(isset($_SESSION['error'])){
                           echo   $_SESSION['error'] ;
                            
                        }else if(isset($_SESSION['success'])) echo ' <div ><p class="text-success" id="success">'.$_SESSION['success'].'</p></div> '?>

                        </p>
					
                    <div ><p id="form-error"></p></div>
                    <div ><p id="success"></p></div>
				</div>
				
				
				
			</div>
            </section>

<style type="text/css">
    .form-group>.delete>.fa-trash{
        font-size: 15px;
        color:red !important;
        background: white !important;
    }
  

</style>

<script type="text/javascript">
    regPhone = new RegExp(/^(\+\d{1,2}\s?)?1?\-?\.?\s?\(?\d{3}\)?[\s.-]?\d{3}[\s.-]?\d{4}$/);
    window.onload = () =>{

        /*ADD PHONE NUMBER */

        $("#submit").click(function(){
            let val = $("#phone").val()
            
            if(!regPhone.test(val)){
                alert("Invalid phone number format");

            }else{
                $.ajax({
                    method:"POST",
                    url:"models/add-phones.php",
                    dataType:"JSON",
                    data:{
                        "val": val
                    },
                    success:function(data){
                        WriteAddPhones(data,val);
                        


                    },
                    error:function(xhr){
                        alert(xhr.responseText)
                    }

                })
            }


        })


        /*Deleting phone number */
        AddEvents();
        


    }
    function WriteAddPhones(data,val){
        html="";

        
        html+=`<div id="input-${data}" class="form-group col-12 px-0 d-flex">
						    
					<input  disabled type="text" id="input-${data}" class="col-10 phone form-control" name="full-name"  value="${val}" />
                    <a class="delete  col-2 pointer" id="${data}">
													<i class="fa fa-trash"></i>
												</a>
				</div>`

       
        $("#phone").val("");

        let current = $("#list-phones").html();

        $("#list-phones").html(current + html);

        let count = $("#list-phones").children().length;

        if(count == 0){

             $("#num-phone").html('<label id="not-have" class="text-danger" for="phone">Your do not have any phones </label>')
        
        }else{
        
            $("#num-phone").html('<label id="not-have" class="text-success" for="phone">Your Current Phones: </label>')

         }

        AddEvents();


    }
    function AddEvents(){
        $(".delete").click(function(){
            var val = $(this).attr("id");
            $.ajax({
                method:"POST",
                url:"models/delete-phone.php",
                dataType:"JSON",
                data:{
                    "id":val
                },
                success:function(data){
                    AfterDelete(data);


                },error:function(xhr){
                    alert("Something go worng");
                }
               

            })
        })

    }
    function AfterDelete(data){
                let id = data.id;
                    
                    $("#input-"+id).remove();
                   
                    $("#phone").val("");


                    let count = $("#list-phones").children().length;
         
             

                    if(count == 0){
                        $("#num-phone").html('<label id="not-have" class="text-danger" for="phone">Your do not have any phones </label>')
                    }else{
                        $("#num-phone").html('<label id="not-have" class="text-success" for="phone">Your Current Phones: </label>')

                    }
    }



</script>