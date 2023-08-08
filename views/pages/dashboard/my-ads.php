<?php

if(!isset($_SESSION['user'])){
    header("Location: index.php?page=login");
    exit;
}
require_once("models/function.php");
WriteLog($_SESSION['user']->id,"dashboar.php","Browsing my ads");

define("NUMBER_POST_DISPALY",10);
$user_id = $_SESSION['user']->id;


$posts = UsersPostForId($user_id,0);




$prepaid = GetPrepaid($_SESSION['user']->id);




?>


    <?php require_once("profile.php");
    
    if(count($posts) > 0):
    ?>
    <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
				<!-- Recently Favorited -->
				<div class="widget dashboard-container my-adslist">
					<h3 class="widget-header">My Ads</h3>
					<table class="table table-responsive product-dashboard-table">
						<thead>
							<tr>
								<th>Image</th>
								<th colspan="2">Product</th>
								
								<th class="text-center">Category</th>
								<th class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>

                            <?php
                            foreach($posts as $el):
                   

                            $price = GetPriceForPost($el->post_id);
                            $price_status = GetPriceStatusForPost($el->post_id);
                            $currency = false;
                            $active = false;
                            $promotions = GetPromotionsForId($user_id,$el->post_id);
                            $days_left = false;
                          

                            if($price == null ){
                                $price = false;
                            }else{
                                $currency = GetCurrencyForPrice($price->id_currency)->currency;
                                $price = $price->price;
                            }
                            
                        

                            if($promotions == null){
                                $promotions = false;
                            }

                            if($promotions != false){

                                $date = new DateTime($promotions->date_end);
                                $timestamp = $date->getTimestamp();

                                $active = $timestamp > time();
                                
                                if($active){
                                    $days_left = $timestamp - time();
                                    $days_left = $days_left / 60 / 60 / 24;
                                    $days_left = floor($days_left);
                                }
                                


                            }




                            ?>
							<tr class="ads-info" id="row-<?=$el->post_id?>">
								
								<td class="product-thumb">
                                    <div class="col-12 col-lg-3">
									    <img id="img-product"  src="<?=$el->min_src?>" alt="<?= substr(stripslashes($el->description),0,80)?>">
                                    </div>
                                </td>
								<td colspan="2" class="product-details" >
									<div class="row">
                                        <h3 class="title col-12"><?= strlen($el->title) > 30 ?  Shorter($el->title,30)."..." : Shorter($el->title,30)?></h3>
									</div>
                                    <?php
                                        if($price_status->status != "Gift"){
                                            echo '<div class="row">';
                                            echo '<span class="add-id col-5">Price:</span><span class="col-7"> ';
                                            echo $price." ".$currency."</span></div>";
                                        }else{
                                            echo '<div class="row">';
                                            echo '<span class="add-id col-5">Price:</span><span class="col-7"> ';
                                            echo "Gift </span></div>";
                                        }
                                    ?>
                                    <div class="row">
									    <span class="col-5">Posted on: </span><span class="col-7"><?=$el->date_created?> </span>
									</div>
                                    <?php
                                        if($promotions){
                                            echo '<div class="row">';
                                            echo '<span class="location col-5">Promotion:</span><span class="col-7"> ';
                                            echo $promotions->promotion."</span></div>";

                                            if($active) echo '<div class="row"> <span class="status active col-lg-5 col-6">Active promo:</span><span class="col-lg-7 col-6"> YES</span></div>';
                                            else echo '<div class="row"> <span class="status active col-lg-5 col-6">Active promo:</span><span class="col-lg-7 col-6"> No</span></div>';

                                            if($active){
                                                echo '<div class="row"> <span class="location col-5">Promo expires:</span><span class="col-7">'.$days_left.' days left</span> </div>';
                                            }
                                            
                                        }
                                    ?>
                                    </span>
                                    
                                    </span>
									<div class="row">
                                        <span class="col-lg-5 col-6">Subcategory:</span><span class="col-lg-7 col-6 d-flex align-items-end"><?php echo $el->id_parrent != null ? $el->category : "Other" ?></span>
                                    </div>
								</td>
                               
                             
								<td class="product-category"><span class="categories"><?php echo $el->id_parrent != null ? GetCategoryForId($el->id_parrent)->category : $el->category?></span></td>
								<td class="action" data-title="Action">
									<div class="px-2">
										<ul class="list-inline justify-content-center">
											<li class="list-inline-item mb-lg-0 mb-2">
												<a class="view pointer" href="index.php?page=single&id=<?=$el->post_id?>">
													<i class="fa fa-eye"></i>
												</a>		
											</li>
											<li class="list-inline-item mb-lg-0 mb-2">
												<a class="edit pointer" href="index.php?page=add-ads&id=<?=$el->post_id?>" id="<?=$el->post_id?>">
													<i class="fa fa-pencil"></i>
												</a>		
											</li>
											<li class="list-inline-item mb-lg-0 mb-2">
												<a class="delete pointer" id="<?=$el->post_id?>">
													<i class="fa fa-trash"></i>
												</a>
											</li>
										</ul>
									</div>
								</td>
							</tr>
							<?php endforeach?>
						</tbody>
					</table>
                    <div id="empty-adses" class="col-lg-7 col-12">  </div>
                    <?php else:?>
                       <div id="empty-adses" class="col-lg-7 col-12"> <h4 class="text-center">You have no ads yet. <a class="text-primary" href="index.php?page=add-ads">Add ads now!</a></h4></div>
                    <?php endif?>
