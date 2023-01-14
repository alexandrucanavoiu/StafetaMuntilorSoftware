<?php /* Smarty version 3.1.27, created on 2016-07-28 14:27:46
         compiled from "C:\Users\Test\Desktop\imprimanta driver\Stafeta_Muntilor_Software\Stafeta Muntilor Software\www\stafeta\templates\ranking\lists.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:123155799ec326280a8_84673046%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b76410693f6ceb9f27f61df73b4de1c25556b2a1' => 
    array (
      0 => 'C:\\Users\\Test\\Desktop\\imprimanta driver\\Stafeta_Muntilor_Software\\Stafeta Muntilor Software\\www\\stafeta\\templates\\ranking\\lists.tpl',
      1 => 1469643686,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '123155799ec326280a8_84673046',
  'variables' => 
  array (
    'category' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5799ec3281c125_96706099',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5799ec3281c125_96706099')) {
function content_5799ec3281c125_96706099 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '123155799ec326280a8_84673046';
?>
<p class="home"><strong>Clasament - Categoria  <?php echo $_smarty_tpl->tpl_vars['category']->value['category_name'];?>
 - Stafeta Muntilor</strong></p>
<div class="total-continut">
	<br />	
<div>
Orientare: 
<a href="/stafeta/?page=ranking/orienteering&category_id=<?php echo $_smarty_tpl->tpl_vars['category']->value['category_id'];?>
" class="btn btn-primary clone">Vezi Clasament Orientare</a>
<a href="/stafeta/?page=ranking/orienteering&category_id=<?php echo $_smarty_tpl->tpl_vars['category']->value['category_id'];?>
&pdf=1" target="_blank" class="btn btn-primary clone">Export to PDF</a>
</div>


<br />
<div>
Cunostinte Turistice: 
<a href="/stafeta/?page=ranking/knowledge&category_id=<?php echo $_smarty_tpl->tpl_vars['category']->value['category_id'];?>
" class="btn btn-primary clone">Vezi Clasament Cunostinte Turistice</a>
<a href="/stafeta/?page=ranking/knowledge&category_id=<?php echo $_smarty_tpl->tpl_vars['category']->value['category_id'];?>
&pdf=1" target="_blank" class="btn btn-primary clone">Export to PDF</a>
</div>


<br />
Raid Montan:
<a href="/stafeta/?page=ranking/raid&category_id=<?php echo $_smarty_tpl->tpl_vars['category']->value['category_id'];?>
" class="btn btn-primary clone">Vezi Clasament Raid Montan</a>
<a href="/stafeta/?page=ranking/raid&category_id=<?php echo $_smarty_tpl->tpl_vars['category']->value['category_id'];?>
&pdf=1" target="_blank" class="btn btn-primary clone">Export to PDF</a>
</div>

<br /><br />
<h3>Clasament General</h3><br />
<a href="/stafeta/?page=ranking/generalcategory&category_id=<?php echo $_smarty_tpl->tpl_vars['category']->value['category_id'];?>
" class="btn btn-primary clone">Vezi Clasament General Categorie</a>
<a href="/stafeta/?page=ranking/generalcategory&category_id=<?php echo $_smarty_tpl->tpl_vars['category']->value['category_id'];?>
&pdf=1" target="_blank" class="btn btn-primary clone">Export to PDF</a>
</div>


</div>
<?php }
}
?>