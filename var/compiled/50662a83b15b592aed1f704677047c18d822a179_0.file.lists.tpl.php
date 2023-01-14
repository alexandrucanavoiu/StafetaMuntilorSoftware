<?php /* Smarty version 3.1.27, created on 2016-07-31 21:50:34
         compiled from "C:\Users\MarketingRomania\Desktop\Stafeta Muntilor Software\www\stafeta\templates\ranking\lists.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:15423579e487a57dbe3_59236402%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '50662a83b15b592aed1f704677047c18d822a179' => 
    array (
      0 => 'C:\\Users\\MarketingRomania\\Desktop\\Stafeta Muntilor Software\\www\\stafeta\\templates\\ranking\\lists.tpl',
      1 => 1469643686,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '15423579e487a57dbe3_59236402',
  'variables' => 
  array (
    'category' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_579e487a5dce11_39373437',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_579e487a5dce11_39373437')) {
function content_579e487a5dce11_39373437 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '15423579e487a57dbe3_59236402';
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