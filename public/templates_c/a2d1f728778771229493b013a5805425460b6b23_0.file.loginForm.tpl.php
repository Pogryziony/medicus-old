<?php
/* Smarty version 3.1.34-dev-7, created on 2021-02-07 17:45:05
  from 'C:\xampp\htdocs\medicus\app\views\login\loginForm.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6020191125d192_46690393',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'a2d1f728778771229493b013a5805425460b6b23' => 
    array (
      0 => 'C:\\xampp\\htdocs\\medicus\\app\\views\\login\\loginForm.tpl',
      1 => 1612716304,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6020191125d192_46690393 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>

<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_1837837324602019112593b8_98764898', "content");
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, "login/login.tpl");
}
/* {block "content"} */
class Block_1837837324602019112593b8_98764898 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_1837837324602019112593b8_98764898',
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
