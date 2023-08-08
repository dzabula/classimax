<?php
    if(!isset($_SESSION['user'])){
        
        header("Location: index.php?page=login");
        exit;
        
    }
    if($_SESSION['user']->role != "admin"){
        header("Location: index.php?page=login");
        exit;
    }
    require_once("models/admin/function.php");
    require_once("models/function.php");
    
    define("NUMBER_POST_DISPALY",10);
    
    $limit = 0;
    $all_requests = GetAllRequest($limit);
    
    
    
    $prepaid = GetPrepaid($_SESSION['user']->id);

    require_once("views/pages/dashboard/profile.php");





 
if(count($all_requests) > 0):
    ?>
    <div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
				<!-- Recently Favorited -->
				<div class="widget dashboard-container my-adslist">
					<h3 class="widget-header">Prepaid Request</h3>
					<table class="table table-responsive product-dashboard-table">
						<thead>
							<tr>
								<th>Image</th>
								<th >Name</th>
								<th>Date</th>
                              
								<th class="text-center">Prepaid</th>
								<th class="text-center">Action</th>
							</tr>
						</thead>
						<tbody>

                            <?php
                            foreach($all_requests as $e):
                            $el = GetUserForId($e['id']);

                            
                            
                            ?>
                   

							<tr class="ads-info" id="row-<?=$el->id?>">
								
								<td class="product-thumb">
                                    <div class="col-12 col-lg-3">
									    <img id="img-product"  src="<?=$el->src?>" alt="<?= substr(stripslashes($el->full_name),0,80)?>">
                                    </div>
                                </td>
								<td  class="product-details" >
									<div class="row">
                                        <h3 class="title col-12"><?= strlen($el->full_name) > 30 ?  Shorter($el->full_name,30)."..." : Shorter($el->full_name,30)?></h3>
									</div>
                                    
								</td>
                                <td>
                                 <div class="row">
									    <span ><?=$e['send']?> </span>
									</div>
                                </td>
                                
                              
                             
								<td class="product-category"><span class="categories" ><?php echo $e['prepaid']?>RSD</span></td>
								<td class="action" data-title="Action">
									<div class="px-2">
										<ul class="list-inline justify-content-center">
											<li class="list-inline-item mb-lg-0 mb-2">
												<a class="view pointer allow" id="cek-<?=$el->id?>" data="<?=$e['prepaid']?>">
                                                <i class="fas fa-check"></i>
												</a>		
											</li>
											<li class="list-inline-item mb-lg-0 mb-2">
												<a class="delete pointer" id="del-<?=$el->id?>">
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
                       <div id="empty-adses" class="col-lg-7 col-12"> <h4 class="text-center">No requests yet </h4></div>
                    <?php endif;?>
                    <div ><p class="text-danger " id="error"></p></div>
                    <div ><p class="text-success" id="success"></p></div>
<?php


$num_post = count(file("config/request_prepaid.txt"));

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
                            <li class="page-item active"><a class="page-link pointer" data-page="<?=$i?>" ><?=$i?></a></li>
                            <?php else:?>


							<li class="page-item"><a class="page-link pointer" data-page="<?=$i?>" ><?=$i?></a></li>
                           
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
    td{
            min-width: 120px !important;
        }
     th{
            min-width: 120px !important;
    }
    @media only screen and (max-width: 1200px) {
       
        td{
            min-width: 150px !important;
        }
        th{
            min-width: 150px !important;
        }
    }

</style>

<script type="text/javascript">

    window.addEventListener('load', (event) => {

        $(".page-link").click(function(){
         
            let limit =  $(this).attr("data-page") - 1;
            limit *= 10;

            

            $.ajax({
                method:"GET",
                dataType:"JSON",
                url:"models/admin/get-prepaid-request.php?limit="+limit,
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



    
        
        addAllEvents();


        
    })
    function WritePosts(data){
        let html =""
        console.log(data)
        for (var el of data) {
            
       
            html+=`


                <tr class="ads-info" id="row-${el.id}">
                    
                    <td class="product-thumb">
                        <div class="col-12 col-lg-3">
                            <img id="img-product"  src="${el.src}" alt="${el.full_name}">
                        </div>
                    </td>
                    <td  class="product-details" >
                        <div class="row">
                            <h3 class="title col-12">${el.full_name}</h3>
                        </div>
                        
                    </td>
                    <td>
                    <div class="row">
                            <span >${el.send}</span>
                        </div>
                    </td>
                    
                
                    <td class="product-category"><span class="categories">${el.prepaid} RSD</span></td>
                    <td class="action" data-title="Action">
                        <div class="px-2">
                            <ul class="list-inline justify-content-center">
                                <li class="list-inline-item mb-lg-0 mb-2">
                                    <a class="view pointer" id="cek-${el.id}">
                                    <i class="fas fa-check"></i>
                                    </a>		
                                </li>
                                <li class="list-inline-item mb-lg-0 mb-2">
                                    <a class="delete pointer" id="del-${el.id}">
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

            $(".delete").each(function(){

                $(this).click(function(){


                if(confirm("Are you sure to decnile request!?")){
                    let id = $(this).attr("id").substr(4,);
                    console.log(id)
                    
                    $.ajax({
                        method:"POST",
                        dataType:"JSON",
                        url:"models/admin/delete-request.php",
                        data:{
                            "id":id
                        },
                        success:function(data){
                            $("#error").html("");
                            $("#success").html("Successful delete!");
                            $("#row-"+id).remove();
                            if($("tr").length < 2 && $(".page-item").length == 1) {
                                $("#empty-adses").html('<h4 class="text-center">No requests yet </h4>');
                                $(".page-item:last-child").remove();
                                $("table").remove();
                            }
                            else if($("tr").length < 2 && $(".page-item").length > 1){
                                
                                $(".page-item:last-child").remove();
                            }
                        },
                        error: function(xhr){
                            $("#success").html("");
                           
                           $("#error").html(xhr.responseText);
                        }

                    })
                }
            })
            })


            $(".allow").each(function(){
                $(this).click(function(){


                if(confirm("Are you sure to allow request!?")){
                    let id = $(this).attr("id").substr(4,);
                    let prepaid = $(this).attr("data");

                   

                
                    
                    $.ajax({
                        method:"POST",
                        dataType:"JSON",
                        url:"models/admin/allow-request.php",
                        data:{
                            "id":id,
                            "prepaid":prepaid
                        },
                        success:function(data){
                            $("#error").html("");
                            $("#success").html("Successful!");
                            $("#row-"+id).remove();
                            if($("tr").length < 2 && $(".page-item").length == 1) {
                                $("#empty-adses").html('<h4 class="text-center">No requests yet </h4>');
                                $(".page-item:last-child").remove();
                                $("table").remove();
                            }
                            else if($("tr").length < 2 && $(".page-item").length > 1){
                                
                                $(".page-item:last-child").remove();
                            }
                        },
                        error: function(xhr){
                            $("#success").html("");
                           
                            $("#error").html(xhr.responseText);

                        }

                    })
                }
            })
        })



    }

</script>
