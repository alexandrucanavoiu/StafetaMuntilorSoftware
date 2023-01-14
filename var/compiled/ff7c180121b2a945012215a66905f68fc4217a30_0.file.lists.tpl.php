<?php /* Smarty version 3.1.27, created on 2016-04-03 23:15:18
         compiled from "D:\UwAmp\UwAmp\www\stafeta\templates\knowledge\lists.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:23170570179d67a0456_55061738%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ff7c180121b2a945012215a66905f68fc4217a30' => 
    array (
      0 => 'D:\\UwAmp\\UwAmp\\www\\stafeta\\templates\\knowledge\\lists.tpl',
      1 => 1440530183,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '23170570179d67a0456_55061738',
  'variables' => 
  array (
    'category' => 0,
    'totalteams' => 0,
    'number' => 0,
    'category_id' => 0,
    'teams' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_570179d6833d00_98116932',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_570179d6833d00_98116932')) {
function content_570179d6833d00_98116932 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '23170570179d67a0456_55061738';
?>
<p class="home"><strong>Cunostinte Turistice - Categoria  <?php echo $_smarty_tpl->tpl_vars['category']->value['category_name'];?>
 - Lista Echipe Stafeta Muntilor</strong></p>
<div class="total-continut">
	<br />	
    <div class='<?php if (isset($_REQUEST['pdf'])) {?> print <?php } else { ?> TabelListaCluburi <?php }?>'>
        <table class="afisare-tabel"> 
            <tr>
                <td class="tabel-optiune">Nr</td>
                <td class="tabel-nume"><div class="text-top-tabel">Echipa</div></td>
				<td class="tabel-optiune">Nr. Greseli</td>
				<td class="tabel-optiune">Intrebari Gresite</td>
				<td class="tabel-optiune">Timp Realizat</td>
				<td class="tabel-optiune">Abandon</td>
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
                    <td class="numere-tabel"><div><?php echo $_smarty_tpl->tpl_vars['number']->value++;?>
 </div></td>
                    <td class="text-tabel"><div><a href="/stafeta/?page=knowledge/update&category_id=<?php echo $_smarty_tpl->tpl_vars['category_id']->value;?>
&team_id=<?php echo $_smarty_tpl->tpl_vars['teams']->value['team_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['teams']->value['team_name'];?>
 </a></div></td>
					<td class="numere-tabel"><div><?php echo $_smarty_tpl->tpl_vars['teams']->value['answers'];?>
 </div></td>
					<td class="numere-tabel"><div><?php echo $_smarty_tpl->tpl_vars['teams']->value['wrongquestions'];?>
 </div></td>
					<td class="numere-tabel"><div><?php echo $_smarty_tpl->tpl_vars['teams']->value['time'];?>
 </div></td>
					<td class="numere-tabel"><div><?php if ($_smarty_tpl->tpl_vars['teams']->value['abandon'] == 0) {?> NU <?php } elseif ($_smarty_tpl->tpl_vars['teams']->value['abandon'] == 1) {?> DA <?php } else { ?> <?php }?></div></td>
                    <td class="tabel-optiune"><div><a href="/stafeta/?page=knowledge/update&category_id=<?php echo $_smarty_tpl->tpl_vars['category_id']->value;?>
&team_id=<?php echo $_smarty_tpl->tpl_vars['teams']->value['team_id'];?>
">Completeaza</a></div></td>
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