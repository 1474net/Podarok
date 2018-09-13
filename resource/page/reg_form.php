<?php
ULogin(0);
?>
<html>
<head>
   <meta charset="utf-8">
    <title>Форма регистрации и входа</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    
    <!--CSS block --->
    <link href="resource/css.css"  type="text/css" rel="stylesheet">
    <!--CSS block --->
    
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
   
   
   

<div class="content_r">
        <div class="acc_form">
            <div class="log_in">
            <h2>Войти</h2>
            <form method="POST" action="/account/login">
                <br><input type="text" name="login" placeholder="Логин" maxlength="10" pattern="[A-Za-z-0-9]{3,10}" title="Не менее 3 и неболее 10 латынских символов или цифр." required>
                <br><input type="password" name="password" placeholder="Пароль" maxlength="15"  pattern="[A-Za-z-0-9]{5,15}" title="Не менее 5 и неболее 15 латынских символов или цифр." required>
                <!--Капча 
                <div class="capdiv"><input type="text" class="capinp" name="captcha" placeholder="Капча" maxlength="10" pattern="[0-9]{1,5}" title="Только цифры." required> <img src="/resource/captcha.php" class="capimg" alt="Каптча"></div>-->
                <br><input type="checkbox" name="remember"> Запомнить меня
            </form>
        </div>
    
    <div class="registr">
    <h2>Регистрация</h2>
    <form method="POST" action="/account/register">
        <br><input type="text" name="login" placeholder="Логин" maxlength="10" pattern="[A-Za-z-0-9]{3,10}" title="Не менее 3 и неболее 10 латынских символов или цифр." required>
        <br><input type="email" name="email" placeholder="E-Mail" required>
        <br><input type="password" name="password" placeholder="Пароль" maxlength="15" pattern="[A-Za-z-0-9]{5,15}" title="Не менее 5 и неболее 15 латынских символов или цифр." required>
        <br><input type="text" name="name" placeholder="Имя" maxlength="10" pattern="[А-Яа-яЁё]{4,10}" title="Не менее 4 и неболее 10 латынских символов или цифр." required>
        <!--Капча 
        <div class="capdivr"><input type="text" class="capinpr" name="captcha" placeholder="Капча" maxlength="10" pattern="[0-9]{1,5}" title="Только цифры." required> <img src="/resource/captcha.php" class="capimgr" alt="Каптча"></div>-->
    </form>
    </div>
    </div>
</div>
    
</body>
</html>


