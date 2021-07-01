<?php
/* Smarty version 3.1.34-dev-7, created on 2021-07-01 12:44:11
  from 'C:\xampp\htdocs\medicus\app\views\admin\edit\editAppointmentForm.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60dd9c7bb6abc1_24000334',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'ed3ee46558ddb11c366406828ce19efd9172fd57' => 
    array (
      0 => 'C:\\xampp\\htdocs\\medicus\\app\\views\\admin\\edit\\editAppointmentForm.tpl',
      1 => 1625136242,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common_elements/navigation/employeeModuleNav.tpl' => 1,
  ),
),false)) {
function content_60dd9c7bb6abc1_24000334 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_6408693960dd9c7bb5ca53_44255006', "content");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "common.tpl");
}
/* {block "content"} */
class Block_6408693960dd9c7bb5ca53_44255006 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_6408693960dd9c7bb5ca53_44255006',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php $_smarty_tpl->_subTemplateRender("file:common_elements/navigation/employeeModuleNav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <div id="featured">
        <div class="container" xmlns="http://www.w3.org/1999/html">
            <h2>Formularz rejestracji wizyty</h2>
            <form method="POST" action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
editAppointment">
                <div class="row-cols-xl-auto " align="center">
                    <input type="id" class="form-control visually-hidden" name="id" placeholder="id" value="<?php if ($_smarty_tpl->tpl_vars['action']->value === "editAppointment") {
echo $_smarty_tpl->tpl_vars['form']->value->id;
}?>" required>
                    <div class="col-xl-3 ">
                        <label for="pesel">Pesel pacjenta</label>
                        <input type="text" class="form-control" name="pesel" placeholder="Pesel" value="<?php if ($_smarty_tpl->tpl_vars['action']->value === "editAppointment") {
echo $_smarty_tpl->tpl_vars['form']->value->patientPesel;
}?>" required>
                        <br/>
                    </div>
                    <div class="col-xl-3 ">
                        <label for="pesel">Pesel pracownika</label>
                        <input type="text" class="form-control" name="pesel" placeholder="Pesel" value="<?php if ($_smarty_tpl->tpl_vars['action']->value === "editAppointment") {
echo $_smarty_tpl->tpl_vars['form']->value->employeePesel;
}?>" required>
                        <br/>
                    </div>
                    <div class="col-xl-3">
                        <label for="date">Data</label>
                        <input class="datepicker active" type="text" name="date" id="date" placeholder="Data" value="<?php if ($_smarty_tpl->tpl_vars['action']->value === "editAppointment") {
echo $_smarty_tpl->tpl_vars['form']->value->date;
}?>" required>
                    </div>
                    <div class="col-xl-3">
                        <label for="time">Godzina</label>
                        <input class="hour_picker" type="text" name="time" id="time" placeholder="Godzina" value="<?php if ($_smarty_tpl->tpl_vars['action']->value === "editAppointment") {
echo $_smarty_tpl->tpl_vars['form']->value->time;
}?>" required>
                    </div>
                    <div class="col-xl-3">
                        <label for="purpose">Cel wizyty</label>
                        <input type="purpose" class="form-control" name="purpose"  value="<?php if ($_smarty_tpl->tpl_vars['action']->value === "editAppointment") {
echo $_smarty_tpl->tpl_vars['form']->value->purpose;
}?>" placeholder="Cel wizyty" required>
                        <br/>
                    </div>

                    <button type="submit" class="button btn-lg">Dodaj wizytę</button>
                </div>
            </form>
        </div>
    </div>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['conf']->value->assets_url;?>
js/datepicker/picker.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['conf']->value->assets_url;?>
js/datepicker/datepicker.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['conf']->value->assets_url;?>
js/datepicker/addAppointmentForm.js"><?php echo '</script'; ?>
>
<?php
}
}
/* {/block "content"} */
}
