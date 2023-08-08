
<?php
require_once("models/function.php");

if(isset($_SESSION['user'])){
	$id_user_log = $_SESSION['user']->id;
}else $id_user_log = "Ghost";

WriteLog($id_user_log,"category.php","Browsing all ads on site");

	$res = GetTopAds();
	$top_ads = $res['arr'];
	$num = $res['num'];

	$cat = GetAllCategoriesAndIcons();

	$limit = 0;

	$res = GetAllAds($limit);
	$all_ads = $res['arr'];
	
	
	$num = $res['num'];
	$num_pag = ceil((int)$num / 12);


	$cities = GetAllCities();
	$deliveries = GetAllDelivery();
	$states = GetAllStates();
	$states = GetAllStates();

	$categories = GetAllCategories();

	$all_currency = GetAllCurrency();
	

	


?>
<section class="page-search">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<!-- Advance Search -->
				<div class="advance-search">
					
						<div class="form-row">
							<div class="form-group col-lg-7">
								<input type="text" class="form-control" id="input-serach" placeholder="What are you looking for">
							</div>
							
							<div class="form-group offset-lg-2 col-lg-2 d-flex align-items-center">
								
								<button type="button" id="search" class="btn btn-success mt-4 mt-lg-0">Search Now</button>
							</div>
						</div>
					
				</div>
			</div>
		</div>
	</div>
</section>
<section class="section-lg mb-5">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 mt-3">
				<div id="search-result" class="search-result bg-gray d-none mb-3">
					
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-3">
				<div class="category-sidebar">
					<div class="widget category-list">
	<h4 class="widget-header">All Category</h4>
	<ul class="category-list">
		
	<?php foreach($categories as $el):
		
		$ck = "";
		if(isset($_GET['id'])){
			if($el->id == $_GET['id']){
				$ck = "checked";
			}
		}else if(isset($_POST['id'])){
			if($el->id == $_POST['id']){
				$ck = "checked";
			}
		}
		
		
		?>
		<li>
			<div class="form-check d-flex">
				<label class="form-check-label col-11">
					<input class="form-check-input ck-category ck" <?=$ck?>  type="checkbox" value="<?=$el->id?>"/>
					<span><?=$el->category?></span>
				</label>
				<div class="fs-11 d-flex justify-content-end align-items-end col-1 px-0"><?=GetNumPostForCategory($el->id)?></div>
			</div>

		</li>
	<?php endforeach?>
	</ul>
</div>


<div class="widget category-list">
	<h4 class="widget-header">City</h4>
	<ul class="category-list">

									
		<?php foreach($cities as $el):?>
		<li>
			<div class="form-check d-flex">
				<label class="form-check-label col-10">
					<input class="form-check-input ck-city ck" type="checkbox" value="<?=$el->id?>"/>
				<span><?=$el->city?></span>
				</label>
			</div>
		</li>
		<?php endforeach?>
		
	</ul>
</div>



<div class="widget price-range">
	<h4 class="widget-header">Price:</h4>
	<div class="form-check d-block ml-0">
		<label class="form-check-label ml-0">
			<input class="form-check-input" checked  class="col-12 ml-0 ck" id="gift" type="checkbox" value="1"/>
			 <span>Gift</span>
		</label>
	</div>

	<div class="row form-gorup">
		<select name="curr" class=" col-12 p-2" id="curr">
			<?php foreach($all_currency as $el):?>
			<option selected value="<?=$el->currency?>"><?=$el->currency?></option>
			<?php endforeach?>
		</select>
			
		<div class="d-block mt-5 col-12">
			<b>0 -</b><b id="display-val">5 000 000 </b>
			<input class="d-block w-100 " type="range" name="range" id="range" step="5000"  min="5000" value="5000000" max="5000000"/>
		</div>
	
	</div>
	<!--<p>
		<label for="amount">Price range:</label>
		<input id="amount" type="text" class="span2" /> 
	</p>
	<div id="slider-range"></div>-->
</div>

<div class="widget product-shorting">
	<h4 class="widget-header">By Condition</h4>

	
	<?php foreach($states as $el):?>

		<div class="form-check mb-20">
		<label class="form-check-label">
			<input class="form-check-input ck-condition ck" type="checkbox" value="<?=$el->id?>"/>
			<span>	<?=$el->state?> </span>
		</label>
		</div>

	<?php endforeach?>

</div>

<div>
	<button id="filtrate" class="btn btn-primary mb-5">Filtrate</button>
