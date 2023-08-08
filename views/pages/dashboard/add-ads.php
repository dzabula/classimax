<?php
if(!isset($_SESSION['user'])){
    header("Location: index.php?page=login");
    exit;
}
require_once("models/function.php");

WriteLog($_SESSION['user']->id,"dashboar.php","Add/Edit ads");

$cat = GetAllCategories();
$first_cat = $cat[0];

$state = GetAllStates();
$curr = GetAllCurrency();
$deliv = GetAllDelivery();
$price_status = GetAllStatuses();
$promotions = GetAllPromotions();


$prepaid = GetPrepaid($_SESSION['user']->id);

if(isset($_GET['id'])){
   
        $id_post = $_GET['id'];
        $usr_post = GetPostForId($id_post);
    $usr_price =  GetPriceForPost($id_post);
    $usr_promotion = GetPromotionsForId($_SESSION['user']->id,$id_post);

    if($usr_promotion == null){
            $usr_promotion = false;
    }

    $usr_currency = false;
    if($usr_price != null){
        $usr_currency = GetCurrencyForPrice($usr_price->id_currency);

    }
        $usr_subcategory = GetSubcategoryForPost($id_post);
        
        $usr_category = GetCategoryForId($usr_subcategory->id_parrent);
        if(!$usr_category){
            $usr_category = $usr_subcategory;
            
        }
        $usr_price_status = GetPriceStatusForPost($id_post);
        $usr_state = GetStateForPost($id_post);
        $usr_images = GetImagesForPost($id_post);


    

    

}


