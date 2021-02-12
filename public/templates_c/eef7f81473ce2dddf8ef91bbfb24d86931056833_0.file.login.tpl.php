<?php
/* Smarty version 3.1.34-dev-7, created on 2021-02-07 12:44:15
  from 'C:\xampp\htdocs\medicus\app\views\templates\login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_601fd28f75cab5_13069999',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'eef7f81473ce2dddf8ef91bbfb24d86931056833' => 
    array (
      0 => 'C:\\xampp\\htdocs\\medicus\\app\\views\\templates\\login.tpl',
      1 => 1612656273,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common_elements/head.tpl' => 1,
    'file:common_elements/loginNav.tpl' => 1,
    'file:messages/messages.tpl' => 1,
  ),
),false)) {
function content_601fd28f75cab5_13069999 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->_subTemplateRender("file:common_elements/head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div id="wrapper">
    <!-- Main -->
    <div class="inner">

        <header id="header">

            <?php $_smarty_tpl->_subTemplateRender("file:common_elements/loginNav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_70248544601fd28f75bfc2_48157905', "content");
?>

        </header>

    </div>
        <?php $_smarty_tpl->_subTemplateRender("file:messages/messages.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    </div>

</div>
<?php }
/* {block "content"} */
class Block_70248544601fd28f75bfc2_48157905 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_70248544601fd28f75bfc2_48157905',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>



            <?php
}
}
/* {/block "content"} */
}
