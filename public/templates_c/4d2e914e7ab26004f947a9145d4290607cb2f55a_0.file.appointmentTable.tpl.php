<?php
/* Smarty version 3.1.34-dev-7, created on 2021-07-01 14:39:52
  from 'C:\xampp\htdocs\medicus\app\views\common_elements\tables\appointmentTable.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60ddb798f34dd0_16116641',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4d2e914e7ab26004f947a9145d4290607cb2f55a' => 
    array (
      0 => 'C:\\xampp\\htdocs\\medicus\\app\\views\\common_elements\\tables\\appointmentTable.tpl',
      1 => 1625143149,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common_elements/navigation/employeeModuleNav.tpl' => 1,
  ),
),false)) {
function content_60ddb798f34dd0_16116641 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_192816522160ddb798f209e0_47741644', "content");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "common.tpl");
}
/* {block "table"} */
class Block_136949769260ddb798f239b4_14201291 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

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
                                        <li><a class="glyphicon glyphicon-trash" aria-hidden="true" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
deleteAppointment/<?php echo $_smarty_tpl->tpl_vars['apt']->value['id'];?>
';">Usuń</a></li>
                                    </ul>
                                </div>
                            </td>

                        </tr>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <?php
}
}
/* {/block "table"} */
/* {block "content"} */
class Block_192816522160ddb798f209e0_47741644 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_192816522160ddb798f209e0_47741644',
  ),
  'table' => 
  array (
    0 => 'Block_136949769260ddb798f239b4_14201291',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php $_smarty_tpl->_subTemplateRender("file:common_elements/navigation/employeeModuleNav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

    <div id="featured">

        <nav class="menu">
            <ul>
                <li>
                    <span class="filter opener">Filtrowanie</span>
                    <ul class="row">
                        <input class="col-2 inline" type="text" name="place" id="place" placeholder="Data wizyty">
                        <input class="col-2 inline" type="text" name="hours" id="hours" placeholder="Godzina wizyty">

                        <button class="button" id="appointment_search_button">Filtruj</button>
                    </ul>
                </li>
        </nav>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Lista wizyt</h4>
            </div>

            <div id="appointment_table" class="panel-body">
                <table class="table table-hover" align="center">
                    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_136949769260ddb798f239b4_14201291', "table", $this->tplIndex);
?>

                </table>
            </div>

            <div class="panel-footer">
                <button type="button" class="button btn-lg" onclick="location.href='<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_root;?>
generateAddAppointmentForm';">Dodaj wizytę</button>
                <span class="col-2">Wyników na stronie:</span>
                <select id='size_select' class="col-1">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                </select>
                <ul id="pagination_buttons" class="pagination col-4 align-right">
                    <li>
                        <button id="prev_btn" class="button disabled">Prev</button>
                    </li>
                    <?php
$_smarty_tpl->tpl_vars['start'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['start']->step = 1;$_smarty_tpl->tpl_vars['start']->total = (int) ceil(($_smarty_tpl->tpl_vars['start']->step > 0 ? $_smarty_tpl->tpl_vars['pages_count']->value+1 - (1) : 1-($_smarty_tpl->tpl_vars['pages_count']->value)+1)/abs($_smarty_tpl->tpl_vars['start']->step));
if ($_smarty_tpl->tpl_vars['start']->total > 0) {
for ($_smarty_tpl->tpl_vars['start']->value = 1, $_smarty_tpl->tpl_vars['start']->iteration = 1;$_smarty_tpl->tpl_vars['start']->iteration <= $_smarty_tpl->tpl_vars['start']->total;$_smarty_tpl->tpl_vars['start']->value += $_smarty_tpl->tpl_vars['start']->step, $_smarty_tpl->tpl_vars['start']->iteration++) {
$_smarty_tpl->tpl_vars['start']->first = $_smarty_tpl->tpl_vars['start']->iteration === 1;$_smarty_tpl->tpl_vars['start']->last = $_smarty_tpl->tpl_vars['start']->iteration === $_smarty_tpl->tpl_vars['start']->total;?>
                        <li>
                            <button class="page <?php if ($_smarty_tpl->tpl_vars['start']->value == 1) {?>active<?php }?>"><?php echo $_smarty_tpl->tpl_vars['start']->value;?>
</button>
                        </li>
                    <?php }
}
?>
                    <li>
                        <button id="next_btn" class="button">Next</button>
                    </li>
                </ul>
                <?php if ($_smarty_tpl->tpl_vars['action']->value == "displayAllAppointments") {?>
                    <div class="col-2 col-12-medium margin-top-1">
                        <a class="button fit" href="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;
echo $_smarty_tpl->tpl_vars['action']->value;?>
">Powrót</a>
                    </div>
                    <div class="col-10 col-0-medium"></div>
                <?php }?>
            </div>
            <span id="pages_count"></span>
            <span id="page_num"><?php echo $_smarty_tpl->tpl_vars['page']->value;?>
</span>
        </div>

    </div>
<?php
}
}
/* {/block "content"} */
}
