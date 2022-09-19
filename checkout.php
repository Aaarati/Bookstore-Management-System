<?php
session_start();

if($_SESSION['customerID']){
    $id=$_SESSION['customerID'];
}
if (!($_SESSION['customerID'])) {
    header ("Location: customerlogin.php");
    }
    
include './admin/config.php';
require 'stripeconfig.php';


$message=" ";
if(isset($_SESSION["shopping_cart"])){
    $total_price = 0;
    $items=array();
    $quantity=array();
    $price=array();
   }
   foreach ($_SESSION["shopping_cart"] as $product)
    {   
        $items[]=$product["name"];
        $quantity[]=$product["quantity"];
        $price[]=$product["price"];
        $total_price += ($product["price"]*$product["quantity"]);   
        }
    $allitems=implode('<br>', $items);
    $allquantity=implode('<br>', $quantity);
    $unitprice=implode('<br>', $price);
    //  $sql="INSERT INTO orders (book_items,order_qty,book_price,total_amount,customerID)
    // VALUES('".$allitems."','".$allquantity."','".$unitprice."','".$total_price."','".$id."')";   
    //             if(mysqli_query($conn,$sql)){
    //                 $message= "order placed";

    //             }
    //             else{
    //                 $message="order not placed";
    //             }           
               
               
                
?>
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link
  href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
  rel="stylesheet"
/>
<link
      rel="stylesheet"
      type="text/css"
      href="./bootstrap/css/bootstrap.min.css"
    />
    <link rel="stylesheet" type="text/css" href="style.css" />
<!-- <div class="main-container"> -->
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
              <a class="nav-link active" aria-current="page" href="index.php">HOME</a>
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
          if(isset($_SESSION['customer'])){
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
            

<?php echo $message."<br>";?>

<div class="container">
  <div class="row mt-3">
  <h5 class="h4 text-center mb-3">Cart Summary</h5>
  <table class="table table-success table-bordered">
    <thead class="table buttons text-capitalize">
      <th>Book items</th>
      <th>quantity</th>
      <th>Book price</th>
</thead>
    <tbody>
         <td><?php echo $allitems.'<br>'; ?></td>
         <td><?php echo $allquantity; ?></td>
         <td><?php echo $unitprice; ?></td>
    </tbody>
    <tr>
    <td colspan="2" class="text-end"> Total Price</td>
    <td><?php echo $total_price;?></td>
    </tr>
    
</table>

<form action="order-submit.php" method="post">
<script src="https://checkout.stripe.com/checkout.js" class="stripe-button"
data-key="<?php echo $publishableKey?>" data-amount="<?php echo $total_price * 100;?>" data-name = "BookPayment" data-description="Payment Gateway" data-image="" data-currency="npr"
data-email="">
 </script>   
<input type="hidden" name="total" value="<?php echo $total_price;?>">

</form>





</div>