<?php
/* Smarty version 3.1.40, created on 2022-05-17 16:29:07
  from 'C:\var\www\azubi-shop\templates\logged_out.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6283b133aeff26_33288045',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5fee0394702e5df4dc461bc599bf0c8e22e6277a' => 
    array (
      0 => 'C:\\var\\www\\azubi-shop\\templates\\logged_out.tpl',
      1 => 1637738162,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6283b133aeff26_33288045 (Smarty_Internal_Template $_smarty_tpl) {
?><li class="nav-item dropdown" id="account">
    <a href="#" class="nav-link" id="navbarDropdownAccount" role="button" data-bs-toggle="dropdown" aria-expanded="false">Account</a>
    <ul class="dropdown-menu" aria-labelledby="navbarDropdown" id="accountNavbar">
            <li id="login"><a class="dropdown-item" onclick="window.location.href='index.php?page=login'">Anmelden</a></li>
            <li><a class="dropdown-item">Profil bearbeiten</a></li>
            <li><a class="dropdown-item">Einstellungen</a></li>
            <li><a class="dropdown-item">Meine Bestellungen</a></li>
    </ul>
</li><?php }
}
