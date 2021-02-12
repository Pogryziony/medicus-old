<?php
/* Smarty version 3.1.34-dev-7, created on 2021-02-07 12:44:15
  from 'C:\xampp\htdocs\medicus\app\views\common_elements\loginNav.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_601fd28f770b67_14811805',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a3dbef3705fa41f684b926859d1fb556e9ec234c' => 
    array (
      0 => 'C:\\xampp\\htdocs\\medicus\\app\\views\\common_elements\\loginNav.tpl',
      1 => 1612645677,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_601fd28f770b67_14811805 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="nav-wrapper">
    <!-- Nav -->
    <nav id="nav">
        <ul>
            <li><a href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
">Homepage</a></li>
            <li class="active"><a href="left-sidebar.html">Logowanie pacjenta</a></li>
            <li><a href="right-sidebar.html">Logowanie lekarza</a></li>
        </ul>
    </nav>
</div>
<?php }
}
