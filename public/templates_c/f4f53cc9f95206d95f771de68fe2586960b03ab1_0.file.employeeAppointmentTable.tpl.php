<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-14 02:28:04
  from 'C:\xampp\htdocs\medicus\app\views\common_elements\tables\employeeAppointmentTable.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_604d66a4af1864_64673035',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f4f53cc9f95206d95f771de68fe2586960b03ab1' => 
    array (
      0 => 'C:\\xampp\\htdocs\\medicus\\app\\views\\common_elements\\tables\\employeeAppointmentTable.tpl',
      1 => 1615685283,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common_elements/navigation/employeeModuleNav.tpl' => 1,
  ),
),false)) {
function content_604d66a4af1864_64673035 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2128774965604d66a4ae4b37_62366456', "content");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "common.tpl");
}
/* {block "content"} */
class Block_2128774965604d66a4ae4b37_62366456 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_2128774965604d66a4ae4b37_62366456',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php $_smarty_tpl->_subTemplateRender("file:common_elements/navigation/employeeModuleNav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <div id="featured">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Lista wizyt</h4>
            </div>

            <div class="panel-body">
                <table class="table table-hover" align="center">
                    <thead>
                    <tr>
                        <th>Pesel pacjenta</th>
                        <th>Data wizyty</th>
                        <th>Godzina wizyty</th>
                        <th>Cel</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['employeeAppointments']->value, 'eapt');
$_smarty_tpl->tpl_vars['eapt']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['eapt']->value) {
$_smarty_tpl->tpl_vars['eapt']->do_else = false;
?>
                        <tr>
                            <td><?php echo $_smarty_tpl->tpl_vars['eapt']->value["pesel_patient"];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['eapt']->value["date"];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['eapt']->value["time"];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['eapt']->value["purpose"];?>
</td>
                        </tr>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </table>
            </div>
        </div>
    </div>
<?php
}
}
/* {/block "content"} */
}