<?php


$num_post = (double)GetNumPost($_SESSION['user']->id);

$num_pagination = ceil($num_post / NUMBER_POST_DISPALY);




?>
                    <div class="pagination justify-content-center">

					<nav aria-label="Page navigation example">
						<ul class="pagination">
							<!--<li class="page-item">
								<a class="page-link" href="#" aria-label="Previous">
									<span aria-hidden="true">&laquo;</span>
									<span class="sr-only">Previous</span>
								</a>
							</li>-->
                            <?php for($i=1;$i<=$num_pagination;$i++):
                            if($i == 1):
                            ?>
                            <li class="page-item active"><a class="page-link" data-page="<?=$i?>" ><?=$i?></a></li>
                            <?php else:?>


							<li class="page-item"><a class="page-link" data-page="<?=$i?>" ><?=$i?></a></li>
                           
							<?php 
                            endif;
                            endfor?>
						</ul>
					</nav>
				</div>
					
				</div>
			</div>
		</div>
		<!-- Row End -->
	</div>
	<!-- Container End -->
</section>
<style type="text/css">
    #img-product{
        width:100px;
    }
    .pointer{
        cursor: pointer;
    }
    @media only screen and (max-width: 1200px) {
       
        td{
            min-width: 210px !important;
        }
        th{
            min-width: 210px !important;
        }
    }

</style>

