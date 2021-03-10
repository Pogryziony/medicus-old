<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-08 03:42:48
  from 'C:\xampp\htdocs\medicus\app\views\admin\edit\editEmployeeForm.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_60458f28c17f16_63040225',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '6aa8b0bf2623d8ded69b0381652e9accc844f886' => 
    array (
      0 => 'C:\\xampp\\htdocs\\medicus\\app\\views\\admin\\edit\\editEmployeeForm.tpl',
      1 => 1615170974,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common_elements/navigation/employeeModuleNav.tpl' => 1,
  ),
),false)) {
function content_60458f28c17f16_63040225 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_60747189560458f28c06388_36954081', "content");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "common.tpl");
}
/* {block "content"} */
class Block_60747189560458f28c06388_36954081 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_60747189560458f28c06388_36954081',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php $_smarty_tpl->_subTemplateRender("file:common_elements/navigation/employeeModuleNav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <div id="featured">
        <div class="container" xmlns="http://www.w3.org/1999/html">
            <h2>Formularz edycji pracownika</h2>
            <form method="post" action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
employeeSave">
                <div class="row-cols-xl-auto" align="center">
                    <div class="col-xl-3 ">
                        <label for="pesel">Pesel</label>
                        <input type="pesel" class="form-control" name="pesel" placeholder="Pesel" value="<?php if ($_smarty_tpl->tpl_vars['action']->value === "editEmployee") {
echo $_smarty_tpl->tpl_vars['form']->value->pesel;
}?>" required>
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="name">Imie</label>
                        <input type="name" class="form-control" name="name" placeholder="Imie" value="<?php if ($_smarty_tpl->tpl_vars['action']->value === "editEmployee") {
echo $_smarty_tpl->tpl_vars['form']->value->name;
}?>" required>
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="second_name">Drugie imie</label>
                        <input type="second_name" class="form-control" name="second_name" value="<?php if ($_smarty_tpl->tpl_vars['action']->value === "editEmployee") {
echo $_smarty_tpl->tpl_vars['form']->value->secondName;
}?>" placeholder="Drugie imie">
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="surname">Nazwisko</label>
                        <input type="surname" class="form-control" name="surname" placeholder="Nazwisko" value="<?php if ($_smarty_tpl->tpl_vars['action']->value === "editEmployee") {
echo $_smarty_tpl->tpl_vars['form']->value->surname;
}?>" required>
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="profession">Zawód</label>
                        <input type="profession" class="form-control" name="profession" placeholder="Zawód" value="<?php if ($_smarty_tpl->tpl_vars['action']->value === "editEmployee") {
echo $_smarty_tpl->tpl_vars['form']->value->profession;
}?>">
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="phone">Numer telefonu</label>
                        <input type="phone" class="form-control" name="phone" placeholder="Numer telefonu" value="<?php if ($_smarty_tpl->tpl_vars['action']->value === "editEmployee") {
echo $_smarty_tpl->tpl_vars['form']->value->phone;
}?>">
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="email">Adres e-mail</label>
                        <input type="email" class="form-control" name="email" placeholder="Adres e-mail" value="<?php if ($_smarty_tpl->tpl_vars['action']->value === "editEmployee") {
echo $_smarty_tpl->tpl_vars['form']->value->email;
}?>">
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="password">Hasło</label>
                        <input type="password" class="form-control" name="password" placeholder="Hasło" value="<?php if ($_smarty_tpl->tpl_vars['action']->value === "editEmployee") {
echo $_smarty_tpl->tpl_vars['form']->value->password;
}?>">
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <div class="panel panel-info" width="50%">
                            <div class="panel-heading">
                                <label for="flexRadioDefault">Wybierz rolę:</label>
                            </div>
                            <div class="panel-body">
                                <select name="role">
                                    <option value="user" <?php ob_start();
echo $_smarty_tpl->tpl_vars['form']->value->role === "user";
$_prefixVariable1 = ob_get_clean();
if ($_smarty_tpl->tpl_vars['action']->value === "editEmployee" && $_prefixVariable1) {?>selected<?php }?>>Użytkownik</option>
                                    <option value="admin" <?php ob_start();
echo $_smarty_tpl->tpl_vars['form']->value->role === "admin";
$_prefixVariable2 = ob_get_clean();
if ($_smarty_tpl->tpl_vars['action']->value === "editEmployee" && $_prefixVariable2) {?>selected<?php }?>>Administrator</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3">
                        <div class="panel panel-info" width="50%">
                            <div class="panel-heading">
                                <label for="flexRadioDefault">Czy użytkownik jest aktywny:</label>
                            </div>
                            <div class="panel-body">
                                <div class="form-check">
                                    <input type="checkbox" id="active" name="active" value="true" <?php ob_start();
echo $_smarty_tpl->tpl_vars['form']->value->active === true;
$_prefixVariable3 = ob_get_clean();
if ($_smarty_tpl->tpl_vars['action']->value === "editEmployee" && $_prefixVariable3) {?>checked<?php }?>>
                                    <label for="active">Aktywny</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <button type="submit" class="btn btn-default btn-lg">Edytuj</button>
        </form>
    </div>

<?php
}
}
/* {/block "content"} */
}
