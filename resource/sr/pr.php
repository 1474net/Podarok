<?php
    session_start();
    include_once '../../setting.php';
    
    function GetStatus($p){
    if ($p == 1) return 'В обработке ';
    else if ($p == 2) return 'Приянт';
    else if ($p == 3) return 'Закрыт';
    }
$CONNECT = mysqli_connect(HOST, USER, PASS, DB);
    $p=$_POST["nomer"];
if ($p==1){
    echo"<div class='nf1''>
    <div class='profil_head'>
    <h1>Заказы</h1></div>
    <div class='p_inf'>";
    

    $order=mysqli_query($CONNECT,"SELECT id, status, date FROM `order` WHERE id_u='$_SESSION[USER_ID]'");
    
    while($data=mysqli_fetch_assoc($order)){      
    echo " <div class='zakaz'onclick=openzak(".$data[id].") >
    <div class='z_nomer'><b>№: </b>".$data['id']."</div>
    <div class='z_data'><b>Дата: </b>".$data['date']."</div>";
    $stat=  GetStatus($data['status']);
    echo "<div class='z_stat'><b>Статус: </b>".$stat."</div>
    </div>";
    }
    echo"</div></div>";
}

if ($p==2){
   echo" <div class='setting'>
   <div class='set_inf'>
   <span>Настройки пользователя</span>
    <form method='POST' action='/settings/'>
   <input type='text' name='email' placeholder='email'>
   <input type='phone' name='phone' placeholder='телефон'>
   </div>
   <div class='set_pas'>
   <span>Изменить пароль</span>
   <input type='password' name='password' placeholder='Старый пароль'>
   <input type='text' name='email' placeholder='Новый пароль'>
   <input type='text' name='email' placeholder='Повторите пароль'>
   </div>
   
   <div class='set_btn'> 
   <input type='submit' name='enter' value='Сохранить'>
   </div>
   </form>
   </div>";
}
if ($p==3){
    
}
$id_zakaz=(int)$_POST["id_zakaz"];
if  ($id_zakaz)
{

    echo "<span class='nomer_zakaza'>Заказ №: ".$id_zakaz."</span>" ;
    echo "<div class='list_z'>Список товаров</div>" ;
    $id_zakaz;
    $p_order=mysqli_query($CONNECT,"SELECT id_t, name, col, price FROM `p_order` WHERE id_o='$id_zakaz'");
    echo "<div class='z_list'>";
        echo"<div id='z_head ' style='border-top: 1px solid;'  class='z_tovar z_p'>
        <div  class='z_it z_id' >
        Номер</div>
        <div class='z_it' >
        Имя</div>
        <div class='z_it  z_id'>
        Кол. </div>
        <div class='z_it z_id'>
        Цена</div>
        </div>
        " ;   
    $i=1;
    while($data=mysqli_fetch_assoc($p_order))
    {
        $i=$i*-1;
        if($i==1){$bg="#C3E47A";}else{$bg="#67C1BB";}
        
        echo"<div  id='z_tovar_".$data['id_t']."'  class='z_tovar'         style='background-color:".$bg."'>

        <div class='z_it  z_id'>".$data['id_t']."
        </div>
        <div class='z_it'>".$data['name']."
        </div>
        <div class='z_it  z_id'>".$data['col']."
        </div>
        <div class='z_it z_id'>".$data['price']."
        </div>
        </div>
        " ;
        $t_col=$t_col+$data['col'];
        $t_price=$t_price+$data['price'];
    }
        $inf=mysqli_fetch_assoc(mysqli_query($CONNECT,"SELECT id_u, status, date FROM `order` WHERE id='$id_zakaz'"));
        
        $name=mysqli_fetch_assoc(mysqli_query($CONNECT,"SELECT name FROM `users` WHERE id='$inf[id_u]'"));
        
    echo "<div class='z_inf'>
    <div class='zs_inf'><label>Имя:</label> ".$name['name']."</div>
    <div class='zs_inf'><label>Дата:</label> ".$inf['date']."</div>";
            $stat=  GetStatus($inf['status']);
    echo "<div class='zs_inf'><label>Статус:</label> ". $stat."</div>
    <hr>
    <div class='zs_inf'><label>Кол. Товаров:</label> ".$t_col."</div>
    <div class='zs_inf'><label>Сумма:</label> ".$t_price."</div>
    </div>";
    
    if($_SESSION['ADMIN_LOG_IN']){
        echo "<div class='set_stat'>
        <h4>Изменить статус заказа</h4>
        <form method='POST' action='/adm/stat/zakaz/".$id_zakaz."'>
            <input type='radio' name='stat' value='close'> Подтвердить<Br>
            <input type='radio' name='stat' value='confirm'> Закрыть<Br>
            <input type='submit' name='enter' value='Сохранить'> 
        </form>   
    </div>";
        echo "<div class='ord_cnat'>
        <h4>Коментарии к заказу</h4>
        <div class='ord_mes'>Комментариев нет</div>
    </div>";
    }
    echo "</div>";
    
}
?>