<?php
if ($_POST['enter']) 
{
    session_start();
    global $CONNECT;
    mysqli_query($CONNECT,"INSERT INTO `order` VALUES ('', '$_SESSION[USER_ID]',1,NOW())");
    $o_id=mysqli_insert_id($CONNECT);
    
    $p=$_SESSION['TOTAL_PRODUCT'];
    for( $i = 0 ;$i <= $p; $i++)
    {  
        if($_SESSION['products']['tovar_'.$i]){
            
            $t_id=$_SESSION['products']['tovar_'.$i]['id'];
            $t_name=$_SESSION['products']['tovar_'.$i]['name'];
            $t_col=$_SESSION['products']['tovar_'.$i]['col'];
            $t_price=$_SESSION['products']['tovar_'.$i]['price']*$t_col;

            mysqli_query($CONNECT,"INSERT INTO `p_order` VALUES ('', '$t_id','$t_name','$t_col','$t_price','$o_id')");
    }
    }
    mail($_SESSION['USER_EMAIL'], 'Ваш заказ номер '.$o_id.' принят в обработку. Состояние заказа отслеживайте в личном кабинете',      'From: robot@podarok.ru');
    unset($_SESSION['products']);
    unset($_SESSION['TOTAL_COUNT']);
    unset($_SESSION['TOTAL_PRICE']);
    unset($_SESSION['TOTAL_PRODUCT']);
    unset($t_id);
    unset($t_name);
    unset($t_col);
    unset($t_price);
    
    
    MessageSend(3, 'Товар принят в обработку, можете отследить его в своих заказах', '/profile');
    }
Location('/');
?>