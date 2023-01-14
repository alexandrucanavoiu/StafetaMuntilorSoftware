<?php /* Smarty version 3.1.27, created on 2016-04-03 16:00:43
         compiled from "/var/www/html/stafeta/templates/orienteering/update.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:8042084515701766b29eea3_20904559%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ee103be57780c1072daa161acdba00e88b2697c7' => 
    array (
      0 => '/var/www/html/stafeta/templates/orienteering/update.tpl',
      1 => 1459713352,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8042084515701766b29eea3_20904559',
  'variables' => 
  array (
    'team' => 0,
    'category' => 0,
    'orienteering' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5701766b2f3276_65377740',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5701766b2f3276_65377740')) {
function content_5701766b2f3276_65377740 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '8042084515701766b29eea3_20904559';
?>
			<?php echo '<script'; ?>
 src="js/lib/jquery.inputmask.bundle.min.js"><?php echo '</script'; ?>
>
			<?php echo '<script'; ?>
>
			$(document).ready(function() {
				if (typeof($.fn.inputmask) == 'function') {
					$(".time").inputmask("h:s:s",{ "placeholder": "hh:mm:ss" });
				}
			});
			<?php echo '</script'; ?>
>

			<center><p class="home"><strong><?php echo $_smarty_tpl->tpl_vars['team']->value['team_name'];?>
 - (Proba Orientare) - Categoria <?php echo $_smarty_tpl->tpl_vars['category']->value['category_name'];?>
 </strong>
			<br />
			Club: <?php echo $_smarty_tpl->tpl_vars['team']->value['club_name'];?>
 </p>
			</center>
			<div class="total-continut">
			                  <div id="formular">
                        <div id="formular-continut" class="animate form">
			<form action="/stafeta/?page=orienteering/update&category_id=<?php echo $_smarty_tpl->tpl_vars['category']->value['category_id'];?>
&team_id=<?php echo $_smarty_tpl->tpl_vars['team']->value['team_id'];?>
" method="POST" autocomplete="off">
    
					<p>
					<label for="name_participant" class="name-participant"> Nume Participant :</label>
					<input type="text" name="name_participant" id="name-participant" value="<?php if ($_smarty_tpl->tpl_vars['orienteering']->value) {
echo $_smarty_tpl->tpl_vars['orienteering']->value['name_participant'];
}?>" size="50" required placeholder="introduceti numele participantului"  oninvalid="this.setCustomValidity('Camp obligatoiu')" oninput="setCustomValidity('')" >
					</p>
					<br />
					<p>
					<label for="start" class="start"> Timp Start :</label>
					<input type="text" name="start" class="time" id="start" value="<?php if ($_smarty_tpl->tpl_vars['orienteering']->value) {
echo $_smarty_tpl->tpl_vars['orienteering']->value['start'];
}?>" size="50" required placeholder="introduceti timpul in formatul: hh:mm:ss"  oninvalid="this.setCustomValidity('Camp obligatoiu')" oninput="setCustomValidity('')" >
					</p>
					<br />
					<p>
					<label for="finish" class="finish"> Timp Finish :</label>
					<input type="text" name="finish" class="time" id="finish" value="<?php if ($_smarty_tpl->tpl_vars['orienteering']->value) {
echo $_smarty_tpl->tpl_vars['orienteering']->value['finish'];
}?>" size="50" required placeholder="introduceti timpul in formatul: hh:mm:ss"  oninvalid="this.setCustomValidity('Camp obligatoiu')" oninput="setCustomValidity('')" >
					</p>
					<br />
					<p>
					<label for="missed_posts" class="missed_posts"> Posturi Ratate :</label>
					<input type="text" name="missed_posts" id="missed_posts" value="<?php if ($_smarty_tpl->tpl_vars['orienteering']->value) {
echo $_smarty_tpl->tpl_vars['orienteering']->value['missed_posts'];
}?>" size="50" required placeholder="in cifre"  oninvalid="this.setCustomValidity('Camp obligatoiu')" oninput="setCustomValidity('')" >
					</p>
					<br />
					<p>
					<label for="abandon" class="abandon"> Abandon / Neprezentare:</label> 
						<select name="abandon" class="abandon">
							<option value="0"  <?php if ($_smarty_tpl->tpl_vars['orienteering']->value && $_smarty_tpl->tpl_vars['orienteering']->value['abandon'] == 0) {?>selected="selected"<?php }?>>Nu</option>
							<option value="1"  <?php if ($_smarty_tpl->tpl_vars['orienteering']->value && $_smarty_tpl->tpl_vars['orienteering']->value['abandon'] == 1) {?>selected="selected"<?php }?>>Da</option>
					</select>
					</p>
			<p class="formular-continut button"> 
				<input type="submit" name="submit" id="submit" value="Update">
			</p>
			</form>
							</div>
						</div>
<a href="/stafeta/?page=orienteering/lists&category_id=<?php echo $_smarty_tpl->tpl_vars['category']->value['category_id'];?>
" class="btn btn-primary clone">INAPOI</a>
<br /><br />
													<div><b>Nota:</b></div>
													<p>Se va completa in felul urmator:</p>
													<p>Nume Participant: se va introduce numele participantui.</p>
													<p>Timp Start: 12:03:05  unde 00 (ore), 05 (minute), 05 (secunde).</p>
													<p>Timp Finish: 12:10:03  unde 00 (ore), 03 (minute), 03 (secunde).</p>
													<p>Posturi ratate: cate posturi a ratat participantul: 1,2,3,4 ( in cifre).</p>
													<p>Abandon / Neprezentare : se va selecta DA, doar daca echipa a abandonat sau nu s-a prezentat.</p>
													<div>
													<strong>Atunci cand este Abandon sau echipa nu s-a prezentat, este important sa adaugati 0 peste tot dupa care se va bifa : Abandon DA </strong>
													</div>
													
			</div><?php }
}
?>