<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-08 23:19:33
  from 'C:\xampp\htdocs\medicus\app\views\common_elements\navigation\patientModuleNav.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6046a2f5867285_00178668',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e7ae4f19eaff9dc55dd30faf54d9d0234a999c64' => 
    array (
      0 => 'C:\\xampp\\htdocs\\medicus\\app\\views\\common_elements\\navigation\\patientModuleNav.tpl',
      1 => 1615170974,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6046a2f5867285_00178668 (Smarty_Internal_Template $_smarty_tpl) {
?><header id="header">
    <div id="nav-wrapper">
        <!-- Nav -->
        <nav id="nav">
            <ul>
                <li class="active"><a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
patientDashboard">Strona główna</a></li>
                <li class="active"><a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
displayAppointmentTable">Moje wizyty</a></li>
                <li class="active"><a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
patientDashboard">Historia wizyt</a></li>

                <li><a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
patientLogout">Wyloguj</a></li>
            </ul>
        </nav>
    </div>
</header>
<?php }
}
