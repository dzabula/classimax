<?php

$num_my_ads = GetNumPost($_SESSION['user']->id);
$num_favorite_ads = GetNumFavoritePost($_SESSION['user']->id);


?>
<section class="user-profile section">
	<div class="container">
		<div class="row">
			<div class="col-md-10 offset-md-1 col-lg-4 offset-lg-0">
				<div class="sidebar">
					<!-- User Widget -->
					<div class="widget user-dashboard-profile">
						<!-- User Image -->
						<div class="profile-thumb">
							<img src="<?=$_SESSION['user']->src?>" alt="<?=$_SESSION['user']->full_name?>" class="rounded-circle">
						</div>
						<!-- User Name -->
						<h5 class="text-center"><?=$_SESSION['user']->full_name?></h5>
						<p><?="Joined ". explode(" ",$_SESSION['user']->date_created)[0]?><p>
                            
                            <a href="index.php?page=edit-profile" class="btn btn-main-sm">Edit Profile</a>
                            <p class="text-primary">Your balans:<strong> <?=$prepaid->prepaid?></strong> RSD</p>

					</div>
					<!-- Dashboard Links -->
					<div class="widget user-dashboard-menu">
						<ul>
							<li <?php echo $_GET['page'] == "my-ads"? "class='active'" : "" ?>>
								<a href="index.php?page=my-ads"><i class="fa fa-user"></i> My Ads<span><?=$num_my_ads?></span></a>
							</li>
							<li <?php echo $_GET['page'] == "favorite-ads"? "class='active'" : "" ?>>
                                
								<a href="index.php?page=favorite-ads"><i class="fa fa-bookmark-o"></i> Favourite Ads <span><?=$num_favorite_ads?></span></a>
							</li>
                            <li <?php echo $_GET['page'] == "add-ads"? "class='active'" : "" ?>>
								<a href="index.php?page=add-ads"><i class="fa fa-plus-circle"></i> Add Ads</a></li>
							<li>
							<li <?php echo $_GET['page'] == "add-phones"? "class='active'" : "" ?>>
								<a href="index.php?page=add-phones"><i class="fa fa-file-archive-o"></i>Add phone number </a>
							</li>
							<li  <?php echo $_GET['page'] == "top-up-credits"? "class='active'" : "" ?>>
								<a href="index.php?page=top-up-credits"><i class="fa fa-bolt"></i> Top up credits</a>
							</li>
							<li>
								<a href="models/logout.php"><i class="fa fa-cog"></i> Logout</a>
							</li>
							<li>
								<a  onclick="DeleteAcc()" class="pointer"><i class="fa fa-power-off"></i>Delete Account</a>
							</li>
							<?php

							if(isset($_SESSION['user'])):
								if($_SESSION['user']->role == "admin"): ?>
							<li <?php echo $_GET['page'] == "approval"? "class='active'" : "" ?>>
								<a  href="index.php?page=approval" class="pointer"><i class="fas fa-user-check"></i>Approval prepaids</a>
							</li>
							<li <?php echo $_GET['page'] == "managment"? "class='active'" : "" ?>>
								<a  href="index.php?page=managment" class="pointer"><i class="fas fa-users"></i>Users managment</a>
							</li>
							<li <?php echo $_GET['page'] == "pricelist"? "class='active'" : "" ?>>
								<a  href="index.php?page=pricelist" class="pointer"><i class="fas fa-ad"></i>Promotions pricelist</a>
							</li>
							<li <?php echo $_GET['page'] == "statistic"? "class='active'" : "" ?>>
								<a  href="index.php?page=statistic" class="pointer"><i class="fas fa-chart-bar"></i>Site statistic</a>
							</li>
							<?php
								endif;
									endif;?>
						</ul>
					</div>
				</div>
			</div>
<style type="text/css">
	.fa-star-of-life{
            color: red;
            font-size: 8px;
        }
		.pointer{
			cursor: pointer;
		}

</style>

<script type="text/JavaScript">
	function DeleteAcc(){
		if(confirm("Are You sure?")){
			window.location.assign('models/delete-profile.php');   
		}
	}

</script>