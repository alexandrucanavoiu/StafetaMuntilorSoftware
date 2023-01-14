<?php /* Smarty version 3.1.27, created on 2016-07-28 13:15:47
         compiled from "C:\Users\Test\Desktop\imprimanta driver\Stafeta_Muntilor_Software\Stafeta Muntilor Software\www\stafeta\templates\teams\update.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:242875799db53a647b5_90377606%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '904ca5c36a77139b68cd685879d186a4af400a98' => 
    array (
      0 => 'C:\\Users\\Test\\Desktop\\imprimanta driver\\Stafeta_Muntilor_Software\\Stafeta Muntilor Software\\www\\stafeta\\templates\\teams\\update.tpl',
      1 => 1469643686,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '242875799db53a647b5_90377606',
  'variables' => 
  array (
    'row' => 0,
    'message' => 0,
    'totalclubs' => 0,
    'club' => 0,
    'categories' => 0,
    'categorie' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5799db5409ca74_78152975',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5799db5409ca74_78152975')) {
function content_5799db5409ca74_78152975 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '242875799db53a647b5_90377606';
?>
<p class="home"><strong>Editare Echipa Participante - Stafeta Muntilor</strong></p>
<div class="total-continut">
<div id="formular">
<div id="formular-continut" class="animate form">
						
				<form action="/stafeta/?page=teams/update&team_id=<?php echo $_smarty_tpl->tpl_vars['row']->value['team_id'];?>
" method="POST" autocomplete="off">
				

				<?php if (!empty($_smarty_tpl->tpl_vars['message']->value)) {?>
					<?php echo $_smarty_tpl->tpl_vars['message']->value;?>

				<?php }?>
				
					<p>
					<label for="club_id" class="club_id"> Nume Club:</label>
				
					<select name="club_id" id="club_id">
					<?php
$_from = $_smarty_tpl->tpl_vars['totalclubs']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars["club"] = new Smarty_Variable;
$_smarty_tpl->tpl_vars["club"]->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars["club"]->value) {
$_smarty_tpl->tpl_vars["club"]->_loop = true;
$foreach_club_Sav = $_smarty_tpl->tpl_vars["club"];
?> 
					<option value="<?php echo $_smarty_tpl->tpl_vars['club']->value['club_id'];?>
" <?php if (($_smarty_tpl->tpl_vars['club']->value['club_id'] == $_smarty_tpl->tpl_vars['row']->value['club_id'])) {?> { selected } <?php }?>><?php echo $_smarty_tpl->tpl_vars['club']->value['club_name'];?>
</option>
					<?php
$_smarty_tpl->tpl_vars["club"] = $foreach_club_Sav;
}
?>
					</select>
					</p>
					
					<br />
				
					<p>
					<label for="team_name" class="club_id"> Nume Echipa:</label>
					<input type="text" name="team_name" id="numeEchipa" value="<?php echo $_smarty_tpl->tpl_vars['row']->value['team_name'];?>
" size="50" required   oninvalid="this.setCustomValidity('Introduceti numele echipei')" oninput="setCustomValidity('')" >
					</p>
					
					<p>
					<label for="category_id" class="category_id"> Categoria:</label>
						<select name="category_id" id="Categorie">
						<?php
$_from = $_smarty_tpl->tpl_vars['categories']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars["categorie"] = new Smarty_Variable;
$_smarty_tpl->tpl_vars["categorie"]->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars["categorie"]->value) {
$_smarty_tpl->tpl_vars["categorie"]->_loop = true;
$foreach_categorie_Sav = $_smarty_tpl->tpl_vars["categorie"];
?> 
						<option value="<?php echo $_smarty_tpl->tpl_vars['categorie']->value['category_id'];?>
" <?php if (($_smarty_tpl->tpl_vars['categorie']->value['category_id'] == $_smarty_tpl->tpl_vars['row']->value['category_id'])) {?> { selected } <?php }?> ><?php echo $_smarty_tpl->tpl_vars['categorie']->value['category_name'];?>
</option>
						<?php
$_smarty_tpl->tpl_vars["categorie"] = $foreach_categorie_Sav;
}
?>
						</select>
					</p>
					
					<p class="formular-continut button"> 
						<input type="submit" name="Trimite" id="Trimite" value="Trimite">
						<input type="reset" name="reset" id="reset" value="Reset!">
					</p>

				</form>
				
</div>
</div>
<a href="/stafeta/?page=teams/lists" class="btn btn-primary clone">INAPOI</a>
<br /><br />
													<div><b>Nota:</b></div>
													<p>Se va completa in felul urmator:</p>
													<p>Nume Club: se va selecta Clubul dorit.</p>
													<p>Nume Echipa: se va modifica numele echipei care va participa din partea clubului selectat mai sus.</p>
													<p>Categoria: se va selecta categoria la care va participa echipa introdusa mai sus.</p>
</div> <?php }
}
?>