<?php
 include('stripeconfig.php');
 
 $total = $_POST['total'] * 100;
if (isset($_POST['stripeToken'])) {
 $token = $_POST['stripeToken'];

 $charge = \Stripe\Charge::create(array(
    "amount"=>$total,
    "currency"=>"npr",
    "description"=>"Payment Gateway",
    "source"=>$token,
 ));
}
?>
<?php
include './admin/config.php';

session_start();	

if($_SESSION['customerID']){
    $id=$_SESSION['customerID'];
}

    // $sql="SELECT * FROM orders WHERE customerID='$id'";
    //   $result=mysqli_query($conn,$sql);

    //   if(mysqli_num_rows($result)>0){
    //     while($row=mysqli_fetch_assoc($result)){

    //       $_SESSION['order'] = $row['order_number'];
          
    //       }
    //    }



 // if($_SESSION['order']){
 //    $orderid=$_SESSION['order'];
 // }

if (!($_SESSION['customerID'])) {
    header ("Location: customerlogin.php");
    }

foreach ($_SESSION["shopping_cart"] as $product)
	{	
		$items[]=$product["name"];
        $quantity[]=$product["quantity"];
        $price[]=$product["price"];
        $total_price += ($product["price"]*$product["quantity"]);   
      
}
    $allitems=implode(' <br>', $items);    
    $allquantity=implode('<br> ', $quantity);
    $unitprice=implode('<br> ', $price);	
       $total=$total_price;

	$sql1= "INSERT INTO orders (book_items,order_qty,book_price,total_amount,order_status,customerID,transaction_id)
			VALUES('".$allitems."','".$allquantity."','".$unitprice."','".$total."','Pending','".$id."','".$token."')"; 
                mysqli_query($conn,$sql1);

    //         $sql2="INSERT INTO payments(transactionID,payment_amt,order_number,customerID)
    // values ('".$token."','".$total."',".$orderid."','".$id."')";
        
    
    // mysqli_query($conn,$sql2);
        
	


	echo "<script>window.alert('Your Order has been placed.')
	</script>";
	

	header("location:index.php");
?>

<?php
	
?>