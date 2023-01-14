<?php /* Smarty version 3.1.27, created on 2016-08-07 22:33:13
         compiled from "C:\Users\MarketingRomania\Desktop\Stafeta Muntilor Software\www\stafeta\templates\organizer\update.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1825457a78cf982a6d6_62416853%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f49d4a765e2ddfaaed41846d4330d5733ca0b26e' => 
    array (
      0 => 'C:\\Users\\MarketingRomania\\Desktop\\Stafeta Muntilor Software\\www\\stafeta\\templates\\organizer\\update.tpl',
      1 => 1469643685,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1825457a78cf982a6d6_62416853',
  'variables' => 
  array (
    'knowledge' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57a78cf98a2703_00901434',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57a78cf98a2703_00901434')) {
function content_57a78cf98a2703_00901434 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1825457a78cf982a6d6_62416853';
?>
			<p class="home"><strong>Configureaza numele organizatorul</strong></p>
			<div class="total-continut">
			                  <div id="formular">
                        <div id="formular-continut" class="animate form">
							<form action="/stafeta/?page=organizer/update&id_organizer=1" method="POST" autocomplete="off">
                                <p> 
                                    <label for="name_trophy" class="name-trophy"> Numele Etapei </label>
                                    <input type="text" name="name_trophy" id="name-trophy" value="<?php if ($_smarty_tpl->tpl_vars['knowledge']->value) {
echo $_smarty_tpl->tpl_vars['knowledge']->value['name_trophy'];
}?>" size="50" required oninvalid="this.setCustomValidity('Introduceti numele etapei')" oninput="setCustomValidity('')" >
                                </p>
								<br />
                                <p> 
                                    <label for="name_organizer" class="name-organizer"> Numele Organizatorului</label>
                                    <input type="text" name="name_organizer" id="name_organizer" value="<?php if ($_smarty_tpl->tpl_vars['knowledge']->value) {
echo $_smarty_tpl->tpl_vars['knowledge']->value['name_organizer'];
}?>" size="50" required oninvalid="this.setCustomValidity('Introduceti numele organizatorului')" oninput="setCustomValidity('')" >
                                </p>
								<br />
								<p>
									<label for="phase_trophy" class="phase-trophy"> Etapa este de tip: </label>
								<select name="phase_trophy" class="phase-trophy">
								<option value="Master" <?php if (($_smarty_tpl->tpl_vars['knowledge']->value['phase_trophy'] == 'Master')) {?>selected<?php }?>>Master </option>
								<option value="Challenge" <?php if ($_smarty_tpl->tpl_vars['knowledge']->value['phase_trophy'] == 'Challenge') {?>selected<?php }?>>Challenge</option>
								<option value="Amical" <?php if ($_smarty_tpl->tpl_vars['knowledge']->value['phase_trophy'] == 'Amical') {?>selected<?php }?>>Amical</option>
							</select>
							<p class="formular-continut button"> 
						<input type="submit" name="Trimite" id="Trimite" value="Trimite" class="btn btn-primary clone">
						<input type="reset" name="reset" id="reset" value="Reset!" class="btn btn-primary clone">
							</p>
							</form>
							</div>
						</div>
			
			</div> 
<?php }
}
?>