<?php /* Smarty version 3.1.27, created on 2016-04-03 15:57:10
         compiled from "/var/www/html/stafeta/templates/ranking/raid.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:170047915957017596f2a9c6_46731885%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f592ee3b0dc88006d77a2b61c010100260502e3d' => 
    array (
      0 => '/var/www/html/stafeta/templates/ranking/raid.tpl',
      1 => 1459713142,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '170047915957017596f2a9c6_46731885',
  'variables' => 
  array (
    'category' => 0,
    'organizer' => 0,
    'challenge' => 0,
    'showLogs' => 0,
    'ranks' => 0,
    'team' => 0,
    'categoryChallengeId' => 0,
    'log' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5701759707c211_90165713',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5701759707c211_90165713')) {
function content_5701759707c211_90165713 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '170047915957017596f2a9c6_46731885';
$_smarty_tpl->tpl_vars['showLogs'] = new Smarty_Variable(isset($_REQUEST['logs']), null, 0);?>
<?php if (isset($_REQUEST['pdf'])) {?>
    <table border=0 align="center">
        <tr>
            <td style="border:none;"><img src="images/logo.png" width="100"></td>
            <td style="border:none;" align="center">
                <h3><strong>Clasament Proba Raid Montan
                        <br/>
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
    <p class="home"><strong>Clasament proba <a href="<?php echo url("challenges/update",array('challenge_id'=>$_smarty_tpl->tpl_vars['challenge']->value['challenge_id'],'category_id'=>$_smarty_tpl->tpl_vars['category']->value['category_id']));?>
"><?php echo $_smarty_tpl->tpl_vars['challenge']->value['challenge_name'];?>
 - Categoria  <?php echo $_smarty_tpl->tpl_vars['category']->value['category_name'];?>
</a> </strong>  </p>
    <a href="/stafeta/?page=ranking/raid&category_id=<?php echo $_smarty_tpl->tpl_vars['category']->value['category_id'];?>
&logs=1" class="btn btn-primary clone">Vezi clasament cu loguri</a>
    <div class="total-continut">
        <div class='TabelListaCluburi'>
<?php }?>


<table class="afisare-tabel" style="width: 100%" >
    <tr>
        <th style="width:8%">Loc</th>
        <th style="width:50%">Echipa</th>
        <th style="width:6%">Scor</th>
        <th style="width:10%">Timp total</th>
        <?php if ($_smarty_tpl->tpl_vars['showLogs']->value) {?>
           <th class="text-left" style="width:47%">Depunctarea</th>
        <?php }?>
    </tr>
    <?php
$_from = $_smarty_tpl->tpl_vars['ranks']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars["team"] = new Smarty_Variable;
$_smarty_tpl->tpl_vars["team"]->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars["team"]->value) {
$_smarty_tpl->tpl_vars["team"]->_loop = true;
$foreach_team_Sav = $_smarty_tpl->tpl_vars["team"];
?>
        <tr title="">
            <td class="numere-tabel"><?php echo $_smarty_tpl->tpl_vars['team']->value['rank'];?>
</td>
            <td class="text-tabel left"><a href="<?php echo url("challenges/update_results",array('category_challenge_id'=>$_smarty_tpl->tpl_vars['categoryChallengeId']->value,'team_id'=>$_smarty_tpl->tpl_vars['team']->value['team_id']));?>
"><?php echo $_smarty_tpl->tpl_vars['team']->value['team_name'];?>
</a></td>
            <td class="numere-tabel"><?php echo $_smarty_tpl->tpl_vars['team']->value['score'];?>
</td>
            <td class="numere-tabel" title="<?php echo $_smarty_tpl->tpl_vars['team']->value['raid_total_time_text_log'];?>
"><?php echo $_smarty_tpl->tpl_vars['team']->value['raid_total_time_text'];?>
</td>
            <?php if ($_smarty_tpl->tpl_vars['showLogs']->value) {?>
                <td class="logs left">
                    <?php if (!empty($_smarty_tpl->tpl_vars['team']->value['logs'])) {?>
                        <?php
$_from = $_smarty_tpl->tpl_vars['team']->value['logs'];
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars["log"] = new Smarty_Variable;
$_smarty_tpl->tpl_vars["log"]->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars["log"]->value) {
$_smarty_tpl->tpl_vars["log"]->_loop = true;
$foreach_log_Sav = $_smarty_tpl->tpl_vars["log"];
?>
                            <?php echo $_smarty_tpl->tpl_vars['log']->value;?>
<br>
                        <?php
$_smarty_tpl->tpl_vars["log"] = $foreach_log_Sav;
}
?>
                    <?php } else { ?>
                        <span>Fara penalizare</span>
                    <?php }?>
                </td>
            <?php }?>
        </tr>
    <?php
$_smarty_tpl->tpl_vars["team"] = $foreach_team_Sav;
}
?>
</table>

<?php if (!isset($_REQUEST['pdf'])) {?>
        </div>
    </div>
    <br>
    <a href="/stafeta/?page=ranking/lists&category_id=<?php echo $_smarty_tpl->tpl_vars['category']->value['category_id'];?>
" class="btn btn-primary clone">INAPOI</a>
    <a href="<?php echo $_SERVER['REQUEST_URI'];?>
&pdf=1&orientation=L" target="_blank" class="btn btn-primary clone">Export to PDF</a>
<?php }
}
}
?>