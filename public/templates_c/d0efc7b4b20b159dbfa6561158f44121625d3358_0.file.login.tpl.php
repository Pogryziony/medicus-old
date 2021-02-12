<?php
/* Smarty version 3.1.34-dev-7, created on 2021-02-07 19:51:07
  from 'C:\xampp\htdocs\medicus\app\views\login\login.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_6020369b235b79_11616097',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd0efc7b4b20b159dbfa6561158f44121625d3358' => 
    array (
      0 => 'C:\\xampp\\htdocs\\medicus\\app\\views\\login\\login.tpl',
      1 => 1612723865,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:common_elements/head.tpl' => 1,
    'file:navigation/patientLoginNav.tpl' => 1,
    'file:messages/messages.tpl' => 1,
  ),
),false)) {
function content_6020369b235b79_11616097 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
$_smarty_tpl->_subTemplateRender("file:common_elements/head.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
<div id="wrapper" xmlns="http://www.w3.org/1999/html">
    <!-- Main -->
    <div class="inner">


            <?php $_smarty_tpl->_subTemplateRender("file:navigation/patientLoginNav.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_5056553326020369b234bc1_78736912', "content");
?>

    </header>
    </div>
        <?php $_smarty_tpl->_subTemplateRender("file:messages/messages.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
    </div>

</div>
<?php }
/* {block "content"} */
class Block_5056553326020369b234bc1_78736912 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_5056553326020369b234bc1_78736912',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>



            <?php
}
}
/* {/block "content"} */
}
