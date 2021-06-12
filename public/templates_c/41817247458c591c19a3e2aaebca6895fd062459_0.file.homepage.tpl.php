<?php
/* Smarty version 3.1.34-dev-7, created on 2021-04-22 16:21:57
  from 'C:\xampp\htdocs\medicus\app\views\homepage.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60818685483126_26632623',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '41817247458c591c19a3e2aaebca6895fd062459' => 
    array (
      0 => 'C:\\xampp\\htdocs\\medicus\\app\\views\\homepage.tpl',
      1 => 1615170974,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common_elements/navigation/homepageNav.tpl' => 1,
    'file:common_elements/features.tpl' => 1,
  ),
),false)) {
function content_60818685483126_26632623 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_4487509296081868547cd18_09685202', "content");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "common.tpl");
}
/* {block "content"} */
class Block_4487509296081868547cd18_09685202 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_4487509296081868547cd18_09685202',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<?php $_smarty_tpl->_subTemplateRender("file:common_elements/navigation/homepageNav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
$_smarty_tpl->_subTemplateRender("file:common_elements/features.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
/* {/block "content"} */
}
