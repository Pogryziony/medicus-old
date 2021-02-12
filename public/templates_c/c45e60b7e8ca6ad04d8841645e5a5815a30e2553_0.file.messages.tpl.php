<?php
/* Smarty version 3.1.34-dev-7, created on 2021-02-07 12:44:15
  from 'C:\xampp\htdocs\medicus\app\views\messages\messages.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_601fd28f782691_58478116',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c45e60b7e8ca6ad04d8841645e5a5815a30e2553' => 
    array (
      0 => 'C:\\xampp\\htdocs\\medicus\\app\\views\\messages\\messages.tpl',
      1 => 1611608203,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_601fd28f782691_58478116 (Smarty_Internal_Template $_smarty_tpl) {
if (!$_smarty_tpl->tpl_vars['msgs']->value->isEmpty()) {?>
    <ul>
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['msgs']->value->getMessages(), 'msg');
$_smarty_tpl->tpl_vars['msg']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['msg']->value) {
$_smarty_tpl->tpl_vars['msg']->do_else = false;
?>
            <li><?php echo $_smarty_tpl->tpl_vars['msg']->value->text;?>
</li>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </ul>
<?php }
}
}
