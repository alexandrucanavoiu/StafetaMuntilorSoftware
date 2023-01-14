<?php /* Smarty version 3.1.27, created on 2016-04-03 15:02:25
         compiled from "/var/www/html/stafeta/templates/orienteering/lists.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1808456781570168c158b841_97608633%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '7806b5fc0a6b478ea0a5befb1c3dcd1a669b28f8' => 
    array (
      0 => '/var/www/html/stafeta/templates/orienteering/lists.tpl',
      1 => 1436965262,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1808456781570168c158b841_97608633',
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
  'unifunc' => 'content_570168c15ca914_63589838',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_570168c15ca914_63589838')) {
function content_570168c15ca914_63589838 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1808456781570168c158b841_97608633';
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