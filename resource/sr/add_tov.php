<?php
    session_start();
    $id = $_POST["t_id"];
    $name = $_POST["t_name"];
    $price = $_POST["t_price"];

if(!$_SESSION['TOTAL_PRODUCT']){
    $c=0;
    $_SESSION['TOTAL_PRODUCT']=0;
    }
else
    {$c=$_SESSION['TOTAL_PRODUCT'];}

for($i=0;$i<$c;$i++)
    {
    if ($id == $_SESSION['products']['tovar_'."$i"]['id'])
    {
        $_SESSION['products']['tovar_'."$i"]['col']=$_SESSION['products']['tovar_'."$i"]['col']+1; 
        goto a;
            
        }
    }
    
    $_SESSION['products']['tovar_'."$c"]['id']=$id;
    $_SESSION['products']['tovar_'."$c"]['price']=$price;
    $_SESSION['products']['tovar_'."$c"]['name']= $name;
    $_SESSION['products']['tovar_'."$c"]['col']=1;
    $_SESSION['TOTAL_PRODUCT']++;
    
a:
    $_SESSION['TOTAL_PRICE']=$_SESSION['TOTAL_PRICE']+$price;
    $_SESSION['TOTAL_COUNT']++;
    
    
    unset($id);
    unset($price);
    echo "<div>Сумма: ".$_SESSION['TOTAL_PRICE']."</div>
        <div> Количество: ".$_SESSION['TOTAL_COUNT']."</div>";


?>