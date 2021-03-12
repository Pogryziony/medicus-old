<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-12 12:53:18
  from 'C:\xampp\htdocs\medicus\app\views\common_elements\tables\appointmentTable.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_604b562e865900_34478105',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4d2e914e7ab26004f947a9145d4290607cb2f55a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\medicus\\app\\views\\common_elements\\tables\\appointmentTable.tpl',
      1 => 1615549883,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common_elements/navigation/employeeModuleNav.tpl' => 1,
  ),
),false)) {
function content_604b562e865900_34478105 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_880852573604b562e855cd1_89147063', "content");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "common.tpl");
}
/* {block "content"} */
class Block_880852573604b562e855cd1_89147063 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_880852573604b562e855cd1_89147063',
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
                        <th>Pesel lekarza</th>
                        <th>Data wizyty</th>
                        <th>Godzina wizyty</th>
                        <th>Cel</th>
                        <th>Akcja</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['appointments']->value, 'apt');
$_smarty_tpl->tpl_vars['apt']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['apt']->value) {
$_smarty_tpl->tpl_vars['apt']->do_else = false;
?>
                        <tr>
                            <td><?php echo $_smarty_tpl->tpl_vars['apt']->value["pesel_employee"];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['apt']->value["pesel_patient"];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['apt']->value["date"];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['apt']->value["time"];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['apt']->value["purpose"];?>
</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle"
                                            type="button" id="actionDrop"
                                            data-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="true">
                                        Rozwiń
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="actionDrop">
                                        <li><a class="glyphicon glyphicon-pencil" aria-hidden="true" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
editAppointment/<?php echo $_smarty_tpl->tpl_vars['apt']->value['id'];?>
';" >Edytuj</a></li>
                                        <li><a class="glyphicon glyphicon-trash" aria-hidden="true"onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
deleteAppointment/<?php echo $_smarty_tpl->tpl_vars['apt']->value['id'];?>
';">Usuń</a></li>
                                    </ul>
                                </div>
                            </td>

                        </tr>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </table>
            </div>

            <div class="panel-footer">
                <button type="button" class="button btn-lg" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
generateAddAppointmentForm';">Dodaj wizytę</button>
            </div>
        </div>

    </div>
<?php
}
}
/* {/block "content"} */
}
