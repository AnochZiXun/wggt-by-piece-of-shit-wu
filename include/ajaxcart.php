<?
include('./config.php') ;
require('./include/cart.class.php') ;
$cart = new cart() ;
/*-----------------------------------
購物車寫入
-------------------------------------*/
$cart -> addCart($_POST['table'] , $_POST['pitem'] , $_POST['userid'] , $_POST['number']) ;
$rows = $db -> getcount("select * from cart where DELETE_ID =0 and PID ='".$_POST['userid']."'") ;
$arr = array ('cartRows'=> $rows );
echo json_encode($arr);
?>
