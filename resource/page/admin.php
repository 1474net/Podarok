<?php
if (!$_SESSION['ADMIN_LOG_IN']){
    Location('/');
}
    MessageShow();
?>
<html>
<head>
   <meta charset="utf-8">
    <title>Панель администратора</title>
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

<body >
   <header>
 
    <div class="header-top">
        <a href="/" class="logo">Подарок</a> 
       	 <div class="reg-but">
            <?php 
            if($_SESSION['USER_LOGIN_IN']==1){
                echo " <a href='/profile' class='prof_btn'>".$_SESSION['USER_NAME']."
                        </a> <a href='/account/logout' class='knopka'>log out</a>";
            }
            if($_SESSION['ADMIN_LOG_IN']==1)
            {
            echo " <a href='/admin' class='prof_btn'>Admin
                </a> <a href='/account/logout' class='knopka'>log out</a>";
            }else
            {
                echo "<a href='reg' class='knopka'>log in</a>" ;
            }
             
            ?>   
	    </div>
    </div>

    </header>   
     <div class="profil_con">
       
        <div class="profil_btn" >
            <a href="/admin">Главная</a>
            <a href="#" onclick="adm(1)">Заказы</a>
            <a href="#" onclick="adm(2)">Товары</a>
            <a href="#" onclick="adm(3)">Сообщения</a>
        </div>
        <div class="profil_inf">
           <div class="inf1">
               <div class="profil_head">
                   <h1>Главная </h1></div>
               <div class="p_inf">
                   
               </div>
           </div>
        </div> 
    </div>
    
</body>

</html>
