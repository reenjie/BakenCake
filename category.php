<?php 
  session_start();
include 'connections/connect.php';

 ?>
<!DOCTYPE html>
<html>

<?php include 'include/header.php' ?>

<style type="text/css">
  @media screen and (max-width: 768px) {
    .banner img {
      height: 240px;
    }
    #bnctitle {
      font-size: 30px;
    }
    #buttonsg {
      position: relative;
      left: 100%;
    }
  }
</style>
<body style="background-color:#f0f5f5;overflow-x: hidden;">

	<?php 
  include 'include/topnavbar.php';
  include 'include/allcategorynav.php';

  ?>

 	
 

  <div class="container-fluid mt-4">


  	  <div class="container">
  	  
  	  <div class="row mt-3">
  	  	  <!--Sort By Categories--->	
  	  		 
              
              <?php 
              if(isset($_GET['sortbycategory'])){ 
                $id = $_GET['sortbycategory'];
                $categoryname = $_GET['category'];

                  include 'sortbycategory.php';

                
              }else {
                 ?>
                   <div id="sorted_by_categories">
                      <div class="spinner-grow text-info" role="status">
  <span class="visually-hidden">Loading...</span>
</div>
<div class="spinner-grow text-info" role="status">
  <span class="visually-hidden">Loading...</span>
</div>
<div class="spinner-grow text-info" role="status">
  <span class="visually-hidden">Loading...</span>
</div>

                   </div>
                 <?php

                }
               ?>
              
  	  
  	  		 </div> 
  	  		 
  	  	<!--Sort By Categories--->
  	  		 


  	  </div> 

  	 
  	   

  	  </div> 
  	  
  	  <p><br></p>

  	
  	 
  
  	 
    <div class="fixed-top bg-light shadow  d-none" style="border-bottom: 4px solid #83b1e4" id="cartalert"   >
     <h5 class="text-primary" style="font-weight:bolder;font-family: 'Annie Use Your Telescope', cursive;float: left;padding: 10px">BakeN'Cake</h5> 
     <a href="cart.php"><h6 style="float: right;  font-weight: bolder;margin-right: 10px ;padding: 5px;padding-top: 15px;">Shopping Cart   <span class="badge badge-danger bg-danger" style="" id="countcarts"></span></h6></a>

    </div> 


  	
  </div> 

 <?php 
  include 'include/footer.php';
  include 'include/itemsview.php';
  ?>
  	
  

  	
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script type="text/javascript">
 
  $(document).ready(function() {
       
        if ( $(window).width() <= 767 ) { 
      $('#buttonsg').removeClass('row');
      $('#footrow').removeClass('row');
       $('#footrow').css('text-align','center');
       $('.e').removeClass('col-md-4');

      }

           getallitems();


          function getallitems(){
            
            
               $.ajax({
                       url : "categories.php",
                        method: "POST",
                         data  : {getAllitems:1},
                         success : function(data){
                        $('#sorted_by_categories').html(data);
                         }
                      })
                
                
          }

            countitemcart();
    function countitemcart (){
        
         $.ajax({
                 url : "contents.php",
                  method: "POST",
                   data  : {cartitems:1},
                   success : function(data){
                $('#countcart').text(data);
                $('#countcarts').text(data);

                   }
                })
        
      
  
          
    }

    countitemwishlist();

    function countitemwishlist (){

        $.ajax({
                 url : "contents.php",
                  method: "POST",
                   data  : {cartwlistitems:1},
                   success : function(data){
                $('#countwlist').text(data);
                   }
                })

    }  

        var fixmeTop = $('#cartbutton').offset().top;     

$(window).scroll(function() {                 

    var currentScroll = $(window).scrollTop(); 

    if (currentScroll >= fixmeTop) {           
        $('#cartalert').removeClass('d-none');
      //$("#cartalert").toggle("slide", { direction: "left" }, 2000);
      //$('#cartalert').animate({right:'120'},1000);
    } else {                                   
      $('#cartalert').addClass('d-none');
       //$('#cartalert').animate({left:'120'},1000);
    }

});
        });      
        
</script> 


     	   			 
		  
		
		<!--Bootstrap Plugins-->
	   <script type="text/javascript" src="js/notify.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/popper.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>