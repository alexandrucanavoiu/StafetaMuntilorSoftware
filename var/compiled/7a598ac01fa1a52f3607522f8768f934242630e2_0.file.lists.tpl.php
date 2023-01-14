<?php /* Smarty version 3.1.27, created on 2016-07-27 21:48:28
         compiled from "C:\Users\Test\Desktop\imprimanta driver\Stafeta_Muntilor_Software\Stafeta Muntilor Software\www\stafeta\templates\orienteering\lists.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1096579901fccdf9c3_21695359%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7a598ac01fa1a52f3607522f8768f934242630e2' => 
    array (
      0 => 'C:\\Users\\Test\\Desktop\\imprimanta driver\\Stafeta_Muntilor_Software\\Stafeta Muntilor Software\\www\\stafeta\\templates\\orienteering\\lists.tpl',
      1 => 1469643685,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1096579901fccdf9c3_21695359',
  'variables' => 
  array (
    'category' => 0,
    'totalteams' => 0,
    'number' => 0,
    'category_id' => 0,
    'team' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_579901fd016350_18824464',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_579901fd016350_18824464')) {
function content_579901fd016350_18824464 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1096579901fccdf9c3_21695359';
?>
<p class="home"><strong>Proba Orientare - Categoria  <?php echo $_smarty_tpl->tpl_vars['category']->value['category_name'];?>
 - Lista Echipe Stafeta Muntilor</strong></p>
<div class="total-continut">
	<br />	
    <div class='TabelListaCluburi'>
        <table class="afisare-tabel">
            <tr>
                <td class="tabel-optiune">Nr</td>
                <td class="tabel-nume"><div class="text-top-tabel">Echipa</div></td>
				<td class="tabel-optiune">Start</td>
				<td class="tabel-optiune">Finish</td>
				<td class="tabel-optiune">Abandon</td>
				<td class="tabel-optiune">Posturi ratate</td>
                <td class="tabel-optiune"></td>
            </tr>
            <?php
$_from = $_smarty_tpl->tpl_vars['totalteams']->value;
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
                    <td class="numere-tabel"><?php echo $_smarty_tpl->tpl_vars['number']->value++;?>
 </div></td>
                    <td class=""><a href="/stafeta/?page=orienteering/update&category_id=<?php echo $_smarty_tpl->tpl_vars['category_id']->value;?>
&team_id=<?php echo $_smarty_tpl->tpl_vars['team']->value['team_id'];?>
"> <?php echo $_smarty_tpl->tpl_vars['team']->value['team_name'];?>
 </a> </div></td>
					<td class="numere-tabel"><?php echo $_smarty_tpl->tpl_vars['team']->value['start'];?>
 </div></td>
					<td class="numere-tabel"><?php echo $_smarty_tpl->tpl_vars['team']->value['finish'];?>
 </div></td>
					<td class="numere-tabel"><?php if ($_smarty_tpl->tpl_vars['team']->value['abandon'] == 0) {?> NU <?php } elseif ($_smarty_tpl->tpl_vars['team']->value['abandon'] == 1) {?> DA <?php } else { ?> <?php }?> </div></td>
					<td class="numere-tabel"><?php echo $_smarty_tpl->tpl_vars['team']->value['missed_posts'];?>
 </div></td>
                    <td class="tabel-optiune"><a href="/stafeta/?page=orienteering/update&category_id=<?php echo $_smarty_tpl->tpl_vars['category_id']->value;?>
&team_id=<?php echo $_smarty_tpl->tpl_vars['team']->value['team_id'];?>
">Completeaza</a></div></td>
                </tr>
            <?php
$_smarty_tpl->tpl_vars["team"] = $foreach_team_Sav;
}
?>
        </table>
    </div>
</div>
<?php }
}
?>