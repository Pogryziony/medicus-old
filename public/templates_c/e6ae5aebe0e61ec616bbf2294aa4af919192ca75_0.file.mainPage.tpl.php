<?php
/* Smarty version 3.1.34-dev-7, created on 2021-02-07 19:49:15
  from 'C:\xampp\htdocs\medicus\app\views\templates\mainPage.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6020362b0da6e3_25443410',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e6ae5aebe0e61ec616bbf2294aa4af919192ca75' => 
    array (
      0 => 'C:\\xampp\\htdocs\\medicus\\app\\views\\templates\\mainPage.tpl',
      1 => 1612723698,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common_elements/head.tpl' => 1,
    'file:navigation/patientLoginNav.tpl' => 1,
    'file:common_elements/features.tpl' => 1,
    'file:messages/messages.tpl' => 1,
    'file:common_elements/footer.tpl' => 1,
  ),
),false)) {
function content_6020362b0da6e3_25443410 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->_subTemplateRender("file:common_elements/head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div id="wrapper">

    <!-- Main -->
    <div class="inner">
        <?php $_smarty_tpl->_subTemplateRender("file:navigation/patientLoginNav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_10601004156020362b0d8ec9_08764704', "content");
?>

        <?php $_smarty_tpl->_subTemplateRender("file:messages/messages.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    </div>
</div>
<?php $_smarty_tpl->_subTemplateRender("file:common_elements/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
/* {block "content"} */
class Block_10601004156020362b0d8ec9_08764704 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_10601004156020362b0d8ec9_08764704',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


            <?php $_smarty_tpl->_subTemplateRender("file:common_elements/features.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

        <?php
}
}
/* {/block "content"} */
}
