<?php /* Smarty version 3.1.27, created on 2016-04-03 14:46:29
         compiled from "/var/www/html/stafeta/templates/ranking/lists.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1630003031570165052b6551_31328788%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '2f93e1cc34e310356bf4ff36b7f0641be7c12b44' => 
    array (
      0 => '/var/www/html/stafeta/templates/ranking/lists.tpl',
      1 => 1436095346,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1630003031570165052b6551_31328788',
  'variables' => 
  array (
    'category' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_570165052e7171_31336796',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_570165052e7171_31336796')) {
function content_570165052e7171_31336796 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1630003031570165052b6551_31328788';
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