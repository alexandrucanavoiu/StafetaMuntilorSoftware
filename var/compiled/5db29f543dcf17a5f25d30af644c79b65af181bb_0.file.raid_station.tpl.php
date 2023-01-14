<?php /* Smarty version 3.1.27, created on 2016-07-28 14:27:09
         compiled from "templates\challenges\components\raid_station.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:326505799ec0d6a59f2_30695618%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5db29f543dcf17a5f25d30af644c79b65af181bb' => 
    array (
      0 => 'templates\\challenges\\components\\raid_station.tpl',
      1 => 1469643684,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '326505799ec0d6a59f2_30695618',
  'variables' => 
  array (
    'type' => 0,
    'is_station' => 0,
    'station' => 0,
    'index' => 0,
    'types' => 0,
    'first' => 0,
    'station_types' => 0,
    'station_type' => 0,
    'selected' => 0,
    'station_name' => 0,
    'hide_input' => 0,
    'hide_add_button' => 0,
    'hide_delete_button' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5799ec0dd0a6f1_15935086',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5799ec0dd0a6f1_15935086')) {
function content_5799ec0dd0a6f1_15935086 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '326505799ec0d6a59f2_30695618';
if (isset($_smarty_tpl->tpl_vars['type']->value)) {?>
    <?php if ($_smarty_tpl->tpl_vars['type']->value == 3) {?>
        <?php $_smarty_tpl->tpl_vars['hide_add_button'] = new Smarty_Variable(true, null, 0);?>
        <?php $_smarty_tpl->tpl_vars['hide_delete_button'] = new Smarty_Variable(true, null, 0);?>
        <?php $_smarty_tpl->tpl_vars['hide_input'] = new Smarty_Variable(false, null, 0);?>
    <?php } elseif (($_smarty_tpl->tpl_vars['type']->value == 0)) {?>
        <?php $_smarty_tpl->tpl_vars['hide_add_button'] = new Smarty_Variable(true, null, 0);?>
        <?php $_smarty_tpl->tpl_vars['hide_delete_button'] = new Smarty_Variable(true, null, 0);?>
        <?php $_smarty_tpl->tpl_vars['hide_input'] = new Smarty_Variable(true, null, 0);?>
	<?php } else { ?>
        <?php $_smarty_tpl->tpl_vars['is_station'] = new Smarty_Variable(true, null, 0);?>
    <?php }?>
<?php }?>


<div class="toclone station <?php if ($_smarty_tpl->tpl_vars['is_station']->value) {?>is-station<?php }?>" <?php if (isset($_smarty_tpl->tpl_vars['type']->value)) {?>data-type="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
"<?php }?>>
	<input type="hidden" name="station_id[]" class="station-id" value="<?php if ($_smarty_tpl->tpl_vars['station']->value) {
echo $_smarty_tpl->tpl_vars['station']->value['station_id'];
} else { ?>0<?php }?>" />
	<span class="label"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['index']->value)===null||$tmp==='' ? '' : $tmp);?>
</span>
	<?php if (isset($_smarty_tpl->tpl_vars['types']->value) && count($_smarty_tpl->tpl_vars['types']->value) == 1) {?>
		<input type="hidden" name="station_type[]" value="<?php echo $_smarty_tpl->tpl_vars['types']->value[0];?>
" />
            <span class="station-type">
			<?php $_smarty_tpl->tpl_vars['first'] = new Smarty_Variable($_smarty_tpl->tpl_vars['types']->value[0], null, 0);?>
			<?php echo $_smarty_tpl->tpl_vars['station_types']->value[$_smarty_tpl->tpl_vars['first']->value];?>

            </span>
	<?php } else { ?>
		<select name="station_type[]">
			<?php
$_from = $_smarty_tpl->tpl_vars['station_types']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars["station_name"] = new Smarty_Variable;
$_smarty_tpl->tpl_vars["station_name"]->_loop = false;
$_smarty_tpl->tpl_vars["station_type"] = new Smarty_Variable;
foreach ($_from as $_smarty_tpl->tpl_vars["station_type"]->value => $_smarty_tpl->tpl_vars["station_name"]->value) {
$_smarty_tpl->tpl_vars["station_name"]->_loop = true;
$foreach_station_name_Sav = $_smarty_tpl->tpl_vars["station_name"];
?>
				<?php if (!isset($_smarty_tpl->tpl_vars['types']->value) || in_array($_smarty_tpl->tpl_vars['station_type']->value,$_smarty_tpl->tpl_vars['types']->value)) {?>
					<?php $_smarty_tpl->tpl_vars["selected"] = new Smarty_Variable(false, null, 0);?>
					<?php if (isset($_smarty_tpl->tpl_vars['station']->value) && $_smarty_tpl->tpl_vars['station']->value['station_type'] == $_smarty_tpl->tpl_vars['station_type']->value) {?>
						<?php $_smarty_tpl->tpl_vars["selected"] = new Smarty_Variable(true, null, 0);?>
					<?php }?>
					<?php if (isset($_smarty_tpl->tpl_vars['type']->value) && $_smarty_tpl->tpl_vars['type']->value == $_smarty_tpl->tpl_vars['station_type']->value) {?>
						<?php $_smarty_tpl->tpl_vars["selectedx"] = new Smarty_Variable(true, null, 0);?>
					<?php }?>
					<option <?php if ($_smarty_tpl->tpl_vars['selected']->value) {?>selected="selected" <?php }?> value="<?php echo $_smarty_tpl->tpl_vars['station_type']->value;?>
"><?php echo $_smarty_tpl->tpl_vars['station_name']->value;?>
</option>
				<?php }?>
			<?php
$_smarty_tpl->tpl_vars["station_name"] = $foreach_station_name_Sav;
}
?>
		</select>
	<?php }?>

	
	<input name="value[]" placeholder="" class="value" type="<?php if ($_smarty_tpl->tpl_vars['hide_input']->value) {?>hidden<?php } else { ?>text<?php }?>" <?php if ($_smarty_tpl->tpl_vars['station']->value) {?>value="<?php if ($_smarty_tpl->tpl_vars['station']->value['station_type'] == 1 || $_smarty_tpl->tpl_vars['station']->value['station_type'] == 3) {
echo $_smarty_tpl->tpl_vars['station']->value['maximum_time'];
} elseif ($_smarty_tpl->tpl_vars['station']->value['station_type'] == 2) {
echo $_smarty_tpl->tpl_vars['station']->value['score'];
}?>"<?php }?> />
	<span class="value-label"></span>

	
	<?php if (!$_smarty_tpl->tpl_vars['hide_add_button']->value) {?>
		<a href="#" class="btn btn-primary clone">adaugă</a>
	<?php }?>

	<?php if (!$_smarty_tpl->tpl_vars['hide_delete_button']->value) {?>
		<a href="#" class="btn btn-default delete">șterge</a>
	<?php }?>
</div><?php }
}
?>