?>


    <?php require_once("profile.php");?>
			<div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
				<!-- Edit Personal Info -->
				<div class="widget personal-info">
					<h3 class="widget-header user">Post your ads</h3>



					<form action="<?php echo isset($_GET['id']) ? "models/edit-post.php" :  "models/insert-post.php" ;?>" method="POST" enctype="multipart/form-data">
						<!-- TITLE -->
						<div class="form-group col-12 px-0">
						    <label for="title">Title <i class="fas fa-star-of-life"></i></label>
						    <input type="text" class="form-control" name="title" id="title" value="<?php echo isset($_GET['id']) ? $usr_post->title : '' ?>" />
						</div>
                        <?php if(!isset($_GET['id'])):?>
                            <div class="form-group col-12 px-0">
                                <label for="title">You tube Iframe tag (Optional)</label>
                                <input type="text" class="form-control" name="youtube" id="youtube" placeholder="Must use iframe youtube tag or video does't work!!!" value="" />
                            </div>
                        <?php endif?>
						<!-- STATE -->
                        <div class="col-12 row my-5 form-group">
                        
                            <label for="state" class="col-12 col-lg-4">State <i class="fas fa-star-of-life"></i></label>
                            <select id="state" name="state" class="col-12 col-lg-7">
                               <?php foreach($state as $el): ?>
                                        
                                           
                                                <option <?php if(isset($_GET['id'])) echo  $el->id == $usr_post->id_state ? "selected":"" ;?> value="<?=$el->id?>"><?=$el->state?></option>
                                        
                                
                               
                                    
                               <?php  endforeach?>
                            </select>

                        </div>
						<!-- PRICE STATUS -->

                        <div class="col-12 row my-5 form-group">
                        
                            <label for="price-status" class="col-12 col-lg-4">Price status  <i class="fas fa-star-of-life"></i></label>
                            <select id="price-status" name="price-status" class="col-12 col-lg-7">
                                <?php foreach($price_status as $el): ?>
                                      <option <?php if(isset($_GET['id'])) echo ($el->status == $usr_price_status->price_status) ? 'selected' : ""  ?>  value="<?=$el->id?>"><?=$el->status?></option>
                                    
                               <?php endforeach?>
                            </select>

                        </div>

                        <div class="col-12 row my-5 form-group">
                        
                            <label for="currency" class="col-12 col-lg-4">Currency  <i class="fas fa-star-of-life"></i></label>
                            <select   id="currency" name="currency" class="col-12 col-lg-7">
                                <?php foreach($curr as $el): ?>
                                      <option  <?php if(isset($_GET['id'])) if($usr_price)  echo $el->id == $usr_currency->id ? "selected":"" ?> value="<?=$el->id?>"><?=$el->currency?></option>
                                    
                               <?php endforeach?>
                            </select>

                        </div>

                        <div class="col-12 row my-5 form-group">
                        
                            <label for="price-status" class="col-12 col-lg-4">Price:  <i class="fas fa-star-of-life"></i></label>
                            <input  type="number" id="price" name="price" value="<?php echo isset($_GET['id']) && $usr_price != null ? $usr_price->price : '' ?>" />

                        </div>

						<!-- DELIVERY -->

                        <div class="col-12 row my-5 form-group">
                        
                            <label for="delivery" class="col-12 col-lg-4">Delivery  <i class="fas fa-star-of-life"></i></label>
                            <select id="delivery" name="delivery" class="col-12 col-lg-7">
                                <?php foreach($deliv as $el): ?>
                                      <option  <?php if(isset($_GET['id'])) echo $el->id == $usr_post->id_delivery ? "selected" : "" ;?>    value="<?=$el->id?>"><?=$el->delivery?></option>
                                    
                               <?php endforeach?>
                            </select>

                        </div>

                        <!-- CATEGORY -->

                        <div class="col-12 row my-5 form-group">
                        
                            <label for="category" class="col-12 col-lg-4">Category  <i class="fas fa-star-of-life"></i></label>
                            <select id="category" name="category" class="col-12 col-lg-7">
                            <?php foreach($cat as $el):?>
                               
                                  
                                      <option <?php if(isset($_GET['id'])) echo $el->id == $usr_category->id ? "selected" : ""  ; ?>   value="<?=$el->id?>"><?=$el->category?></option>
                               
                              <?php endforeach?>
                            </select>

                        </div>


                        <!-- SUBCATEGORY -->

                        <div class="col-12 form-group row my-5 form-group">
                        
                            <label for="subcategory" class="col-12 col-lg-4">Subcategory  <i class="fas fa-star-of-life"></i></label>
                            <select id="subcategory" name="subcategory" class="col-12 col-lg-7">
                                    
                                    
                                    
                               
                            </select>

                        </div>


                        <!--DESCRIPTION-->
                        <div class="form-group">
						    <label for="desc">Description <i class="fas fa-star-of-life"></i></label>
						    <textarea  class="form-control" name="desc"  value="" id="desc"> <?php echo isset($_GET['id']) ?  $usr_post->description : '' ?></textarea>
						</div>

                        <!--Images if editing ads-->
                        <?php if(isset($_GET['id'])):
                            
                            if(count($usr_images)>0): 
                                echo "<p>This is yout old photo:</p>
                                    <div class='row d-flex'>";
                                foreach($usr_images as $img):?>
                               
                                    <div class="col-12 col-md-6 col-lg-3 mb-3">
                                        <img class="img-fluid" src="<?=$img->src?>" alt="<?=$img->alt?>"/>
                                    </div>
                                


                        <?php endforeach;
                            echo "</div>";
                                endif;
                            endif;
                        ?>   

                        <!--END-->



						<!-- File chooser -->
						<div class="form-outline my-5"> 

                            <label class="text-center mb-0">Upload photos (Max 8 Mb). <small>Optional</small></label>
                            <div class="d-flex justify-content-center">
                                <div class="images">
                                    <div class="pic">
                                    add
                                    </div>
                                </div>
                            </div>
                            <input id="file" type="file" name="pic[]" accept="image/png, image/jpeg" multiple="multiple"/>
                            <?php if(isset($_GET['id'])) echo "<p class='mt-2'>If you do not upload a different imager, the old image is retained</p>";?>
                        </div>
                        <?php if(!isset($_GET['id'])):?>
                        <div class="col-12 form-group row my-5">
                                <p class="font-18 <?php  if($prepaid->prepaid > 0) echo  "text-success";else echo "text-danger";?>">You have <?=$prepaid->prepaid?> RSD credits </p>

                                
                        </div>
                        <?php endif?>
                         <!-- Promotions -->

                         <div class="col-12 form-group row my-5 form-group">
                        
                        <label for="promotions" class="col-12 font-20">Promotions: </label>
                           <!-- <select id="promotions" name="promotions" class="col-12">-->
                                    <div class="row">
                                        
                                        <?php
                                        if(!isset($_GET['id'])):
                                        foreach($promotions as $el):?>

                                        <div class="row mb-3 align-items-center">
                                            <input type="radio"  id="<?=$el->id?>" class="col-1 radio" name="promotions" value="<?=$el->id?>" /><p class="col-11 promo"><?=$el->promotion?> (<?=$el->description?>) duration: <?=$el->day_duration?> day and price = <?=$el->price?>RSD</p>
                                        </div>
                                        
                                        <?php endforeach?>

                                                <div class="row" id="nothing">
                                                <input type="radio" checkded id="nothing-radio" class="col-1 mb-2 radio" name="promotions" value="0" /><p class="col-11 mb-2 promo"> Nothing.</p>
                                                </div>
                                        <?php else:

                                         if($usr_promotion){
                                            foreach($promotions as $el): 
                                                if($el->id == $usr_promotion->promotion_id):?>
                                                
                                                    <div class="row mb-3 align-items-center">
                                                        <input type="radio" checked id="<?=$el->id?>" class="col-1 radio" name="promotions" value="<?=$el->id?>" /><p class="col-11 promo"><?=$el->promotion?> (<?=$el->description?>) duration: <?=$el->day_duration?> day and price = <?=$el->price?>RSD</p>
                                                        <p>Promotions cannot change!</p>
                                                    </div>
                                            <?php
                                                endif;
                                            endforeach;
                                        }else{?>

                                                <div class="row pl-5 mb-3 align-items-center" id="nothing">
                                                <input type="radio" checkded id="nothing-radio" class="col-1 mb-2 radio" name="promotions" value="0" /><p class="col-11 mb-2 promo"> Nothing.</p>
                                                <p>Promotions cannot change!</p>
                                                </div>
                                              
                                              
                                              <?php  
                                              
                                        };
                                            endif;
                                        
                                        
                                          ?>
                                       
                                    </div>

                            
                            <!--</select>-->

                         </div>
						
						
						
						<!-- Submit button -->

						<input type="submit" class="btn btn-transparent" id="submit" name="submit" type="submit" value="<?php echo isset($_GET['id']) ? "Save Changes" : "Go public"?>"/>
                        <p id="error" class="text-danger">
                            <?php
                                if(isset($_SESSION['error'])){
                                    echo $_SESSION['error'];
                            
                                }
                                ?>
                        </p>


                        <!-- end -->

                        <?php 

                            if(isset($_GET['id'])){
                                echo "<input type='hidden' name='post-id' value='".$id_post."' /> " ;

                            }

                        ?>



					</form>
				</div>
				
				
				
			</div>
		</div>
	</div>
