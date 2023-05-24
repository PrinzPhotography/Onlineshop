<?php
/* Smarty version 3.1.40, created on 2021-10-28 08:08:28
  from 'C:\var\www\uebungen\testSmarty\A-Z.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_617a3e5c550403_93876127',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '830cb5304879b7031c2ebcd7ce1822712fc3fbda' => 
    array (
      0 => 'C:\\var\\www\\uebungen\\testSmarty\\A-Z.html',
      1 => 1635332533,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_617a3e5c550403_93876127 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="Smarty.css">
    <link rel="stylesheet" type="text/css" href="A-Z.css">
    <?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.6.0.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="Plattensammlung.js"><?php echo '</script'; ?>
>
    <meta charset="UTF-8">
    <title>Meine Plattensammlung</title>
</head>
<body>
    <div id="back">
        <a href="Plattensammlung_sammlung.html"><b><<</b></a>
    </div>
    <div id="vor">
        <a href="Plattensammlung_eintrag.html"><b>>></b></a>
    </div>
    <div id="azborder">
        <div id="letters">
            <p class="category" id="A">A</p>
            <p class="category" id="B">B</p>
            <p class="category" id="C">C</p>
            <p class="category" id="D">D</p>
            <p class="category" id="E">E</p>
            <p class="category" id="F">F</p>
            <p class="category" id="G">G</p>
            <p class="category" id="H">H</p>
            <p class="category" id="I">I</p>
            <p class="category" id="J">J</p>
            <p class="category" id="K">K</p>
            <p class="category" id="L">L</p>
            <p class="category" id="M">M</p>
            <p class="category" id="N">N</p>
            <p class="category" id="O">O</p>
            <p class="category" id="P">P</p>
            <p class="category" id="Q">Q</p>
            <p class="category" id="R">R</p>
            <p class="category" id="S">S</p>
            <p class="category" id="T">T</p>
            <p class="category" id="U">U</p>
            <p class="category" id="V">V</p>
            <p class="category" id="W">W</p>
            <p class="category" id="X">X</p>
            <p class="category" id="Y">Y</p>
            <p class="category" id="Z">Z</p>
            <p class="category" id="number">0-9</p>
        </div>
    </div>
    <div id="chooseArtist">
        Künstler wählen:
        <hr>
    </div>
    <div id="artistList">
    </div>
<?php }
}
