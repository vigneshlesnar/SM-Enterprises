<?php include_once($_SERVER['DOCUMENT_ROOT']."/SMenterprise/conn.php"); ?>  
<?php
session_start();
if(!empty($_GET['id']) && !empty($_GET['page']))
 {  
     $id=$_GET['id'];
     $page=$_GET['page'];
     $sql = "DELETE FROM `product` WHERE `id`='$id'";
     $res = $conn -> query($sql);
    if($res===TRUE)   
    {
        echo "deleted";
    }
    else
    {
    echo $conn->error;
    }
}
session_destroy();
?>