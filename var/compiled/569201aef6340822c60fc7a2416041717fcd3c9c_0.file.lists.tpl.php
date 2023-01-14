<?php /* Smarty version 3.1.27, created on 2016-04-03 23:00:46
         compiled from "D:\Stafeta Muntilor\UwAmp\UwAmp\www\stafeta\templates\clubs\lists.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:38215701766ed80e24_13035406%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '569201aef6340822c60fc7a2416041717fcd3c9c' => 
    array (
      0 => 'D:\\Stafeta Muntilor\\UwAmp\\UwAmp\\www\\stafeta\\templates\\clubs\\lists.tpl',
      1 => 1459635460,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '38215701766ed80e24_13035406',
  'variables' => 
  array (
    'totalclubs' => 0,
    'number' => 0,
    'club' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5701766edd9381_84750409',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5701766edd9381_84750409')) {
function content_5701766edd9381_84750409 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '38215701766ed80e24_13035406';
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