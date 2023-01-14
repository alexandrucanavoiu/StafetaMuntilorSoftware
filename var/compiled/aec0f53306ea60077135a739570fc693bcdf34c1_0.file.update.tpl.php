<?php /* Smarty version 3.1.27, created on 2016-07-31 01:21:53
         compiled from "C:\Users\Test\Desktop\imprimanta driver\Stafeta_Muntilor_Software\Stafeta Muntilor Software\www\stafeta\templates\cultural\update.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:17391579d2881d37421_44767097%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'aec0f53306ea60077135a739570fc693bcdf34c1' => 
    array (
      0 => 'C:\\Users\\Test\\Desktop\\imprimanta driver\\Stafeta_Muntilor_Software\\Stafeta Muntilor Software\\www\\stafeta\\templates\\cultural\\update.tpl',
      1 => 1469643685,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '17391579d2881d37421_44767097',
  'variables' => 
  array (
    'club' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_579d2882261e25_20909115',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_579d2882261e25_20909115')) {
function content_579d2882261e25_20909115 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '17391579d2881d37421_44767097';
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