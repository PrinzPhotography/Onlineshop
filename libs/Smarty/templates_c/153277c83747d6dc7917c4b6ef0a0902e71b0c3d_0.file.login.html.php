<?php
/* Smarty version 3.1.40, created on 2021-10-26 11:47:12
  from 'C:\var\www\uebungen\testSmarty\login.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6177cea0ee2715_07757575',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '153277c83747d6dc7917c4b6ef0a0902e71b0c3d' => 
    array (
      0 => 'C:\\var\\www\\uebungen\\testSmarty\\login.html',
      1 => 1635241630,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6177cea0ee2715_07757575 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="Smarty.css">
    <link rel="stylesheet" type="text/css" href="index.css">
    <?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.6.0.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="Plattensammlung.js"><?php echo '</script'; ?>
>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
    <div id="login">
        <p>Einloggen</p>
        <hr>
        <form action="login.php" method="post" id="formLogin">
            <label>Benutzername</label>
            <br>
            <input type="email" name="user" id="user" class="login" placeholder="E-Mail">
            <br>
            <label>Passwort</label>
            <br>
            <input type="password" name="pass" id="pass" class="login" placeholder="Passwort">
            <br>
            <input type="button" id="loginButton" value="Login">
            <input type="button" id="regButton" value="Registrieren" onclick="window.location.href='index.php?page=registrieren'">
        </form>
    </div>
<?php }
}
