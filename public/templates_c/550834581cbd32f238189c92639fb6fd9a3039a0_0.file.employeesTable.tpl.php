<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-08 03:42:45
  from 'C:\xampp\htdocs\medicus\app\views\common_elements\tables\employeesTable.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60458f257494f4_72245469',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '550834581cbd32f238189c92639fb6fd9a3039a0' => 
    array (
      0 => 'C:\\xampp\\htdocs\\medicus\\app\\views\\common_elements\\tables\\employeesTable.tpl',
      1 => 1615170974,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common_elements/navigation/employeeModuleNav.tpl' => 1,
  ),
),false)) {
function content_60458f257494f4_72245469 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_189534441060458f25738bb6_93603725', "content");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "common.tpl");
}
/* {block "content"} */
class Block_189534441060458f25738bb6_93603725 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_189534441060458f25738bb6_93603725',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

<?php $_smarty_tpl->_subTemplateRender("file:common_elements/navigation/employeeModuleNav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <div id="featured">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Lista pracowników</h4>
            </div>

            <div class="panel-body">
                <table class="table table-hover" align="center">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Pesel</th>
                        <th>Imię</th>
                        <th>Drugie imię</th>
                        <th>Nazwisko</th>
                        <th>Stanowisko</th>
                        <th>Numer telefonu</th>
                        <th>Adres email</th>
                        <th>Akcja</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['employee']->value, 'emp');
$_smarty_tpl->tpl_vars['emp']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['emp']->value) {
$_smarty_tpl->tpl_vars['emp']->do_else = false;
?>
                        <tr>
                            <td><?php echo $_smarty_tpl->tpl_vars['emp']->value["id"];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['emp']->value["pesel"];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['emp']->value["name"];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['emp']->value["second_name"] ? $_smarty_tpl->tpl_vars['emp']->value["second_name"] : "---";?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['emp']->value["surname"];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['emp']->value["profession"] ? $_smarty_tpl->tpl_vars['emp']->value["profession"] : "---";?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['emp']->value["phone"];?>
</td>
                            <td><?php echo $_smarty_tpl->tpl_vars['emp']->value["email"];?>
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
editEmployee/<?php echo $_smarty_tpl->tpl_vars['emp']->value['id'];?>
';" >Edytuj</a></li>
                                        <li><a class="glyphicon glyphicon-trash" aria-hidden="true" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
employeeDelete/<?php echo $_smarty_tpl->tpl_vars['emp']->value['id'];?>
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
generateEmployeeRegisterForm';">Dodaj pracownika</button>
            </div>
        </div>

    </div>
<?php
}
}
/* {/block "content"} */
}
