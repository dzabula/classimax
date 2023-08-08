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
    

    
    
    
    $promotions = GetAllPromotions();
    $prepaid = GetPrepaid($_SESSION['user']->id);
    require_once("views/pages/dashboard/profile.php");


?>


<div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
				<!-- Recently Favorited -->
				<div class="widget dashboard-container my-adslist">
					<h3 class="widget-header">Prepaid Request</h3>
					<table class="table table-responsive product-dashboard-table">
						<thead>
							<tr>
								<th>Name</th>
								<th colspan="2">Description</th>
                               
								<th class="text-center">Price</th>
                                
								<th class="text-center">Day Duration</th>
								<th class="text-center">Change price/duration</th>
							</tr>
						</thead>
						<tbody>

                            <?php
                            foreach($promotions as $el):
                            

                            
                            
                            ?>
                   

							<tr class="ads-info" id="row-<?=$el->id?>">
								
								<td  class="product-details" >
									<div class="row">
                                        <h3 class="title col-12"><?=$el->promotion?><h3>
									</div>
                                    
								</td>
								<td  colspan="2" class="product-details" >
									<div class="row">
                                        <p class=" desc title col-12"><?=$el->description?></p>
									</div>
                                    
								</td>
                          
                                
                                <td>
                                 <div class="row justify-content-center">
									    <span id="price-<?=$el->id?>" calss="price"><?=$el->price?></span>
									</div>
                                </td>
                                
                              
                             
								<td class="">
                                    <div class="row justify-content-center">
                                        <span id="duration-<?=$el->id?>" class="categories duration" ><?=$el->day_duration?>
                                    </div>
                                </td>
								<td class="action" data-title="Action">
									<div class="px-2">
										<ul class="list-inline justify-content-center">
											<li class="list-inline-item mb-lg-0 mb-2">
												<a class="bg-success pointer edit "  data-toggle="modal" data-target="#modal-edit" id="<?=$el->id?>" data-duration="<?=$el->day_duration?>" data-price="<?=$el->price?>">
                                                <i class="text-light fa fa-pencil"></i>
												</a>		
											</li>
											
										</ul>
									</div>
								</td>
							</tr>
							<?php endforeach?>
						</tbody>
					</table>
                </div>
</div>
</section>


<!-- Modal -->
<div class="modal fade" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Change price or day duration</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group row">
            <label for="price" class="col-10">Price: (Currency is RSD) </label>
            <input type="number" class="col-10 mx-2 form-control" id="price" value="700">
        </div>
        <div class="form-group row align-items-center">
            <label for="price" class="col-4">Day duration:</label>
            <input type="number" class="col-6 mx-2 form-control" id="duration" value="7">
        </div>
        <input type="hidden" id="id" />
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="save" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
          
                
                    <div ><p class="text-danger " id="error"></p></div>
                    <div ><p class="text-success" id="success"></p></div>


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

<script type="text/JavaScript">
    window.onload = () =>{

    
    
    $("#save").click(function(){
        let id =$("#id").val();
        let duration = $("#duration").val();
        let price = $("#price").val();

        $("#modal-edit").modal('hide');
  
            $.ajax({
                        method:"POST",
                        dataType:"JSON",
                        url:"models/admin/update-promotion.php",
                        data:{
                            "id":id,
                            "duration":duration,
                            "price":price
                        },
                        success:function(data){
                            
                            


                            $("#price-"+id).html(price);
                            $("#duration-"+id).html(duration);

                            $("#"+id).attr("data-duration",duration);
                            $("#"+id).attr("data-price",price);
                
                            $("#success").html("Successful update!");

                            $("#error").html("");

                        },
                        error: function(xhr){
                            $("#success").html("");
                               
                            $("#error").html("Something go wrong, please try again later !");

                        }

                    })
                    AddEvents();
            })

    AddEvents();
    }

    function AddEvents(){
        $(".edit").click(function(){
            let id = $(this).attr("id");
            let duration = $(this).attr("data-duration");
            let price = $(this).attr("data-price");
            $("#id").val(id);
            $("#duration").val(duration);
            $("#price").val(price);
         })
    }
</script>