</section>
<?php
   
?>
<style type="text/css">
</style>

<script type="text/javascript">

    window.addEventListener('load', (event) => {
        

        $("form").submit(function(event){
            
            if($("#title").val()=="" ){
                $("#error").html("Ttile are required field");
           
                event.preventDefault();
            }
            else if( $("#desc").val() == ""){
                $("#error").html("Description are required field");
                event.preventDefault();
            }else if($("#price").val() == "" && $("#price-status").val() != 4 ){
                $("#error").html("Price must not be empty");
                event.preventDefault();
            }
        })


        $("#price-status").on("change",function(){
            
            if($("#price-status").val() == 1 || $("#price-status").val() == 5){
       
                $("#currency").prop("disabled", false);
                $("#price").prop("disabled", false);

            }else{

                $("#currency").prop("disabled", true);
                $("#price").prop("disabled", true);
                
            }
            
        })


        if($("#price-status").val() == 1 || $("#price-status").val() == 5){
       
       $("#currency").prop("disabled", false);
       $("#price").prop("disabled", false);

        }else{

            $("#currency").prop("disabled", true);
            $("#price").prop("disabled", true);
            
        }

        $("#nothing-radio").prop("checked",true)

        <?php
        if(isset($_SESSION['error'])):?>
        $('html, body').animate({
            scrollTop: $('#error').offset().top - 600
        }, 10);

        <?php endif;
        unset($_SESSION['error']);
        ?>

        let id = $("#category").val();
            $.ajax({
                method:"GET",
                url:"models/get-subcategory.php?id="+id,
                dataType:"JSON",
                success:function(data){
                

                    <?php
                        if(isset($_GET['id'])){
                            echo "let currId = ".$usr_post->id_category . ";";
                        }
                    
                    ?>
                    html = "<option value='0'>Other</option>";
                    
                    for(let i=0; i<data.length; i++){
                        <?php
                        if(isset($_GET['id'])):?>
                          
                            if(currId == data[i].id)
                                html+=`<option selected value="${data[i].id}">${data[i].category}</option>`;
                            else html+=`<option  value="${data[i].id}">${data[i].category}</option>`;


                        <?php else:?>
                    
                        html+=`<option value="${data[i].id}">${data[i].category}</option>`

                        <?php endif?>

                    }
                    
                    $("#subcategory").html(html);
                },
                error:function(xhr){
                    //console.log("Error with page to display subcategories");
                    console.log(xhr.responseText);
                
                }
            })

        
    







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

    })


    document.getElementById("category").addEventListener("change",function(){
            
            let id = $("#category").val();
            $.ajax({
                method:"GET",
                url:"models/get-subcategory.php?id="+id,
                dataType:"JSON",
                success:function(data){
                   
                    html = "<option value='0'>Other</option>";
                    
                    for(let i=0; i<data.length; i++){
                   
                        html+=`<option value="${data[i].id}">${data[i].category}</option>`

                    }
                    
                    $("#subcategory").html(html);
                },
                error:function(xhr){
                    //console.log("Error with page to display subcategories");
                    console.log(xhr.responseText);
                
                }
            })
        })
</script>


<style type="text/css">
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
        /*border-radius: 50% !important;*/
        
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
        #desc{
            height: 120px;
        }
        .radio{
            max-height: 15px !important;
        }
        .promo{
            margin-bottom:  0px !important;
        }
        #nothing{
            width: 100% !important;
            display: flex;
            align-items: center;

        }
        #nothing>input{
            margin-bottom:0px !important;
        }
        
        @media screen and (max-width: 400px) {
        
        .images .img,
        .images .pic {
        /* flex-basis: 100%;*/
            margin-right: 0;
        }
        }
</style>



