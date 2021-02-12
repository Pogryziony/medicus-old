<?php
/* Smarty version 3.1.34-dev-7, created on 2021-02-07 19:46:00
  from 'C:\xampp\htdocs\medicus\app\views\common_elements\pageHeader.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_602035683d98f1_49462143',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5d127b7c51eb801343b95a89bc66abb2b5e51663' => 
    array (
      0 => 'C:\\xampp\\htdocs\\medicus\\app\\views\\common_elements\\pageHeader.tpl',
      1 => 1612723560,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:navigation/patientLoginNav.tpl' => 1,
  ),
),false)) {
function content_602035683d98f1_49462143 (Smarty_Internal_Template $_smarty_tpl) {
?><header id="header">
    <?php $_smarty_tpl->_subTemplateRender("file:navigation/patientLoginNav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

</header>

<?php }
}
