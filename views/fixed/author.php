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
					<h1>ClASSIMAX </h1>
					<p>Whatever you need, Classimax is there <br> Whatever you don't need, Classimax is there</p>
					<div class="short-popular-category-list text-center">
						<h2>Buy and save / Sell and earn</h2>
						
					</div>
					
				</div>
				<!-- Advance Search -->
				<div class="advance-search text-left p-lg-5 p-2 m-0 font-18">
                Classimax je najveća online zajednica za kupovinu i prodaju u Srbiji, sa preko 2.5 miliona registrovanih korisnika i 760 hiljada poseta svakog dana. Spajamo one koji žele nešto da prodaju, sa onima koji žele to da kupe. Pored pojedinaca, na Classimax-u uspešno prodaje i veliki broj malih i srednjih domaćih biznisa. 

                Prvi oglas na Classimax je postavljen u februaru 2008. godine. Danas ih se dnevno objavi preko 60 hiljada. Sa preko 4.3 miliona aktivnih oglasa u svakom trenutku, na KupujemProdajem možete pronaći praktično sve!

                KupujemProdajem je u vlasništvu firme:

                Quable B.V.
                Plesmanlaan 84, 2497CB Hag, Holandija
                Registracioni broj: 27302667
                info

                Pitanja nam možete postaviti korišćenjem forme u donjem desnom uglu svake stranice portala.
                Korisne informacije i novosti o platformi možete pratiti na KP Blogu.

                Ime i logo KupujemProdajem su zaštićeni žig firme Quable B.V.
					
				</div>
				
			</div>
		</div>
	</div>
   

	<!-- Container End -->
</section>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<br/>
<div class="container">
    <a href="models/export/exp_author.php"><button class="btn btn-outline-primary mt-5">Download about us text</button></a>
</div>
<!--===================================
=            Client Slider            =
====================================-->


<!--===========================================
=            Popular deals section            =
============================================-->




<!--==========================================
=            All Category Section            =
===========================================-->

<section class=" section">
    <br/>

	<!-- Container Start -->
	<div class="container">
		<div class="row">
            <div class="col-lg-3 col-6">
			    <img src="images/author/author.jpeg" class="img-fluid" alt="Marko Dasic"/>
            </div>
            <div class="col-6 col-lg-8">
			    <p>Marko Dasic 110/20</p>
                <p>Student druge godine osnovnih studija visoke ICT skole.</p>

            </div>

		</div>
	</div>
	<!-- Container End -->
</section>



<style type="text/css">
    .bg-1{
        background: url("images/call-to-action/cta-background.jpg") !important;
        background-size: cover !important;
        background-repeat: no-repeat !important;
    }
    .hero-area .advance-search {
        margin-bottom: -200px !important;
    }
    .font-18{

        font-size: 20px !important;
    }
    .advance-search{
        background-color: rgba(255,255,255,0.8) !important;
    }

</style>