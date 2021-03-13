<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-13 18:24:55
  from 'C:\xampp\htdocs\medicus\app\views\common_elements\navigation\loginNav.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_604cf5674375c4_01893595',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '00b3238cff6606b6b9ea72ec3f2d27ac2d17586a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\medicus\\app\\views\\common_elements\\navigation\\loginNav.tpl',
      1 => 1615656292,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_604cf5674375c4_01893595 (Smarty_Internal_Template $_smarty_tpl) {
?><header id="header">
    <div id="nav-wrapper">
        <!-- Nav -->
        <nav id="nav">
        <ul>
            <li class="active"><a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
dashboard">Strona główna</a></li>
            <li><a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
employeeLogin">Lekarz</a></li>
            <li><a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
patientLogin">Pacjent</a></li>
        </ul>
    </nav>
</div>

<?php }
}
