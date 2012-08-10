
<div  class="tree flexigrid" ><div style="padding: 6px;" class="mDiv" ><?=$GLOBALS['tree_title']?></div>
     <div class="tDiv"><div class="tDiv2">
             <div class="fbutton"><div><span onclick="add<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?>();">Добавить</span></div></div>
             <div class="fbutton"><div><span onclick="edit<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?>();" >Редактировать</span></div></div>
             <div class="fbutton"><div><span onclick="del<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?>();">Удалить</span></div></div>
             <div class="fbutton"><div><span onclick="sel_all<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?>();">Выбрать все</span></div></div>
             <div class="fbutton"><div><span onclick="unsel_all<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?>();">Отменить выбор</span></div></div>
             <div class="fbutton"><div><span onclick="insel_all<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?>();">Инвертировать выбор</span></div>
             </div><div class="btnseparator"></div></div><div style="clear:both"></div></div>
    
    <div style="margin: 9px;overflow: hidden;" id="ram_<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?>" >
        <div style="width: 100%;border: 1px black dashed" id="cor_<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?>" num="0" ><center>корень</center></div>
<?=$GLOBALS[tree_dan]?>
    </div>
</div>
