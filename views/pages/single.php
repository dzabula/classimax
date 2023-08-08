<?php

	require_once("models/function.php");
	$post = GetFullDataPostForId($_GET['id']);
	$cat = GetAllCategoriesAndIcons();

	if(isset($_SESSION['user']))
		$is_favorite = IsFavorite($post->post_id);
	else $is_favorite = false;

	if(isset($_SESSION['user'])){
		$id_user_log = $_SESSION['user']->id;
	}else $id_user_log = "Ghost";
	
	WriteLog($id_user_log,"single.php","Browsing single ads");

?>

<section class="page-search">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- Advance Search -->
				<div class="advance-search">
					<form action="index.php?page=category" method="POST">
						<div class="form-row">
							<div class="form-group col-12 col-lg-7">
								<input type="text" class="form-control" name="name" id="inputtext4" placeholder="What are you looking for">
							</div>
							
							<div id="subcategory-block" class="form-group col-12 col-lg-3 mt-3 mt-lg-0">
								<select class="form-control w-100" name="id" id="subcategoryy">
									<option value="0">Other</option>
								<?php foreach($cat as $i => $el):?>
                                        <option value="<?=$el->category_id?>" ><?=$el->category?></option>
                                       
								<?php endforeach?>
								</select>
							</div>
							<div class="form-group col-md-2">
								
								<button type="submit" class="btn btn-success mt-4 mt-lg-0">Search Now</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section bg-gray">
	<!-- Container Start -->
	<div class="container">
		<div class="row">
			<!-- Left sidebar -->
			<div class="col-lg-8">
				<div class="product-details">
				<div class="product-header">	
					<h1 class="product-title"><?=$post->title?></h1>
					<div class="product-meta">
						<ul class="list-inline">
							<li class="list-inline-item lli"><i class="  fa fa-user-o"></i> By: <a ><?php
							if(isset($_SESSION['user'])){
							
								
								if($_SESSION['user']->id == $post->user_id){
									 echo "You";
								}else{
									echo $post->full_name;
								}

							}else{
								echo $post->full_name;
							}
							?></a></li>
							<li class="list-inline-item lli"><i class="fa fa-folder-open-o"></i> Category:<a clas="pointer" href="index.php?page=category&id=<?=$post->id_parrent?>"><?php  $x = GetCategoryForId($post->id_parrent); echo $x == null ? $post->category : $x->category; ?></a></li>
							<li class="list-inline-item lli"><i class="fa fa-location-arrow"></i> Location:<a clas="pointer"><?=$post->city?></a></li>
							<li class="list-inline-item lli"><i class="fas fa-tools"></i> State:<a clas="pointer"><?=$post->state?></a></li>
							<li class="list-inline-item lli"><i class="fas fa-truck-loading"></i> Delivery:<a clas="pointer"><?=$post->delivery?></a></li>
							
						</ul>
					</div>

				</div>
					<div id="carouselExampleIndicators" class="product-slider carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
							<?php $img = GetImagesForPost($post->post_id);
								for($i=0; $i<count($img)-1 ; $i++):
							?>
							<li data-target="#carouselExampleIndicators" data-slide-to="<?=$i+1?>"></li>
							<?php endfor?>
						</ol>
						<div class="carousel-inner">
							<div class="carousel-item active">
								<img class="img-ads d-block " src="<?=$post->src?>" alt="<?= substr($post->description,0,20)?>"/>
							</div>
							<?php
							foreach($img as $i => $e):
								if($i != 0):
							?>
								<div class="carousel-item">
									<img class="img-ads d-block " src="<?=$e->src?>" alt="<?= substr($e->alt,20)?>"/>
								</div>
							<?php
							endif;
							endforeach;?>
						</div>
						<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
							<span class="carousel-control-prev-icon  bg-primary p-3 rounded-circle" aria-hidden="true"></span>
							<span class="sr-only">Previous</span>
						</a>
						<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
							<span class="carousel-control-next-icon primary bg-primary p-3 rounded-circle" aria-hidden="true"></span>
							<span class="sr-only">Next</span>
						</a>
					</div>
					<div class="content">
						<ul class="nav nav-pills  justify-content-center" id="pills-tab" role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Product Details</a>
							</li>
							<!--<li class="nav-item">
								<a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">Specifications</a>
							</li>-->
							<li class="nav-item">
								<a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-contact" role="tab" aria-controls="pills-contact" aria-selected="false">Reviews</a>
							</li>
						</ul>
						<div class="tab-content" id="pills-tabContent">
							<div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
								<h3 class="tab-title">Description</h3>
								<p id="desc">
									<?php
										echo $post->description;
									
									?>
								</p>
								<div class="d-flex justify-content-center">
									<?php
									
									if(isset($post->you_tube)){
										if($post->you_tube != null && strpos($post->you_tube, "<iframe") !== false){
									
											echo stripslashes($post->you_tube);
										}
									}
									?>
								</div>
								<p></p>
								
								
							</div>
							<!--
							<div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
								<h3 class="tab-title">Product Specifications</h3>
								<table class="table table-bordered product-table">
								  <tbody>
								    <tr>
								      <td>Seller Price</td>
								      <td>$450</td>
								    </tr>
								    <tr>
								      <td>Added</td>
								      <td>26th December</td>
								    </tr>
								    <tr>
								      <td>State</td>
								      <td>Dhaka</td>
								    </tr>
								    <tr>
								      <td>Brand</td>
								      <td>Apple</td>
								    </tr>
								    <tr>
								      <td>Condition</td>
								      <td>Used</td>
								    </tr>
								    <tr>
								      <td>Model</td>
								      <td>2017</td>
								    </tr>
								    <tr>
								      <td>State</td>
								      <td>Dhaka</td>
								    </tr>
								    <tr>
								      <td>Battery Life</td>
								      <td>23</td>
								    </tr>
								  </tbody>
								</table>
							</div>-->
							<?php		

									$comments = GetFullDataLikesForPost($post->user_id);

							?>
							<div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab">
								<h3 class="tab-title">Seler Review</h3>
								<div class="product-review">
									<div id="recnets">
										<?php 
										if(count($comments) == 0):
											echo "<p id='no-comm'>He has no reviews yet</p>";
										


										else:
										foreach($comments as $e):?>
										
										<div class="media" id="<?php if(isset($_SESSION['user'])){

										echo  $e->id_who == $_SESSION['user']->id ? "current-comm" : ""; 
										
										}?>">
										 <!-- Avater -->
											
											<img class="rounded-circle" src="<?=$e->src?>" alt="<?= substr($e->src,0,20)?>">
											
											<div class="media-body" >
												<!-- Ratings -->
												<div class="ratings">
													<ul class="list-inline">
														<?php for($i=0;$i<$e->stars; $i++):?>
														<li class="list-inline-item">
															<i class="fa fa-star"></i>
														</li>
														<?php endfor?>
													</ul>
												</div>
												<div class="name">
													<h5><?=$e->full_name?></h5>
												</div>
												<div class="date">
													<p><?= explode(" ",$e->date_created)[0]?></p>
												</div>
												<div class="review-comment">
													<p>
													<?=$e->message?>
													</p>
												</div>
												<div class="d-flex w-100 justify-content-center mt-3 ">
													<?php
													if(isset($_SESSION['user'])){
														echo $e->id_who == $_SESSION['user']->id  ? '<a class="delete-comment pointer text-danger mx-auto">Delete review.</a>':"";
													}
													?>
													</div>
											</div>
										</div>
										<?php endforeach;
										endif;?>
									</div>	
							  		<div class="review-submission">
							  			<h3 class="tab-title">Submit your review</h3>
						  				<!-- Rate -->
						  				<!--<div class="rate">
						  					<div id="starrr">
												<li class="list-inline-item">
							  							<i class="fa fa-star"></i>
							  						</li>
							  						<li class="list-inline-item">
							  							<i class="fa fa-star"></i>
							  						</li>
							  						<li class="list-inline-item">
							  							<i class="fa fa-star"></i>
							  						</li>
							  						<li class="list-inline-item">
							  							<i class="fa fa-star"></i>
							  						</li>
							  						<li class="list-inline-item">
							  							<i class="fa fa-star"></i>
							  						</li></div>
													</div-->
									<div class="widget rate">
						<!-- Heading -->
											<h5 class="widget-header text-center">What would you rate
											<br>
											this  seller</h5>
											<!-- Rate -->
											<div id="stars" class="starrr"></div>
										</div>

						  				<div class="review-submit">
						  					
						  						
						  						<div class="col-12">
						  							<textarea name="review" id="review" rows="10" class="form-control" placeholder="Comment"></textarea>
						  						</div>
						  						<div class="col-12">
						  							<button type="button"  id="submit" class="btn btn-main">Sumbit</button>
						  						</div>
						  					
						  				</div>
							  		</div>
							  	</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="sidebar">
					<div class="widget price text-center">
						<h4>Price:</h4>
						<?php 
							$price = GetFullPriceForPost($post->post_id);
						?>
						<p>
						<?php
							if($price->status == "Gift") echo "Gift";
							else{
								echo $price->price . "  ". $price->currency;
							} 
						?>
						</p>
					</div>
					<!-- User Profile widget -->
					
					<div class="widget user">
						<div class="w-100 d-flex justify-content-center">
							<img id="user-img" class="rounded-circle" src="<?=$post->user_img?>" alt="<?= substr($post->full_name,0,80)?>">
						</div>
						<h4 class="text-center"><a href="">
						<?php if(isset($_SESSION['user'])){
								
								if($_SESSION['user']->id == $post->user_id) echo "You";
								else echo $post->full_name;
							}else
								echo $post->full_name;
							
							?>
						</a></h4>
						<p class=" text-center member-time">Member Since <?= explode(" ",$post->user_created)[0]?></p>
						<!--<p class="text-center"><a class="text-center" href="">See all ads</a></p>-->
						<!--<ul id="phone-list" class="list-inline mt-20 d-flex justify-content-center">-->
							<?php
							$ph = GetAllPhonesForUser($post->user_id);	
							if(count($ph) > 0):?>
							<p class="text-center"><a  onclick="ShowPhone()" class=" pointer text-primary  btn-contact">Contact<br> (Click to show phone number)</a></p>
							<div id="phone">
							<ul>
							
							<?php	foreach($ph as $e):?>
								<li class="list-inline-item"><a href="tel:<?=$e->phone?>" class="btn text-primary btn-offer"><?=$e->phone?></a></li>
								<?php endforeach?>
							</ul>

							</div>
							<?php else:?>
							
							<p class=""><a href="" class=" btn-offer">He doesn't have a phone. Contact user with comment</a></p>

							<?php endif?>
						<!--</ul>-->
					</div>
				
					<div class="widget favorite p-0">
						<!-- Favorite Label -->
						<div class="placement d-flex justify-content-center align-items-center">
							<h6 class="text-favorite">Add to favorites</h6>	<div class="heart <?= $is_favorite ? "is-active" : "" ?>"></div>
						</div>
		
					</div>
					
					<!-- Coupon Widget -->
					<div class="widget coupon text-center">
						<!-- Coupon description -->
						<p>Have a great product to post ? Share it with
							your fellow users.
						</p>
						<!-- Submii button -->
						<a href="index.php?page=add-ads" class="btn btn-transparent-white">Submit Listing</a>
					</div>
					<!-- Rate Widget -->
					
					<!-- Safety tips widget -->
					<div class="widget disclaimer">
						<h5 class="widget-header">Safety Tips</h5>
						<ul>
							<li>Meet seller at a public place</li>
							<li>Check the item before you buy</li>
							<li>Pay only after collecting the item</li>
							<li>Pay only after collecting the item</li>
						</ul>
					</div>
					
					
				</div>
			</div>
			
		</div>
	</div>
	<!-- Container End -->
