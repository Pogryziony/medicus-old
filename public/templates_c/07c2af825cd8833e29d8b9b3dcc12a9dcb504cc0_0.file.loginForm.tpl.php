<?php
/* Smarty version 3.1.34-dev-7, created on 2021-02-07 12:44:15
  from 'C:\xampp\htdocs\medicus\app\views\templates\loginForm.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_601fd28f74b353_51683320',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '07c2af825cd8833e29d8b9b3dcc12a9dcb504cc0' => 
    array (
      0 => 'C:\\xampp\\htdocs\\medicus\\app\\views\\templates\\loginForm.tpl',
      1 => 1612692276,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_601fd28f74b353_51683320 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1741337195601fd28f7474c9_99185725', "content");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "login.tpl");
}
/* {block "content"} */
class Block_1741337195601fd28f7474c9_99185725 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_1741337195601fd28f7474c9_99185725',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


<div class="container">
    <div id="logo">
        <section id="banner">
            <div class="content">
                <header>
                    <div class="align-center">
                    <h2 align="center">Zaloguj się</h2>
                     </div>
                </header>
        <form method="POST" action="<?php echo $_smarty_tpl->tpl_vars['conf']->value->action_url;?>
login">
            <div class="row gtr-uniform">
                <div class="col-4 col-2-large"></div>
                <div class="col-4 col-12-small col-8-large">
                    <input type="text" name="email" id="email" placeholder="Email">
                </div>
                <div class="col-4 col-2-large"></div>
                <div class="col-4 col-2-large"></div>
                <div class="col-4 col-12-small col-8-large">
                    <input type="password" name="password" id="password" placeholder="Hasło">
                </div>
                <div class="col-4 col-2-large"></div>

                <div class="col-4 col-2-large"></div>
                <div class="col-4 col-12-small col-8-large">
                    <input type="checkbox" id="remember-me" name="remember-me">
                    <label for="demo-copy">Zapamiętaj mnie</label>
                </div>
                <div class="col-4 col-2-large"></div>
                <div class="col-4 col-2-large"></div>
                <div class="col-4 col-12-small col-8-large">
                    <input type="submit" value="Zaloguj" class="primary fit">
                    <input type="button" value="Zarejestruj się" class="primary fit">
                </div>
                <div class="col-12">

                </div>
            </div>
<?php
}
}
/* {/block "content"} */
}
