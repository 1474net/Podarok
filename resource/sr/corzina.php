<?php
session_start();
$chek = $_POST["chek"];

if($chek==1){
    
    $nomer=$_POST["nomer"];    
    
    $_SESSION['TOTAL_PRICE']=$_SESSION['TOTAL_PRICE']-($_SESSION['products']['tovar_'.$nomer]["price"]*$_SESSION['products']['tovar_'.$nomer]["col"]);
    $_SESSION['TOTAL_COUNT']=$_SESSION['TOTAL_COUNT']-$_SESSION['products']['tovar_'.$nomer]["col"];
    unset($_SESSION['products']['tovar_'.$nomer]);
    $_SESSION['TOTAL_PRODUCT']--;
   
    if( $_SESSION['TOTAL_COUNT']==0 or $_SESSION['TOTAL_PRICE']==0 or  $_SESSION['TOTAL_PRODUCT']==0){
        unset($_SESSION['products']);
        unset($_SESSION['TOTAL_COUNT']);
        unset($_SESSION['TOTAL_PRICE']);
    }
   

}
if($chek==2){
    $nomer=$_POST["nomer"];
    $_SESSION['products']['tovar_'.$nomer]["col"]--;
    $_SESSION['TOTAL_COUNT']--;
    $_SESSION['TOTAL_PRICE']= $_SESSION['TOTAL_PRICE']-$_SESSION['products']['tovar_'.$nomer]['price'];
}
if($chek==3){
    $nomer=$_POST["nomer"];
    $_SESSION['products']['tovar_'.$nomer]["col"]++;
    $_SESSION['TOTAL_COUNT']++;
    $_SESSION['TOTAL_PRICE']= $_SESSION['TOTAL_PRICE']+$_SESSION['products']['tovar_'.$nomer]['price'];
}

if($_SESSION['USER_LOGIN_IN'] == 1){
    if($_SESSION['products']){
        echo " <div class='btn_conf'>
                <form method='POST' action='/confirm/'>
                    <input type='submit' name='enter' value='Подтвердить'>
                </form>
                </div>";
               echo "<div class='text_conf'>Вы заказали товар в количестве ".$_SESSION['TOTAL_COUNT']." на сумму ".$_SESSION['TOTAL_PRICE']." рублей</div>";    
    }else {
                   echo"<div class='ifo_conf' >Ваша корзина пуста! Положите товар в корзину что-бы заказать его.<div>";
               }
}
else{
    echo"<div class='cor_login'>
                    <h2>Войти</h2>
                            <form method='POST' action='/account/login'>
                            <br><input type='text' name='login' placeholder='Логин' maxlength='10' pattern='[A-Za-z-0-9]{3,10}' title='Не менее 3 и неболее 10 латынских символов или цифр.' required>
                            <br><input type='password' name='password' placeholder='Пароль' maxlength='15'  pattern='[A-Za-z-0-9]{5,15}' title='Не менее 5 и неболее 15 латынских символов или цифр.' required>
                            <!--Капча 
                            <div class='capdiv'><input type='text' class='capinp' name='captcha' placeholder='Капча' maxlength='10' pattern='[0-9]{1,5}' title='Только цифры.' required> <img src='/resource/captcha.php' class='capimg' alt='Каптча'></div>-->
                            <br><input type='checkbox' name='remember'> Запомнить меня
                            <br><br><input type='submit' name='enter' value='Вход'> <input type='reset' value='Очистить'>
                        </form>
                        <div>";
}
?>
