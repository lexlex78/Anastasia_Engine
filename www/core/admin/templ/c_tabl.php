
<div id="flex2_<?=$GLOBALS['ta_tabl']?>" style="width:100%" ><div id="flex1_<?=$GLOBALS['ta_tabl']?>"></div></div>
<div id="modload_<?=$GLOBALS['ta_tabl']?>" style="display: none;font-size: 10px;"  title=""></div>

        
<script type="text/javascript">
            
                    
                
   //показывает ход выполения отправки поста             
   function showRequest<?=$GLOBALS['ta_tabl']?> (){
    $("#modload_<?=$GLOBALS['ta_tabl']?>" ).html('<center><img src="/css/images/load.gif"/></center>');  
   }           
  //после отправки формы закрывает окно
  // и обновляет таблицу
   function showResponse<?=$GLOBALS['ta_tabl']?> (){
   $( "#modload_<?=$GLOBALS['ta_tabl']?>" ).dialog("close"); 
   $( "#modload_<?=$GLOBALS['ta_tabl']?>" ).html('');   
   $('#flex1_<?=$GLOBALS['ta_tabl']?>').flexReload();    
   }  
   
   function selall<?=$GLOBALS['ta_tabl']?>(){
    $('#flex1_<?=$GLOBALS['ta_tabl']?> tr').addClass('trSelected');   
   }
     function unselall<?=$GLOBALS['ta_tabl']?>(){
    $('#flex1_<?=$GLOBALS['ta_tabl']?> tr').removeClass('trSelected');  
   }
   function invselall<?=$GLOBALS['ta_tabl']?>(){
    $('#flex1_<?=$GLOBALS['ta_tabl']?> tr').toggleClass('trSelected');   
   }
   
   function send_<?=$GLOBALS['ta_tabl']?>(){
    $.each( $('textarea.tiny') ,
       function(){
           $(this).val(tinyMCE.get($(this).attr('name')).getContent());
           });
           
      $('#form_<?=$GLOBALS['ta_tabl']?>').ajaxForm({success: showResponse<?=$GLOBALS['ta_tabl']?> ,beforeSubmit: showRequest<?=$GLOBALS['ta_tabl']?>}).submit();
   }
   
   // попдаем сюда поле нажатия дополнительных кнопок  
   <?=$GLOBALS['t_dop_but_sc']?>
   
   // попдаем сюда поле нажатия кнопки(добавить удалить и тд)  
   function go<?=$GLOBALS['ta_tabl']?> (com, grid) {
        /col количество выбранных строк/	
	col=$('.trSelected', grid).length;
    
        /id - id в строку через,/
        obj= $('.trSelected', grid);
        id='';
	$.each( obj ,function(){id=id+$(this).attr('id').substring(3)+',';});
        id=id.slice(0, -1);
        /добовляем запись////////////////////////
     if (com=="Добавить"){
         $.ajax({
         type: "POST",
         url: "/core/admin/add.php",
         data: {tabl:'<?=$GLOBALS['ta_tabl']?>', dat: '<?=$GLOBALS['ta_dat']?>', dop_wh: '<?=$GLOBALS['ta_dw']?>'}
          }).done(function( msg ) {
           
          
          $("#modload_<?=$GLOBALS['ta_tabl']?>").html(msg);
          $( "#modload_<?=$GLOBALS['ta_tabl']?>" ).append('<br><button  onclick="send_<?=$GLOBALS['ta_tabl']?>();">Сохранить</button>\n\
          <button onclick="$(\'#modload_<?=$GLOBALS['ta_tabl']?>\').dialog(\'close\');$(\'#modload_<?=$GLOBALS['ta_tabl']?>\').html(\'\');">Отменить</button>');
    
          $("#modload_<?=$GLOBALS['ta_tabl']?> button").button();
          
          $("#modload_<?=$GLOBALS['ta_tabl']?>" ).dialog({autoOpen: true,modal:true,width: 900,title: "Добавить"});
          $( "#modload_<?=$GLOBALS['ta_tabl']?>").dialog("open");
          
         
         $("#modload_<?=$GLOBALS['ta_tabl']?> form").validationEngine();
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
          $(".datytimy").datetimepicker({
            dateFormat:'yy-mm-dd',
        	addSliderAccess: true,
	sliderAccessArgs: { touchonly: false }
});
         
          
          
          
          
           
          });
          }
          
    /удаляем запись///////////////////
    if (com=="Удалить"){
    //запрос на удаление
    
    if (col<=0){alert("Невыбраны записи!!!");}
    else{if (confirm("Удалить?") ){
         $.ajax({
         type: "POST",
         url: "/core/admin/del_bd.php",
         data: {tabl:'<?=$GLOBALS['ta_tabl']?>',ids:id,dat:'<?=$GLOBALS['ta_dat']?>'}
        })
         .done(function( msg ) {
         
         
         //после удаления перегружаемся
         $('#flex1_<?=$GLOBALS['ta_tabl']?>').flexReload();
         });
    
    }
    }    
    }
    /////////////////////
    
    ///изменяем запись
    if (com=="Редактировать"){
     if (col!=1){alert("Выбирите одну запись!!!");}
     else {
                $.ajax({
                type: "POST",
                url: "/core/admin/edit.php",
                data: {tabl:'<?=$GLOBALS['ta_tabl']?>', dat: '<?=$GLOBALS['ta_dat']?>', id:id}
                }).done(function( msg ) {
                    
                

                $("#modload_<?=$GLOBALS['ta_tabl']?>").html(msg);
                $( "#modload_<?=$GLOBALS['ta_tabl']?>" ).append('<br><button  onclick="send_<?=$GLOBALS['ta_tabl']?>();">Сохранить</button>\n\
                <button onclick="$(\'#modload_<?=$GLOBALS['ta_tabl']?>\').dialog(\'close\');$(\'#modload_<?=$GLOBALS['ta_tabl']?>\').html(\'\');">Отменить</button>');

                $("#modload_<?=$GLOBALS['ta_tabl']?> button").button();
                
          $("#modload_<?=$GLOBALS['ta_tabl']?>" ).dialog({autoOpen: true,modal:true,width: 900,title: "Редактировать"});
          $( "#modload_<?=$GLOBALS['ta_tabl']?>").dialog("open");      
         
         $("#modload_<?=$GLOBALS['ta_tabl']?> form").validationEngine();
          
          $(".daty").datepicker();$(".daty").datepicker( "option", "dateFormat","yy-mm-dd");
          
          $(".timy").timepicker({
	timeOnlyTitle: 'Выберите время',
	timeText: 'Время',
	hourText: 'Часы',
	minuteText: 'Минуты',
	secondText: 'Секунды',
	currentText: 'Теперь',
	closeText: 'Закрыть'});
        $(".datytimy").datetimepicker({
            dateFormat:'yy-mm-dd',
        	addSliderAccess: true,
	sliderAccessArgs: { touchonly: false }
});
      
          
          
          
         tiniini();
                
                     
                

                });
     
          }
    }
    ////////////////////
    
    
   }	
   
   function sort<?=$GLOBALS['ta_tabl']?> (name,id){
     
   $.ajax({
         type: "POST",
         url: "/core/admin/sort_bd.php",
         data: {tabl:'<?=$GLOBALS['ta_tabl']?>',
         name:name,id:id,
         sortname:'<?=$GLOBALS['ta_sortname']?>',
         sortorder:'<?=$GLOBALS['ta_sortorder']?>',
         dat:'<?=$GLOBALS['ta_dat']?>',
         where:'<?=$GLOBALS['ta_where']?>'
          }
        })
         .done(function( msg ) {
         
         
         // перегружаемся
         $('#flex1_<?=$GLOBALS['ta_tabl']?>').flexReload();
         });
   
  } 
  /////////////////////   


