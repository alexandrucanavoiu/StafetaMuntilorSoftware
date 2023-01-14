<?php /* Smarty version 3.1.27, created on 2016-04-03 23:15:16
         compiled from "D:\UwAmp\UwAmp\www\stafeta\templates\challenges\update.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:8439570179d4057ea0_01354025%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '86cfbf277ad1e68ec7d481131bf5afa9ad02e725' => 
    array (
      0 => 'D:\\UwAmp\\UwAmp\\www\\stafeta\\templates\\challenges\\update.tpl',
      1 => 1436907256,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8439570179d4057ea0_01354025',
  'variables' => 
  array (
    'challenge' => 0,
    'category' => 0,
    'challenge_id' => 0,
    'category_id' => 0,
    'categoryChallenge' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_570179d40c7167_73912661',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_570179d40c7167_73912661')) {
function content_570179d40c7167_73912661 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '8439570179d4057ea0_01354025';
?>
<p class="home"><strong>Configurare proba <?php echo $_smarty_tpl->tpl_vars['challenge']->value['challenge_name'];?>
 - <?php echo $_smarty_tpl->tpl_vars['category']->value['category_name'];?>
</strong></p>
	
<div class="total-continut">

    <form method="POST" action="/stafeta/?page=challenges/update" autocomplete="off" class="form-horizontal sm-form" role="form">
        <input type="hidden" name="challenge_id" value="<?php echo $_smarty_tpl->tpl_vars['challenge_id']->value;?>
"/>
        <input type="hidden" name="category_id" value="<?php echo $_smarty_tpl->tpl_vars['category_id']->value;?>
"/>
        <div class="">
            <?php if ($_smarty_tpl->tpl_vars['categoryChallenge']->value['challenge_id'] == 1) {?>
                <?php echo $_smarty_tpl->getSubTemplate ("challenges/components/raid.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

            <?php }?>
        </div>
		<div class="sm-buttons">
            <input type="submit" class="btn btn-primary" value="Salveaza" />
            <?php if (!empty($_smarty_tpl->tpl_vars['categoryChallenge']->value['category_challenge_id'])) {?>
                <a class="btn btn-default" href="/stafeta/?page=challenges/delete&category_challenge_id=<?php echo $_smarty_tpl->tpl_vars['categoryChallenge']->value['category_challenge_id'];?>
">Șterge</a>
                <a class="btn btn-default" href="/stafeta/?page=challenges/results&category_id=<?php echo $_smarty_tpl->tpl_vars['category_id']->value;?>
&challenge_id=<?php echo $_smarty_tpl->tpl_vars['challenge_id']->value;?>
">Adaugă rezultate</a>
            <?php }?>
        </div>
    </form>


</div>

<?php }
}
?>