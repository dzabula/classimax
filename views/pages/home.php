<?php
require_once("models/function.php");
if(isset($_SESSION['user'])){
	$id_user_log = $_SESSION['user']->id;
}else $id_user_log = "Ghost";

WriteLog($id_user_log,"home.php","None");

	$res = GetTopAds();
	$top_ads = $res['arr'];
	$num = $res['num'];

	$cat = GetAllCategoriesAndIcons();

	$cat_most_product = GetCategoriesWithMostProducts(4);


?>



<!--===============================
=            Hero Area            =
================================-->

<section class="hero-area bg-1 text-center overly">
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- Header Contetnt -->
				<div class="content-block">
					<h1>Buy & Sell Near You </h1>
					<p>Join the millions who buy and sell from each other <br> everyday in local communities around the world</p>
					<div class="short-popular-category-list text-center">
						<h2>PCategories with the most products</h2>
						<ul class="list-inline">
							<?php foreach($cat_most_product as $el):?>
							<li class="list-inline-item">
								<a href="index.php?page=category&id=<?=$el->id_parrent?>"><i class="<?=$el->icon ?>"></i> <?= GetCategoryForId($el->id_parrent)->category?></a>
							</li>
							<?php endforeach?>
						</ul>
					</div>
					
				</div>
				<!-- Advance Search -->
				<div class="advance-search">
					<form action="index.php?page=category" method="POST">
						<div class="row">
							<!-- Store Search -->
							<div class="col-lg-6 col-md-12 mb-2">
								<div class="block d-flex">
									<input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="name" name="name" placeholder="Search for store">
								</div>
							</div>
							<div class="col-lg-6 col-md-12">
								<div id="search-block" class=" d-md-flex justify-content-between">
                                    
                                    <select  class=" col-12 mb-3 col-md-6 p-2" name="id" id="id">
									<option value="0" selected>Other</option>	
									<?php foreach($cat as $i => $el):?>
                                        <option value="<?=$el->category_id?>" ><?=$el->category?></option>
                                       
										<?php endforeach?>
                                    </select>
                                    
									
                                    
									
									<!-- Search Button -->
									<button type="submit" class="btn btn-main mb-3 col-12 col-md-4 offset-md-1" id="search" name="search">SEARCH</button>
								</div>
							</div>
						</div>
					</form>
					
				</div>
				
			</div>
		</div>
	</div>
	<!-- Container End -->
</section>

<!--===================================
=            Client Slider            =
====================================-->


<!--===========================================
=            Popular deals section            =
============================================-->

