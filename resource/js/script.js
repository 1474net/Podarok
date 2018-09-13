
function get_tov(id){
             $.ajax({
          type: "POST",
          url: "resource/sr/sr_index.php",
          dataType: "html",
          data: { id_categoru : id},
          success: function(data) {
              $("#scat").html(data);
              }
    });  
}

function get_men(id){
          $.ajax({
          type: "POST",
          url: "resource/sr/sr_index.php",
          dataType: "html",
          data: { id_scategoru : id},
          success: function(data) {
              $(".masonry").html(data);
              }
    }); 
}

function menu(){
    console.log("as");

    state=document.getElementById("menu").style.display;
    if(state=="none" && state!="block" ){
        $("#menu").fadeIn(500);
    }else
    {   
        document.getElementById('menu').style.display = "none"; 
    }
} 
function pokaz_tovar(id,state){

    if(state=='block'){
       $("#tov_form").fadeIn(450);
        document.getElementById('wrap').style.display = state;
        get_tover(id);
    }
    else{
    document.getElementById('tov_form').style.display = state;			
    document.getElementById('wrap').style.display = state; 
    }
}
function get_tover(id){
             $.ajax({
          type: "POST",
          url: "resource/sr/sr_index.php",
          dataType: "html",
          data: { tovar_id : id,},
          success: function(data) {
              $("#tov_form").html(data);
              }
    }); 
}

function show(state){

    if(state=='block'){
       $("#reg_form").fadeIn(700);
        document.getElementById('wrap').style.display = state;
        lesectreg('log');
    }
    else{
    document.getElementById('reg_form').style.display = state;			
    document.getElementById('wrap').style.display = state; 
    }
}
function lesectreg(state){
          $.ajax({
          type: "POST",
          url: "resource/sr/sr_index.php",
          dataType: "html",
          data: { chek : state,},
          success: function(data) {
              $(".tab-content").html(data);
              }
    });
    
}

function adm(key){
        console.log(key);
        $.ajax({
        type: "POST",
        url: "resource/sr/admin.php",
        dataType: "html",
        data: {key : key},
        success: function(data) {
            $(".profil_inf").html(data);
        }
    });
        
}
/***********************************************************************/
kol=1;
    function pokaz()
    {
        a="block_";
a=a+kol;
            document.getElementById(a).style.display="block";  
        kol=kol+1;
    }
/***********************************************************************/
function del(b)
    {   
        a="#tovar_";
        a=a+b;
        console.log(a);
        $(a).hide('slow', function(){
        $(this).remove();
            
          
    }); 
        $.ajax({
          type: "POST",
          url: "resource/sr/corzina.php",
          dataType: "html",
          data: { chek : 1, nomer : b},
          success: function(data) {
              $(".ifo_conf").html(data);
              }
    });
    }
/***********************************************************************/
function minus(c)
    {  
        col = $('#tovar_'+c+' div.col'); 
        p=col.text();
        console.log(p);
        if(p==1)
            {if(confirm('Вы хотите удалить товар?')) 
                {del(c);} }
        else {        
            p--;
            $('#tovar_'+c+' div.col').html(p);
        
       $.ajax({
          type: "POST",
          url: "resource/sr/corzina.php",
          dataType: "html",
          data: { chek : 2, nomer : c},
          success: function(data) {
              $(".ifo_conf").html(data);
          }
              
    });
            }
    }
/***********************************************************************/    
function plus(b)
    {   
        col = $('#tovar_'+b+' div.col'); 
        p=col.text();
        console.log(p);
        if(p>20)
            {alert('Больше 99 товаров добавить нельзя!');}
        else {        
            p++;
            $('#tovar_'+    b+' div.col').html(p);
        
       $.ajax({
          type: "POST",
          url: "resource/sr/corzina.php",
          dataType: "html",
          data: { chek : 3, nomer : b},
          success: function(data) {
              $(".ifo_conf").html(data);
          }
              
    });
            }
    } 
/***********************************************************************/
function openmod(b){
            console.log(b);
            $.ajax({
            type: "POST",
            url: "resource/sr/pr.php",
            dataType: "html",
            data: {nomer : b},
            success: function(data) {
                $(".profil_inf").html(data);
            }
    }); 
}
/***********************************************************************/
function loadselect(b){
    console.log(b);
    id_s = $('#category_'+b).val();
    console.log(Number(id_s));
   
    $.ajax({
    type: "POST",
    url: "resource/sr/admin.php",
    dataType: "html",
    data: {select : b, id_s : id_s },
    success: function(data) {
    $("#scategory_"+b).html(data);
    } }); 
    
}
/***********************************************************************/
/***********************************************************************/
/***********************************************************************/

function openzak(id){
      console.log(id);
      $.ajax({
      type: "POST",
      url: "resource/sr/pr.php",
      dataType: "html",
      data: {id_zakaz : id},
      success: function(data) {
      $(".profil_inf").html(data);
      } }); 
}
/***********************************************************************/
function addcor(){

    var allprice = $('#block-cart span#price').attr("price");
    var count = $('#block-cart span.count').attr("cun");       
    var price = $('.add_tovar').attr("price");
    var name = $('.add_tovar').attr("name_t");
    console.log(name);

    console.log(price);
    var tovarid = $('.add_tovar').attr("rel");
        console.log(Number(tovarid));
        $.ajax({
          type: "POST",
          url: "resource/sr/add_tov.php",
          dataType: "html",
          data: { t_id : tovarid, t_price : price, t_name : name},
          success: function(data) {
              $("#kor").html(data);
              }
    });
}

$(document).ready(function() {
  document.getElementById('menu').style.display = "none";
  /* var dpt = window.devicePixelRatio;
   var widthM = window.screen.width;
   var widthH = window.screen.height;
   if (widthM*dpt < 976) {
   document.write('<meta name="viewport" content="width=1024, user-scalable=yes">');
    }*/
   /* $('.add_tovar').click(function(){
    //var allprice = $('#block-cart span#price').attr("price");
    //var count = $('#block-cart span.count').attr("cun");       
    var price = $(this).attr("price");
    var name = $(this).attr("name_t");
    console.log(name);
    var tovarid = $(this).attr("rel");

/*
    newprice = Number(allprice) + Number(price); 
    newcount =  Number(count);
    newcount++;

    $('#block-cart span.count').html("("+newcount+")").attr("cun",newcount);
    $('#block-cart span#price').html(newprice+' руб.').attr("price",newprice);

*/
      /*  $.ajax({
          type: "POST",
          url: "resource/sr/add_tov.php",
          dataType: "html",
          data: { t_id : tovarid, t_price : price, t_name : name},
          success: function(data) {
              $(".hamper").html(data);
              }
    });
    });  */

});   