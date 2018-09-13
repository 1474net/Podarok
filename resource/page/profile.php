<?php 
    ULogin(1);
?>
<html>
<head>
   <meta charset="utf-8">
    <title>Профиль</title>
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
    <!--JS block --->

</head>

<body>
<header>
    <div class="header-top">
       <a href="/" class="logo">Подарок</a> 
       	<div class="reg-but">
            <?php 
            if($_SESSION['USER_LOGIN_IN']==1){
                echo " <a href='/profile' class='prof_btn'>".$_SESSION['USER_NAME']."
                        </a> <a href='/account/logout' class='knopka'>log out</a>";
            }else
                echo "<a href='reg' class='knopka'>log in</a>" ;
            ?>    
	    </div>
    </div>
 
</header>
   <?php
    MessageShow();
    ?>

    <div class="profil_con">
       
            <div class="profil_btn">
            <a href="profile">Профиль</a>
           <a href="#order" onclick="openmod(1)">Покупки</a>
           <a href="#setting" onclick="openmod(2)">Настройки</a>
           <a href="#fidback" onclick="openmod(3)">ФидБэк</a>
        </div>
        <div class="profil_inf">
           <div class="inf1">
               <div class="profil_head">
                   <h1>Профиль</h1></div>
               <div class="p_inf">
                   <div><label>Имя: </label><?php echo  $_SESSION['USER_NAME']?></div>
                   <div><label>Логин:</label><?php echo  $_SESSION['USER_LOGIN']?></div>
                   <div><label>Почта:</label> <?php echo  $_SESSION['USER_EMAIL']?></div>
                   <div><label>Телефон:</label> <?php echo  $_SESSION['USER_PHONE']?></div>
                   
               </div>
           </div>
        </div> 
    </div>
   

    
</body>
    <div id="footer">
  Телефон: 8-929-480-97-87<br>
    Адрес: 50 лет Октября Дом 40
  </div>
</html>


