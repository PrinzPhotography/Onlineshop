<?php
/* Smarty version 3.1.40, created on 2021-10-22 10:19:49
  from 'C:\var\www\uebungen\testSmarty\Kontakt.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_61727425e85690_12879480',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '88da11f971f7f017d9f99f9b7ddf6f9fcd97ca56' => 
    array (
      0 => 'C:\\var\\www\\uebungen\\testSmarty\\Kontakt.html',
      1 => 1634886244,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61727425e85690_12879480 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="Smarty.css">
    <link rel="stylesheet" type="text/css" href="Kontakt.css">
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
    <div id="contactTitle">
        <p>Kontakt</p>
        <hr>
    </div>
    <div id="contactForm">
        <form action="Kontakt.php" method="post">
            <p><b>Nachname:</b></p>
            <input type="text" name="nachname" id="nachname" placeholder="Nachname">
            <br>
            <p><b>Vorname:</b></p>
            <input type="text" name="vorname" id="vorname" placeholder="Vorname">
            <br>
            <p><b>E-Mail:</b></p>
            <input type="text" name="email" id="email" placeholder="E-Mail">
            <br>
            <p><b>Ihr Anliegen:</b></p>
            <textarea name="contactText" id="contactText" rows="10" cols="50"></textarea>
            <br>
            <input type="submit" value="Senden" id="send" onclick="window.location.href='index.php?page=Kontakt'">
        </form>
    </div><?php }
}
