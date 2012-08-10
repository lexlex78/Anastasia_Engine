<div><?=$GLOBALS[tree_body]?></div>
<div id="modloadtree_<?=$GLOBALS['ta_tabl']?>" style="display: none;font-size: 10px;"  title=""></div>
<script type="text/javascript">
    
    function sel_all<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?>(){
    var unchecked = $('#ram_<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?> .cece ').filter(":not(:checked)");
    unchecked.each(function(){$(this).prop('checked',true);});  
   }
     function unsel_all<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?>(){
    var checked = $('#ram_<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?> .cece').filter(":checked");
    checked.each(function(){$(this).prop('checked',false);});
    
   }
   function insel_all<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?>(){
       
    var checked = $('#ram_<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?> .cece').filter(":checked");
    var unchecked = $('#ram_<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?> .cece').filter(":not(:checked)");
    checked.each(function(){$(this).prop('checked',false);});
    unchecked.each(function(){$(this).prop('checked',true);});  
    
   }
    
    
    var n_rel<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?>=0;
    function showRequest<?=$GLOBALS['ta_tabl']?> (){
    $("#modloadtree_<?=$GLOBALS['ta_tabl']?>" ).html('<center><img src="/css/images/load.gif"/></center>');  
   }   
    
     function showResponse<?=$GLOBALS['ta_tabl']?> (){
   $( "#modloadtree_<?=$GLOBALS['ta_tabl']?>" ).dialog("close"); 
   $( "#modloadtree_<?=$GLOBALS['ta_tabl']?>" ).html(''); 
   
   reload_<?=$GLOBALS['ta_tabl']?>();
   }  
    
    function send_<?=$GLOBALS['ta_tabl']?>(n){
    n_rel<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?>=n;
    $.each( $('textarea.tiny') ,
       function(){
           $(this).val(tinyMCE.get($(this).attr('name')).getContent());
           });
          
      $('#form_<?=$GLOBALS['ta_tabl']?>').ajaxForm({success: showResponse<?=$GLOBALS['ta_tabl']?> ,beforeSubmit: showRequest<?=$GLOBALS['ta_tabl']?>}).submit();
   }
    
    
    //////////////////// добавить /////////////////////////////////////////////////////
  function add<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?>(){
  kol=$("#ram_<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?> .cece:checked ").length;
if (kol<2){  
  id_kuda=$("#ram_<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?> .cece:checked ").attr('value');
          $.ajax({
         type: "POST",
         url: "/core/admin/add_tree.php",
         data: {tabl:'<?=$GLOBALS['ta_tabl']?>', dat: '<?=$GLOBALS['ta_dat']?>', id_kuda:id_kuda,pid:'<?=$GLOBALS['tree_pid']?>',sort:'<?=$GLOBALS['tree_sort']?>'}
          }).done(function( msg ) {
           
          
          $("#modloadtree_<?=$GLOBALS['ta_tabl']?>").html(msg);
          $( "#modloadtree_<?=$GLOBALS['ta_tabl']?>" ).append('<br><button  onclick="send_<?=$GLOBALS['ta_tabl']?>('+id_kuda+');">Сохранить</button>\n\
          <button onclick="$(\'#modload_<?=$GLOBALS['ta_tabl']?>\').dialog(\'close\');$(\'#modloadtree_<?=$GLOBALS['ta_tabl']?>\').html(\'\');">Отменить</button>');
    
          $("#modloadtree_<?=$GLOBALS['ta_tabl']?> button").button();
         
         $("#modloadtree_<?=$GLOBALS['ta_tabl']?> form").validationEngine();
          tiniini();
         
          $(".daty").datepicker();$(".daty").datepicker( "option", "dateFormat","yy-mm-dd");
          $(".timy").timepicker({
	timeOnlyTitle: 'Выберите время',
	timeText: 'Время',
	hourText: 'Часы',
	minuteText: 'Минуты',
	secondText: 'Секунды',
	currentText: 'Теперь',
	closeText: 'Закрыть'});
          $(".datytimy").timepicker();
          $(".datytimy").datepicker( "option", "dateFormat","yy-mm-dd");
         
          
          $("#modloadtree_<?=$GLOBALS['ta_tabl']?>" ).dialog({autoOpen: true,modal:true,width: 900,title: "Добавить"},"open");
                              
          });
    }
    else {alert('Нужно выбирать не болие одной ветки!!!!')}
  }  
  
 /////////////////////////////////////////////////////////////////////////////////  

 //////////////////// редактироваание /////////////////////////////////////////////////////
  function edit<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?>(){
  kol=$("#ram_<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?>  .cece:checked").length;
if (kol==1){  
  id_kuda=$("#ram_<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?> .cece:checked ").attr('value');
          $.ajax({
         type: "POST",
         url: "/core/admin/edit_tree.php",
         data: {tabl:'<?=$GLOBALS['ta_tabl']?>', dat: '<?=$GLOBALS['ta_dat']?>', id_kuda:id_kuda,pid:'<?=$GLOBALS['tree_pid']?>'}
          }).done(function( msg ) {
           
          
          $("#modloadtree_<?=$GLOBALS['ta_tabl']?>").html(msg);
          $( "#modloadtree_<?=$GLOBALS['ta_tabl']?>" ).append('<br><button  onclick="send_<?=$GLOBALS['ta_tabl']?>('+id_kuda+');">Сохранить</button>\n\
          <button onclick="$(\'#modloadtree_<?=$GLOBALS['ta_tabl']?>\').dialog(\'close\');$(\'#modloadtree_<?=$GLOBALS['ta_tabl']?>\').html(\'\');">Отменить</button>');
    
          $("#modloadtree_<?=$GLOBALS['ta_tabl']?> button").button();
         
         $("#modloadtree_<?=$GLOBALS['ta_tabl']?> form").validationEngine();
          tiniini();
         
          $(".daty").datepicker();$(".daty").datepicker( "option", "dateFormat","yy-mm-dd");
          $(".timy").timepicker({
	timeOnlyTitle: 'Выберите время',
	timeText: 'Время',
	hourText: 'Часы',
	minuteText: 'Минуты',
	secondText: 'Секунды',
	currentText: 'Теперь',
	closeText: 'Закрыть'});
          $(".datytimy").timepicker();
          $(".datytimy").datepicker( "option", "dateFormat","yy-mm-dd");
         
          
          $("#modloadtree_<?=$GLOBALS['ta_tabl']?>" ).dialog({autoOpen: true,modal:true,width: 900,title: "Добавить"},"open");
          
                    
          });
    }
    else {alert('Нужно выбирать одну ветки!!!!')}
  }  
 ///////////////////////////////////////////////////////////////////////////////// 
 
 
