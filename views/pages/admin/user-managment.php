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
    

  
    
    
    
    $prepaid = GetPrepaid($_SESSION['user']->id);

    require_once("views/pages/dashboard/profile.php");


    $arr = GetAllUsers();
    $users = $arr['users'];
    $number = $arr['num'];




 
if(count($users) > 0):
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
                              
								<th class="text-center">Number Of Posts</th>
								<th class="text-center">Ban/ReBan</th>
							</tr>
						</thead>
						<tbody>

                            <?php
                            foreach($users as $el):
                          

                            
                            
                            ?>
                   

							<tr class="ads-info" id="row-<?=$el->id?>">
								
								<td class="product-thumb">
                                    <div class="col-12 col-lg-3">
									    <img id="img-product"  src="<?=$el->src?>" alt="<?= substr(stripslashes($el->full_name),0,80)?>">
                                    </div>
                                </td>
								<td  class="product-details" >
									<div class="row">
                                        <h3 class="title col-12"><?= strlen($el->full_name) > 30 ?  Shorter($el->full_name,30)."..." : Shorter($el->full_name,30)?><br/>(<?=$el->role?>)</h3>
									</div>
                                    
								</td>
                                <td>
                                 <div class="row">
									    <span ><?=$el->date_created?> </span>
									</div>
                                </td>
                                
                              
                             
								<td class="product-category"><span class="categories" ><?php echo GetNumPost($el->id)?></span></td>
								<td class="action" data-title="Action">
									<div class="px-2">
										<ul class="list-inline justify-content-center">
											<li class="list-inline-item mb-lg-0 mb-2">
                                                <button class="btn btn-danger pointer ban" data="<?=$el->active?>" id="<?=$el->id?>">
												
                                                <?=$el->active == 1 ? "Ban" :"Reban"?>
													
                                                </button>	
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
                       <div id="empty-adses" class="col-lg-7 col-12"> <h4 class="text-center">No    users yet </h4></div>
                    <?php endif;?>
                    <div ><p class="text-danger " id="error"></p></div>

                    <a href="models/export/exp_users.php"><button class="btn btn-outline-primary mt-5" >Download Users Data</button></a>
              
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

       
        addAllEvents();

    })


    function addAllEvents(){

            $(".ban").each(function(){

                $(this).click(function(){


                if(confirm("Are you sure to continue!?")){
                    let id = $(this).attr("id");
                    active = $(this).attr("data");
                    
                    
                    $.ajax({
                        method:"POST",
                        dataType:"JSON",
                        url:"models/admin/ban-user.php",
                        data:{
                            "id":id,
                            "active":active
                        },
                        success:function(data){
                            $("#error").html("");
                            $("#success").html(data.text);
                            if(active == 1){
                                $("#"+id).attr("data", 0);
                                $("#"+id).html("Reban");
                            }else{
                                $("#"+id).attr("data", 1);
                                $("#"+id).html("Ban");
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
