<?php
  global $CONNECT;
session_start();
if ($Module == 'add_cat' and $_POST['add']){


    $_POST['category']=FormChars($_POST['category']);
    
    $rew=mysqli_fetch_assoc(mysqli_query($CONNECT,"SELECT id FROM category WHERE name='$_POST[category]'"));
    
    if(!$rew and  $_POST['category']){   
    mysqli_query($CONNECT,"INSERT INTO category (name) VALUES ('$_POST[category]')");  
    MessageSend(3, 'Дабовление прошло успешно!', '/admin');  
    }
    else {
        MessageSend(1, 'Упс!', '/admin');
    }
}
if ($Module == 'rem_cat' and $_POST['rem']){
    $_POST['category']= FormChars($_POST['category']);
    
    //$row=mysqli_fetch_assoc(mysqli_query($CONNECT,"SELECT id FROM category WHERE id='$_POST[category]'"));
    
    if ($_POST['category']){
        mysqli_query($CONNECT,"DELETE FROM category WHERE id='$_POST[category]'");
         MessageSend(3, 'Ура вы удалили запись !', '/admin');
        
    }
    else {
        MessageSend(3, 'Упс !', '/admin');
    }
}
if ($Module == 'add_scat' and $_POST['add']){
    $_POST['category']= FormChars($_POST['category']);
    $_POST['scategory']= FormChars($_POST['scategory']);
    $row=mysqli_fetch_assoc(mysqli_query($CONNECT,"SELECT id FROM s_category WHERE name ='$_POST[scategory]'"));
    if($_POST['category'] and $_POST['scategory'] and  !$row){
         
        mysqli_query($CONNECT,"INSERT INTO s_category (name, id_c) VALUES ('$_POST[scategory]','$_POST[category]')");
        MessageSend(3, 'Дабовление прошло успешно!', '/admin');
    }
    else {
        MessageSend(3, 'Упс !', '/admin');
    }
}
if ($Module == 'rem_scat' and $_POST['enter']){
    $_POST['category']= FormChars($_POST['category']);
    $_POST['scategory']= FormChars($_POST['scategory']);
    
    if($_POST['category'] and $_POST['scategory']){
         
        mysqli_query($CONNECT,"DELETE FROM s_category WHERE id='$_POST[scategory]'");
        
        MessageSend(3, 'Удаление прошло успешно!', '/admin');
    }
    else {
        MessageSend(3, 'Упс !', '/admin');
    }
}

if($Module == 'add_tovar' and $_POST['enter'])
{

    $_POST['category']= FormChars($_POST['category']);
    $_POST['scategory']= FormChars($_POST['scategory']);
    $_POST['name']= FormChars($_POST['name']);
    $_POST['price']= FormChars($_POST['price']);
    $_POST['text']= FormChars($_POST['text']);

    if($_POST['category'] and $_POST['scategory'] and $_POST['name'] and  $_POST['price'] and $_POST['text'] and $_FILES['f']['tmp_name'])
    {
    mysqli_query($CONNECT,"INSERT INTO `product` VALUES ('',' $_POST[name]','$_POST[scategory]',' $_POST[price]',' $_POST[text]','1' )");
    $p_id=mysqli_insert_id($CONNECT);
        
  
    if ($_FILES['f']['type'] != 'image/jpeg') MessageSend(2, 'Не верный тип изображения.');
    if ($_FILES['f']['size'] > 1000000) MessageSend(2, 'Размер изображения слишком большой.');
    $Image = imagecreatefromjpeg($_FILES['f']['tmp_name']);
    $Size = getimagesize($_FILES['f']['tmp_name']);
    $Tmp = imagecreatetruecolor(250, 250);
    imagecopyresampled($Tmp, $Image, 0, 0, 0, 0, 250, 250, $Size[0], $Size[1]);

       /* if ($_SESSION['USER_AVATAR'] == 0) {
            $Files = glob('resource/img/tovar/*', GLOB_ONLYDIR);
            foreach($Files as $num => $Dir) {
            $Num ++;
            $Count = sizeof(glob($Dir.'/*.*'));

            if ($Count < 250) {
                $Download = $Dir.'/'.$_SESSION['USER_ID'];

                $_SESSION['USER_AVATAR'] = $Num;
                mysqli_query($CONNECT, "UPDATE `users`  SET `avatar` = $Num WHERE `id` = $_SESSION[USER_ID]");
                break;
                }
            }
        }
    else */
    mysqli_query($CONNECT,"INSERT INTO `image` VALUES ('',' $p_id','1')");  
    $p_id=mysqli_insert_id($CONNECT);    
    $Download = 'resource/img/tovar/'.$p_id;
    imagejpeg($Tmp, $Download.'.jpg');
    imagedestroy($Image);
    imagedestroy($Tmp);
    MessageSend(1, 'Все прошло успешно1.','/admin');    
    }
    else {
        MessageSend(1, 'Что-то пошло не так1.','/admin');   
    }
}
if($Module == 'rem_tovar' and $Param['t'] and $_POST['enter'])
{
    $Param[t]=FormChars($Param['t']);
    $row=mysqli_fetch_array(mysqli_query($CONNECT,"SELECT `name` FROM `product` WHERE id='$Param[t]'"));
    if($row){
        $row=mysqli_query($CONNECT,"SELECT `id` FROM `image` WHERE id_p='$Param[t]'");
        while($data=mysqli_fetch_array($row))
        {
            unlink("resource/img/tovar/".$data['id'].".jpg");
        }
        
        $row=mysqli_query($CONNECT, "DELETE FROM `product` WHERE id='$Param[t]'");
        if ($row) 
        {
            MessageSend(3, "Все прошло успешно", "/admin");
        }
    }
        MessageSend(1, "Не все прошло успешно","/admin");
    
    
}

if($Module='stat' and $_POST['stat'] and $_POST['enter'] and $Param['zakaz']){
    $Param['zakaz']=FormChars($Param['zakaz']);
    $row=  mysqli_fetch_array(mysqli_query($CONNECT, "SELECT * FROM `order` WHERE id='$Param[zakaz]'"));
    if($row){
        if($_POST['stat']=='close'){
            $row1= mysqli_fetch_array(mysqli_query($CONNECT, "UPDATE `order` SET `status`=2 WHERE id='$Param[zakaz]'"));
        }
        if($_POST['stat']=='confirm'){
            $row1= mysqli_fetch_array(mysqli_query($CONNECT, "UPDATE `order` SET `status`=3 WHERE id='$Param[zakaz]'"));  
        }
                        MessageSend(2, "Все прошло успешно","/admin");
    }
    MessageSend(1, "НЕ все прошло успешно","/admin");   
}
?>