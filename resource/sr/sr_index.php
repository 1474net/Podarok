<?php
include_once '../../setting.php';
$CONNECT = mysqli_connect(HOST, USER, PASS, DB);
if($_POST['chek']=="log"){
    echo"
            <form method='POST' action='/account/login'>
                <br><input type='text' name='login' placeholder='Логин' maxlength='10' pattern='[A-Za-z-0-9]{3,10}' title='Не менее 3 и неболее 10 латынских символов или цифр.' required>
                <br><input type='password' name='password' placeholder='Пароль' maxlength='15'  pattern='[A-Za-z-0-9]{5,15}' title='Не менее 5 и неболее 15 латынских символов или цифр.' required>
                <!--Капча 
                <div class='capdiv'><input type='text' class='capinp' name='captcha' placeholder='Капча' maxlength='10' pattern='[0-9]{1,5}' title='Только цифры.' required> <img src='/resource/captcha.php' class='capimg' alt='Каптча'></div>-->
                <br><input type='checkbox' name='remember'> Запомнить меня
                <br><br><input type='submit' name='enter' value='Вход'> 
            </form>"; 
}
if($_POST['chek']=="reg"){
    echo"
    <form method='POST' action='/account/register'>
        <br><input type='text' name='login' placeholder='Логин' maxlength='10' pattern='[A-Za-z-0-9]{3,10}' title='Не менее 3 и неболее 10 латынских символов или цифр.' required>
        <br><input type='email' name='email' placeholder='E-Mail' required>
        <br><input type='password' name='password' placeholder='Пароль' maxlength='15' pattern='[A-Za-z-0-9]{5,15}' title='Не менее 5 и неболее 15 латынских символов или цифр.' required>
        <br><input type='text' name='name' placeholder='Имя' maxlength='10' pattern='[А-Яа-яЁё]{4,10}' title='Не менее 4 и неболее 10 латынских символов или цифр.' required>
        <!--Капча 
        <div class='capdivr'><input type='text' class='capinpr' name='captcha' placeholder='Капча' maxlength='10' pattern='[0-9]{1,5}' title='Только цифры.' required> <img src='/resource/captcha.php' class='capimgr' alt='Каптча'></div>-->
        <br><input type='submit' name='enter' value='Регистрация'>
    </form>
"; 
}
if($_POST['tovar_id']){

    $id=(int)$_POST['tovar_id'];
    $row=  mysqli_fetch_array(mysqli_query($CONNECT, "SELECT `id`, `name`, `price`,`id_s`, `count`, `description` FROM `product` WHERE id='$id'"));
    $cat=  mysqli_fetch_array(mysqli_query($CONNECT, "SELECT s.name as scat, c.name as cat FROM category c RIGHT JOIN s_category s ON c.id=s.id_c WHERE s.id='$row[id_s]]' "));
    $image=  mysqli_fetch_array(mysqli_query($CONNECT, "SELECT id FROM `image` WHERE id_p='$id'"));
    echo "<div class='content_tovar'>"
         ."<div class='block_head'>
           <span >
               ".$cat['cat']." - ".$cat['scat']."
           </span>
       </div>"
    . "<div class='block_img'><img src='/resource/img/tovar/".$image['id'].".jpg '></div>"
    . "<div class='block_inf'>"
    /*. "<div class='tovar_head'><span>".$cat['cat']." </span> - <span> ".$cat['scat']." </span></div>"*/


    . "<div class='inf_tovar'>"
            . "<p id='t_name'>".$row[name]."</p>"
            . "<p>Цена: ".$row[price]."</p>"
            . "<p>Количство: ".$row[count]."</p>"
            ."<a href='#bue' price='".$row[price]."' name_t='".$row[name]."' rel='".$row["id"]."' class='add_tovar' onclick='addcor()'> "

            . "<img src='resource/img/icon/shopping.png' style='width: 24px; height: 24px; display: inline-block; margin-right:5px;'>В корзину</a>"
            . "</div>"
            . "<hr>"
            . "</div>"
            . "<div class='dis_tovar'><span>
            Описание     
            </span>
             <p>".$row[description]." </p></div>"
    . "</div>";
    
}
if($_POST['id_categoru']){
    $id=(int)$_POST['id_categoru'];
    $row=  mysqli_query($CONNECT, "SELECT `id`, `name` FROM s_category WHERE id_c='$id'");
    while ($data=  mysqli_fetch_array($row)){
         echo "<div class='i_scat'><a href='#tovar' onclick='get_men(".$data['id'].")'>".$data['name']."</a></div>";
    }
}
if($_POST['id_scategoru']){
    $id=(int)$_POST['id_scategoru'];
    $row=  mysqli_query($CONNECT, "SELECT p.id as id_p, p.name , p.price, im.id as picture  FROM product p LEFT JOIN image im ON p.id=im.id_p WHERE p.id_s='$id' and im.osn=1");
        while ($data=mysqli_fetch_array($row)){
            echo "<div class='item'>
            <a href='#' onclick=pokaz_tovar(".$data['id_p'].",'block')><img src='resource/img/tovar/".$data['picture'].".jpg'></a>
            ".$data['name']."
            <br>".$data['price']." Рублей
             </div>";
           }
           
}
?>