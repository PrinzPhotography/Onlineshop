<?php
/* Smarty version 3.1.40, created on 2021-10-28 09:05:01
  from 'C:\var\www\azubi-shop\Smarty\header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_617a4b9d1d7664_10030095',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '14232d2404732b51c7ba69c11e335ec7efc3f8e9' => 
    array (
      0 => 'C:\\var\\www\\azubi-shop\\Smarty\\header.tpl',
      1 => 1635404700,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_617a4b9d1d7664_10030095 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="menu.css">
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <?php echo '<script'; ?>
 src="/bootstrap/js/bootstrap.bundle.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.6.0.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="/sidemenu.js"><?php echo '</script'; ?>
>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<nav class="navbar navbar-expand-sm sticky-top navbar-light bg-light">
    <a href="#" class="navbar-brand mb-0 h1"><img class="d-inline-block align-top" src="shoplogo.png" width="30" height="30">Azubi-Shop</a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a href="#" class="nav-link">Home</a>
            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Kategorien</a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a href="#" class="dropdown-item">Elektronik & Computer</a></li>
                    <li><a href="#" class="dropdown-item">Spielzeug & Baby</a></li>
                    <li><a href="#" class="dropdown-item">Haushalt & Garten</a></li>
                    <li><a href="#" class="dropdown-item">Sport & Freizeit</a></li>
                    <li><a href="#" class="dropdown-item">Bekleidung</a></li>
                </ul>
            </li>
            <li class="nav-item active">
                <a href="#" class="nav-link">Kontakt</a>
            </li>
        </ul>
        <form class="d-flex">
            <input type="search" class="form-control me-2">
            <button type="submit" class="btn btn-primary">Suche</button>
        </form>
    </div>
    <div class="collapse navbar-collapse" id="navbarNavAccount">
        <ul class="navbar-nav">
            <li class="nav-item dropdwon" id="login">
                <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownLogin" role="button" data-bs-toggle="dropdown" aria-expanded="false">Login</a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown" id="loginNavbar">
                    <form class="form" role="form" method="post" action="login" accept-charset="UTF-8" id="login-nav">
                        <div class="form-group">
                            <label class="sr-only" for="exampleInputEmail2">E-Mail Adresse</label>
                            <input type="email" class="form-control" id="exampleInputEmail2" placeholder="E-Mail" required>
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="exampleInputPassword2">Passwort</label>
                            <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Passwort" required>
                            <div class="help-block text-right"><a href="">Passwort vergessen ?</a></div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">Anmelden</button>
                            <button type="submit" class="btn btn-primary btn-block">Registrieren</button>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox"> keep me logged-in
                            </label>
                        </div>
                    </form>
                </ul>
            </li>
        </ul>
        <ul class="navbar-nav">
            <li class="nav-item dropdown" id="account">
                <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownAccount" role="button" data-bs-toggle="dropdown" aria-expanded="false">Account</a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown" id="accountNavbar">
                    <li><a href="#" class="dropdown-item">Profil bearbeiten</a></li>
                    <li><a href="#" class="dropdown-item">Einstellungen</a></li>
                    <li><a href="#" class="dropdown-item">Meine Bestellungen</a></li>
                    <li><a href="#" class="dropdown-item">Logout</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
<div class="menu-btn">
    <i class="material-icons">menu</i>
</div>
<div class="side-bar">
    <div class="close-btn">
        <i class="material-icons">close</i>
    </div>
    <div class="menu">
        <div class="item"><a href="#">Home</a></div>
        <div class="item">
            <a class="sub-btn">Kategorie</a>
            <div class="sub-menu">
                <a href="#" class="sub-item">Elektronik & Computer</a>
                <a href="#" class="sub-item">Spielzeug & Baby</a>
                <a href="#" class="sub-item">Haushalt & Garten</a>
                <a href="#" class="sub-item">Sport & Freizeit</a>
                <a href="#" class="sub-item">Bekleidung</a>
            </div>
        </div>
        <div class="item"><a href="#">Bestellungen</a></div>
        <div class="item"><a href="#">Einstellungen</a></div>
        <div class="item"><a href="#">Hilfe</a></div>
        <div class="item"><a href="#">Kontakt</a></div>
    </div>
</div><?php }
}
