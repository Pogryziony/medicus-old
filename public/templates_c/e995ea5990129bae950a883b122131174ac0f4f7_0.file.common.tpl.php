<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-08 03:42:44
  from 'C:\xampp\htdocs\medicus\app\views\common.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60458f248bea90_57470020',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e995ea5990129bae950a883b122131174ac0f4f7' => 
    array (
      0 => 'C:\\xampp\\htdocs\\medicus\\app\\views\\common.tpl',
      1 => 1615170974,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common_elements/head.tpl' => 1,
    'file:common_elements/messages/messages.tpl' => 1,
    'file:common_elements/footer.tpl' => 1,
  ),
),false)) {
function content_60458f248bea90_57470020 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->_subTemplateRender("file:common_elements/head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div id="wrapper">

    <!-- Main -->
    <div class="inner">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_214233317760458f248bda93_92338357', "content");
?>

        <?php $_smarty_tpl->_subTemplateRender("file:common_elements/messages/messages.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    </div>
</div>
<?php $_smarty_tpl->_subTemplateRender("file:common_elements/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
/* {block "content"} */
class Block_214233317760458f248bda93_92338357 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_214233317760458f248bda93_92338357',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


        <?php
}
}
/* {/block "content"} */
}
