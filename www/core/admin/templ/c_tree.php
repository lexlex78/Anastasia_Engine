<div  class="tree flexigrid">
   
    <div style="padding: 6px;" class="mDiv" ><?=$GLOBALS['tree_title']?></div>
    <div style="margin: 9px;">
<?=$GLOBALS[tree_dan]?>
    </div>
</div>
<script type="text/javascript">
$("#<?=$GLOBALS['tree_tab'].'_'.$GLOBALS['tree_num']?>").treeview();
</script>