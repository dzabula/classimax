<script src="plugins/jquery/dist/jquery.min.js"></script>
  <!--<script src="plugins/jquery-ui/jquery-ui.min.js"></script>-->
  <script src="plugins/tether/js/tether.min.js"></script>
  <script src="plugins/raty/jquery.raty-fa.js"></script>
  <script src="plugins/bootstrap/dist/js/popper.min.js"></script>
  <script src="plugins/bootstrap/dist/js/bootstrap.min.js"></script>
 <!-- <script src="plugins/seiyria-bootstrap-slider/dist/bootstrap-slider.min.js"></script>-->
  <script src="plugins/slick-carousel/slick/slick.min.js"></script>
<!--<script src="plugins/jquery-nice-select/js/jquery.nice-select.min.js"></script>-->
  
  <script src="plugins/fancybox/jquery.fancybox.pack.js"></script>
  <script src="plugins/smoothscroll/SmoothScroll.min.js"></script>
  <script src="https://kit.fontawesome.com/d97b95c4d1.js" crossorigin="anonymous"></script>
  <!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCC72vZw-6tGqFyRhhg5CkF2fqfILn2Tsw"></script>-->
  <?php if(isset($_GET['page'])){
  if($page != "registration")  echo '<script src="js/scripts.js"></script>';
  }
  ?>
    

</body>

</html>