</div>

				</div>
			</div>
			<div class="col-lg-9 relative">
				<div class="category-search-filter">
					<div class="row">
						<div class="col-lg-8 col-12 mb-3 d-flex align-items-center">
							<div class="container d-flex align-items-center">
								<strong class="col-3">Short</strong>
								<select class="col-8 p-2" id="sort" onchange="Filter()">
									<option value="1">Highest Raiting</option>
									<option value="2">Lowest Raiting</option>
								</select>
							</div>
						</div>
						<div class="col-md-4 col-12 d-flex justify-content-start mb-3">
							<div id="view" class="view ">
								<strong>Views</strong>
								<ul class="list-inline view-switcher">
									<li class="list-inline-item">
										<a id="tree-col"><i class="fa fa-th-large"></i></a>
									</li>
									<li class="list-inline-item">
										<a id="one-col"><i class="fa fa-reorder"></i></a>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
				<div class="product-grid-list mb-5">
			<div id="all-ads-display" class="row mt-30">
				<?php 
				if(!isset($_GET['id']) && !isset($_POST['id'])):
				foreach($all_ads as $i => $el):
						
						$likes = GetNumLikesForPost($el->id_user);	

						if($likes == null){
							$like =0;
						}else if($likes->num != 0){
							$like = ceil($likes->sam / $likes->num);
						}else{
							$like = 0;
						}
					?>


<div class="ads col-sm-12 col-lg-6 col-md-6">
							<!-- product card -->
	<div class="product-item bg-light">
		<div class=" product-block card <?php echo $el->promotion == "On top" ? "bg-promotion" : ""?>">
			<div class="thumb-content mx-auto pt-4">
				<!-- <div class="price">$200</div> -->
				<a href="index.php?page=single&id=<?=$el->post_id?>">
					<img class="card-img-top img-fluid" src="<?=$el->min_src?>" alt="<?= Shorter($el->description,20)?>" />
				</a>
			</div>
			<div class="card-body relative">
				<h4 class="card-title"><a href="index.php?page=single&id=<?=$el->post_id?>"><?php echo Shorter($el->title,30) . " (".$el->state.")" ?></a></h4>
				<ul class="list-inline product-meta">
					<li class="list-inline-item">
						<a href=""><i class="fa fa-folder-open-o"></i><?= $el->category?></a>
					</li>
					<li class="list-inline-item">
						<a href=""><i class="fa fa-calendar"></i><?= explode(" ",$el->date_created)[0]?></a>
					</li>
				</ul>
				<p class="card-text mb-5">
				<?php
					$desc = Shorter($el->description, 80);
					echo $desc;
											
				?>
				</p>
				<div class="py-2"></div>
				<div class="price">
    				<div class="product-ratings">
    					<?php if($like > 0):?>
    					<p class="mb-0">Seller rating:</p>
    					<ul class="list-inline">
    						<?php
    						
    							for($i = 0 ; $i < 5 ; $i++):?>
    
    								<li class="list-inline-item <?php echo $i < $like ? "selected":""?> "><i class="fa fa-star"></i></li>
    						
    						<?php 
    							endfor;?>
    							</ul>
    					
    						
    						<?php	endif; ?>
    				
    				</div>
    				<div>
    					<p class="bold text-center mt-2">
    						<?php
    						$price = GetFullPriceForPost($el->post_id);
    
    						if( $price->status == "Gift" ){
    							echo "Gift";
    						}else{
    							echo $price->price." ".$price->currency;
    						}
    						
    						
    						?>
    					</p>
    				</div>
    			</div>	
			</div>
		</div>
	</div>
</div>
<?php endforeach;
		endif;
?>


					</div>
				</div>
	
		
				<div id="pagination-block" class="mx-auto w-75  pagination justify-content-center">
					<nav aria-label="Page navigation example mt-5">
						<ul class="pagination mt-5">
							

							<?php for($i = 0 ; $i < $num_pag; $i++):?>

							
								<li class="page-item <?php echo $i == 0 ? "active":"" ?>"><a class="page-link pointer" data-page="<?=$i?>" ><?=$i+1?></a></li>
							<?php endfor?>
						</ul>
					</nav>
				</div>
			</div>
		</div>
	</div>
</section>

