<?php
/* Smarty version 3.1.34-dev-7, created on 2021-02-07 15:20:26
  from 'C:\xampp\htdocs\medicus\app\views\common_elements\footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.34-dev-7',
  'unifunc' => 'content_601ff72aec1963_37888497',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4521304e6b3ad69ca7e0aa879e41145e8e83ad1b' => 
    array (
      0 => 'C:\\xampp\\htdocs\\medicus\\app\\views\\common_elements\\footer.tpl',
      1 => 1612699321,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_601ff72aec1963_37888497 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-4 widget">
                <h3 class="widget-title">Kontakt</h3>
                <div class="widget-body">
                    <p>
                        <a href="mailto:#">adamchrostek98@wp.pl</a><br>
                    </p>
                </div>
            </div>

            <div class="col-md-4 widget">
                <h3 class="widget-title">Gdzie mnie znaleźć</h3>
                <div class="widget-body">
                    <p class="follow-me-icons">
                        <a href="https://github.com/pogryziony"><i class="fa fa-github fa-2"></i></a>
                        <a href="https://www.linkedin.com/in/adamchrostek/"><i class="fa fa-linkedin fa-2"></i></a>
                    </p>
                </div>
            </div>

            <div class="col-md-4 widget">
                <h3 class="widget-title">Cel ćwiczenia</h3>
                <div class="widget-body">
                    <p>Widok stworzony w oparciu o style  <a href="https://getbootstrap.com/docs/5.0/getting-started/download/" target="_blank">Bootstrap</a>.</p>
                </div>
            </div>
        </div> <!-- /row of widgets -->
    </div>
    </footer>
</div>
<!-- Copyright -->
<div id="copyright">
    <div class="container">
        Template: <a href="http://templated.co">templated.co</a>
    </div>
</div>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['conf']->value->assets_url;?>
js/jquery.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['conf']->value->assets_url;?>
js/browser.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['conf']->value->assets_url;?>
js/breakpoints.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['conf']->value->assets_url;?>
js/util.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="<?php echo $_smarty_tpl->tpl_vars['conf']->value->assets_url;?>
js/main.js"><?php echo '</script'; ?>
>
    </body>
    </html>
<?php }
}
