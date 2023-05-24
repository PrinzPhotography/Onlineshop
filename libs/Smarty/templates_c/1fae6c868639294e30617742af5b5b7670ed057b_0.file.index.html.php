<?php
/* Smarty version 3.1.40, created on 2021-10-22 09:38:36
  from 'C:\var\www\uebungen\testSmarty\index.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_61726a7c0ef2e3_12326715',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1fae6c868639294e30617742af5b5b7670ed057b' => 
    array (
      0 => 'C:\\var\\www\\uebungen\\testSmarty\\index.html',
      1 => 1634888314,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61726a7c0ef2e3_12326715 (Smarty_Internal_Template $_smarty_tpl) {
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
            <input type="text" name="user" id="user" class="login" placeholder="E-Mail">
            <br>
            <label>Passwort</label>
            <br>
            <input type="password" name="pass" id="pass" class="login" placeholder="Passwort">
            <br>
            <input type="submit" id="loginButton" value="Login">
            <input type="button" id="regButton" value="Registrieren">
        </form>
    </div>
<?php }
}
