<?php
/* Smarty version 3.1.40, created on 2021-10-22 09:47:47
  from 'C:\var\www\uebungen\testSmarty\Plattensammlung_eintrag.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_61726ca377a2d3_76724423',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '35b7b6460354461c6e9ce4100c57283c642b16b0' => 
    array (
      0 => 'C:\\var\\www\\uebungen\\testSmarty\\Plattensammlung_eintrag.html',
      1 => 1634886244,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_61726ca377a2d3_76724423 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="Smarty.css">
    <link rel="stylesheet" type="text/css" href="Plattensammlung_eintrag.css">
    <?php echo '<script'; ?>
 src="https://code.jquery.com/jquery-3.6.0.min.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
 src="Plattensammlung.js"><?php echo '</script'; ?>
>
    <meta charset="UTF-8">
    <title>Neuer Eintrag</title>
</head>
<body>
    <div id="back">
        <a href="A-Z.html"><b><<</b></a>
    </div>
    <div id="vor">
        <a href="Impressum.html"><b>>></b></a>
    </div>
    <div id="divNewAlbum">
        <div class="main">
            <div id="newAlbum">
                <p>Neues Album hinzufügen:</p>
            </div>
            <hr>
                <div id="form">
                    <form action="Platten_insert.php" method="post" id="forminsert">
                    <input type="text" id="artist" name="Artist" placeholder="Künstler">
                    <input type="text" id="album" name="Album" placeholder="Album">
                    <input type="text" id="Erscheinungsjahr" name="Erscheinungsjahr" placeholder="Release">
                    <select id="genre" name="genre">
                        <option value="Rock">Rock</option>
                        <option value="Metal">Metal</option>
                        <option value="Pop">Pop</option>
                        <option value="Metalcore">Metalcore</option>
                        <option value="Punk">Punk</option>
                        <option value="HipHop">HipHop</option>
                    </select>
                    <select id="medium" name="Medium">
                        <option value="Vinyl">Vinyl</option>
                        <option value="CD">CD</option>
                        <option value="Digital">Digital</option>
                    </select>
                    <input type="file" name="image" id="image">
                    <div id="inputButton">
                    <input class="button" id="insert" type="submit" value="Rein damit!">
                    <a href="Plattensammlung_index.html"><input class="button" type="button" value="Zurück"></a>
                    </div>
                    </form>
                </div>
        </div>
    </div><?php }
}
