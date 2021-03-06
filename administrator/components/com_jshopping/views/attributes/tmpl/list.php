<?php 
	defined('_JEXEC') or die();
	displaySubmenuOptions();
	$rows = $this->rows; $count = count ($rows); $i = 0; 
	$saveOrder = $this->filter_order_Dir=="asc" && $this->filter_order=="attr_ordering";
?>
<form action = "index.php?option=com_jshopping&controller=attributes" method = "post" name = "adminForm">
<table class = "adminlist">
<thead>
  <tr>
    <th class = "title" width  = "10">
        #
    </th>
    <th width = "20">
        <input type="checkbox" name="toggle" value="" onClick="checkAll(<?php echo $count;?>);" />
    </th>
    <th width = "200" align = "left">
        <?php echo JHTML::_('grid.sort', _JSHOP_TITLE, 'name', $this->filter_order_Dir, $this->filter_order); ?>
    </th>
    <th align = "left">
        <?php echo _JSHOP_OPTIONS; ?>
    </th>
    <th align = "left">
        <?php echo JHTML::_('grid.sort', _JSHOP_DEPENDENT, 'independent', $this->filter_order_Dir, $this->filter_order); ?>
    </th>
    <th colspan = "3" width = "40">
        <?php echo JHTML::_('grid.sort', _JSHOP_ORDERING, 'attr_ordering', $this->filter_order_Dir, $this->filter_order); ?>
        <?php if ($saveOrder){?>
            <a class="saveorder" href="javascript:saveorder(<?php echo ($count-1);?>, 'saveorder')"></a>
        <?php }?>
    </th>
    <th width = "50">
        <?php echo _JSHOP_EDIT; ?>
    </th>
    <th width = "40">
        <?php echo JHTML::_('grid.sort', _JSHOP_ID, 'attr_id', $this->filter_order_Dir, $this->filter_order); ?>
    </th>
  </tr>
</thead>
<?php
 $count = count($rows);
 foreach ($rows as $row){
 ?>
  <tr class = "row<?php echo $i % 2;?>">
   <td>
     <?php echo $i + 1;?>
   </td>
   <td>
     <input type = "checkbox" onclick = "isChecked(this.checked)" name = "cid[]" id = "cb<?php echo $i;?>" value = "<?php echo $row->attr_id?>" />
   </td>
   <td>
    <?php if (!$row->count_values) {?><img src="components/com_jshopping/images/disabled.png" alt="" /><?php }?>
     <a href = "index.php?option=com_jshopping&controller=attributes&task=edit&attr_id=<?php echo $row->attr_id; ?>"><?php echo $row->name;?></a>
   </td>
   <td>
     <a href = "index.php?option=com_jshopping&controller=attributesvalues&task=show&attr_id=<?php echo $row->attr_id?>"><?php echo _JSHOP_OPTIONS?></a>
     <?php echo $row->values;?>
   </td>
   <td>
    <?php if ($row->independent==0){
        print _JSHOP_YES;
    }else{
        print _JSHOP_NO;
    }?>
   </td>
   <td align = "right" width = "20">
   <?php
        if ($i != 0 && $saveOrder) echo '<a href = "index.php?option=com_jshopping&controller=attributes&task=order&id=' . $row->attr_id . '&order=up&number=' . $row->attr_ordering . '"><img alt="' . _JSHOP_UP . '" src="components/com_jshopping/images/uparrow.png"/></a>';
   ?>
   </td>
   <td align = "left" width = "20">
   <?php
        if ($i!=$count-1 && $saveOrder) echo '<a href = "index.php?option=com_jshopping&controller=attributes&task=order&id=' . $row->attr_id . '&order=down&number=' . $row->attr_ordering . '"><img alt="' . _JSHOP_DOWN . '" src="components/com_jshopping/images/downarrow.png"/></a>';
   ?>
   </td>
   <td align = "center" width = "10">
    <input type="text" name="order[]" id = "ord<?php echo $row->attr_id;?>" size="5" value="<?php echo $row->attr_ordering?>" <?php if (!$saveOrder) echo 'disabled'?> class="text_area" style="text-align: center" />
   </td>
   <td align="center">
        <a href='index.php?option=com_jshopping&controller=attributes&task=edit&attr_id=<?php print $row->attr_id;?>'><img src='components/com_jshopping/images/icon-16-edit.png'></a>
   </td>
   <td align="center">
    <?php print $row->attr_id;?>
   </td>
  </tr>
<?php
$i++;
}
?>
</table>

<input type="hidden" name="filter_order" value="<?php echo $this->filter_order?>" />
<input type="hidden" name="filter_order_Dir" value="<?php echo $this->filter_order_Dir?>" />
<input type = "hidden" name = "task" value = "<?php echo JRequest::getVar('task', 0)?>" />
<input type = "hidden" name = "hidemainmenu" value = "0" />
<input type = "hidden" name = "boxchecked" value = "0" />
</form>