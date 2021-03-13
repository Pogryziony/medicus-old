<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-13 13:13:29
  from 'C:\xampp\htdocs\medicus\app\views\mainEmployeePage.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_604cac691e72a9_04506856',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3160d1ed301d7966afb01bb7f331f983fc8b56a4' => 
    array (
      0 => 'C:\\xampp\\htdocs\\medicus\\app\\views\\mainEmployeePage.tpl',
      1 => 1615637607,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common_elements/navigation/employeeModuleNav.tpl' => 1,
  ),
),false)) {
function content_604cac691e72a9_04506856 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1159865598604cac691e1598_14321583', "content");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "common.tpl");
}
/* {block "content"} */
class Block_1159865598604cac691e1598_14321583 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_1159865598604cac691e1598_14321583',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php $_smarty_tpl->_subTemplateRender("file:common_elements/navigation/employeeModuleNav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <div id="featured">
        <div class="panel panel-info" width="50%">
            <div class="panel-heading">Panel heading without title</div>
            <div class="panel-body">
                Panel content
            </div>
        </div>

        <div class="panel panel-info" width="50%">
            <div class="panel-heading">Panel heading without title</div>
            <div class="panel-body">
                Panel content
            </div>
        </div>

        <div class="panel panel-info">
            <div class="panel-heading">Panel heading without title</div>
            <div class="panel-body">
                Panel content
            </div>
        </div>
        <?php if (\core\RoleUtils::inRole('admin')) {?>
            //jakiś HTML ...
        <?php }?>
    </div>
    </br>

<?php
}
}
/* {/block "content"} */
}
