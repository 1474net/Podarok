<?php
session_start();

include_once 'setting.php';
$CONNECT = mysqli_connect(HOST, USER, PASS, DB);

/**********************************
******* КУКИ сайта **************
**********************************/
$_COOKIE['user'] = FormChars($_COOKIE['user'], 1);

    
if (!$_SESSION['USER_LOGIN_IN'] and $_COOKIE['user']) {
$Row = mysqli_fetch_assoc(mysqli_query($CONNECT, "SELECT `id`, `name`, `email`, `login` FROM `users` WHERE `password` = '$_COOKIE[user]'"));

if (!$Row) {
setcookie('user', '', strtotime('-30 days'), '/');
unset($_COOKIE['user']);
MessageSend(1, 'Ошибка авторизации', '/');
}
$_SESSION['USER_LOGIN_IN'] = 1;
foreach ($Row as $Key => $Value) $_SESSION['USER_'.strtoupper($Key)] = $Value;
}



if ($_SERVER['REQUEST_URI'] == '/') {
$Page = 'index';
$Module = 'index';
} else {
$URL_Path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$URL_Parts = explode('/', trim($URL_Path, ' /'));
$Page = array_shift($URL_Parts);
$Module = array_shift($URL_Parts);


if (!empty($Module)) {
$Param = array();
for ($i = 0; $i < count($URL_Parts); $i++) {
$Param[$URL_Parts[$i]] = $URL_Parts[++$i];
}
}
}

if ($Page == 'index') {
include('resource/page/index.php');
}
else if ($Page == 'tovar') include('resource/page/tovar.php');
else if ($Page =='reg') include('resource/page/reg_form.php');
else if ($Page =='profile') include('resource/page/profile.php');
else if ($Page =='corzina') include('resource/page/cor.php');
else if ($Page =='admin') include('resource/page/admin.php');

/**********************************
******* Подключение форм **************
**********************************/
else if($Page =='account') include('resource/form/accaunt.php');
else if($Page =='confirm') include('resource/form/confirm.php');
else if($Page =='adm') 
include('resource/form/admin.php');
/**************************************/
//else include('resource/page/index.php');
/**********************************
******* Функии сайта **************
**********************************/


function FormChars($p1, $p2 = 0) {
global $CONNECT;
if ($p2) return mysqli_real_escape_string($CONNECT, $p1);
else return nl2br(htmlspecialchars(trim($p1), ENT_QUOTES), false);
}

/**/
function GenPass ($p1, $p2) {
return md5('GOVNOKOD'.md5('322'.$p1.'228').md5('666'.$p2.'777'));
}

/*Функции сообщений */
function MessageSend($p1, $p2, $p3 = '', $p4 = 1) {
if ($p1 == 1) $p1 = 'Ошибка';
else if ($p1 == 2) $p1 = 'Подсказка';
else if ($p1 == 3) $p1 = 'Информация';
$_SESSION['message'] = '<div class="MessageBlock"><b>'.$p1.'</b>: '.$p2.'</div>';
if ($p4) {
Location($p3);
}
}

function Location ($p1) {
if (!$p1) $p1 = $_SERVER['HTTP_REFERER'];
exit(header('Location: '.$p1));
}



function MessageShow() {
if ($_SESSION['message'])$Message = $_SESSION['message'];
echo $Message;
$_SESSION['message'] = array();
}
/*Функции сообщений */

function RandomString($p1) {
$Char = '0123456789abcdefghijklmnopqrstuvwxyz';
for ($i = 0; $i < $p1; $i ++) $String .= $Char[rand(0, strlen($Char) - 1)];
return $String;
}

function ULogin($p1) {
if ($p1 <= 0 and $_SESSION['USER_LOGIN_IN'] != $p1) MessageSend(1, 'Данная страница доступна только для гостей.', '/');
else if ($_SESSION['USER_LOGIN_IN'] != $p1) MessageSend(1, 'Данная сртаница доступна только для пользователей.', '/reg');
}

function HideEmail($p1) {
$Explode = explode('@', $p1);
return $Explode[0].'@*****';
}


function AdminLog($pass){
    if($pass==ADMIN_PASS){
       
        $_SESSION['ADMIN_LOG_IN']=1;
        return 1;

    }else {return 0;}
} 
?>