//////////////////// Удаление  /////////////////////////////////////////////////////
  function del<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?>(){
  kol=$("#ram_<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?> .cece:checked").length;
if (kol>0){  
  id_kuda=$("#ram_<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?> .cece:checked").attr('value');
  if (confirm("Удалить?") ){
      
      //id - id в строку через,/
        obj=$("#ram_<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?> .cece:checked");
        id='';
	$.each( obj ,function(){id=id+$(this).attr('value')+',';});
        id=id.slice(0, -1);
      
          $.ajax({
         type: "POST",
         url: "/core/admin/tree_del.php",
         data: {tabl:'<?=$GLOBALS['ta_tabl']?>', dat: '<?=$GLOBALS['ta_dat']?>',ids:id}
         }).done(function( msg ) {
           
          reload_<?=$GLOBALS['ta_tabl']?>(0);                    
          });
     }     
    }
    else {alert('Нужно выбирать ветки!!!!')}
  }  
 ///////////////////////////////////////////////////////////////////////////////// 
 
 
 


function ini_<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?> (){

 $("#<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?>").treeview();
  
 
 $( "#<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?> span" ).draggable({ 
     revert: true,
     containment: "#ram_<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?>" });
 
 
 
 
 $( "#<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?> span , #cor_<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?>" ).droppable({
			drop: function( event, ui ) {
			id_kto=$(ui.draggable).attr('num');
                        id_kuda=$(this).attr('num');
                        
	$("#<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?>" ).append('<div style="position:absolute;top:0px;left:0px; width: 100%; height: 100%; background: #fff; opacity: 0.7"><center><img style="position:absolute;top:40px;" src="/css/images/load.gif"/></center></div>');		
         $.ajax({
         type: "POST",
         url: "/core/admin/tree_drop.php",
         data: {id_kto:id_kto,id_kuda:id_kuda,data:<?=$GLOBALS['js_dan']?>}
         })
         .done(function( msg ) {
          n_rel<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?>=id_kuda;   
         //перегружаем 
         
          reload_<?=$GLOBALS['ta_tabl']?>(id_kuda);
         
         
         });
    
    }       
                        
                        
		});
 
 }
 
 ini_<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?> ();
 
 
 
 function  reload_<?=$GLOBALS['ta_tabl']?>(n){
 $("#<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?>" ).append('<div style="position:absolute;top:0px;left:0px; width: 100%; height: 100%; background: #fff; opacity: 0.7"><center><img style="position:absolute;top:40px;" src="/css/images/load.gif"/></center></div>');
  
  $.ajax({
         type: "POST",
         url: "/core/admin/tree_read.php",
         
         data: {id_kto:n,id_kuda:n,id_reload:n_rel<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?>,data:<?=$GLOBALS['js_dan']?>}
         })
         .done(function( msg ) {
          $( "#<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?>" ).parent().parent().parent().html(msg);
          ini_<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?> ();
                  
         });
 
 
 }
 
</script>
