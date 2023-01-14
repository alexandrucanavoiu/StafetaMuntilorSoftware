<?php /* Smarty version 3.1.27, created on 2016-07-27 21:36:47
         compiled from "templates\common\menu.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:3985798ff3fbb3e91_46113965%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd3620085a3f91fcec8f4a6a89f7f11a902b718b4' => 
    array (
      0 => 'templates\\common\\menu.tpl',
      1 => 1469643684,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3985798ff3fbb3e91_46113965',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5798ff3fc82f43_26806048',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5798ff3fc82f43_26806048')) {
function content_5798ff3fc82f43_26806048 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '3985798ff3fbb3e91_46113965';
?>
<div class="navigation">
    <h3>Stafeta Muntilor</h3>
    <ul>
        <li><a href="/stafeta/?page=challenges/configure"><i class="art"></i> Configurare</a></li>
        <li><a href="/stafeta/?page=clubs/lists"><i class="clubs"></i> Cluburi</a></li>
        <li><a href="/stafeta/?page=teams/lists"><i class="user"></i> Echipe</a></li>
        <li><a href="/stafeta/?page=cultural/lists"><i class="cultural"></i> Cultural</a></li>
        <li><a href="/stafeta/?page=others/lists"><i class="other"></i> Others</a></li>
    </ul>
</div>

<div class="navigation">
    <h3>Categoria <span>Open</span></h3>
    <ul>
        <li><a href="/stafeta/?page=knowledge/lists&category_id=4"><i class="cunostinte"></i> Cunostinte Turistice</a></li>
        <li><a href="/stafeta/?page=orienteering/lists&category_id=4"><i class="orientare"></i> Orientare</a></li>
        <li><a href="/stafeta/?page=challenges/results&category_id=4&challenge_id=1"><i class="raidmontan"></i> Raid Montan</a></li>
        <li><a href="/stafeta/?page=ranking/lists&category_id=4"><i class="categoriecat"></i> Clasamente</a></li>
    </ul>
</div>
<div class="navigation">
    <h3>Categoria <span>Juniori</span></h3>
    <ul>
        <li><a href="/stafeta/?page=knowledge/lists&category_id=2"><i class="cunostinte"></i> Cunostinte Turistice</a></li>
        <li><a href="/stafeta/?page=orienteering/lists&category_id=2"><i class="orientare"></i> Orientare</a></li>
        <li><a href="/stafeta/?page=challenges/results&category_id=2&challenge_id=1"><i class="raidmontan"></i> Raid Montan</a></li>
        <li><a href="/stafeta/?page=ranking/lists&category_id=2"><i class="categoriecat"></i> Clasamente</a></li>
    </ul>
</div>
<div class="navigation">
    <h3>Categoria <span>Family</span></h3>
    <ul>
        <li><a href="/stafeta/?page=knowledge/lists&category_id=1"><i class="cunostinte"></i> Cunostinte Turistice</a></li>
        <li><a href="/stafeta/?page=orienteering/lists&category_id=1"><i class="orientare"></i> Orientare</a></li>
        <li><a href="/stafeta/?page=challenges/results&category_id=1&challenge_id=1"><i class="raidmontan"></i> Raid Montan</a></li>
        <li><a href="/stafeta/?page=ranking/lists&category_id=1"><i class="categoriecat"></i> Clasamente</a></li>
    </ul>
</div>
<div class="navigation">
    <h3>Categoria <span>Feminin</span></h3>
    <ul>
        <li><a href="/stafeta/?page=knowledge/lists&category_id=6"><i class="cunostinte"></i> Cunostinte Turistice</a></li>
        <li><a href="/stafeta/?page=orienteering/lists&category_id=6"><i class="orientare"></i> Orientare</a></li>
        <li><a href="/stafeta/?page=challenges/results&category_id=6&challenge_id=1"><i class="raidmontan"></i> Raid Montan</a></li>
        <li><a href="/stafeta/?page=ranking/lists&category_id=6"><i class="categoriecat"></i> Clasamente</a></li>
    </ul>
</div>
<div class="navigation">
    <h3>Categoria <span>Veterani</span></h3>
    <ul>
        <li><a href="/stafeta/?page=knowledge/lists&category_id=5"><i class="cunostinte"></i> Cunostinte Turistice</a></li>
        <li><a href="/stafeta/?page=orienteering/lists&category_id=5"><i class="orientare"></i> Orientare</a></li>
        <li><a href="/stafeta/?page=challenges/results&category_id=5&challenge_id=1"><i class="raidmontan"></i> Raid Montan</a></li>
        <li><a href="/stafeta/?page=ranking/lists&category_id=5"><i class="categoriecat"></i> Clasamente</a></li>
    </ul>
</div>
<div class="navigation">
    <h3>Categoria <span>Elite</span></h3>
    <ul>
        <li><a href="/stafeta/?page=knowledge/lists&category_id=3"><i class="cunostinte"></i> Cunostinte Turistice</a></li>
        <li><a href="/stafeta/?page=orienteering/lists&category_id=3"><i class="orientare"></i> Orientare</a></li>
        <li><a href="/stafeta/?page=challenges/results&category_id=3&challenge_id=1"><i class="raidmontan"></i> Raid Montan</a></li>
        <li><a href="/stafeta/?page=ranking/lists&category_id=3"><i class="categoriecat"></i> Clasamente</a></li>
    </ul>
</div>
<div class="navigation">
    <h3>Clasament General</h3>
    <ul>
        <li><a href="<?php echo url("ranking/general");?>
"><i class="clasamentgen"></i> Vezi Clasament</a></li>
    </ul>
</div><?php }
}
?>