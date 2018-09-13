<html>
<head>
   <meta charset="utf-8">
    <title>Корзина с товарами</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width">
    
    <!--CSS block --->
    <link href="resource/css.css"  type="text/css" rel="stylesheet">
    
    <!--CSS block --->
    
    <!--JS block --->
    <script type="text/javascript" src="resource/js/jquery-1.8.2.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
    <script type="text/javascript" src="resource/js/script.js"></script>

</head>
<body>
<svg style="position: absolute; width: 0; height: 0;" width="0" height="0" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
<defs>
<symbol id="icon-plus" viewBox="0 0 16 16">
<title>plus</title>
<path class="path1" d="M15.5 6h-5.5v-5.5c0-0.276-0.224-0.5-0.5-0.5h-3c-0.276 0-0.5 0.224-0.5 0.5v5.5h-5.5c-0.276 0-0.5 0.224-0.5 0.5v3c0 0.276 0.224 0.5 0.5 0.5h5.5v5.5c0 0.276 0.224 0.5 0.5 0.5h3c0.276 0 0.5-0.224 0.5-0.5v-5.5h5.5c0.276 0 0.5-0.224 0.5-0.5v-3c0-0.276-0.224-0.5-0.5-0.5z"></path>
</symbol>
<symbol id="icon-minus" viewBox="0 0 16 16">
<title>minus</title>
<path class="path1" d="M0 6.5v3c0 0.276 0.224 0.5 0.5 0.5h15c0.276 0 0.5-0.224 0.5-0.5v-3c0-0.276-0.224-0.5-0.5-0.5h-15c-0.276 0-0.5 0.224-0.5 0.5z"></path>
</symbol>
<symbol id="icon-cross" viewBox="0 0 16 16">
<title>cross</title>
<path class="path1" d="M15.854 12.854c-0-0-0-0-0-0l-4.854-4.854 4.854-4.854c0-0 0-0 0-0 0.052-0.052 0.090-0.113 0.114-0.178 0.066-0.178 0.028-0.386-0.114-0.529l-2.293-2.293c-0.143-0.143-0.351-0.181-0.529-0.114-0.065 0.024-0.126 0.062-0.178 0.114 0 0-0 0-0 0l-4.854 4.854-4.854-4.854c-0-0-0-0-0-0-0.052-0.052-0.113-0.090-0.178-0.114-0.178-0.066-0.386-0.029-0.529 0.114l-2.293 2.293c-0.143 0.143-0.181 0.351-0.114 0.529 0.024 0.065 0.062 0.126 0.114 0.178 0 0 0 0 0 0l4.854 4.854-4.854 4.854c-0 0-0 0-0 0-0.052 0.052-0.090 0.113-0.114 0.178-0.066 0.178-0.029 0.386 0.114 0.529l2.293 2.293c0.143 0.143 0.351 0.181 0.529 0.114 0.065-0.024 0.126-0.062 0.178-0.114 0-0 0-0 0-0l4.854-4.854 4.854 4.854c0 0 0 0 0 0 0.052 0.052 0.113 0.090 0.178 0.114 0.178 0.066 0.386 0.029 0.529-0.114l2.293-2.293c0.143-0.143 0.181-0.351 0.114-0.529-0.024-0.065-0.062-0.126-0.114-0.178z"></path>
</symbol>
</defs>
</svg>

   <div onclick="show('none'); pokaz_tovar(0,'none')" id="wrap"></div> 
