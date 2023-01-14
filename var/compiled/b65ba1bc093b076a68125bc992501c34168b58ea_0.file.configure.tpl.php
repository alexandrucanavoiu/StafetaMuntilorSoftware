<?php /* Smarty version 3.1.27, created on 2016-07-27 21:42:05
         compiled from "C:\Users\Test\Desktop\imprimanta driver\Stafeta_Muntilor_Software\Stafeta Muntilor Software\www\stafeta\templates\challenges\configure.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:306335799007d16b1e6_22246447%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b65ba1bc093b076a68125bc992501c34168b58ea' => 
    array (
      0 => 'C:\\Users\\Test\\Desktop\\imprimanta driver\\Stafeta_Muntilor_Software\\Stafeta Muntilor Software\\www\\stafeta\\templates\\challenges\\configure.tpl',
      1 => 1469643684,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '306335799007d16b1e6_22246447',
  'variables' => 
  array (
    'categories' => 0,
    'category' => 0,
    'challenges' => 0,
    'challenge' => 0,
    'tables' => 0,
    'relatedTables' => 0,
    'label' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5799007d40ef05_67151393',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5799007d40ef05_67151393')) {
function content_5799007d40ef05_67151393 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '306335799007d16b1e6_22246447';
?>
<p class="home"><strong>Configurare Etapa - Stafeta Muntilor</strong></p>
<div class="total-continut">
    <div class="organizator"><strong>Organizator:</strong>
        <div class="modifica"><a href="/stafeta/?page=organizer/update&id_organizer=1">MODIFICA </a></div>
    </div>
	
    <?php
$_from = $_smarty_tpl->tpl_vars['categories']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars["category"] = new Smarty_Variable;
$_smarty_tpl->tpl_vars["category"]->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars["category"]->value) {
$_smarty_tpl->tpl_vars["category"]->_loop = true;
$foreach_category_Sav = $_smarty_tpl->tpl_vars["category"];
?>
        <div class="organizator"><strong>Categoria <?php echo $_smarty_tpl->tpl_vars['category']->value['category_name'];?>
:</strong>
            <?php
$_from = $_smarty_tpl->tpl_vars['challenges']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars["challenge"] = new Smarty_Variable;
$_smarty_tpl->tpl_vars["challenge"]->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars["challenge"]->value) {
$_smarty_tpl->tpl_vars["challenge"]->_loop = true;
$foreach_challenge_Sav = $_smarty_tpl->tpl_vars["challenge"];
?>
				<?php if ($_smarty_tpl->tpl_vars['challenge']->value['challenge_id'] == 1) {?>
                <div>
                    <?php echo $_smarty_tpl->tpl_vars['challenge']->value['challenge_name'];?>

                    <div class="adauga"><a href="/stafeta/?page=challenges/update&challenge_id=<?php echo $_smarty_tpl->tpl_vars['challenge']->value['challenge_id'];?>
&category_id=<?php echo $_smarty_tpl->tpl_vars['category']->value['category_id'];?>
">Configureaza</a></div>
                </div>
				<?php }?>
            <?php
$_smarty_tpl->tpl_vars["challenge"] = $foreach_challenge_Sav;
}
?>
        </div>
    <?php
$_smarty_tpl->tpl_vars["category"] = $foreach_category_Sav;
}
?>

    <br>
    <br>
    <br>
    <form method="POST" action="<?php echo url('challenges/configure');?>
" autocomplete="off" class="form-horizontal sm-form" role="form" id="eraseForm">

        <div class="col-sm-6">
            <div class="panel panel-danger">
                <div class="panel-heading">Ștergere date</div>
                <div class="panel-body">
                    <?php
$_from = $_smarty_tpl->tpl_vars['tables']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars["relatedTables"] = new Smarty_Variable;
$_smarty_tpl->tpl_vars["relatedTables"]->_loop = false;
$_smarty_tpl->tpl_vars["label"] = new Smarty_Variable;
foreach ($_from as $_smarty_tpl->tpl_vars["label"]->value => $_smarty_tpl->tpl_vars["relatedTables"]->value) {
$_smarty_tpl->tpl_vars["relatedTables"]->_loop = true;
$foreach_relatedTables_Sav = $_smarty_tpl->tpl_vars["relatedTables"];
?>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="tables[]" value="<?php echo implode(',',$_smarty_tpl->tpl_vars['relatedTables']->value);?>
" checked="checked">
                                <?php echo $_smarty_tpl->tpl_vars['label']->value;?>

                            </label>
                        </div>
                    <?php
$_smarty_tpl->tpl_vars["relatedTables"] = $foreach_relatedTables_Sav;
}
?>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <br>
                            <button type="submit" class="btn btn-danger confirm-submit" data-toggle="modal" data-target="#confirm">Șterge</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    Confirmare ștergere date
                </div>
                <div class="modal-body">
                    Esti sigur ca vrei să ștergi datele?
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Anulare</button>
                    <a href="#" id="submit" class="btn btn-danger danger confirm-ok" data-form="#eraseForm">Șterge</a>
                </div>
            </div>
        </div>
    </div>

</div><?php }
}
?>