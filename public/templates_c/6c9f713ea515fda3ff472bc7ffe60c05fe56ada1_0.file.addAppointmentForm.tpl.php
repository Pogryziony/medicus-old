<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-14 01:53:21
  from 'C:\xampp\htdocs\medicus\app\views\admin\registration\addAppointmentForm.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_604d5e818af1b7_43666330',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6c9f713ea515fda3ff472bc7ffe60c05fe56ada1' => 
    array (
      0 => 'C:\\xampp\\htdocs\\medicus\\app\\views\\admin\\registration\\addAppointmentForm.tpl',
      1 => 1615683200,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common_elements/navigation/employeeModuleNav.tpl' => 1,
  ),
),false)) {
function content_604d5e818af1b7_43666330 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1533912568604d5e818a1be3_96866498', "content");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "common.tpl");
}
/* {block "content"} */
class Block_1533912568604d5e818a1be3_96866498 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_1533912568604d5e818a1be3_96866498',
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
registerAppointment">
                <div class="row-cols-xl-auto " align="center">
                    <div class="col-xl-3 ">
                        <label for="pesel">Pesel pacjenta</label>
                        <input type="text" class="form-control" name="pesel" placeholder="Pesel" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->patientPesel;?>
" required>
                        <br/>
                    </div>
                    <div class="col-xl-3 ">
                        <label for="pesel">Pesel pracownika</label>
                        <input type="text" class="form-control" name="pesel" placeholder="Pesel" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->employeePesel;?>
" required>
                        <br/>
                    </div>
                    <div class="col-xl-3">
                        <div class="panel panel-default" width="50%">
                            <div class="panel-heading">
                                <label for="flexRadioDefault">Data</label>
                            </div>
                            <div class="panel-body">
                                <input class="datepicker active" type="text" name="date" id="date" placeholder="Dzień" value="<?php echo substr($_smarty_tpl->tpl_vars['form']->value->date,0,10);?>
" required>
                                <input class="hour_picker" type="text" name="time" id="time" placeholder="Godzina" value="<?php echo substr($_smarty_tpl->tpl_vars['form']->value->time,11,5);?>
" required>


                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <label for="purpose">Cel wizyty</label>
                        <input type="purpose" class="form-control" name="purpose"  value="<?php echo $_smarty_tpl->tpl_vars['form']->value->purpose;?>
" placeholder="Cel wizyty" required>
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
