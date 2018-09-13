<?php
session_start();
include_once '../../setting.php';
function GetStatus($p){
if ($p == 1) return 'В обработке ';
else if ($p == 2) return 'Приянт';
else if ($p == 3) return 'Закрыт';
}
$CONNECT = mysqli_connect(HOST, USER, PASS, DB);
$key =(int) $_POST["key"];

if($key==1){
     echo"<div class='nf1''>
    <div class='profil_head'>
    <h2>Заказы</h2></div>
    <div class='p_inf'>";
    

    $order=mysqli_query($CONNECT,"SELECT id, status, date FROM `order` WHERE status=1");
    while($data=mysqli_fetch_assoc($order)){      
    echo " <div class='zakaz'onclick=openzak(".$data[id].") >
    <div class='z_nomer'><b>№: </b>".$data['id']."</div>
    <div class='z_data'><b>Дата: </b>".$data['date']."</div>";
    $stat =  GetStatus($data['status']);
    echo "<div class='z_stat'><b>Статус: </b>".$stat."</div></div>";
    }
    echo"</div></div><hr> <div class='p_inf'>";
     
    $order=mysqli_query($CONNECT,"SELECT id, status, date FROM `order` WHERE status!=1");
    
    while($data=mysqli_fetch_assoc($order)){      
    echo " <div class='zakaz'onclick=openzak(".$data[id].") >
    <div class='z_nomer'><b>№: </b>".$data['id']."</div>
    <div class='z_data'><b>Дата: </b>".$data['date']."</div>";
     $stat =  GetStatus($data['status']);
    echo "<div class='z_stat'><b>Статус: </b>".$stat."</div>
    </div>";
    }
    echo"</div></div></div>";
}
/**************************************
                ********************************
                                ********************************/
/**************************************
                ********************************
                                ********************************/
if($key==2){
     echo"<div class='nf1''>
    <div class='profil_head'>
    <h2>Работа с товаром</h2></div>
    <div class='p_inf'>
<h4>Категории</h4>
    
    <form method='POST' action='/adm/add_cat'>
    <input type='text' name='category' placeholder='Категория' >
    <input type='submit' class='a_button' name='add' value='Добавить'> 
    </form>
    
    <form method='POST' action='/adm/rem_cat'>
    <select id='category' name='category' class='select_c'>
    <option>Выберите Категорию</option>";
    $result=mysqli_query($CONNECT,"SELECT id, name FROM `category`");
    while ($row=mysqli_fetch_array($result))
         {
            print "<option value=".$row['id'].">";
            print $row['name'];
            echo("</option>");
         }
    echo"  </select>
    <input type='submit' class='a_button' name='rem' value='Удалить'> 
 
    </form>
    <hr>
    
<h4>Подкатегории</h4>
    <form method='POST' action='/adm/add_scat'>
    <select id='category_1' name='category' class='select_c'>
    <option>Выберите Категорию</option>";
    $result=mysqli_query($CONNECT,"SELECT id, name FROM `category`");
    while ($row=mysqli_fetch_array($result))
         {
            print "<option value=".$row['id'].">";
            print $row['name'];
            echo("</option>");
         }
    echo" </select>
    <input type='text' name='scategory' placeholder='Подкатегория' >
    <input type='submit' class='a_button' name='add' value='Добавить'> 
    </form>
    
    <form method='POST' action='/adm/rem_scat'>
    <select id='category_2' name='category' class='select_c' onclick='loadselect(2)'>   
    <option>Выберите Категорию</option>";
    $result=mysqli_query($CONNECT,"SELECT id, name FROM `category`");
    while ($row=mysqli_fetch_array($result))
         {
            print "<option value=".$row['id'].">";
            print $row['name'];
            echo("</option>");
         }
    echo" </select>
    <select id='scategory_2' name='scategory' class='select_s'>
    
    </select>
    <input type='submit' class='a_button' name='enter' value='Удалить'> 
    </form>
  <hr>
  <div class='a_tovar'>
  
  
<h4>Товары</h4>
    <form method='POST' action='/adm/add_tovar' enctype='multipart/form-data'>
    <div class='a_inf_tovar'>
    <p>
    <select id='category_3' name='category' class='select_c' onclick='loadselect(3)'>
    <option>Выберите Категорию</option>";
    $result=mysqli_query($CONNECT,"SELECT id, name FROM `category`");
    while ($row=mysqli_fetch_array($result))
         {
            print "<option value=".$row['id'].">";
            print $row['name'];
            echo("</option>");
         }
    echo" </select>
    
    <select id='scategory_3' name='scategory' class='select_s'>
    
    </select>
    </p>
    
    <p><input type='text' name='name' placeholder='Имя товара' ></p>
   
    <p><input type='text' name='price' placeholder='Цена товара' ></p>

    <p><textarea rows='15' cols='80' name='text'Style=' resize:none'>Т
    ут типа описание товара ЛОЛ.
    </textarea></p>
    </div>

    <div class='img_block'>
        <img src='/resource/img/BG.jpg' width='250px' height='250px' >
        <p><input type='file' name='f' accept='image/jpeg'>
    </div>
    <p>
    <input type='submit' class='a_button' name='enter' value='Добавить'> 
    </p>
    </form>
    
    
    
    
    <br>
    <hr>
    <br>
     <p>
    <select id='category_4' name='category' class='select_c' onclick='loadselect(4)'>
    <option>Выберите Категорию</option>";
    $result=mysqli_query($CONNECT,"SELECT id, name FROM `category`");
    while ($row=mysqli_fetch_array($result))
         {
            print "<option value=".$row['id'].">";
            print $row['name'];
            echo("</option>");
         }
    echo" </select>
    
    <select id='scategory_4' name='scategory' class='select_s'>
    
    </select>
    </p>
    
    <div class='block_tovar'>
    <div class='z_tovar  ' id='z_head' style='float:left'>
        <div class='z_it z_id'>Номер товара</div>
        <div class='z_it'>Наимменование</div>
        <div class='z_it z_id'>Количество товара</div>
        <div class='z_it z_id'>Цена товара</div>
    </div>";
    $row=mysqli_query($CONNECT,"SELECT * FROM `product`");
    while($data=  mysqli_fetch_array($row))
    {
        echo"<div class='z_tovar a_list' style='float:left;'> 
            <div class='z_it z_id'>".$data['id']."</div>
            <div class='z_it '>".$data['name']."</div>
            <div class='z_it z_id'>".$data['count']."</div>
            <div class='z_it z_id'>".$data['price']."</div>
            <form method='POST' action='/adm/rem_tovar/t/".$data['id']."' >
                <input type='submit'  name='enter' value='Удалить'>
            </form>
            </div>";
    }
    echo "</div>
    </div>";

    echo"</div></div>";
}
  
    /**************************************
                ********************************
                                ********************************/
/**************************************
                ********************************
                                ********************************/
$select =(int) $_POST["select"];
$id_s =(int) $_POST["id_s"];
if($id_s and $select)
{
    echo "<option>Выберите Подкатегорию</option>";
    $result=mysqli_query($CONNECT,"SELECT id, name FROM `s_category` WHERE id_c='$id_s'");
    
    while ($row=mysqli_fetch_array($result))
         {
            print "<option value=".$row['id'].">";
            print $row['name'];
            echo("</option>");
         }
    echo" </select>";
}
?>