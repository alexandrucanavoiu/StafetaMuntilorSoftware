<?php /* Smarty version 3.1.27, created on 2016-07-28 14:55:27
         compiled from "C:\Users\Test\Desktop\imprimanta driver\Stafeta_Muntilor_Software\Stafeta Muntilor Software\www\stafeta\templates\ranking\orienteering.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:25555799f2afdc29f5_91909640%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dc2e984ee4f4dfdd99896a1fbdadaeaf17559495' => 
    array (
      0 => 'C:\\Users\\Test\\Desktop\\imprimanta driver\\Stafeta_Muntilor_Software\\Stafeta Muntilor Software\\www\\stafeta\\templates\\ranking\\orienteering.tpl',
      1 => 1469643686,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '25555799f2afdc29f5_91909640',
  'variables' => 
  array (
    'category' => 0,
    'organizer' => 0,
    'ranking' => 0,
    'team' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5799f2b0381b22_04879838',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5799f2b0381b22_04879838')) {
function content_5799f2b0381b22_04879838 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '25555799f2afdc29f5_91909640';
if (isset($_REQUEST['pdf'])) {?>
   <table border=0 align="center">
        <tr>
            <td style="border:none;"><img src="images/logo.png" width="100"></td>
            <td style="border:none;" align="center">
                <h3><strong>Clasament Proba Orientare
			<br />
				- Categoria  <?php echo $_smarty_tpl->tpl_vars['category']->value['category_name'];?>
 - </strong></h3>
                <br/>
                <?php echo $_smarty_tpl->tpl_vars['organizer']->value['name_trophy'];?>
 - <?php echo $_smarty_tpl->tpl_vars['organizer']->value['phase_trophy'];?>

                <br/>
                Organizator <?php echo $_smarty_tpl->tpl_vars['organizer']->value['name_organizer'];?>

				<br />
				<?php if (($_smarty_tpl->tpl_vars['organizer']->value['phase_trophy'] == "Amical")) {?>
				Acest clasament nu se cumuleaza in cadrul Stafeta Muntilor.
				<?php }?>
            </td>
            <td style="border:none;"><img src="images/logo.png" width="100"></td>
        </tr>
    </table>
    <br/>

<?php } else { ?>
    <p class="home"><strong>Clasament Proba Orientare - Categoria  <?php echo $_smarty_tpl->tpl_vars['category']->value['category_name'];?>
</strong>  </p>

    <div class="total-continut">
        <div class='TabelListaCluburi'>
<?php }?>

        <table class="afisare-tabel" style="width: 100%" >
				<tr>
					<th style="width:5%"><strong>Loc</strong></th>
					<th style="width:40%"><strong>Echipa</strong></th>
					<th style="width:30%"><strong>Nume Concurent</strong></th>
					<th style="width:10%"><strong>Timp Realizat</strong></th>
					<th style="width:10%"><strong>Punctaj</strong></th>

				</tr>
				
				<?php
$_from = $_smarty_tpl->tpl_vars['ranking']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars["team"] = new Smarty_Variable;
$_smarty_tpl->tpl_vars["team"]->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars["team"]->value) {
$_smarty_tpl->tpl_vars["team"]->_loop = true;
$foreach_team_Sav = $_smarty_tpl->tpl_vars["team"];
?>
					<tr>
						<td class="numere-tabel"><?php if (empty($_smarty_tpl->tpl_vars['team']->value['orienteering_id']) || $_smarty_tpl->tpl_vars['team']->value['orienteering_abandon'] == 1 || $_smarty_tpl->tpl_vars['team']->value['missed_posts'] > 0) {
} else {
echo $_smarty_tpl->tpl_vars['team']->value['rank'];
}?></td>
						<td class="text-tabel left"><a href="<?php echo url('orienteering/update',array('category_id'=>$_smarty_tpl->tpl_vars['category']->value['category_id'],'team_id'=>$_smarty_tpl->tpl_vars['team']->value['team_id']));?>
"><?php echo $_smarty_tpl->tpl_vars['team']->value['team_name'];?>
</a></td>
						<td class="text-tabel left"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['team']->value['name_participant'])===null||$tmp==='' ? '-' : $tmp);?>
</td>
						<td class="numere-tabel"><?php if ($_smarty_tpl->tpl_vars['team']->value['orienteering_abandon'] == 1 || empty($_smarty_tpl->tpl_vars['team']->value['orienteering_id'])) {?> Abandon <?php } elseif ($_smarty_tpl->tpl_vars['team']->value['missed_posts'] >= 1) {?> Post Lipsa <?php } else { ?> <?php echo $_smarty_tpl->tpl_vars['team']->value['total'];?>
  <?php }?></td>
						<td class="numere-tabel"><?php if ($_smarty_tpl->tpl_vars['team']->value['orienteering_abandon'] == 1) {?> 0 <?php } elseif ($_smarty_tpl->tpl_vars['team']->value['missed_posts'] >= 1) {?> 0 <?php } else { ?> <?php echo $_smarty_tpl->tpl_vars['team']->value['score'];?>
 <?php }?></td>
					</tr>
				<?php
$_smarty_tpl->tpl_vars["team"] = $foreach_team_Sav;
}
?>
			</table>

<?php if (!isset($_REQUEST['pdf'])) {?>
    </div>
</div>

<a href="/stafeta/?page=ranking/lists&category_id=<?php echo $_smarty_tpl->tpl_vars['category']->value['category_id'];?>
" class="btn btn-primary clone">INAPOI</a>
<a href="<?php echo $_SERVER['REQUEST_URI'];?>
&pdf=1" target="_blank" class="btn btn-primary clone">Export to PDF</a>
<?php }
}
}
?>