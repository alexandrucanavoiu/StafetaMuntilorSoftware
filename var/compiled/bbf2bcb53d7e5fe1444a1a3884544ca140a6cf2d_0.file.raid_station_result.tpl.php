<?php /* Smarty version 3.1.27, created on 2016-07-28 15:01:41
         compiled from "templates\challenges\components\raid_station_result.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:26465799f4258dc200_10490354%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'bbf2bcb53d7e5fe1444a1a3884544ca140a6cf2d' => 
    array (
      0 => 'templates\\challenges\\components\\raid_station_result.tpl',
      1 => 1469643684,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '26465799f4258dc200_10490354',
  'variables' => 
  array (
    'entry' => 0,
    'type' => 0,
    'is_station' => 0,
    'sid' => 0,
    'f_placeholder' => 0,
    'f_class' => 0,
    'f_attr' => 0,
    's_placeholder' => 0,
    's_class' => 0,
    's_attr' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5799f425ca4ee2_35376940',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5799f425ca4ee2_35376940')) {
function content_5799f425ca4ee2_35376940 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '26465799f4258dc200_10490354';
$_smarty_tpl->tpl_vars['s_placeholder'] = new Smarty_Variable('plecare', null, 0);?>
<?php $_smarty_tpl->tpl_vars['f_placeholder'] = new Smarty_Variable('sosire', null, 0);?>

<?php $_smarty_tpl->tpl_vars['sid'] = new Smarty_Variable($_smarty_tpl->tpl_vars['entry']->value['station_id'], null, 0);?>
<?php $_smarty_tpl->tpl_vars['s_class'] = new Smarty_Variable('', null, 0);?>
<?php $_smarty_tpl->tpl_vars['f_class'] = new Smarty_Variable('', null, 0);?>

<?php $_smarty_tpl->tpl_vars['s_attr'] = new Smarty_Variable('', null, 0);?>
<?php $_smarty_tpl->tpl_vars['f_attr'] = new Smarty_Variable('', null, 0);?>

<?php if (isset($_smarty_tpl->tpl_vars['type']->value)) {?>
    <?php if ($_smarty_tpl->tpl_vars['type']->value == 3) {?>
        <?php $_smarty_tpl->tpl_vars['hide_input'] = new Smarty_Variable(true, null, 0);?>
        <?php $_smarty_tpl->tpl_vars['s_attr'] = new Smarty_Variable('readonly="readonly"', null, 0);?>
    <?php } elseif (($_smarty_tpl->tpl_vars['type']->value == 0)) {?>
        <?php $_smarty_tpl->tpl_vars['hide_input'] = new Smarty_Variable(true, null, 0);?>
        <?php $_smarty_tpl->tpl_vars['f_attr'] = new Smarty_Variable('readonly="readonly"', null, 0);?>
	<?php } else { ?>
        <?php $_smarty_tpl->tpl_vars['is_station'] = new Smarty_Variable(true, null, 0);?>
    <?php }?>
<?php }?>

<tr class="toclone station <?php if ($_smarty_tpl->tpl_vars['is_station']->value) {?>is-station<?php }?>" <?php if (isset($_smarty_tpl->tpl_vars['type']->value)) {?>data-type="<?php echo $_smarty_tpl->tpl_vars['type']->value;?>
"<?php }?>>
    <td>
        <span class="name"><?php echo getStationName($_smarty_tpl->tpl_vars['entry']->value);?>
</span>
        <input type="hidden" name="entries[<?php echo $_smarty_tpl->tpl_vars['sid']->value;?>
][station_id]" class="station-id" value="<?php if ($_smarty_tpl->tpl_vars['entry']->value) {
echo $_smarty_tpl->tpl_vars['entry']->value['station_id'];
} else { ?>0<?php }?>" />
        <input type="hidden" name="entries[<?php echo $_smarty_tpl->tpl_vars['sid']->value;?>
][entry_id]" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['entry']->value['entry_id'])===null||$tmp==='' ? 0 : $tmp);?>
" />
    </td>

    <td>
        <span class="label"><?php echo getStationLabel($_smarty_tpl->tpl_vars['entry']->value);?>
</span>
    </td>

    <td>
        <?php if ($_smarty_tpl->tpl_vars['type']->value == 2) {?>
            <input type="hidden" name="entries[<?php echo $_smarty_tpl->tpl_vars['sid']->value;?>
][hits]" value="1" />
            <label><input type="checkbox" name="entries[<?php echo $_smarty_tpl->tpl_vars['sid']->value;?>
][hits]" value="0" <?php if (isset($_smarty_tpl->tpl_vars['entry']->value['hits']) && $_smarty_tpl->tpl_vars['entry']->value['hits'] == 0) {?>checked="checked"<?php }?> /> Post ratat</label>

        <?php } else { ?>
            <input type="text" name="entries[<?php echo $_smarty_tpl->tpl_vars['sid']->value;?>
][time_finish]" placeholder="<?php echo $_smarty_tpl->tpl_vars['f_placeholder']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['f_class']->value;?>
 time" <?php echo $_smarty_tpl->tpl_vars['f_attr']->value;?>
 value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['entry']->value['time_finish'])===null||$tmp==='' ? '' : $tmp);?>
" />
            <input type="text" name="entries[<?php echo $_smarty_tpl->tpl_vars['sid']->value;?>
][time_start]"  placeholder="<?php echo $_smarty_tpl->tpl_vars['s_placeholder']->value;?>
" class="<?php echo $_smarty_tpl->tpl_vars['s_class']->value;?>
 time" <?php echo $_smarty_tpl->tpl_vars['s_attr']->value;?>
 value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['entry']->value['time_start'])===null||$tmp==='' ? '' : $tmp);?>
" />
        <?php }?>
    </td>

    <td>
        <span class="value"><?php if ($_smarty_tpl->tpl_vars['entry']->value['station_type'] == 1) {
echo $_smarty_tpl->tpl_vars['entry']->value['maximum_time'];
} elseif ($_smarty_tpl->tpl_vars['entry']->value['station_type'] == 2) {
echo $_smarty_tpl->tpl_vars['entry']->value['score'];
}?></span>
    </td>

    <td>
        <span class="value-label"></span>
    </td>
    <td>
    </td>

</tr><?php }
}
?>