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

    $res = GetLogStatistic();

    $statistic = $res['statistics'];
    $counting = $res['counting'];

    $allLogins = GetNumLogin24H();



    




?>



<div class="col-md-10 offset-md-1 col-lg-8 offset-lg-0">
				<!-- Recently Favorited -->
            <div class="widget">
                <h2>In the last 24 hours we had <?=count($allLogins)?> logins</h2>
            </div>


				<div class="w-100 widget dashboard-container my-adslist">
					<h3 class="widget-header">Page Statistic Traffic (for different ip adress)</h3>
					<table class="table w-100 table-responsive product-dashboard-table">
						<thead>
							<tr>
								<th>Page</th>
								<th class="text-center">Visit in 24H <th>
								<th class="text-center">Visit at last year in  %</th>
                               
							</tr>
						</thead>
						<tbody>

                            <?php
                            foreach($statistic as $i => $el):
                            

                            
                            
                            ?>
                   

							<tr class="ads-info" >
								
								<td   class="" >
								
                                        <h3 class="title col-12"><?= $el['page']?><h3>
									
                                    
								</td>
                                
                                <td   class="product-details" >
									
                                        <p class="text-center  desc title col-12"><?=$counting[$i]['count']?></p>
						
                                    
								</td>
                                <td></td>

								<td   class="product-details" >
									
                                        <p class="text-center desc title col-12"><?= substr($el['percent'],0,4) ?>% </p>
									
                                    
								</td>
                                
                                
                                
							</tr>
							<?php endforeach?>
						</tbody>
					</table>
                </div>
</div>
</section>
<style type="text/css">
     td{
           min-width: 120px !important;
     
       }
       th{
           min-width: 120px !important;
       }
@media only screen and (max-width: 1200px) {
       
       td{
           min-width: 120px !important;

       }
       th{
           min-width: 120px !important;
       }
   }

</style>