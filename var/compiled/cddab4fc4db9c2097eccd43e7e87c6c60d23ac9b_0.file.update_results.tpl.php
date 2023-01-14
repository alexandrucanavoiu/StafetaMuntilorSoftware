<?php /* Smarty version 3.1.27, created on 2016-07-28 15:01:41
         compiled from "C:\Users\Test\Desktop\imprimanta driver\Stafeta_Muntilor_Software\Stafeta Muntilor Software\www\stafeta\templates\challenges\update_results.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:113775799f42540d965_45690604%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'cddab4fc4db9c2097eccd43e7e87c6c60d23ac9b' => 
    array (
      0 => 'C:\\Users\\Test\\Desktop\\imprimanta driver\\Stafeta_Muntilor_Software\\Stafeta Muntilor Software\\www\\stafeta\\templates\\challenges\\update_results.tpl',
      1 => 1469643684,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '113775799f42540d965_45690604',
  'variables' => 
  array (
    'team' => 0,
    'challenge' => 0,
    'category' => 0,
    'categoryChallenge' => 0,
    'participation' => 0,
    'entries' => 0,
    'stations' => 0,
    'entry' => 0,
    'types' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5799f42588a176_00916481',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5799f42588a176_00916481')) {
function content_5799f42588a176_00916481 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '113775799f42540d965_45690604';
?>
<p class="home"><strong><?php echo $_smarty_tpl->tpl_vars['team']->value['team_name'];?>
 - Proba <?php echo $_smarty_tpl->tpl_vars['challenge']->value['challenge_name'];?>
 - Categoria <?php echo $_smarty_tpl->tpl_vars['category']->value['category_name'];?>
 </strong>
    <?php if (!empty($_smarty_tpl->tpl_vars['categoryChallenge']->value)) {?>
        <small>
            - <a href="/stafeta/?page=challenges/update&challenge_id=<?php echo $_smarty_tpl->tpl_vars['categoryChallenge']->value['challenge_id'];?>
&category_id=<?php echo $_smarty_tpl->tpl_vars['categoryChallenge']->value['category_id'];?>
">vezi configuratie</a>
        </small>
        <?php }?>
    <br />
    Club: <?php echo $_smarty_tpl->tpl_vars['team']->value['club']['club_name'];?>

</p>


<div class="total-continut">
    <form method="POST" action="/stafeta/?page=challenges/update_results" autocomplete="off" class="form-horizontal sm-form" role="form">
        <input type="hidden" name="category_challenge_id" value="<?php echo $_smarty_tpl->tpl_vars['categoryChallenge']->value['category_challenge_id'];?>
"/>
        <input type="hidden" name="team_id" value="<?php echo $_smarty_tpl->tpl_vars['team']->value['team_id'];?>
"/>

        <div class="col-sm-6">
            <div class="form-group">
                <label class="control-label col-sm-5" for="abandon">Abandon:</label>
                <div class="col-sm-2">
                    <input type="hidden" name="participation[abandonment]" value="0">
                    <input type="checkbox" id="abandon" name="participation[abandonment]" value="1" <?php if ($_smarty_tpl->tpl_vars['participation']->value['abandonment'] == 1) {?>checked="checked"<?php }?>>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-5" for="missing_footwear">Lipsa bocanci:</label>
                <div class="col-sm-2">
                    <input type="hidden" name="participation[missing_footwear]" value="0">
                    <input type="checkbox" id="missing_footwear" name="participation[missing_footwear]" value="1" <?php if ($_smarty_tpl->tpl_vars['participation']->value['missing_footwear'] == 1) {?>checked="checked"<?php }?>>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-5" for="gear">Lipsa echipamente:</label>
                <div class="col-sm-2">
                    <input type="number" class="form-control" id="gear" value="<?php echo (($tmp = @$_smarty_tpl->tpl_vars['participation']->value['missing_equipment_items'])===null||$tmp==='' ? 0 : $tmp);?>
" min="0" name="participation[missing_equipment_items]">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-5" for="minimum_distance_penalty">Nerespectare distanta intre membrii:</label>
                <div class="col-sm-2">
                    <input type="hidden" name="participation[minimum_distance_penalty]" value="0">
                    <input type="checkbox" id="minimum_distance_penalty" name="participation[minimum_distance_penalty]" value="1" <?php if ($_smarty_tpl->tpl_vars['participation']->value['minimum_distance_penalty'] == 1) {?>checked="checked"<?php }?>>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-5" for="abandon">Posturi:</label>
                <div class="col-sm-2">
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <table class="stations cloneable">
                <?php if (empty($_smarty_tpl->tpl_vars['entries']->value)) {?>
                    <?php $_smarty_tpl->tpl_vars['entries'] = new Smarty_Variable($_smarty_tpl->tpl_vars['stations']->value, null, 0);?>
                <?php }?>

                <?php
$_from = $_smarty_tpl->tpl_vars['entries']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars["entry"] = new Smarty_Variable;
$_smarty_tpl->tpl_vars["entry"]->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars["entry"]->value) {
$_smarty_tpl->tpl_vars["entry"]->_loop = true;
$foreach_entry_Sav = $_smarty_tpl->tpl_vars["entry"];
?>
                    <?php if ($_smarty_tpl->tpl_vars['entry']->value['station_type'] == 1) {?>
                        <?php $_smarty_tpl->tpl_vars['types'] = new Smarty_Variable(array(1,2), null, 0);?>
                    <?php } elseif ($_smarty_tpl->tpl_vars['entry']->value['station_type'] == 2) {?>
                        <?php $_smarty_tpl->tpl_vars['types'] = new Smarty_Variable(array(1,2), null, 0);?>
                    <?php } else { ?>
                        <?php $_smarty_tpl->tpl_vars['types'] = new Smarty_Variable(array($_smarty_tpl->tpl_vars['entry']->value['station_type']), null, 0);?>
                    <?php }?>
                    <?php echo $_smarty_tpl->getSubTemplate ("challenges/components/raid_station_result.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>$_smarty_tpl->tpl_vars['entry']->value['station_type'],'types'=>$_smarty_tpl->tpl_vars['types']->value,'entry'=>$_smarty_tpl->tpl_vars['entry']->value), 0);
?>

                <?php
$_smarty_tpl->tpl_vars["entry"] = $foreach_entry_Sav;
}
?>
            </table>
        </div>


        <div class="form-group">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-default">Salvează</button>
            </div>
        </div>

    </form>


</div><?php }
}
?>