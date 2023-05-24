<?php
/* Smarty version 3.1.40, created on 2021-10-26 11:45:37
  from 'C:\var\www\uebungen\testSmarty\header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6177ce418ac4c7_51926760',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '65152d7b30ee5a4accf2f3bea892c74788a9e62f' => 
    array (
      0 => 'C:\\var\\www\\uebungen\\testSmarty\\header.tpl',
      1 => 1635241536,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6177ce418ac4c7_51926760 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" type="text/css" href="Smarty.css">
    <meta charset="UTF-8">
    <title>Meine Plattensammlung</title>
</head>
<body>
<div id="body">
    <div id="header">
        <div id="titel">
            <span id="seitentitel">Mein kleiner Plattenladen</span>
            <span id="logout" onclick="window.location.href='index.php'">Logout</span>
            <span</span>
        </div>
    </div>
    <div id="leftSidebar">
        <button class="dropdown" id="index" onclick="window.location.href='index.php?page=Plattensammlung_index'">Home</button>
        <button class="dropdown" id="sammlung" onclick="window.location.href='index.php?page=Plattensammlung_sammlung'">Sammlung</button>
        <div class="dropdownInterpreten">
            <button class="dropdown">Interpreten</button>
            <div class="dropdown-content">
                <button class="dropdown-content" onclick="window.location.href='index.php?page=A-Z'">A-Z</button>

            </div>
        </div>
        <div class="dropdownInterpreten">
            <div class="dropdown-content">
                <p class="content" id="Rock">Rock</p>
                <p class="content" id="Metal">Metal</p>
                <p class="content" id="Pop">Pop</p>
                <p class="content" id="Metalcore">Metalcore</p>
                <p class="content" id="Punk">Punk</p>
                <p class="content" id="Hiphop">HipHop</p>
            </div>
        </div>
        <button class="dropdown" id="eintrag" onclick="window.location.href='index.php?page=Plattensammlung_eintrag'">Neuer Eintrag</button>
        <div id="filter">
            <p class="filter">Filter</p>
            <hr id="hrfilter">
            <div id="filterSuche">
                <div id="filterCheck">
                    <input type="checkbox" name="genre[]" value="Rock" class="check" id="rock2">
                    <label>Rock</label>
                    <input type="checkbox" name="genre[]" value="Metal" class="check" id="metal2">
                    <label>Metal</label>
                    <input type="checkbox" name="genre[]" value="Pop" class="check" id="pop2">
                    <label>Pop</label>
                    <br>
                    <input type="checkbox" name="genre[]" value="Metalcore" class="check" id="metalcore2">
                    <label>Metalcore</label>
                    <input type="checkbox" name="genre[]" value="Punk" class="check" id="punk2">
                    <label>Punk</label>
                    <input type="checkbox" name="genre[]" value="Hiphop" class="check" id="hiphop2">
                    <label>Hiphop</label>
                </div>
                <input type="search" placeholder="Suche..." name="search" id="suche">
                <div type="button" id="searchButton" class="material-icons">
                    search
                </div>
            </div>
        </div>
    </div><?php }
}
