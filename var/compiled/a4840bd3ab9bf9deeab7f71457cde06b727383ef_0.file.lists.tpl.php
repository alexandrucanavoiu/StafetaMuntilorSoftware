<?php /* Smarty version 3.1.27, created on 2016-06-09 18:56:15
         compiled from "D:\Stafeta Muntilor Software\www\stafeta\templates\clubs\lists.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:170235759919fce0157_77649705%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a4840bd3ab9bf9deeab7f71457cde06b727383ef' => 
    array (
      0 => 'D:\\Stafeta Muntilor Software\\www\\stafeta\\templates\\clubs\\lists.tpl',
      1 => 1459635460,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '170235759919fce0157_77649705',
  'variables' => 
  array (
    'totalclubs' => 0,
    'number' => 0,
    'club' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5759919fd2ff65_45708732',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5759919fd2ff65_45708732')) {
function content_5759919fd2ff65_45708732 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '170235759919fce0157_77649705';
?>
<p class="home"><strong>Lista Cluburi Participante - Stafeta Muntilor</strong></p>
<div class="total-continut">
    <div><a href="/stafeta/?page=clubs/add" class="btn btn-primary clone">ADAUGA CLUB</a></div>
	<br />	
    <div class='TabelListaCluburi'>
        <table class="afisare-tabel">
            <tr>
				<td class="tabel-optiune"><div class="text-top-tabel">Nr.</div></td>
                <td class="tabel-nume"><div class="text-top-tabel">Nume Club</div></td>
                <td class="tabel-optiune"></td>
                <td class="tabel-optiune"></td>
            </tr>
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
                <tr>
					<td class="numere-tabel"><?php echo $_smarty_tpl->tpl_vars['number']->value++;?>
</td>
                    <td><div class="t"><?php echo $_smarty_tpl->tpl_vars['club']->value['club_name'];?>
</div></td>
                    <td class="tabel-optiune"><a href="/stafeta/?page=clubs/update&club_id=<?php echo $_smarty_tpl->tpl_vars['club']->value['club_id'];?>
">Editare</a></td>
                    <td class="tabel-optiune"><a href="/stafeta/?page=clubs/delete&club_id=<?php echo $_smarty_tpl->tpl_vars['club']->value['club_id'];?>
">Sterge</a></td>
                </tr>
            <?php
$_smarty_tpl->tpl_vars["club"] = $foreach_club_Sav;
}
?>
        </table>
    </div>

</div><?php }
}
?>