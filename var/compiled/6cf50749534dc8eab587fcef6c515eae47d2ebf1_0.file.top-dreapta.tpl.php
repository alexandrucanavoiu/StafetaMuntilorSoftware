<?php /* Smarty version 3.1.27, created on 2016-04-03 14:45:39
         compiled from "templates/common/top-dreapta.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:2090442925570164d3a929c1_79098352%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6cf50749534dc8eab587fcef6c515eae47d2ebf1' => 
    array (
      0 => 'templates/common/top-dreapta.tpl',
      1 => 1434904312,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2090442925570164d3a929c1_79098352',
  'variables' => 
  array (
    'clubs' => 0,
    'teams' => 0,
    'organizer' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_570164d3aa5b49_91352289',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_570164d3aa5b49_91352289')) {
function content_570164d3aa5b49_91352289 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2090442925570164d3a929c1_79098352';
?>
<div class="lista-cluburi-top">
    <div class="icon">
        <i class="lista-cluburi-top-img"></i>
    </div>
    <div class="icon-text">
        <h3><?php echo $_smarty_tpl->tpl_vars['clubs']->value;?>
</h3>
        <p>Cluburi inscrise</p>
    </div>
    <div class="clearfix"></div>
</div>
<div class="lista-echipei-top">
    <div class="icon">
        <i class="lista-echipei-top-img"></i>
    </div>
    <div class="icon-text">
        <h3><?php echo $_smarty_tpl->tpl_vars['teams']->value;?>
</h3>
        <p>Echipe inscrise</p>
    </div>
    <div class="clearfix"></div>
</div>
<div class="nume-organizatori-top">
    <div class="nume-organizatori-top-text">
        <div class="nume-organizator">Nume Etapa: <span><?php echo $_smarty_tpl->tpl_vars['organizer']->value['name_trophy'];?>
</span></div>
		<div class="nume-1-organizator">Organizator: <span><?php echo $_smarty_tpl->tpl_vars['organizer']->value['name_organizer'];?>
</span></div>
		<div class="nume-etapa-organizator">Etapa: <span><?php echo $_smarty_tpl->tpl_vars['organizer']->value['phase_trophy'];?>
</span></div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="clearfix"></div><?php }
}
?>