<section class="popular-deals section bg-gray">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="section-title">
					<h2>Trending Ads</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quas, magnam.</p>
				</div>
			</div>
		</div>
		<div class="d-flex">
    		<div class="arr">
    		   <i id="arr-left" class="fas fa-arrow-left"></i>
    		</div>
    		<div class="d-flex" id="ovverflov">
    			<!-- offer 01 -->
    			<?php foreach($top_ads as $i => $el):
    
    					$likes = GetNumLikesForPost($el->id_user);	
    					
    					if($likes->num == 0){
    						$like =0;
    					}else
    					$like = ceil($likes->sam / $likes->num);
    			?>
    			<div class="item-scroll col-12 col-sm-12 col-lg-4 relative"><span class="d-flex align-items-center  justify-content-center badge bg-danger">TOP</span>
    				<!-- product card   -->
    
    
    				<div class=" product-item bg-light">
    					<div class="product-block card bg-promotion">
    						
    							<div class="thumb-content mx-auto py-4">
    								<!-- <div class="price">$200</div> -->
    								<a href="index.php?page=single&id=<?=$el->post_id?>">
    									<img class="card-img-top img-fluid " src="<?=$el->src?>" alt="<?=Shorter($el->description,20)?>"/>
    								</a>
    							</div>
    						
    						<div class="relative card-body">
    							<h4 class="card-title"><a href="index.php?page=single&id=<?=$el->post_id?>"><?=Shorter($el->description, 40)."  "?> (<?=$el->state?>)</a></h4>
    							<ul class="list-inline product-meta">
    								<li class="list-inline-item">
    									<a href=""><i class="fa fa-folder-open-o"></i><?= $el->category?></a>
    								</li>
    								<li class="list-inline-item">
    									<a href=""><i class="fa fa-calendar"></i><?= explode(" ",$el->date_created)[0]?></a>
    								</li>
    							</ul>
    							<p class="card-text">
    								<?php
    									$desc = Shorter($el->description, 150);
    									echo $desc;
    										
    								?>
    							</p>
    							<div class="product-ratings">
    								<p class="mb-0">Seller rating:</p>
    							
    								<ul class="list-inline">
    									<?php
    									if($like > 0):
    										for($i = 0 ; $i < 5 ; $i++):?>
    
    											<li class="list-inline-item <?php echo $i < $like ? "selected":""?> "><i class="fa fa-star"></i></li>
    									
    									<?php 
    										endfor;
    									endif;
    									
    									?>
    								</ul>
    							</div>
    							<div class=""><br/></div>
    							<div class="price">
    								<p class=" bold w-100 mt-2 mx-auto text-center">
    								<?php
    								$price = GetFullPriceForPost($el->post_id);
    								if($price->status == "Gift"){
    									echo "Gift";
    								}else{
    									echo $price->price." ".$price->currency;
    								}
    								
    								
    								?></p>
    							</div>
    						</div>
    					</div>
    				</div>
    
    
    
    			</div>
    			<?php endforeach?>
    		</div>
    		<div class="arr">
    		   <i id="arr-right" class="fas fa-arrow-right"></i>
    		</div>
    	</div>
	</div>
</section>



<!--==========================================
=            All Category Section            =
===========================================-->

<section class=" section">
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<div class="col-12">
				<!-- Section title -->
				<div class="section-title">
					<h2>All Categories</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis, provident!</p>
				</div>
				<div class="row">
					<!-- Category list -->

				<?php foreach($cat as $c):


					$sub_cat = GetSubCategoryAndNumberPost($c->category_id);

					?>

					<div class=" col-lg-3 offset-lg-0 col-md-5 offset-md-1 col-sm-6 col-12">
						<div class="category-block cat-card">
							<div class="header" >
								<!--<i class="fa fa-laptop icon-bg-1">--><i class="icon <?=$c->icon?>"></i></i></i> 
								<h4><?=$c->category?></h4>
							</div>
							<ul class="category-list" >
								<?php foreach($sub_cat as $el):?>
								<li><a ><?=$el->category?> <span><?=$el->num?></span></a></li>
								<?php endforeach?>
								
							</ul>
							<div class="d-flex justify-content-center see-all w-100">
								<a class="text-center text-primary" href="index.php?page=category&id=<?=$c->category_id?>">See All</a>
							</div>
						</div>
					</div> 

				<?php endforeach?>

					<!-- /Category List -->
					
				</div>
			</div>
		</div>
	</div>
	<!-- Container End -->
</section>



