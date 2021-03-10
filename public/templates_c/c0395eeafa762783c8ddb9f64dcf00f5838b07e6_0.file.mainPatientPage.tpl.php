<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-08 23:19:33
  from 'C:\xampp\htdocs\medicus\app\views\mainPatientPage.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6046a2f5852393_72824615',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c0395eeafa762783c8ddb9f64dcf00f5838b07e6' => 
    array (
      0 => 'C:\\xampp\\htdocs\\medicus\\app\\views\\mainPatientPage.tpl',
      1 => 1615170974,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common_elements/navigation/patientModuleNav.tpl' => 1,
  ),
),false)) {
function content_6046a2f5852393_72824615 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_13916322706046a2f584ef09_34085644', "content");
$_smarty_tpl->inheritance->endChild($_smarty_tpl, "common.tpl");
}
/* {block "content"} */
class Block_13916322706046a2f584ef09_34085644 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_13916322706046a2f584ef09_34085644',
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
