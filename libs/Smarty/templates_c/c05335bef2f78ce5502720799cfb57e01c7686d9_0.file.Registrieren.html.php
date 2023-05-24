<?php
/* Smarty version 3.1.40, created on 2021-10-26 11:59:00
  from 'C:\var\www\uebungen\testSmarty\Registrieren.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6177d16414ec58_68727447',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c05335bef2f78ce5502720799cfb57e01c7686d9' => 
    array (
      0 => 'C:\\var\\www\\uebungen\\testSmarty\\Registrieren.html',
      1 => 1635242338,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6177d16414ec58_68727447 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="Smarty.css">
    <link rel="stylesheet" type="text/css" href="registrieren.css">
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
    <p>Registrieren</p>
    <hr>
    <form action="registrieren.php" method="post" id="formReg">
        <label>Vor- und Nachname</label>
        <br>
        <input type="text" name="name" id="name" class="login" placeholder="Vor- und nachname" required>
        <br>
        <label>E-Mail Adresse</label>
        <br>
        <input type="text" name="user" id="user" class="login" placeholder="E-Mail" required>
        <br>
        <label>Passwort</label>
        <br>
        <input type="password" name="pass" id="pass" class="login" placeholder="Passwort" required>
        <br>
        <label>Passwort bestätigen</label>
        <br>
        <input type="password" name="pass2" id="pass2" class="login" placeholder="Passwort" required>
        <br>
        <input type="submit" id="regButton" value="Registrieren">
    </form>
</div><?php }
}