$("#flex1_<?=$GLOBALS['ta_tabl']?>").flexigrid({
	url: '/core/admin/read.php',
	dataType: 'json',
	colModel : [<?=$GLOBALS['ta_colModel']?>],
	buttons : [
		<? if ($GLOBALS['ta_dat1']['add']!='0')echo"{name: 'Добавить', bclass: '', onpress : go".$GLOBALS['ta_tabl']."},"?>
                <? if ($GLOBALS['ta_dat1']['edit']!='0')echo"{name: 'Редактировать', bclass: '', onpress : go".$GLOBALS['ta_tabl']."},"?>
                <? if ($GLOBALS['ta_dat1']['del']!='0')echo"{name: 'Удалить', bclass: '', onpress : go".$GLOBALS['ta_tabl']."},"?>
                    
                <? if ($GLOBALS['ta_dat1']['sel_all']!='0')echo"{name: 'Выбрать все', bclass: '', onpress : selall".$GLOBALS['ta_tabl']."},"?>
                <? if ($GLOBALS['ta_dat1']['an_sel_all']!='0')echo"{name: 'Отменить выбор', bclass: '', onpress : unselall".$GLOBALS['ta_tabl']."},"?>
                <? if ($GLOBALS['ta_dat1']['in_sel_all']!='0')echo"{name: 'Инвертировать выбор', bclass: '', onpress : invselall".$GLOBALS['ta_tabl']."},"?>
                <?=$GLOBALS['t_dop_but']?>   
                {separator: true}
		],
	searchitems : [
                <?=$GLOBALS['ta_searchitems']?>
				],
	sortname: "<?=$GLOBALS['ta_sortname']?>",
	sortorder: "<?=$GLOBALS['ta_sortorder']?>",
	usepager: true,
	title: '<?=$GLOBALS['ta_title']?>',
	useRp: true,
	rp: 15,
	showTableToggleBtn: true,
	//width: 700,
	height: 'auto',
        pagestat: 'Показанно от {from} до {to} из {total} записей',
			pagetext: 'Страница',
			outof: 'из',
			findtext: 'Найти',
			procmsg: 'Пожалуйста, ждите ...',
			nomsg: 'Нет записей',
                        params:[
                            {name: 'dat',value: '<?=$GLOBALS['ta_dat']?>'},
                            {name: 'tabl',value: '<?=$GLOBALS['ta_tabl']?>'},
                            {name: 'where',value: '<?=$GLOBALS['ta_where']?>'},
                            
                        ]
});

//$( "#flex2_<?=$GLOBALS['ta_tabl']?>" ).draggable({ handle: ".ftitle",containment: "body", scroll: false  });
	

</script>