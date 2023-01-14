<?php /* Smarty version 3.1.27, created on 2016-04-03 15:11:11
         compiled from "/var/www/html/stafeta/templates/cultural/update.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:64914950057016acf64de08_46045629%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dff0d1fa8899326fcea4ef1e05b642a57e1646d7' => 
    array (
      0 => '/var/www/html/stafeta/templates/cultural/update.tpl',
      1 => 1435967598,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '64914950057016acf64de08_46045629',
  'variables' => 
  array (
    'club' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57016acf66d623_80073377',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57016acf66d623_80073377')) {
function content_57016acf66d623_80073377 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '64914950057016acf64de08_46045629';
?>
			<p class="home"><strong><?php echo $_smarty_tpl->tpl_vars['club']->value['club_name'];?>
 - Proba Culturala</strong></p>
			<div class="total-continut">
			                  <div id="formular">
                        <div id="formular-continut" class="animate form">
		
			<form action="/stafeta/?page=cultural/update&club_id=<?php echo $_smarty_tpl->tpl_vars['club']->value['club_id'];?>
" method="POST" autocomplete="off">
    
			<p>
					<label for="scor_cultural" class="scor-cultural"> Scor Cultural </label>
					<input type="number" name="scor_cultural" id="scor_cultural" value="<?php if ($_smarty_tpl->tpl_vars['club']->value) {
echo $_smarty_tpl->tpl_vars['club']->value['scor_cultural'];
}?>" size="50" required placeholder="introduceti punctajul"  oninvalid="this.setCustomValidity('Camp obligatoiu')" oninput="setCustomValidity('')" >
			</p>
			<p class="formular-continut button"> 
				<input type="submit" name="submit" id="submit" value="Update">
			</p>
			</form>
							</div>
						</div>
			</div>
			<a href="/stafeta/?page=cultural/lists" class="btn btn-primary clone">INAPOI</a><?php }
}
?>