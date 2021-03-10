<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-08 03:42:44
  from 'C:\xampp\htdocs\medicus\app\views\common_elements\messages\messages.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60458f248e3a73_58521375',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1fdc7bd9ecd5bcc212ba6fa48a73213b69d3fac1' => 
    array (
      0 => 'C:\\xampp\\htdocs\\medicus\\app\\views\\common_elements\\messages\\messages.tpl',
      1 => 1615170974,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60458f248e3a73_58521375 (Smarty_Internal_Template $_smarty_tpl) {
if (!$_smarty_tpl->tpl_vars['msgs']->value->isEmpty()) {?>
    <ul class="list-group alert-danger">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['msgs']->value->getMessages(), 'msg');
$_smarty_tpl->tpl_vars['msg']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['msg']->value) {
$_smarty_tpl->tpl_vars['msg']->do_else = false;
?>
            <li class="list-group-item"><?php echo $_smarty_tpl->tpl_vars['msg']->value->text;?>
</li>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </ul>
<?php }?>
</div>
<?php }
}
