<html>
<head>
   <meta charset="utf-8">
    <title>Каталог товаров</title>
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    
    <!--CSS block -->
    <link href="resource/css.css"  type="text/css" rel="stylesheet">

    
    <!--CSS block -->
    
    <!--JS block -->
    <script type="text/javascript" src="resource/js/jquery-1.8.2.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.8.3.js"></script>
    <script type="text/javascript" src="resource/js/script.js"></script>
</head>

<body onload="pokaz();">
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
         <nav role="navigation">
		<ul>
    <?php  
            global $CONNECT;
        $sql='SELECT id, name FROM category';
        $category=mysqli_query($CONNECT,$sql);

        while  ($data = mysqli_fetch_assoc($category))
        {   $name=$data["name"];
            $scategory=mysqli_query($CONNECT,"SELECT name FROM s_category WHERE id_c='$data[id]'");
            
            
           
            echo "<li>

                    <a href='tovar?id=$name'>".$data['name']."</a><div>
                "; 
            if($scategory){
                 while  ($sdata = mysqli_fetch_assoc($scategory))
                 { $names=$sdata["name"];
                  
                     echo"
                    <ul>
						<li><a href='tovar?ids=$names'>".$sdata["name"]."</a></li>
					</ul>";
                }
                echo"
				</div>
			</li>";
        }
        }
    ?>
        </ul>
	</nav>
    </header>
    
      <?php
    MessageShow();
    ?>
   
<!--q#################################################################################################################################################################################################--> 
    
    <div class="content">
        <div class='con_top'>
       
                <a  href='corzina' class="kr" ><div class='hamper' id="block-cart">
                    <?php if(!$_SESSION['TOTAL_PRICE']){echo"Корзина пустая!";}
                    else {
                   echo "
                   <span class='count'>
                            (".$_SESSION['TOTAL_COUNT'].")
                     </span>
                    <span  
                          id='price'> ".$_SESSION['TOTAL_PRICE']." руб. 
                     </span>";}
                    ?>
                </div></a>
        </div> 
<!--q#################################################################################################################################################################################################-->        
        <div class="tovar_con">
            
            <?php
                $labels = 'ids';
                $name_s = false;
                if (  !empty( $_GET[ $labels ] )  )
                {
                    $name_s =FormChars( $_GET[ $labels ]);
                    $id_s=mysqli_fetch_assoc(mysqli_query($CONNECT,"SELECT id FROM s_category WHERE name='$name_s'"));
                    $tovar=mysqli_query($CONNECT,"SELECT p.id as id_p, p.name , p.price, im.id as picture  FROM product p LEFT JOIN image im ON p.id=im.id_p WHERE id_s='$id_s[id]' and im.osn=1 ");

                }               
                $label = 'id';
                $name = false;
                if (  !empty( $_GET[ $label ] )  )
                {
                  $name = FormChars($_GET[ $label ]);
                    $id=mysqli_fetch_assoc(mysqli_query($CONNECT,"SELECT id FROM category WHERE name='$name'"));
                    $id_s=mysqli_fetch_assoc(mysqli_query($CONNECT,"SELECT id FROM s_category WHERE id_c='$id[id]'"));
                    
                    $tovar=mysqli_query($CONNECT,"Select distinct(p.id) as id_p, p.name, p.price, im.id picture From s_category sc, product p LEFT JOIN image im ON p.id=im.id_p WHERE p.id_s=sc.id AND sc.id_c='$id[id]' AND im.osn=1");
                }
        $i=0;
        $k=1;
        echo "<div class='block' id='block_".$k."'>";
                    while  ($data = mysqli_fetch_assoc($tovar))
        {$i++;
                    echo"<div class='video'> 
                        <div id='product' class='product vid'>
                            <img             src='/resource/img/tovar/".$data["picture"].".jpg'>
                            <p >
                            <a id='name_tovar' href='#'>".$data["name"]."</a></p>
                            <p id='prize'>".$data["price"]." рублей</p>
                            <img class='img_rat' src='resource/img/gold.png'>
                            <div class='kor'>
                                <p price='".$data["price"]."' name_t='".$data["name"]."' rel='".$data["id_p"]."' class='add_tovar'>В корзину</p>
                            </div>
                        </div>
                    </div>"; 
         if($i%6==0){$k++; echo "</div><div class='block' id='block_".$k."'>";}            
        }
        echo "</div>";
            ?>
            <div class="add_more">
                <div class='more' onclick="pokaz();"> Показать еще</div>
            </div>
                            
           
            
            
        </div>
    
    </div>
 