<script type="text/javascript">
    window.onload = () =>{
		<?php
			if(isset($_SESSION['notification'])):?>
				alert("<?=$_SESSION['notification']?>");
		<?php 	unset($_SESSION['notification']);
				endif?>

        console.log($("#ovverflov").offset().left);
        $("#ovverflov").offset().left = 500;
        console.log($("#ovverflov").offset().left);
        
        $("#arr-left").click(function(){
           
             let width = document.getElementsByClassName('item-scroll')[0].clientWidth
            let x = $("#ovverflov").scrollLeft() - width
            $("#ovverflov").scrollLeft(x)
          
        })	
        $("#arr-right").click(function(){
            let width = document.getElementsByClassName('item-scroll')[0].clientWidth
            let x = $("#ovverflov").scrollLeft() + width
            $("#ovverflov").scrollLeft(x)
            
           
          
        })	
		/*
			let id = $("#category").val();
            $.ajax({
                method:"GET",
                url:"models/get-subcategory.php?id="+id,
                dataType:"JSON",
                success:function(data){
                

                    <?php
                       /* if(isset($_GET['id'])){
                            echo "let currId = ".$usr_post->id_category . ";";
                        }*/
                    
                    ?>
                    html = "";
                   
                    for(let i=0; i<data.length; i++){
                        <?php
                        /*if(isset($_GET['id'])):?>
                          
                            if(currId == data[i].id)
                                html+=`<option selected value="${data[i].id}">${data[i].category}</option>`;
                            else html+=`<option  value="${data[i].id}">${data[i].category}</option>`;


                        <?php else:?>
                    
                        html+=`<option value="${data[i].id}">${data[i].category}</option>`*/

                        #<?#php //endif?>

                    /*}
                    
                    $("#subcategory").html(html);
                },
                error:function(xhr){
                    //console.log("Error with page to display subcategories");
                    console.log(xhr.responseText);
                
                }
            })

			*/
			/*$("#category").on("change",function(){

				let id = $("#category").val();
				console.log(id)

				if(id == '0'){
					$("#subcategory").html('<option value="0" selected>Other</option>');
				}else{

					$.ajax({
						method:"GET",
						url:"models/get-subcategory.php?id="+id,
						dataType:"JSON",
						success:function(data){
						
							
							html = '<option value="0" selected>Other</option>';
							
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


				}
			})*/
    }
</script>

<style type="text/css">

	.bg-promotion{
		background: rgb(210,215,26);
	background: linear-gradient(117deg, rgba(210,215,26,0.2024160005799195) 18%, rgba(202,224,11,0.17720591654630602) 30%, rgba(255,252,0,0.2752451322325805) 100%);
	}
	.cat-card{
			min-height: 350px !important;
	}
	.product-item{
		-webkit-box-shadow: 0px 4px 17px 0px rgba(78,64,140,0.44);
			-moz-box-shadow: 0px 4px 17px 0px rgba(78,64,140,0.44);
			box-shadow: 0px 4px 17px 0px rgba(78,64,140,0.44);
	}
	
	.bold{
		font-weight: bold;
	}
	#ovverflov{
	    overflow-x:auto;
	    overflow:hidden;
	}
	.arr{
	    display:flex;
	    justify-content:center;
	    align-items:center;
	    margin: 0 5px;
	}
	.arr>i{
	    font-size:28px;
	    color:#c1c1c1;
	}
	.arr>i:hover{
	    color:blue;
	}
	.top-ads-container{
	    /*display:block !important;*/
	    overflow-x:auto !important;
	    display:flex !important;
	}
	.top-ads-item{
	    display:inline-block !important;
	    flex:0 0 100% !important;
	    
	}
	.icon{
		font-size: 20px !important;
		height: 45px !important;
		width: 45px !important;
		line-height: 45px !important;
		color: white;
		background-color: #f874a8;
	}
	.height-300{
		height: 200px !important;
	}
	.product-block{
		min-height: 600px !important;
	}
	.badge{
		position: absolute !important;
		background-color: red;
		color: white !important;
		/*padding: 5px 15px 5px 15px !important;*/
		width: 40px;
		height: 40px;
		border-radius: 50% !important;
		top: 5px !important;
		left:25px;
		z-index: 2;
	}
	
	
    .category-block{
		position: relative;
		min-height: 400px !important;
	}

	.see-all{

		position: absolute;
		bottom: 10px;
		left: 0px;
	}
	.card-img-top{
		max-height: 230px !important;
	}
	.card-body{
		border-top: solid 1px #c2c2c2;
		
	}
	.price{
		width: 100%;
		position: absolute !important;
		bottom: 5px;
		left: 0px;
		margin: 0 auto;
	}
	@media only screen and (max-width: 766px) {
	.nice-select {
		width: 100%;
	}
	}	


	@media only screen and (max-width: 800px) {
		.cat-card{
			min-height: 250px !important;
		}
		.product-block{
			min-height: 550px !important;
		}

	}

</style>