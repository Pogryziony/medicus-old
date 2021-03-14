<?php
/* Smarty version 3.1.34-dev-7, created on 2021-03-13 22:26:09
  from 'C:\xampp\htdocs\medicus\app\views\admin\registration\patientAdminRegistrationForm.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_604d2df10c8525_52993356',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5c1d31fe63c38805ebfc27fde7be15a9bcfeb878' => 
    array (
      0 => 'C:\\xampp\\htdocs\\medicus\\app\\views\\admin\\registration\\patientAdminRegistrationForm.tpl',
      1 => 1615670224,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common_elements/navigation/employeeModuleNav.tpl' => 1,
  ),
),false)) {
function content_604d2df10c8525_52993356 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_908883532604d2df10bbb67_54949581', "content");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "common.tpl");
}
/* {block "content"} */
class Block_908883532604d2df10bbb67_54949581 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_908883532604d2df10bbb67_54949581',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <?php $_smarty_tpl->_subTemplateRender("file:common_elements/navigation/employeeModuleNav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    <div id="featured">
        <div class="container" xmlns="http://www.w3.org/1999/html">
            <h2>Formularz rejestracji pacjenta</h2>
            <form method="POST" action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
registerPatient">
                <div class="row-cols-xl-auto " align="center">
                    <div class="col-xl-3 ">
                        <label for="pesel">Pesel</label>
                        <input type="text" class="form-control" name="pesel" placeholder="Pesel" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->pesel;?>
" required>
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="name">Imie</label>
                        <input type="name" class="form-control" name="name" placeholder="Imie" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->name;?>
" required>
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="second_name">Drugie imie</label>
                        <input type="second_name" class="form-control" name="second_name" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->secondName;?>
" placeholder="Drugie imie">
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="surname">Nazwisko</label>
                        <input type="surname" class="form-control" name="surname" placeholder="Nazwisko" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->surname;?>
" required>
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="voivodeship">Województwo</label>
                        <input type="voivodeship" class="form-control" name="voivodeship" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->voivodeship;?>
" placeholder="Województwo">
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="city">Miasto</label>
                        <input type="city" class="form-control" name="city"  value="<?php echo $_smarty_tpl->tpl_vars['form']->value->city;?>
" placeholder="Miasto" required>
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="street">Ulica</label>
                        <input type="street" class="form-control" name="street" placeholder="Ulica" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->street;?>
">
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="house_number">Numer domu lub bloku</label>
                        <input type="house_number" class="form-control" name="house_number" placeholder="Numer domu lub bloku" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->houseNumber;?>
">
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="flat_number">Numer mieszkania</label>
                        <input type="flat_number" class="form-control" name="flat_number" placeholder="Numer mieszkania" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->flatNumber;?>
">
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="phone">Numer telefonu</label>
                        <input type="phone" class="form-control" name="phone" placeholder="Numer telefonu" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->phone;?>
">
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="email">Adres e-mail</label>
                        <input type="email" class="form-control" name="email" placeholder="Adres e-mail" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->email;?>
">
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="password">Hasło</label>
                        <input type="password" class="form-control" name="password" placeholder="Hasło" value="<?php echo $_smarty_tpl->tpl_vars['form']->value->password;?>
">
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <div class="panel panel-info" width="50%">
                            <div class="panel-heading">
                                <label for="flexRadioDefault">Czy użytkownik jest aktywny:</label>
                            </div>
                            <div class="panel-body">
                                <div class="form-check">
                                    <input type="checkbox" id="active" name="active" value="true" <?php if ($_smarty_tpl->tpl_vars['form']->value->isActive === "true") {?> checked<?php }?>>
                                    <label for="active">Aktywny</label>
                                </div>

                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-default btn-lg">Zarejestruj</button>
                </div>
            </form>
        </div>
    </div>
<?php
}
}
/* {/block "content"} */
}
