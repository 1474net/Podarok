<html>
<head>
   <meta charset="utf-8">
    <title>Магазин "Подарок"</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width">


</head>

<body>

   <div onclick="show('none'); pokaz_tovar(0,'none')" id="wrap"></div> 
<header>
    
        <div class="header-top">
               <div class="gam_men">
                   <button class="cmn-toggle-switch cmn-toggle-switch__rot" onclick="menu()">
                     <span>toggle menu</span>
                 </button>
                </div>
        <a href="/" class="logo">Подарок</a>
        <img src="/resource/img/logo.png" ">
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
   
    <div class="tov_form" id='tov_form'> 

    </div>


       
       
    <div class='block_top'>
       <div class="menu" id="menu">
       <?php 
           global $CONNECT;
       $row=mysqli_query($CONNECT, "SELECT `id`,`name` FROM `category`");
       echo "<div class='cat'>";
       while($data=mysqli_fetch_array($row)){
           echo "<div class='i_cat'><a href='#tovar' onclick='get_tov(".$data['id'].")'>".$data['name']."</a></div>";
       }
        echo "</div>";
       ?>
           <div class='scat' id='scat'>
               
           </div>    
   </div>
        
        <div class="search_block">
            <div class="block_head">
           <span>
               Поиск
           </span>
       </div>
            <div class="search">
                <input type="text" name='search' class='inp_search'>
            </div>
            <div class='tag_list'>
                <div class="block_teg">
                    <div class="tag"> 
                        <span>Часы</span>
                    </div>
                    <div class="tag"> 
                        <span>Наручные</span>
                    </div>
                    <div class="tag"> 
                        <span>Мужские</span>
                    </div><div class="tag"> 
                        <span>Current</span>
                    </div>
                    <div class="tag"> 
                        <span>Черные</span>
                    </div>
                    <div class="tag"> 
                        <span>Кожа</span>
                    </div>
                    <div class="tag"> 
                        <span>Механические</span>
                    </div>
   
                </div>
            </div>
         </div> 
        <a href="corzina">  <div class="hamp_block">
            <div class="hamper">
                    <div class="block_head">
                        <span>
                           <img src="resource/img/icon/shoping.ico" style="width: 24px; height: 24px; display: inline-block; margin: -3px"> Корзина
                        </span>
                    </div> 
                <div id="kor">
                <div>Сумма: <?PHP echo $_SESSION['TOTAL_PRICE']; ?></div>
                <div> Количество:<?PHP echo $_SESSION['TOTAL_COUNT']; ?></div>
                </div>
            </div></a>
        </div>
    </div>  
   <div class="block_content">
   <div class='list_tovar'>
       <div class="block_head">
           <span>
               Товар
           </span>
       </div>
       <div class='masonry'>
           <?PHP
           $row=  mysqli_query($CONNECT, "SELECT p.id as id_p, p.name , p.price, im.id as picture  FROM product p LEFT JOIN image im ON p.id=im.id_p WHERE im.osn=1");
           $it=1;
           while ($data=mysqli_fetch_array($row) and $id<=16){
               echo "<div class='item'>
                    <a href='#' onclick=pokaz_tovar(".$data['id_p'].",'block')><img src='resource/img/tovar/".$data['picture'].".jpg'></a>
                    ".$data['name']."
                    <br>".$data['price']." Рублей
                    </div>"
               . "";
               $it++;
           }
           
           ?>
       </div>
   </div>
       <div class="list_news">
           <div class="block_head" style="margin-bottom: 0.5em">
                    <span>
                        Новости
                    </span>
                </div>
           <div class="block_news">
               <div class="news_img">
                   
               <img src="resource/img/news/sale.jpg">
                </div>
               <span>
                   Акция!!
                   <br>1 купил второй в подарок!!
               </span>

               
               
           </div>
       </div>
   </div>
      
    <div id="footer">
  Телефон: 8-929-480-97-87<br>
    Адрес: 50 лет Октября Дом 40
  </div>
</body> 
<script>
    
   
(function() {
 
  "use strict";
 
  var toggles = document.querySelectorAll(".cmn-toggle-switch");
 
  for (var i = toggles.length - 1; i >= 0; i--) {
    var toggle = toggles[i];
    toggleHandler(toggle);
  };
 
  function toggleHandler(toggle) {
    toggle.addEventListener( "click", function(e) {
      e.preventDefault();
      (this.classList.contains("active") === true) ? this.classList.remove("active") : this.classList.add("active");
    });
  }
 
})();
    
</script>

    <!--CSS block -->
    <link href="resource/css.css"  type="text/css" rel="stylesheet">
    <!--CSS block -->
    
    <!--JS <script type="text/javascript" src="resource/js/jquery-1.8.2.min.js"></script>  block -->
    
    <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
    <script type="text/javascript" src="resource/js/script.js"></script>
</html>