<header>
    
        <div class="header-top">
        <a href="/" class="logo">Подарок</a> 
       	 <div class="reg-but">
            <?php 
            if($_SESSION['USER_LOGIN_IN']==1){
                
                echo " <a href='/profile' class='prof_btn'>".$_SESSION['USER_NAME']."</a> "
                        . "<a href='/account/logout' class='knopka'> <img src='resource/img/icon/arrow.png' style='width: 24px; height: 24px; margin-right: 10px;
            margin-left: -10px; '>log out</a>";
            }
            if($_SESSION['ADMIN_LOG_IN']==1)
            {
            echo " <a href='/admin' class='prof_btn'>Admin</a> "
                . "<a href='/account/logout' class='knopka' > <img src='resource/img/icon/arrow.png' style='width: 24px; height: 24px; margin-right: 12px;
            margin-left: -10px; '>log out</a>";
            }
            if($_SESSION['ADMIN_LOG_IN']!=1 AND $_SESSION['USER_LOGIN_IN']!=1)
            {
                echo "<a href='#' class='knopka' onclick=show('block')> <img src='resource/img/icon/exit.png' style='width: 24px; height: 24px; margin-right: 12px;
            margin-left: -10px; '> Войти</a>" ;
                
            }
            ?>   
	    </div>
    </div>

</header>
   <?php
    MessageShow();
    ?>
    <div class="reg_form" id='reg_form'> 
        <div class="reg_button"> 
            <ul class="navigation">
                <li><a href="#refistr" id="registr" title="Вход" onclick="lesectreg('log')" >Вход</a></li>
                <li><a href="#login"id="registr" title="Регистрация" onclick="lesectreg('reg')" >Регистрация</a></li>
            </ul>
            <div class="tab-content"></div>
        </div>
    </div>
    
   <div class='content'>
       <div class="cor_tovar">
                     <div class="block_head">
           <span>
               Корзина
           </span>
                         </div>             
           <div class='cor_pr'>
            <?php 
                $p=$_SESSION['TOTAL_PRODUCT'];
                if(!$_SESSION['TOTAL_PRODUCT']){
                    echo "В данный момент корзина пуста! Добавте какой-нибудь товар что-бы сдесь что-нибудь появилось.";
                }else{
                for( $i = 0 ;$i <= $p; $i++)
                {  
                    if($_SESSION['products']['tovar_'.$i]){              
                    echo "<div class='product_c' id='tovar_".$i."'>";
                        echo "<div class='c_name par' ><a href='product?idtovar=".$_SESSION['products']['tovar_'.$i]['id']."'>".$_SESSION['products']['tovar_'.$i]['name']."</a></div>";//Имя товара 
                        echo "<svg class='icon icon-cross par crest' onclick='del(".$i.");'><use xlink:href='#icon-cross'></use></svg>"; //Крест   
                    echo "<div class='c_price par' >".$_SESSION['products']['tovar_'.$i]['price']." Руб.</div>"; //Цена               
                        
                        echo "<svg class='icon icon-minus par rem_col' onclick='minus(".$i.")';><use xlink:href='#icon-minus'></use></svg>";//Минус
                        echo "<div class='c_col par col' >".$_SESSION['products']['tovar_'.$i]['col']."</div>";//количество 
                        
                        echo "<svg class='icon icon-plus par add_col' onclick='plus(".$i.")';><use xlink:href='#icon-plus'></use></svg>";//Плюс
                        

                    echo "</div>";  }
                    
                }}
            ?>
            </div>
        </div>
        <?php  
            if($_SESSION['products']){
                echo"<div class='conf_cor' >"
                . "<span class='head_cor'>Подтвердить заказ</span>";
 
               if(!$_SESSION['USER_LOGIN_IN'] == 0) {

                    echo "<div class='ifo_conf' style='height:75px'> <div class='btn_conf'>
                    <form method='POST' action='/confirm'>
                        <input type='submit' name='enter' value='Подтвердить'>
                    </form>
                    </div>";
                   echo "<div class='text_conf'>Вы заказали товар в количестве ".$_SESSION['TOTAL_COUNT']." на сумму ".$_SESSION['TOTAL_PRICE']." рублей</div>";
                   }
                else {
                    echo"<div class='ifo_conf'>
                    <div class='cor_login'>
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
            
                }
            
            ?>
            </div>
        </div>
    </div>
    </div>
    </div>
<div id="footer">
  Телефон: 8-929-480-97-87<br>
    Адрес: 50 лет Октября Дом 40
  </div>
</body>

</html>