<style type="text/css">

	#susubcategory-block>select{
		height: inherit !important;
	}
	
	select.form-control:not([size]):not([multiple]){
		height: calc(2.25rem + 14px) !important;
	}
	#subcategory-block>select>option, #category-block>select>option {
		background-color: white !important;
		color:black;
	}
	.fs-11{
		font-size: 11px !important;
	}
	.bg-promotion{
		background: rgb(210,215,26);
	background: linear-gradient(117deg, rgba(210,215,26,0.2024160005799195) 18%, rgba(202,224,11,0.17720591654630602) 30%, rgba(255,252,0,0.2752451322325805) 100%);
	}
	.cat-card{
		min-height: 400px !important;
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
		min-height: 450px !important;
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
	.thumb-content{
		display: flex;
		justify-content: center !important;
		align-items: center;
		width: 150px;
		height: 150px;
	}
	.product-item{
		-webkit-box-shadow: 0px 4px 17px 0px rgba(78,64,140,0.44);
			-moz-box-shadow: 0px 4px 17px 0px rgba(78,64,140,0.44);
			box-shadow: 0px 4px 17px 0px rgba(78,64,140,0.44);
	}
	.font-15{
		font-size: 15px !important;
	}
	#amount{
		border:0; color:#f6931f; font-weight:bold;
	}

	.img-fluid{
		max-height: 150px !important;
	}

	#pagination-block{
		bottom: 0px;
		position: absolute ;
		bottom: 0px;
	}
	.price{
		position: abosulte  !important;
		bottom: 5px;
		width: 100%;
		left: 0px;
	}

	@media only screen and (max-width: 800px) {
		.cat-card{
			min-height: 250px !important;
		}
		#view{
			display: none;
		}
		.form-check{
			margin-bottom: 20px;
		}
		.form-check-label>span{
			margin-left: 35px !important;
		}
		label{
			display: flex !important;
			justify-content: between;
		}
		.ck{
			height:25px !important;
			width: 25px !important;
			margin-right: 25px;
			margin-bottom: 20px !important;
		}
		.mb-20{
			margin-bottom: 20px !important;
		}

	}

</style>


  <script type="text/javascript">
    window.onload = () =>{
       // $("#search-block").removeClass("d-none");
		localStorage.setItem("pagination",0);

/*
	$("#category").on("change",function(){

			let id = $("#category").val();
			

			if(id == '0'){
				$("#subcategory").html('<option value="0" selected>Other</option>');
			}else{

				$.ajax({
					method:"GET",
					url:"models/get-subcategory.php?id="+id,
					dataType:"JSON",
					success:function(data){
					
						
						html = '<option value="0" selected>Other</option>';
						
						for(let i=0; i< data.length; i++){
					
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


		})
*/

	
	
	
	
	
	$("#search").on("click",function(){
	    Filter(0);
	   setTimeout(function(){
            $('html, body').animate({
                scrollTop: $('#all-ads-display').offset().top - 240
            }, 'slow');},200);
	});


	$(".page-link").click(function(){
		let val = $(this).attr("data-page");
		localStorage.setItem("pagination",val);
		Filter(val*12);



	})


	$("#range").on("change",function(){
		let val  = $(this).val();
		
		$("#display-val").html(val);

	})



	//javascript:void(0);
	$("#one-col").click(function(){
		$(".ads").removeClass("col-sm-12")
		$(".ads").removeClass("col-lg-6")
		$(".ads").removeClass("col-md-6")
		$(".ads").addClass("col-12");
		$("#tree-col").css("color","black");
		$(this).css("color","blue");

	})

	$("#tree-col").click(function(){
		$(".ads").removeClass("col-12");
		$(".ads").addClass("col-sm-12");
		$(".ads").addClass("col-lg-6");
		$(".ads").addClass("col-md-6");
		$("#one-col").css("color","black");

		$(this).css("color","blue");


	})




	$("#filtrate").on("click",function(){Filter(0)});
	<?php
	if(isset($_POST['name'])){
		echo '$("#input-serach").val("'.$_POST['name'].'");';
		echo "Filter(0)";
	}else if(isset($_GET['id'])){
		echo "Filter(0);";
	}
	?>
			
}

function AddPaginationEvent(){
	$(".page-link").click(function(){
		let val = $(this).attr("data-page");
		localStorage.setItem("pagination",val);
		Filter(val*12);



	})
}