</section>
<input type="hidden"  id="id-user" value="<?=$post->user_id?>"/>
<input type="hidden"  id="id-post" value="<?=$post->post_id?>"/>
<input type="hidden"  id="src-user" value="<?= isset($_SESSION['user']) ? $_SESSION['user']->src : "empty"?>"/>
<input type="hidden"  id="full-name-user" value="<?= isset($_SESSION['user']) ? $_SESSION['user']->full_name : "empty"?>"/>


<style type="text/css">


	.heart {
	width: 100px;
	height: 110px;
	background: url("https://cssanimation.rocks/images/posts/steps/heart.png") no-repeat;
	background-position: 0 0;
	cursor: pointer;
	transition: background-position 1s steps(28);
	transition-duration: 0s;
		}
	.is-active {
		transition-duration: 1s;
		background-position: -2800px 0;
	}


	

	
	.text-favorite{
		color: #b80606;
		font-weight: bold;
	}
	
	textarea{
		height:150px !important;
	}
	.product-review .media-body{
		padding: 0px !important;
		padding-left: 7px !important;
	}
	.img-ads{
		max-height: 350px !important;
		margin: 0 auto !important;
	}
	#desc{
		white-space: pre-line !important;
		 line-height: 1.9 !important;
	}
	#phone{
		display: none;
	}
    #user-img{
		width: 150px !important;
	}
	#susubcategory-block>select{
		height: inherit !important;
	}
	select.form-control:not([size]):not([multiple]){
		height: calc(2.25rem + 14px) !important;
	}
	#subcategory-block>select>option,  #category-block>select>option{
		background-color: white;
		color:black;
	}
	.fs-11{
		font-size: 11px !important;
	}
	.pointer{
		cursor: pointer !important;
	}
	.product-header{
		padding: 15px 10px !important;
		background-color: #eaeaea !important;
	}
	@media only screen and (max-width: 600px) {
		#pills-tabContent{
			padding: 10px !important;
		}
		.img-ads{
			max-height: 200px !important;
		}
		.product-review img{
			width: 40px !important;
		}
		.lli{
		    display:block !important;
		    margin-bottom:10px !important;
		}
	}
	@media only screen and (max-width: 430px) {
		.img-ads{
			max-height: 150px !important;
		}
	}
