
<?php include_once($_SERVER['DOCUMENT_ROOT']."/SMenterprise/conn.php"); ?>
<?php
if(!empty($_GET['id']) && !empty($_GET['data']))
{  
    $id=$_GET['id'];
    $paisa=$_GET['data'];  
    $sql = "SELECT * FROM `product` WHERE `id`=$id ";
    $result=$conn->query($sql);
    if ($result==true)
   {
       while($row=$result->fetch_assoc())
       {   $id=$row['id'];
           $name=$row['pro_name'];
           $image=$row['pro_image'];
           $actualprice=$row['price'];
           $cate=$row['category'];
       }
    }else
    {
        echo $conn->error;
    }

}
?>
<?php

require('config.php');
require('razorpay-php/Razorpay.php');
// session_start();

// Create the Razorpay Order

use Razorpay\Api\Api;

$api = new Api($keyId, $keySecret);

//
// We create an razorpay order using orders api
// Docs: https://docs.razorpay.com/docs/orders
//
$orderData = [
    'receipt'         => 3456,
    'amount'          => $paisa * 100, // 2000 rupees in paise
    'currency'        => 'INR',
    'payment_capture' => 1 // auto capture
];

$razorpayOrder = $api->order->create($orderData);

$razorpayOrderId = $razorpayOrder['id'] ;

$_SESSION['razorpay_order_id'] = $razorpayOrderId;  

$displayAmount = $amount = $orderData['amount'];

if ($displayCurrency !== 'INR')
{
    $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
    $exchange = json_decode(file_get_contents($url), true);

    $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
}

// $checkout = 'automatic';

// if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true))
// {
//     $checkout = $_GET['checkout'];
// }
$fname=$_POST['first_name']; 
$lname=$_POST['last_name']; 
$email=$_POST['email'];
$company=$_POST['company'];
$address=$_POST['street_address'];
$city=$_POST['city'];
$zipCode=$_POST['zipCode'];
$phone_number=$_POST['phone_number'];
$comment=$_POST['comment'];
$data = [
    "key"               => $keyId,
    "amount"            => $amount,
    "name"              => "$name",
    "description"       => "payment",
    "image"             => "img/$image",
    "prefill"           => [
    "name"              => "$fname",
    "email"             => "$email",
    "contact"           => "$phone_number",
    ],
    "notes"             => [
    "address"           => "$address",
    "merchant_order_id" => "12312321",
    ],
    "theme"             => [ 
    "color"             => "#F37254"
    ],
    "order_id"          => $razorpayOrderId,
];

if ($displayCurrency !== 'INR')
{
    $data['display_currency']  = $displayCurrency;
    $data['display_amount']    = $displayAmount;
}

$json = json_encode($data);

require("checkout/manual.php");
?>
