<?php

  
session_start();
if($_SESSION['customerID']){
    $id=$_SESSION['customerID'];
}
 include 'admin/config.php';


 $sql1 = "SELECT * FROM orders WHERE customerID = '".$id."' " ;
$res = mysqli_query($conn, $sql1);
$data = [];
if (mysqli_num_rows($res) > 0) {
    while ($row = mysqli_fetch_assoc($res)) {
    array_unshift($data, $row);
        }
    }

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Book Store Management system</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width-device-width, initial-scale=1" />

    <link
      rel="stylesheet"
      type="text/css"
      href="./bootstrap/css/bootstrap.min.css"
    />
    <link rel="stylesheet" type="text/css" href="style.css" />
  </head>
  <body>
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand h1 fs-4" href="#">SN BOOK STORE</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div
          class="collapse navbar-collapse justify-content-between"
          id="navbarSupportedContent"
        >
          <ul
            class="navbar-nav justify-content-center w-100 ml-auto mb-2 mb-lg-0"
          >
            <li class="nav-item">
              <a class="nav-link " aria-current="page" href="index.php">HOME</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.php">ABOUT</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="bookcard.php">BOOKS</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./index.php#contact">CONTACT US</a>
            </li>
          </ul>
          
                  
              <div class=" d-flex justify-content-center align-items-center  " >

<div class="me-5">
        <?php if(isset($_SESSION['customer'])){ echo $_SESSION['customer'];}?></div>
               <div class=" d-flex me-3">

                  <?php
           if(!empty($_SESSION["shopping_cart"])) {
           $cart_count = count(array_keys($_SESSION["shopping_cart"]));
            ?>

   <?php
          if(isset($_SESSION['customerID'])){
          echo "<a class='text-decoration-none text-black' href='order-view.php'>orders</a>";
      }?>

         
            <div class="cart_div ms-5">

    <a class="text-decoration-none text-black" href="cart.php">Cart(<?php echo $cart_count; ?>)
              
            </a>
            </div>
            <?php
            }
            ?>
</div>
            <button class="buttons">
              <?php
          if(isset($_SESSION['customerID'])){
          echo "<a class='text-decoration-none text-white' href='customerlogout.php' class='login'>logout</a>";
      }
      
         else{
         echo "<a class='text-decoration-none text-white' href='customerlogin.php' class='login'>login</a>";
     }
         ?>
       </button>
        </div>
      </div>
    </div>
  </nav>


  <div class="container mt-5">
    <div class="row">
      
  <h5 class="h4 text-center">Order history</h5>
    <table class="table  table-bordered table-success">
        <thead class="table buttons text-capitalize ">
        <th>S.N</th>
        <th>book items</th>
        <th>quantity</th>
        <th>book price</th>
        <th>total amount</th>
        <th>Order date</th>
        <th>status</th>
        
        </thead>
        
        <tbody>
            <?php
            $i = 1;
            foreach ($data as $d) {
            ?>
              <tr class="">
                <td><?php echo $i++; ?></td>
                <td><?php echo $d['book_items']; ?></td>
                <td><?php echo $d['order_qty']; ?></td>
                <td><?php echo $d['book_price']; ?></td>
                <td><?php echo $d['total_amount']?></td>
                <td><?php echo $d['order_date']?></td>
                <td><?php echo $d['order_status']; ?></td>
            
               
                
              </tr>

           
            <?php } ?>
          </tbody>
        
    </table>
    </div>
</div>
    </div>
  </div>
</body>
</html>
