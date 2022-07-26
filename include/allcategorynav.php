<nav class="navbar navbar-expand-lg shadow-sm" style="background-color: #d4dee0; font-size: 14px">
  <div class="container-fluid">
   
    <div class="" id="navbarNav">
      <ul class="navbar-nav">
        <?php 
            $getallcategory = " select * from category   ";
                        $getting_category = mysqli_query($con,$getallcategory); 
                     
                         while($row = mysqli_fetch_array($getting_category)){
                        ?>
                           <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="category.php?sortbycategory=<?php echo $row['cat_id'] ?>&category=<?php echo $row['category_name'] ?>"><?php echo $row['category_name'] ?></a>
                      </li>
                        <?php
                         }
                  
         ?>

     
       
      
      </ul>
    </div>
  </div>
</nav>