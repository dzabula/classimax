<!DOCTYPE html>
<html lang="en">
<head>
<?php
$keyword = "Classimax Buy Sell ads category";
$desc = "ClASSIMAX Whatever you need. Classimax is there. Whatever you don't need, Classimax is there. Buy and save / Sell and earn. See All ads and produtc on Classimax marketplace.";

$title = "Classimax";

if(isset($_GET['page'])){
    $page =$_GET['page'];

    switch($_GET['page']){
        case "category":{
          $keyword = "Classimax category city all ads price search";
          $desc = "ClASSIMAX Whatever you need. Classimax is there. Whatever you don't need, Classimax is there. Buy and save / Sell and earn. See All ads and produtc on Classimax marketplace.";
          $title = "Classimax - All ads";
          break;

        };
        case "single":{
          $keyword = "Classimax image price delivery reviews review ads product";
          $desc = "This is one of the many articles on the clasimas website. view product, seller reviews call and order your product.";
          
          $title = "Classimax - Ads";
          break;

        };
        case "registration":{
          $keyword = "Classimax registration sign up email profile image password";
          $desc = "Registration now and start fast sell your products or buy products from other user! ";
          
          $title = "Classimax - Registration";
          break;

  
        };
        case "author":{
          $keyword = "Classimax author about us  ";
          $desc = "Author web site Classimax is Marko Dasic second-year student of the ICT college. ";
          $title = "Classimax - Author";
          break;

  
        };
        case "add-ads":{
          $keyword = "Classimax add  edit ads profile ";
          $desc = "Post your ad on the clasimas website and sell it at the best price in the shortest possible time. ";
          $title = "Classimax - Add ads";
          break;


        }
        case "favorite-ads":{
          $keyword = "Classimax my favorites favorite ads profile ";
          $desc = "All your favorite ads on Classimax marketplace. Add more ads to your favorite list how did you see it later and maybe buy something ads.";
          $title = "Classimax - Favorite ads";
          break;

        }
        case "top-up-credits":{
          $keyword = "Classimax top up credits money profile ";
          $desc = "Send reuqest to administrator for top up your credits on your profile.";
          $title = "Classimax - Top up credits";
          break;
        
        }
        case "approval":{
          $keyword = "Classimax admin approval credits profile";
          $desc = "For admin. Accept or Dencile users request for top up credits on they's profile.";
          $title = "Classimax - Approval";
          break;
        
        }
        case "managment":{
          $keyword = "Classimax admin users managment profile";
          $desc = "For admin. Ban or Reban users profile and see how much they have ads.";
          $title = "Classimax - Managment";
          break;
        
        }case "pricelist":{
          $keyword = "Classimax admin pricelist promotion profile";
          $desc = "For admin. View adn change price promotion and day duration for promotion.";
          $title = "Classimax - Pricelist";
          break;
        
        }
        case "statistic":{
          $keyword = "Classimax  statistic profile site page";
          $desc = "For admin. Statistic classsimax site, visited pages last 24H and number loged in on last 24H";
          $title = "Classimax - Statistic";
          break;
        
        }
        case "edit-profile":{
          $keyword = "Classimax  email full name profile image";
          $desc = "Change your profile data. Change profile image, name, email";
          $title = "Classimax - Edit profile";
          break;
        
        }
        case "my-ads":{
          $keyword = "Classimax my ads cars eletronics home furniture services pets phone Tv";
          $desc = "View all your active ads and update it or delete it.";
          $title = "Classimax - My ads";
          break;
        
        }
        case "add-phones":{
          $keyword = "Classimax add phone number profile";
          $desc = "Add new or remove current your phone number on your profile.";
          $title = "Classimax - Add phone";
          break;

        }
        case "login": {
          $keyword = "Classimax login email password sign in";
          $desc = "Sign in now and start fast sell your products or buy products from other user! ";
          $title = "Classimax - Log in";
          break;
        }
        
    }
  }
?>

  <!-- SITE TITTLE -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="<?=$desc?>">
  <meta name="keywords" content="<?=$keyword?>">
  <meta name="author" content="Marko Dasic">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=$title?></title>
  

  <?php 
  if(isset($_GET['page'])){
    if($_GET['page']=="registration" || $_GET['page']=="edit-profile" ) {
      echo '<link rel="stylesheet" href="https://unpkg.com/jcrop/dist/jcrop.css">';
      echo '<link rel="stylesheet" href="https://unpkg.com/dropzone/dist/dropzone.css" />';
      echo '<link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>';
      echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />';
    }
  }
  ?>
  <!-- PLUGINS CSS STYLE -->
  <!--<link href="plugins/jquery-ui/jquery-ui.min.css" rel="stylesheet">-->
  <!-- Bootstrap -->
  <link rel="icon" href="images/ikonica.ico" type="image/ico" sizes="32x32"/>
  <link href="plugins/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <!-- Font Awesome -->
  <link href="plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet"/>
  <!-- Owl Carousel -->
  <link href="plugins/slick-carousel/slick/slick.css" rel="stylesheet"/>
  <link href="plugins/slick-carousel/slick/slick-theme.css" rel="stylesheet"/>
  
  <!-- Fancy Box -->
  <link href="plugins/fancybox/jquery.fancybox.pack.css" rel="stylesheet"/>
  <link href="plugins/jquery-nice-select/css/nice-select.css" rel="stylesheet"/>
  <link href="plugins/seiyria-bootstrap-slider/dist/css/bootstrap-slider.min.css" rel="stylesheet"/>
  <!-- CUSTOM CSS -->
  <link href="css/style.css" rel="stylesheet"/>
 

  <!-- FAVICON -->
  <link href="img/favicon.png" rel="shortcut icon"/>

  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

</head>