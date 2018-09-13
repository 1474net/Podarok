<?php 

if ($Module == 'logout' and $_SESSION['USER_LOGIN_IN'] or $_SESSION['ADMIN_LOG_IN']) {
    if ($_COOKIE['user'] ) {
        setcookie('user', '', strtotime('-30 days'), '/');
        unset($_COOKIE['user']);
    }
    session_unset();
    Location('/');
}

function MIX($p1) {
    return md5($p1.date('d.m.Y H').'65475g45');
}


function CheckRegInfo($p1, $p2) {
    global $CONNECT;
    if (mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `login` FROM `users` WHERE `login` = '$p1'"))) MessageSend(1, 'Логин <b>'.$_POST['login'].'</b> уже используеться.');
    else if (mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `email` FROM `users` WHERE `email` = '$p2'"))) MessageSend(1, 'E-Mail <b>'.$_POST['email'].'</b> уже используеться.');
}

ULogin(0);


if ($Module == 'register' and $_POST['enter']) {
    $_POST['login'] = FormChars($_POST['login']);
    $_POST['email'] = FormChars($_POST['email']);
    $pass=$_POST['password'];
    $_POST['password'] = GenPass(FormChars($_POST['password']), $_POST['login']);
    $_POST['name'] = FormChars($_POST['name']);
 /*   $_POST['captcha'] = FormChars($_POST['captcha']);*/

    
if (!$_POST['login'] or !$_POST['email'] or !$_POST['password'] or !$_POST['name'] or $_POST['country'] > 4 /*or !$_POST['captcha']*/)          MessageSend(1, 'Невозможно обработать форму.');
/* Проверка капчи
if ($_SESSION['captcha'] != md5($_POST['captcha'])) MessageSend(1, 'Капча введена не верно.');*/
    CheckRegInfo($_POST['login'], $_POST['email']);
    $_SESSION['REGISTER_INFO'] = "$_POST[name],$_POST[login],$_POST[password],$_POST[email]";
    $_SESSION['REGISTER_CONFIRM'] = GenPass($_POST['email'], $_POST['login']);

mail($_POST['email'], 'Регистрация', 'Ссылка для активации: http://http://podarok.tw1.su/account/activate/code/'.MIX($_SESSION['REGISTER_CONFIRM']),      'From: robot@podarok.ru');
MessageSend(3, 'Регистрация акаунта успешно завершена. На указанный E-mail адрес <b>'.$_POST['email'].'</b> отправленно письмо о подтверждении регистрации.<br>Пароль для входа: '.$pass.'.');
}

else if ($Module == 'activate' and $Param['code'] and $_SESSION['REGISTER_INFO'] and $_SESSION['REGISTER_CONFIRM']) {
    if (MIX($_SESSION['REGISTER_CONFIRM']) != $Param['code']) MessageSend(1, 'Активация не возможна.');
    CheckRegInfo($Exp[1], $Exp[3]);
    $Exp = explode(',', $_SESSION['REGISTER_INFO']);
    mysqli_query($CONNECT, "INSERT INTO `users`  VALUES ('', '$Exp[0]', '$Exp[1]', '$Exp[2]', '$Exp[3]', 1)");
    unset($_SESSION['REGISTER_INFO']);
    unset($_SESSION['REGISTER_CONFIRM']);
    MessageSend(3, 'Аккаунт подтвержден.', '/');
}



else if ($Module == 'login' and $_POST['enter']) {
   $_POST['login'] = FormChars($_POST['login']);
   $_POST['password']=FormChars($_POST['password']);
   /* $_POST['captcha'] = FormChars($_POST['captcha']);*/
    
    if($_POST['login']=='Admin'){
    if(AdminLog($_POST['password']))
    MessageSend(3, 'Вы в панели админа!', '/admin');    
    }

     $_POST['password'] = GenPass($_POST['password'], $_POST['login']);
       // MessageSend(3,  $login.'-'.$pass, '/admin');  
    
    if (!$_POST['login'] or ! $_POST['password']/* or !$_POST['captcha']*/) MessageSend(1, 'Невозможно обработать форму.');

/*капча
    if ($_SESSION['captcha'] != md5($_POST['captcha'])) MessageSend(1, 'Капча введена не верно.');*/

    $Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `password` FROM `users` WHERE `login` = '$_POST[login]'"));


    if ($Row['password'] != $_POST[password]) MessageSend(1, 'Не верный логин или пароль.');
        
    $Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `id`, `name`, `email`, `password`, `login` FROM `users` WHERE `login` = '$_POST[login]'"));
        
    $_SESSION['USER_LOGIN_IN'] = 1;
        
    foreach ($Row as $Key => $Value) $_SESSION['USER_'.strtoupper($Key)] = $Value;
        
    if ($_REQUEST['remember']) setcookie('user',  $_POST['password'], strtotime('+30 days'), '/');
    Location('/profile');
}

?>