<script type="text/javascript">
    window.onload = () =>{


        
        addAllEvents();


        $(".page-link").click(function(){
            let limit =  $(this).attr("data-page") - 1;
            limit *= 10;

            

            $.ajax({
                method:"GET",
                dataType:"JSON",
                url:"models/get-users-post.php?limit="+limit,
                success:function(data){
                    WritePosts(data);
                    
                },
                error: function(xhr){
                    alert(xhr.responseText)
                }

            })

            $(".page-link").each(function(){
                
                $(this).parent().removeClass("active");
                if($(this).attr("data-page") - 1 == limit/10){
                    $(this).parent().addClass("active");
                }
            })





        })
    }

    function WritePosts(posts){
        let html =""

        for (var el of posts) {
            
       
            html+=`
            <tr id="row-${el.post_id}">
								
								<td class="product-thumb">
                                    <div class="col-12 col-lg-3">
									    <img id="img-product"  src="${el.min_src}" alt="${el.description.substring(0,80)}"/>
                                    </div>
                                </td>
								<td class="product-details" colspan="2">
									<div class="row">
                                        <h3 class="title col-12">${ el.title.length > 30 ? el.title.substring(0,30)+"..." : el.title}</h3>
									</div>`
                                       
                                        if(el.d_price){
                                            html+= '<div class="row">';
                                            html+= '<span class="add-id col-4">Price:</span><span class="col-8"> ';
                                            html+= el.d_price +" "+ el.d_currency.currency + "</span></div>";
                                        }else{
                                            html+= '<div class="row">';
                                            html+= '<span class="add-id col-4">Price:</span><span class="col-8"> ';
                                            html+= "Gift</span></div>";
                                        }
                                    html+=`
                                    <div class="row">
									    <span class="col-4">Posted on: </span><span class="col-8">${el.date_created} </span>
									</div>`
                                    
                                        if(el.d_promotions){
                                            html+= '<div class="row">';
                                            html+= '<span class="location col-4">Promotion:</span><span class="col-8"> ';
                                            html+= el.d_promotions.promotion + "</span></div>";

                                            if(el.d_active) html+= '<div class="row"> <span class="status active col-lg-4 col-5">Is active:</span><span class="col-lg-8 col-6"> YES</span></div>';
                                            else html+= '<div class="row"> <span class="status active col-lg-4 col-5">Is active:</span><span class="col-lg-8 col-6"> No</span></div>';

                                            if(el.d_active){
                                                html+= '<div class="row"> <span class="location col-4">Left:</span><span class="col-8">'+ el.d_days_left +' days</span> </div>';
                                            }
                                            
                                        }
                                        html+=`
                                    </span>
                                    
                                    </span>
                                    `
                                    if(el.d_master_category){
                                       html+=` <div class="row">
                                            <span class="col-lg-4 col-5">Subcategory: </span><span class="col-lg-8 col-7 d-flex align-items-end"> ${el.category}</span>
                                        </div>`
                                    }
								html+=`</td>
                              
								<td class="product-category"><span class="categories">`
                              
                                if(el.d_master_category){
                                    html+= el.d_master_category.category;
                                }else{
                                    html+= el.category;
                                }
                                
                                html+=`</span></td>
                                <td class="action" data-title="Action">
									<div class="px-2">
										<ul class="list-inline justify-content-center">
											<li class="list-inline-item mb-lg-0 mb-2">
												<a class="view pointer" href="index.php?page=single&id=${el.post_id}">
													<i class="fa fa-eye"></i>
												</a>		
											</li>
											<li class="list-inline-item mb-lg-0 mb-2">
												<a class="edit pointer" id="${el.post_id}">
													<i class="fa fa-pencil"></i>
												</a>		
											</li>
											<li class="list-inline-item mb-lg-0 mb-2">
												<a class="delete pointer" id="${el.post_id}">
													<i class="fa fa-trash"></i>
												</a>
											</li>
										</ul>
									</div>
								</td>
							</tr>
                            `
        }
        $("tbody").html(html);
        addAllEvents();

    }


    function addAllEvents(){
            $(".delete").click(function(){


                if(confirm("Are you sure to delete!?")){
                    let id = $(this).attr("id");
                    
                    $.ajax({
                        method:"GET",
                        dataType:"JSON",
                        url:"models/delete-post.php?id="+id,
                        success:function(data){

                            $("#row-"+id).remove();
                            if($("tr").length < 2 && $(".page-item").length == 1) {
                                $("#empty-adses").html('<h4 class="text-center">You have no ads yet. <a class="text-primary" href="index.php?page=add-ads">Add ads now!</a></h4>');
                                $(".page-item:last-child").remove();
                                $("table").remove();
                            }
                            else if($("tr").length < 2 && $(".page-item").length > 1){
                                
                                $(".page-item:last-child").remove();
                            }
                        },
                        error: function(xhr){
                            alert(xhr.responseText)
                        }

                    })
                }
            })
        }

</script>