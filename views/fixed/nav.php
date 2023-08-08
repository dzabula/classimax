<body class="body-wrapper">
<section id="header">
	<?php if(!isset($_SESSION['user'])) echo '<div class="container">';
		else  echo '<div class="container-fluid">';?>
	
		<div class="row">
			<div class="col-md-12">
				<nav class="navbar navbar-expand-lg  navigation">
					<a class="navbar-brand" class="w-25" href="index.php">
						<img src="images/logo.png" alt="Grab&Buy logo">
					</a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span id="hamburger" class="navbar-toggler-icon d-flex justify-content-center align-items-center"><i class="fas fa-bars"></i></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarSupportedContent">
						<ul class="navbar-nav mx-auto main-nav ">
							<li class="nav-item active">
								<a class="nav-link" href="index.php">Home</a>
							</li>
							
							<li class="nav-item">
								<a class="nav-link" href="index.php?page=category">All ads</a>
							</li>
							
							

							<?php if(isset($_SESSION['user'])):?>

							<li class="nav-item dropdown dropdown-slide">
								<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Dashboard <span><i class="fa fa-angle-down"></i></span>
								</a>
								<!-- Dropdown list -->
								<div class="dropdown-menu dropdown-menu-right">
									<a class="dropdown-item" href="index.php?page=my-ads">My ads</a>
									<a class="dropdown-item" href="index.php?page=favorite-ads">Favorite Ads</a>
									<a class="dropdown-item" href="index.php?page=add-ads">Add ads</a>	
									<a class="dropdown-item" href="index.php?page=add-phones">Add phone</a>	
									<a class="dropdown-item" href="index.php?page=top-up-credits">Top up Credits</a>
									<?php if($_SESSION['user']->role == "admin"):?>
									<a class="dropdown-item" href="index.php?page=approval">Approval prepaids</a>
									<a class="dropdown-item" href="index.php?page=managment">Users Managment</a>
									<a class="dropdown-item" href="index.php?page=pricelist">Promotion pricelist</a>
									<a class="dropdown-item" href="index.php?page=statistic">Site Statistic</a>
									
									<?php endif?>
								</div>
							</li>

							<?php endif?>

							<li class="nav-item">
								<a class="nav-link" href="index.php?page=author">Abouth Us</a>
							</li>

							
							<li class="nav-item  mt-lg-0 pt-0 pb-0 pl-0 pr-0 px-0 py-0 d-flex justify-content-between">
										<a class="nav-link " href="index.php?page=add-ads"><i class="fa fa-plus-circle"></i> Add Ads</a>
							</li>
							<?php if(!isset($_SESSION['user'])):?>
									
								<li class=" mt-lg-0 pt-0 pb-0 pl-0 pr-0 px-0 py-0  nav-item d-flex justify-content-center align-items-center">
									<a class="nav-link login-button" href="index.php?page=login">Registration/Login</a>
								</li>
							<?php endif?>
						</ul>
						<ul class="navbar-nav mt-10 d-flex justify-content-between">
							<?php if(isset($_SESSION['user'])):?>
								<li class="nav-item d-flex justify-content-center align-items-center" id="profile-block">
									<img class="" id="profile-img" src="<?=$_SESSION['user']->src?>" alt="<?=$_SESSION['user']->full_name?>" />
								</li>
								<li class="nav-item mx-2 d-flex justify-content-center align-items-center">
									<a href="index.php?page=my-ads" class="pointer mb-0 text-primary font-20"><?=$_SESSION['user']->full_name?> <?= $_SESSION['user']->role == "admin" ? "(Admin)" : ""?></a>
								</li>
								<li class="nav-item mx-2 d-flex justify-content-center align-items-center">
									<a class="nav-link login-button" href="models/logout.php">Log out</a>
								</li>
								<!--<li class="nav-item mt-3 mt-lg-0 ">
										<a class="nav-link add-button" href="#"><i class="fa fa-plus-circle"></i> Add Listing</a>
								</li>-->
							
							<?php endif?>
							
						</ul>
					</div>
				</nav>
			</div>
		</div>
	</div>
</section>
<style type="text/css">


/*#profile-block{
        display: flex;
        justify-content: center;
        align-items: center;
        width: 50px;
        height: 50px;
        background-color: #111111;
        border-radius: 50% !important;
		background-image: url("user-image/ghost.png");
		background-size: cover;
    }
*/
#profile-img{
	border-radius: 50%;
	width: 50px;
}


#hamburger>i{
	font-size: 25px;
}
#header{
   
	background-color: rgba(255,255,255,0.9);
	width:100%;
	z-index: 999;
}
#header:hover{
	background-color: white;
}
.font-20{
	font-size: 20px;
}
.pointer{
	cursor: pointer;
}
.nav-item > .add-button{
	padding-left: 15px !important;
	padding-right: 15px !important;
}
.login-button{
	padding: 0px 15px !important;
}
</style>
<script type="text/javascript">
	//setTimeout(function(){
	window.onscroll = function(event) {
		console.log()
		if(window.pageYOffset >= 300){
			document.getElementById("header").style.position = "fixed";
			document.getElementById("header").style.zindex = 999;
			//$("#header").css("position","fixed");
			//$("#header").css("z-index","9");
		}else{
			document.getElementById("header").style.position = "relative";
			document.getElementById("header").style.zindex = 1;


			//$("#header").css("position","relative");
			//$("#header").css("z-index","1");
		}


	};
	//},800);

</script>