function Filter(limit){

	var cities = []
	 $(".ck-city").each(function(){
		if($(this).prop("checked")){
			cities.push($(this).val());
		}
	})

	var categories = []
	 $(".ck-category").each(function(){
		if($(this).prop("checked")){
			categories.push($(this).val());
		}
	})

	var condition = []
	 $(".ck-condition").each(function(){
		if($(this).prop("checked")){
			condition.push($(this).val());
		}
	})
	var curr = $("#curr").val();

	var price = parseFloat($("#range").val());

	var gif = 0;

	if($("#gift").prop("checked")){
		 gif = 1;
	}
	
	let sort =  $("#sort").val();

	let search = $("#input-serach").val();
	
	$.ajax({
		method:"POST",
		url:"models/get-filter-post.php",
		dataType:"JSON",
		data:{
			"limit":limit,
			"search":search,
			"sort":sort,
			"gift" : gif,
			"curr":curr,
			"cities":cities,
			"categories":categories,
			"conditions":condition,
			"price":price
		},
		success:function(data){
			WritePosts(data)
		},
		error:function(xhr){
			console.log(xhr.responseText);
		}
	})

}

function WritePosts(response){
	
	var num = response.num
	var data = response.result;


	
	
	

	$("#all-ads-display").html("");
	
	if(data.length == 0){
		html = "<p>No items were found</p>";
		$("#all-ads-display").html(html);

		$("#pagination-block").html("");

	}else{
		for(var t = 0 ; t < data.length; t++){
			html =`
				<div class="ads col-sm-12 col-lg-6 col-md-6">
											<!-- product card -->
					<div class="product-item bg-light">
						<div class=" product-block card ${ data[t].promotion == "On top" ? "bg-promotion" : ''}">
							<div class="thumb-content mx-auto pt-4">
								<!-- <div class="price">$200</div> -->
								<a href="index.php?page=single&id=${data[t].post_id}">
									<img class="card-img-top img-fluid" src="${data[t].min_src}" alt="${data[t].description.substring(0,20)}" />
								</a>
							</div>
							<div class="card-body relative">
								<h4 class="card-title"><a href="index.php?page=single&id=${data[t].post_id}">${data[t].title.length > 30 ? data[t].title.substring(0,30)+"..." : data[t].title.substring(0,30)}  (${data[t].state})</a></h4>
								<ul class="list-inline product-meta">
									<li class="list-inline-item">
										<a ><i class="fa fa-folder-open-o"></i>${data[t].category}</a>
									</li>
									<li class="list-inline-item">
										<a ><i class="fa fa-calendar"></i>${data[t].date_created.split(" ")[0]}</a>
									</li>
								</ul>
								<p class="card-text mb-4">
								${data[t].description.length > 80 ? data[t].description.substring(0,80) + "..." : data[t].description.substring(0,80)} 
								</p>
								<div class="py-2"></div>
								<div class="price">
								<div class="product-ratings">
								`
								if(data[t].stars !=null){
									html+=`
									<p class="mb-0">Seller rating:</p>
									<ul class="list-inline">`
										
											if(data[t].stars.length > 0){
												for(let i = 0 ; i < 5 ; i++)
													html+=`<li class="list-inline-item ${ i < data[t].stars ? "selected":''} "><i class="fa fa-star"></i></li>`;
											}
										

									html+=	`
									</ul>`
									}
							html+=	`</div>
								<div>
									<p class="bold text-center mt-2">`
										
										

										if( data[t].status == "Gift" ){
											html +="Gift";
										}else{
											html += ` ${data[t].price}  ${data[t].currency} `;
										}
										
										
									`
									</p>
								</div>
								</div>
							</div>
						</div>
					</div>
				</div>
		
	`
		let old = $("#all-ads-display").html();
		$("#all-ads-display").html(old + html);

		}

	
	}


		if($("#input-serach").val() != ""){
			let val = $("#input-serach").val();
			$("#search-result").html(`<h2>Results For "${val}"  <span class="font-15">${num} results</span></h2>`);
			$("#search-result").removeClass("d-none");
		}else{
			$("#search-result").html("");
			$("#search-result").addClass("d-none");
		}

	
		WritePagination(num);
}

function WritePagination(num){

	
	if(num == 0){
		html = ` <nav aria-label="Page navigation example">
						<ul class="pagination"></ul>
			</nav>`
	}else{

		html=` <nav aria-label="Page navigation example">
							<ul class="pagination">`
			current = localStorage.getItem("pagination");

			num = Math.ceil(parseInt(num) / 12);

			for(let i = 0 ; i < num; i++){

			
				html+=`<li class="page-item ${current == i ? "active":"" }"><a class="page-link pointer" data-page="${i}" >${i+1}</a></li>`
			}


		html+=`</ul>
				</nav>`

	
	}
	$("#pagination-block").html(html);

	AddPaginationEvent();
}



</script>



