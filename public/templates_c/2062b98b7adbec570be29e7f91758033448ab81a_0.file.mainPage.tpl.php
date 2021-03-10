<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-08 03:42:44
  from 'C:\xampp\htdocs\medicus\app\views\mainPage.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60458f24a1ecd2_43001471',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2062b98b7adbec570be29e7f91758033448ab81a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\medicus\\app\\views\\mainPage.tpl',
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
function content_60458f24a1ecd2_43001471 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_7837486260458f24a1b5d3_51232850', "content");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "common.tpl");
}
/* {block "content"} */
class Block_7837486260458f24a1b5d3_51232850 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_7837486260458f24a1b5d3_51232850',
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