</style>


<script type="text/javascript">
    window.onload = () =>{
		
       // $("#search-block").removeClass("d-none");
       $("#submit").on("click",function(){
			var stars = $("#stars .fa-star").length;
			var text = $("#review").val();
			var id = $("#id-user").val();
			var src = $("#src-user").val();
			var full_name = $("#full-name-user").val();

		
			if(stars == 0) stars = 1;

			$.ajax({
				method:"POST",
				url:"models/insert-like.php",
				dataType:"JSON",
				data:{
					"id":id,
					"stars":stars,
					"text":text
				},
				success:function(data){
					WriteLikes(text,stars,src,full_name);
					$("#review").val("");
					$("#stars .fa-star").each(function(){
						$(this).removeClass("fa-star");
						$(this).addClass("fa-star-o");
					})
				},
				error:function(xhr){
					
					alert(xhr.responseText);
				}
			})


			
	   })



	   $(function() {
			$(".heart").on("click", function() {
				$(this).toggleClass("is-active");
				let id = $("#id-post").val();
				AddDelFavorite(id);

			});
		});

		AddEvents();

    }
	function ShowPhone(){
		$("#phone-list").removeClass("d-flex");
		$("#phone-list").removeClass("justif-content-center");
			$("#phone").show()
	}
	function WriteLikes(text,stars,src,full_name){
		var html = "";
		
		var today = new Date();
	
		date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
		
			html+=`
									<div class="media" id="current-comm"}>
											<!-- Avater -->
											<img class="rounded-circle" src="${src}" alt="${full_name}">
											<div class="media-body">
												<!-- Ratings -->
												<div class="ratings">
													<ul class="list-inline">`
														 for(let i=0; i < stars; i++){
														html+=`<li class="list-inline-item">
																	<i class="fa fa-star"></i>
																</li>`
														 }
											html+=		`</ul>
												</div>
												<div class="name">
													<h5>${full_name}</h5>
												</div>
												<div class="date">
													<p>${date}</p>
												</div>
												<div class="review-comment">
													<p>
													${text}
													</p>
												</div>
												<div class="d-flex w-100 justify-content-center mt-3 ">
						
														<a class="delete-comment pointer text-danger mx-auto">Delete review.</a>
													
												</div>
											</div>
										</div>
			
			`
			var old = $("#recnets").html();
			$("#recnets").html(old + " " +html);	
			try{
			$("#no-comm").remove();
			}catch( e){
				console.log("");
			}
			AddEvents();				

		



	}
	function AddDelFavorite(id){

		$.ajax({
			method:"POST",
				url:"models/insert-favorite.php",
				dataType:"JSON",
				data:{
					"id":id,
				},
				success:function(data){
					

				},
				error:function(xhr){
					
					alert(xhr.responseText);
					$(".heart").removeClass("is-active");
				}
		})


	}
	function AddEvents(){

		$(".delete-comment").each(function(){
			$(this).click(function(){
				let id = $("#id-user").val();
				DeleteComments(id);
			})
		
		})
	}

	function DeleteComments(id){
		
	
		$.ajax({
			method:"POST",
				url:"models/delete-like.php",
				dataType:"JSON",
				data:{
					"id-whom":id
				},
				success:function(data){
					
					$("#current-comm").remove();


				},
				error:function(xhr){
					
					
					alert(xhr.responseText);
				}
		})
			
	}


	
</script>
