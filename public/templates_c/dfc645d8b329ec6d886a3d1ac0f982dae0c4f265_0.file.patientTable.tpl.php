<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-12 23:40:03
  from 'C:\xampp\htdocs\medicus\app\views\common_elements\tables\patientTable.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_604bedc3ba09e5_06115098',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'dfc645d8b329ec6d886a3d1ac0f982dae0c4f265' => 
    array (
      0 => 'C:\\xampp\\htdocs\\medicus\\app\\views\\common_elements\\tables\\patientTable.tpl',
      1 => 1615584649,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common_elements/navigation/employeeModuleNav.tpl' => 1,
  ),
),false)) {
function content_604bedc3ba09e5_06115098 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_31785004604bedc3b8df47_79933337', "content");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "common.tpl");
}
/* {block "content"} */
class Block_31785004604bedc3b8df47_79933337 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_31785004604bedc3b8df47_79933337',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php $_smarty_tpl->_subTemplateRender("file:common_elements/navigation/employeeModuleNav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <div id="featured">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Lista pacjentów</h4>
            </div>

            <div class="panel-body">
                <table class="table table-hover" align="center">
                    <thead>
                    <tr>
                        <th>Pesel</th>
                        <th>Imię</th>
                        <th>Drugie imię</th>
                        <th>Nazwisko</th>
                        <th>Województwo</th>
                        <th>Miasto</th>
                        <th>Ulica</th>
                        <th>Numer domu</th>
                        <th>Numer mieszkania</th>
                        <th>Numer telefonu</th>
                        <th>Adres email</th>
                        <th>Akcja</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['patient']->value, 'pat');
$_smarty_tpl->tpl_vars['pat']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['pat']->value) {
$_smarty_tpl->tpl_vars['pat']->do_else = false;
?>
                        <tr>
                            <td><?php echo $_smarty_tpl->tpl_vars['pat']->value["pesel"];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['pat']->value["name"];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['pat']->value["second_name"] ? $_smarty_tpl->tpl_vars['pat']->value["second_name"] : "---";?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['pat']->value["surname"];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['pat']->value["voivodeship"];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['pat']->value["city"];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['pat']->value["street"];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['pat']->value["house_number"];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['pat']->value["flat_number"] ? $_smarty_tpl->tpl_vars['pat']->value["flat_number"] : "---";?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['pat']->value["phone"];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['pat']->value["email"];?>
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
editPatient/<?php echo $_smarty_tpl->tpl_vars['pat']->value['id'];?>
';" >Edytuj</a></li>
                                        <li><a class="glyphicon glyphicon-trash" aria-hidden="true" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
deletePatient/<?php echo $_smarty_tpl->tpl_vars['pat']->value['id'];?>
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
generateAdminPatientRegistrationView';">Dodaj pacjenta</button>
            </div>
        </div>

    </div>
<?php
}
}
/* {/block "content"} */
}
