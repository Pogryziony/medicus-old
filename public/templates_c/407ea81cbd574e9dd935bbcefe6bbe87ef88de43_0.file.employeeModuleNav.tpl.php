<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-13 01:32:52
  from 'C:\xampp\htdocs\medicus\app\views\common_elements\navigation\employeeModuleNav.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_604c083444ff17_26566886',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '407ea81cbd574e9dd935bbcefe6bbe87ef88de43' => 
    array (
      0 => 'C:\\xampp\\htdocs\\medicus\\app\\views\\common_elements\\navigation\\employeeModuleNav.tpl',
      1 => 1615595561,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_604c083444ff17_26566886 (Smarty_Internal_Template $_smarty_tpl) {
?><header id="header">
    <div id="nav-wrapper">
        <!-- Nav -->
        <nav id="nav">
        <ul>
            <li class="active"><a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
displayPatientsTable">Lista pacjentów</a></li>
            <li class="active"><a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
displayEmployeeTable">Lista pracowników</a></li>
            <li class="active"><a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
displayEmployeeAppointments">Moje wizyty</a></li>
            <li class="active"><a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
displayAllAppointments">Wszystkie wizyty</a></li>
            <li><a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
employeeLogout">Wyloguj</a></li>
        </ul>
    </nav>
</div>

<?php }
}
