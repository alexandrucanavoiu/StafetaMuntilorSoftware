<?php /* Smarty version 3.1.27, created on 2016-04-03 14:45:39
         compiled from "templates/common/messages.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1501092408570164d3aa9ed3_85644505%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '56a17d1486d58dd226bb3d007fc59149a60a7d6b' => 
    array (
      0 => 'templates/common/messages.tpl',
      1 => 1436484854,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1501092408570164d3aa9ed3_85644505',
  'variables' => 
  array (
    'messages' => 0,
    'type' => 0,
    'class' => 0,
    'title' => 0,
    'message' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_570164d3ae8439_50922992',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_570164d3ae8439_50922992')) {
function content_570164d3ae8439_50922992 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1501092408570164d3aa9ed3_85644505';
if (!empty($_smarty_tpl->tpl_vars['messages']->value)) {?>
    <?php $_smarty_tpl->tpl_vars['type'] = new Smarty_Variable((($tmp = @$_smarty_tpl->tpl_vars['type']->value)===null||$tmp==='' ? "notice" : $tmp), null, 0);?>
    <?php $_smarty_tpl->tpl_vars['class'] = new Smarty_Variable("info", null, 0);?>
    <?php $_smarty_tpl->tpl_vars['title'] = new Smarty_Variable("Notificare", null, 0);?>

    <?php if ($_smarty_tpl->tpl_vars['type']->value == 'error') {?>
        <?php $_smarty_tpl->tpl_vars['class'] = new Smarty_Variable("danger", null, 0);?>
        <?php $_smarty_tpl->tpl_vars['title'] = new Smarty_Variable("Eroare", null, 0);?>
    <?php }?>

    <?php if ($_smarty_tpl->tpl_vars['type']->value == 'success') {?>
        <?php $_smarty_tpl->tpl_vars['class'] = new Smarty_Variable("success", null, 0);?>
        <?php $_smarty_tpl->tpl_vars['title'] = new Smarty_Variable("Succes", null, 0);?>
    <?php }?>

    <?php
$_from = $_smarty_tpl->tpl_vars['messages']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars["message"] = new Smarty_Variable;
$_smarty_tpl->tpl_vars["message"]->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars["message"]->value) {
$_smarty_tpl->tpl_vars["message"]->_loop = true;
$foreach_message_Sav = $_smarty_tpl->tpl_vars["message"];
?>
        <div class="alert alert-<?php echo $_smarty_tpl->tpl_vars['class']->value;?>
 fade in alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</strong>
            <?php echo $_smarty_tpl->tpl_vars['message']->value;?>

        </div>
    <?php
$_smarty_tpl->tpl_vars["message"] = $foreach_message_Sav;
}
?>
<?php }
}
}
?>