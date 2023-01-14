<?php /* Smarty version 3.1.27, created on 2016-04-03 15:34:40
         compiled from "/var/www/html/stafeta/templates/teams/lists.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:2054179056570170509f6674_65937902%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6ab9e55c81c22eb9950f9930895ed8023ba3e095' => 
    array (
      0 => '/var/www/html/stafeta/templates/teams/lists.tpl',
      1 => 1459635757,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2054179056570170509f6674_65937902',
  'variables' => 
  array (
    'categorie' => 0,
    'totalteams' => 0,
    'number' => 0,
    'teams' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_57017050a46e29_12122617',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_57017050a46e29_12122617')) {
function content_57017050a46e29_12122617 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2054179056570170509f6674_65937902';
?>
<p class="home"><strong>Lista Echipelor Participante - Stafeta Muntilor</strong></p>
<div class="total-continut">
    <div><a href="/stafeta/?page=teams/add" class="btn btn-primary clone">ADAUGA ECHIPA</a>
	<a href="/stafeta/?page=teams/listsbyteams" class="btn btn-primary clone">LISTA ECHIPE IN FUNCTIE DE CATEGORII</a></div>
	
	
			<form action="" method="POST" id="sort-clubs">
				<strong>Filtreaza in functie de categorie: </strong>
				
					<select name="category_id" id="category_id">
					<option value="">Toate</option>
					<option value="1" <?php if ($_smarty_tpl->tpl_vars['categorie']->value == 1) {?> selected <?php }?>>Family</option>
					<option value="2" <?php if ($_smarty_tpl->tpl_vars['categorie']->value == 2) {?> selected <?php }?>>Juniori</option>
					<option value="3" <?php if ($_smarty_tpl->tpl_vars['categorie']->value == 3) {?> selected <?php }?>>Elite</option>
					<option value="4" <?php if ($_smarty_tpl->tpl_vars['categorie']->value == 4) {?> selected <?php }?>>Open</option>
					<option value="5" <?php if ($_smarty_tpl->tpl_vars['categorie']->value == 5) {?> selected <?php }?>>Veterani</option>
					<option value="6" <?php if ($_smarty_tpl->tpl_vars['categorie']->value == 6) {?> selected <?php }?>>Feminin</option>
					</select>

						<input type="submit" class="btn btn-primary clone" name="Aplica" id="Aplica" value="Aplica">

				</form>
	
	
	
	<br />	
    <div class='TabelListaCluburi'>
        <table class="afisare-tabel">
            <tr>
                <td class="tabel-optiune"><div class="text-top-tabel">Nr</div></td>
				<td class="tabel-nume"><div class="text-top-tabel">Club</div></td>
                <td class="tabel-nume"><div class="text-top-tabel">Echipa</div></td>
				<td class="afisare-categorie"><div class="text-top-tabel">Categorie</div></td>
                <td class="tabel-optiune"></td>
                <td class="tabel-optiune"></td>
            </tr>
            <?php
$_from = $_smarty_tpl->tpl_vars['totalteams']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars["teams"] = new Smarty_Variable;
$_smarty_tpl->tpl_vars["teams"]->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars["teams"]->value) {
$_smarty_tpl->tpl_vars["teams"]->_loop = true;
$foreach_teams_Sav = $_smarty_tpl->tpl_vars["teams"];
?>
                <tr>
                    <td><div class="tabel-centrat"><?php echo $_smarty_tpl->tpl_vars['number']->value++;?>
</div></td>
					<td><div class="text-tabel"><?php echo $_smarty_tpl->tpl_vars['teams']->value['club_name'];?>
</div></td>
                    <td><div class="text-tabel"><?php echo $_smarty_tpl->tpl_vars['teams']->value['team_name'];?>
</div></td>
					<td><div class="tabel-centrat"><?php echo $_smarty_tpl->tpl_vars['teams']->value['category_name'];?>
</div></td>
                    <td class="tabel-optiune"><a href="/stafeta/?page=teams/update&team_id=<?php echo $_smarty_tpl->tpl_vars['teams']->value['team_id'];?>
">Editare</a></td>
                    <td class="tabel-optiune"><a href="/stafeta/?page=teams/delete&team_id=<?php echo $_smarty_tpl->tpl_vars['teams']->value['team_id'];?>
">Sterge</a></td>
                </tr>
            <?php
$_smarty_tpl->tpl_vars["teams"] = $foreach_teams_Sav;
}
?>
        </table>
    </div>
</div>
<?php }
}
?>