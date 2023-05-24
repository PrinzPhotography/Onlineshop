<?php
/* Smarty version 3.1.40, created on 2022-05-17 16:29:07
  from 'C:\var\www\azubi-shop\templates\index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6283b133ab2a22_02298760',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b41d05fc6032c3ae13fb16f6e6e497322d74588d' => 
    array (
      0 => 'C:\\var\\www\\azubi-shop\\templates\\index.tpl',
      1 => 1652268240,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_6283b133ab2a22_02298760 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
echo '<script'; ?>
 src="../js/shopping_cart.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="../js/suche.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="../js/artikelseite.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 src="../js/bewertung.js"><?php echo '</script'; ?>
>
<link rel="stylesheet" type="text/css" href="../css/index.css">
<div class="container-fluid">
    <div class="container-fluid" id="alle_artikel">
        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['alleArtikel']->value, 'artikel');
$_smarty_tpl->tpl_vars['artikel']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['artikel']->value) {
$_smarty_tpl->tpl_vars['artikel']->do_else = false;
?>
            <?php $_smarty_tpl->_assignInScope('bez', explode(",",$_smarty_tpl->tpl_vars['artikel']->value['artikelbez']));?>
            <div class="container-sm-12 artikel_spalte">
                <input type="hidden" id="hidden" value="<?php echo $_smarty_tpl->tpl_vars['artikel']->value['artikelnr'];?>
">
                <div class="artikel_bild">
                    <div class="article_image">
                        <img src="../img/<?php echo $_smarty_tpl->tpl_vars['artikel']->value['produktbild'];?>
" class="produktbilder">
                    </div>
                </div>
                <div class="artikel_name">
                    <?php echo $_smarty_tpl->tpl_vars['artikel']->value['artikelname'];?>

                </div>
                <div class="artikel_bez">
                        <ul>
                            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['bez']->value, 'bezeichnung');
$_smarty_tpl->tpl_vars['bezeichnung']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['bezeichnung']->value) {
$_smarty_tpl->tpl_vars['bezeichnung']->do_else = false;
?>
                                <li><?php echo $_smarty_tpl->tpl_vars['bezeichnung']->value;?>
</li>
                            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                        </ul>
                </div>
                <div class="bewertung">
                    <form>
                        <fieldset>
                    <span class="star-cb-group">
                        <input type="radio" class="rating-5" name="rating" value="5"/>
                        <label for="rating-5" class="material-icons stars">star_border</label>
                        <input type="radio" class="rating-4" name="rating" value="4"/>
                        <label for="rating-4" class="material-icons stars">star_border</label>
                        <input type="radio" class="rating-3" name="rating" value="3"/>
                        <label for="rating-3" class="material-icons stars">star_border</label>
                        <input type="radio" class="rating-2" name="rating" value="2"/>
                        <label for="rating-2" class="material-icons stars">star_border</label>
                        <input type="radio" class="rating-1" name="rating" value="1"/>
                        <label for="rating-1" class="material-icons stars">star_border</label>
                        <input type="radio" class="rating-0 star-cb-clear" name="rating" value="0"/>
                        <label for="rating-0" class="material-icons">star_border</label>
                    </span>
                        </fieldset>
                    </form>
                    <?php $_smarty_tpl->_assignInScope('total', 0);?>
                    <?php $_smarty_tpl->_assignInScope('count', 0);?>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['durchschnittsBewertung']->value, 'bewertung');
$_smarty_tpl->tpl_vars['bewertung']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['bewertung']->value) {
$_smarty_tpl->tpl_vars['bewertung']->do_else = false;
?>
                        <?php if ($_smarty_tpl->tpl_vars['artikel']->value['artikelnr'] == $_smarty_tpl->tpl_vars['bewertung']->value['artikelnr']) {?>
                            <?php $_smarty_tpl->_assignInScope('total', $_smarty_tpl->tpl_vars['total']->value+$_smarty_tpl->tpl_vars['bewertung']->value['sterne']);?>
                            <?php $_smarty_tpl->_assignInScope('count', $_smarty_tpl->tpl_vars['count']->value+1);?>
                        <?php }?>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    <?php $_smarty_tpl->_assignInScope('durchschnitt', $_smarty_tpl->tpl_vars['total']->value/$_smarty_tpl->tpl_vars['count']->value);?>

                    <input type="hidden" class="average" value="<?php echo $_smarty_tpl->tpl_vars['durchschnitt']->value;?>
">
                    <i class="sterne"><span><?php echo $_smarty_tpl->tpl_vars['durchschnitt']->value;?>
</span> von 5 Sterne</i>
                </div>
                <div class="preis">
                    <?php echo $_smarty_tpl->tpl_vars['artikel']->value['preis'];?>
 €
                </div>
                <div class="details">
                    <ul>
                        <li>Lieferung bis</li>
                            <?php if ($_smarty_tpl->tpl_vars['artikel']->value['verfuegbarkeit'] == "Auf Lager") {?>
                                <li style="color: green" class="verfuegbarkeit"><?php echo $_smarty_tpl->tpl_vars['artikel']->value['verfuegbarkeit'];?>
</li>
                            <?php } elseif ($_smarty_tpl->tpl_vars['artikel']->value['verfuegbarkeit'] == "Bald wieder lieferbar") {?>
                                <li style="color: orange" class="verfuegbarkeit"><?php echo $_smarty_tpl->tpl_vars['artikel']->value['verfuegbarkeit'];?>
</li>
                            <?php } else { ?>
                                <li style="color: red" class="verfuegbarkeit"><?php echo $_smarty_tpl->tpl_vars['artikel']->value['verfuegbarkeit'];?>
</li>
                            <?php }?>
                    </ul>
                </div>

                <button type="button"  class="btn btn-primary zum_artikel" value="<?php echo $_smarty_tpl->tpl_vars['artikel']->value['artikelnr'];?>
">Zum Artikel</button>
                <?php if ($_smarty_tpl->tpl_vars['artikel']->value['verfuegbarkeit'] == "Auf Lager") {?>
                    <button type="button" class="btn btn-success material-icons shopping_cart" value="<?php echo $_smarty_tpl->tpl_vars['artikel']->value['artikelnr'];?>
">add_shopping_cart</button>
                <?php } else { ?>
                    <button type="button" class="btn btn-success material-icons shopping_cart" value="<?php echo $_smarty_tpl->tpl_vars['artikel']->value['artikelnr'];?>
" disabled>add_shopping_cart</button>
                <?php }?>
            </div>
        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        <div style="    display: flex;justify-content: center;align-items: center;">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                        <a class="page-link" onclick="window.location.href='index.php?page=index&pageN=<?php echo $_smarty_tpl->tpl_vars['first']->value;?>
'" >Erster</a>
                    </li>
                    <?php if ($_smarty_tpl->tpl_vars['pageno']->value == 1) {?>
                        <li class="page-item active">
                            <a class="page-link" onclick="window.location.href='index.php?page=index&pageN=<?php echo $_smarty_tpl->tpl_vars['pageno']->value;?>
'"><?php echo $_smarty_tpl->tpl_vars['pageno']->value;?>
</a>
                        </li>
                    <?php } else { ?>
                        <li class="page-item">
                            <a class="page-link" onclick="window.location.href='index.php?page=index&pageN=<?php echo $_smarty_tpl->tpl_vars['pageno']->value-1;?>
'"><?php echo $_smarty_tpl->tpl_vars['pageno']->value-1;?>
</a>
                        </li>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['pageno']->value == 1) {?>
                        <li class="page-item">
                            <a class="page-link" onclick="window.location.href='index.php?page=index&pageN=<?php echo $_smarty_tpl->tpl_vars['pageno']->value+1;?>
'"><?php echo $_smarty_tpl->tpl_vars['pageno']->value+1;?>
</a>
                        </li>
                    <?php } else { ?>
                        <li class="page-item active">
                            <a class="page-link" onclick="window.location.href='index.php?page=index&pageN=<?php echo $_smarty_tpl->tpl_vars['pageno']->value;?>
'"><?php echo $_smarty_tpl->tpl_vars['pageno']->value;?>
</a>
                        </li>
                    <?php }?>
                    <?php if ($_smarty_tpl->tpl_vars['pageno']->value == 1) {?>
                        <li class="page-item">
                            <a class="page-link" onclick="window.location.href='index.php?page=index&pageN=<?php echo $_smarty_tpl->tpl_vars['pageno']->value+2;?>
'"><?php echo $_smarty_tpl->tpl_vars['pageno']->value+2;?>
</a>
                        </li>
                    <?php } else { ?>
                        <li class="page-item">
                            <a class="page-link" onclick="window.location.href='index.php?page=index&pageN=<?php echo $_smarty_tpl->tpl_vars['pageno']->value+1;?>
'"><?php echo $_smarty_tpl->tpl_vars['pageno']->value+1;?>
</a>
                        </li>
                    <?php }?>
                    <li class="page-item">
                        <a class="page-link" onclick="window.location.href='index.php?page=index&pageN=<?php echo $_smarty_tpl->tpl_vars['last']->value;?>
'">Letzter</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php }
}
