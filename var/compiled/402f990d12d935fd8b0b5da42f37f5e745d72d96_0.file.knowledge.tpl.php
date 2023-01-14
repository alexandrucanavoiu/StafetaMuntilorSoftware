<?php /* Smarty version 3.1.27, created on 2016-07-28 14:27:54
         compiled from "C:\Users\Test\Desktop\imprimanta driver\Stafeta_Muntilor_Software\Stafeta Muntilor Software\www\stafeta\templates\ranking\knowledge.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:260405799ec3a4a4649_75352146%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '402f990d12d935fd8b0b5da42f37f5e745d72d96' => 
    array (
      0 => 'C:\\Users\\Test\\Desktop\\imprimanta driver\\Stafeta_Muntilor_Software\\Stafeta Muntilor Software\\www\\stafeta\\templates\\ranking\\knowledge.tpl',
      1 => 1469643686,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '260405799ec3a4a4649_75352146',
  'variables' => 
  array (
    'category' => 0,
    'organizer' => 0,
    'lists' => 0,
    'teams' => 0,
    'category_id' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5799ec3a9c4f78_63031674',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5799ec3a9c4f78_63031674')) {
function content_5799ec3a9c4f78_63031674 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '260405799ec3a4a4649_75352146';
if (isset($_REQUEST['pdf'])) {?>
   <table border=0 align="center">
        <tr>
            <td style="border:none;"><img src="images/logo.png" width="100"></td>
            <td style="border:none;" align="center">
                <h3><strong>Clasament Proba Cunostinte Turistice			<br />
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
    <p class="home"><strong>Clasament Proba Cunostinte Turistice - Categoria  <?php echo $_smarty_tpl->tpl_vars['category']->value['category_name'];?>
 - </strong>  </p>
    <div class="total-continut">
        <div class='TabelListaCluburi'>
<?php }?>

        <table class="afisare-tabel" style="width: 100%" >
			<tr>
                <th style="width:8%">Loc</th>
               <th style="width:30%">Nume Echipa</th>
				<th style="width:10%">Greseli</th>
				<th style="width:auto"><?php if (!isset($_REQUEST['pdf'])) {?> Intrebarile gresite <?php }
if (isset($_REQUEST['pdf'])) {?> Ai gresit la <br /> intrebarile cu numarul <?php }?></th>
				<th style="width:10%">Scor</th>
				<th style="width:9%">Timp</th>

            </tr>
            <?php
$_from = $_smarty_tpl->tpl_vars['lists']->value;
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
                    <td class="numere-tabel"><?php echo (($tmp = @$_smarty_tpl->tpl_vars['teams']->value['rank'])===null||$tmp==='' ? '-' : $tmp);?>
</td>
                    <td class="text-tabel left"><a href="/stafeta/?page=knowledge/update&category_id=<?php echo $_smarty_tpl->tpl_vars['category_id']->value;?>
&team_id=<?php echo $_smarty_tpl->tpl_vars['teams']->value['team_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['teams']->value['team_name'];?>
 </a></td>
					<td class="numere-tabel"><?php if ($_smarty_tpl->tpl_vars['teams']->value['abandon'] == 1) {?> - <?php } else { ?> <?php echo $_smarty_tpl->tpl_vars['teams']->value['answers'];?>
 <?php }?></td>
					<td class="numere-tabel"><?php if ($_smarty_tpl->tpl_vars['teams']->value['abandon'] == 1) {?> - <?php } else { ?> <?php echo $_smarty_tpl->tpl_vars['teams']->value['wrongquestions'];?>
 <?php }?></td>
					<td class="numere-tabel"><?php if ($_smarty_tpl->tpl_vars['teams']->value['abandon'] == 1) {?> Abandon <?php } else { ?> <?php echo $_smarty_tpl->tpl_vars['teams']->value['scor'];?>
  <?php }?>  </td>
					<td class="numere-tabel"><?php if ($_smarty_tpl->tpl_vars['teams']->value['abandon'] == 1) {?> - <?php } else { ?> <?php echo $_smarty_tpl->tpl_vars['teams']->value['time'];?>
 <?php }?></td>
                   
                </tr>
            <?php
$_smarty_tpl->tpl_vars["teams"] = $foreach_teams_Sav;
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