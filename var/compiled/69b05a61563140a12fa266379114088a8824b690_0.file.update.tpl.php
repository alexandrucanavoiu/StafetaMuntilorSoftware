<?php /* Smarty version 3.1.27, created on 2016-07-27 21:44:04
         compiled from "C:\Users\Test\Desktop\imprimanta driver\Stafeta_Muntilor_Software\Stafeta Muntilor Software\www\stafeta\templates\clubs\update.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:26059579900f4154e89_96968394%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '69b05a61563140a12fa266379114088a8824b690' => 
    array (
      0 => 'C:\\Users\\Test\\Desktop\\imprimanta driver\\Stafeta_Muntilor_Software\\Stafeta Muntilor Software\\www\\stafeta\\templates\\clubs\\update.tpl',
      1 => 1469643684,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '26059579900f4154e89_96968394',
  'variables' => 
  array (
    'row' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_579900f42b47e4_90829322',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_579900f42b47e4_90829322')) {
function content_579900f42b47e4_90829322 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '26059579900f4154e89_96968394';
?>
			<p class="home"><strong>Editare - Nume Club - Participare - Stafeta Muntilor</strong></p>
			<div class="total-continut">
			                  <div id="formular">
                        <div id="formular-continut" class="animate form">
						
			<form action="/stafeta/?page=clubs/update&club_id=<?php echo $_smarty_tpl->tpl_vars['row']->value['club_id'];?>
" method="POST" autocomplete="off">
 
				<p>
				<label for="club_name" class="club-name"> Nume Club :</label>
				<input type="text" name="club_name" id="club-name" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['club_name'];?>
" size="50" required   oninvalid="this.setCustomValidity('Introduceti numele clubului')" oninput="setCustomValidity('')" >
				</p>
					
				<p class="formular-continut button"> 
					<input type="hidden" name="club_id" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['club_id'];?>
">
					<input type="submit" name="submit" id="submit" value="Update">
				</p>
					

			</div>
			</form>
			</div>
			</div>
			</div>
			<a href="/stafeta/?page=clubs/lists" class="btn btn-primary clone">INAPOI</a><?php }
}
?>