<?php
/* Smarty version 3.1.34-dev-7, created on 2021-04-22 18:00:14
  from 'C:\xampp\htdocs\medicus\app\views\patientHomepage.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60819d8e5e55f1_78944271',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a4d916d1d682d4c006611ce839229bf0583f887f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\medicus\\app\\views\\patientHomepage.tpl',
      1 => 1615670224,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common_elements/navigation/patientModuleNav.tpl' => 1,
  ),
),false)) {
function content_60819d8e5e55f1_78944271 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_144729454760819d8e5dd200_99371145', "content");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "common.tpl");
}
/* {block "content"} */
class Block_144729454760819d8e5dd200_99371145 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_144729454760819d8e5dd200_99371145',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php $_smarty_tpl->_subTemplateRender("file:common_elements/navigation/patientModuleNav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
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

    </div>
    </br>

<?php
}
}
/* {/block "content"} */
}
