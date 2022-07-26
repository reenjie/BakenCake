<?php 
session_start();
include 'connections/connect.php';
//echo $_SESSION['user_id'];
  /////////////////////////////SET ONLY IF USER ACCOUNT ID IS NOT SET //////////////////////////////////////
if(isset($_SESSION['user_isset'])){

 

}else {
 
    function getClientIP() {

    if (isset($_SERVER)) {

        if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
            return $_SERVER["HTTP_X_FORWARDED_FOR"];

        if (isset($_SERVER["HTTP_CLIENT_IP"]))
            return $_SERVER["HTTP_CLIENT_IP"];

        return $_SERVER["REMOTE_ADDR"];
    }

    if (getenv('HTTP_X_FORWARDED_FOR'))
        return getenv('HTTP_X_FORWARDED_FOR');

    if (getenv('HTTP_CLIENT_IP'))
        return getenv('HTTP_CLIENT_IP');

    return getenv('REMOTE_ADDR');
}

$usertempip = getClientIP();
      $checktemporary_user = " SELECT * FROM `tempuser` WHERE ipaddress= '$usertempip'  ";
                  $checkandtosave = mysqli_query($con,$checktemporary_user); 
                  $counttemporary_user= mysqli_num_rows($checkandtosave);
               
               if ($counttemporary_user>=1){
                   while($row = mysqli_fetch_array( $checkandtosave)){
                    $temp_id = $row['ipaddress'];
                  
                                 }
                    $_SESSION['user_id'] = $temp_id;
               
               }else {
                  date_default_timezone_set('Asia/Manila'); 
                  $datenow = date('Y-m-d H:i:s');
                $insertnewtemp_users = "INSERT INTO `tempuser`(`ipaddress`, `datecreated`) VALUES ('$usertempip','$datenow')";
                mysqli_query($con,$insertnewtemp_users);

               $_SESSION['user_id']=  $usertempip;
               }


}



               //////////////////////////////////////////////////////////


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

  	 <div class="row">
  	 	 <div class="col-md-1">
  	 	 	
  	 	 </div> 
  	 	  <div class="col-md-10">
  	 	  			 <div class="banner">
  	 		<img src="img/banner.png" style="width: 100%;border-radius: 1px;">
  	 </div> 
  	 	  </div> 
  	 	   <div class="col-md-1">
  	 	 	
  	 	 </div>
  	 	 
  	 </div> 
     <hr>

  	  <div class="container">
  	  
  	  <div class="row mt-3">
  	  		
  	  		 
  	  		<h4 style="font-weight: bolder">Most Ordered</h4>

  	  		 <div class="row mt-4" id="items">
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
  	  		 
  	  	
  	  		 


  	  </div> 

  	   <div class="row mt-5">
  	   	 <div class="" style="float: right;">
  	   	 
  	   	<button onclick="window.location.href='category.php' " class="btn btn-primary" style="font-size: 13px;width: auto;float: right;">View All Categories <i class="fas fa-arrow-right"></i></button>
  	   	</div> 
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
      
      if ( $(window).width() <= 767 ) { 
      $('#buttonsg').removeClass('row');
      $('#footrow').removeClass('row');
       $('#footrow').css('text-align','center');
       $('.e').removeClass('col-md-4');

      }

  

      $('.unaddtowishlist').click(function() { 

             
             }) 
             items();
              function items(){
        
         $.ajax({
                 url : "contents.php",
                  method: "POST",
                   data  : {allitems:1},
                   success : function(data){
                $('#items').html(data);
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
</script>

 
		  
		
		<!--Bootstrap Plugins-->
	   <script type="text/javascript" src="js/notify.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script type="text/javascript" src="js/popper.js"></script>
		<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>