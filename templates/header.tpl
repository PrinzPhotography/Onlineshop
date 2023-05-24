<!DOCTYPE html>
<html lang="en">
<head>
    <script src="../libs/jquery/jquery-3.6.0.min.js"></script>
    <script src="../js/libs/bootstrap/js/bootstrap.bundle.js"></script>
    <script src="../js/sidemenu.js"></script>
    <script src="../js/login_registration.js"></script>
    <script src="../js/logout.js"></script>
    <script src="../js/suche.js"></script>
    <script src="../js/libs/Sweetalert/sweetalert.js"></script>
    <link rel=icon href=/img/shoplogo.png sizes="16x16" type="image/png">
    <link rel="stylesheet" href="../css/libs/bootstrap/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" type="text/css" href="../css/menu.css">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>Azubi-Shop</title>
</head>
<body>
<nav class="navbar navbar-expand-sm sticky-top navbar-light bg-light">
    <a href="#" class="navbar-brand mb-0 h1"><img class="d-inline-block align-top" src="../img/shoplogo.png" width="30" height="30" onclick="window.location.href='index.php?page=index'">Azubi-Shop</a>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" onclick="window.location.href='index.php?page=home'">Home</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" onclick="window.location.href='index.php?page=index&pageN=1'">Alle Artikel</a>

            </li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">Kategorien</a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown" id="categoryNavbar">
                    <li><a class="dropdown-item" onclick="window.location.href='index.php?page=elektronik_computer'">Elektronik & Computer</a></li>
                    <li><a class="dropdown-item" onclick="window.location.href='index.php?page=spielzeug_baby'">Spielzeug & Baby</a></li>
                    <li><a class="dropdown-item" onclick="window.location.href='index.php?page=haushalt_garten'">Haushalt & Garten</a></li>
                    <li><a class="dropdown-item" onclick="window.location.href='index.php?page=sport_freizeit'">Sport & Freizeit</a></li>
                    <li><a class="dropdown-item" onclick="window.location.href='index.php?page=bekleidung'">Bekleidung</a></li>
                </ul>
            </li>
            <li class="nav-item active">
                <a href="#" class="nav-link" onclick="window.location.href='index.php?page=kontakt'">Kontakt</a>
            </li>
        </ul>
    </div>
    <div id="div_suche_header">
        <form class="d-flex" id="suche_header">
                <input type="search" class="form-control me-2 suche" id="suche_alle" name="suche_alle" placeholder="Suche nach Artikel...">
                <button type="button" class="btn btn-primary material-icons" id="btn_search_all">search</button>
                <button type="button" class="btn btn-secondary material-icons" id="btn_reset_all" onclick="window.location.href='index.php?page=index'">close</button>
        </form>
    </div>
    <div class="collapse navbar-collapse" id="navbarNavAccount">
        <ul class="navbar-nav">
            {if $isLoggedIn eq true}
                {include file="logged_in.tpl"}
                        {else}
                            {include file="logged_out.tpl"}
                    {/if}
                </ul>
            </li>
        </ul>

        {if $isLoggedIn eq true}
            <ul class="navbar-nav">
                <li class="nav-item dropdown" id="account">
                    <a href="#" class="nav-link material-icons" id="navbarDropdownShoppingCart" role="button" data-bs-toggle="dropdown" aria-expanded="false">shopping_cart
                        {if $cartNumberLoggedIn eq 0}
                        <span style="color: orange" id="anzahl_warenkorb">({$cartNumberLoggedIn})</span><span
                                class="preis_warenkorb" style="color: orange">0,00€</span></a>
                    {else}
                    <span style="color: orange" id="anzahl_warenkorb">({$cartNumberLoggedIn})</span><span class="preis_warenkorb" style="color: orange">{$cartSum.0|replace:".":","}€</span></a>
                    {/if}
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown" id="shoppingNavbar">
                        <div id="warenkorb">
                            <div id="artikel_warenkorb">

                            </div>
                            <button class="btn btn-primary" id="shopping_cart">Zum Warenkorb</button>
                        </div>
                    </ul>
                </li>
            </ul>
        {else}
            <ul class="navbar-nav">
                <li class="nav-item dropdown" id="account">
                    <a href="#" class="nav-link material-icons" id="navbarDropdownShoppingCart" role="button" data-bs-toggle="dropdown" aria-expanded="false">shopping_cart
                        {if $cartNumberNotLoggedIn eq 0}
                        <span style="color: orange" id="anzahl_warenkorb">(0)</span><span
                                class="preis_warenkorb" style="color: orange">0,00€</span></a>
                    {else}
                    <span style="color: orange" id="anzahl_warenkorb">({$cartNumberNotLoggedIn})</span><span class="preis_warenkorb" style="color: orange">{$cartSums.0|replace:".":","}€</span></a>
                    {/if}

                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown" id="shoppingNavbar">
                        <div id="warenkorb">
                            <div id="artikel_warenkorb">

                            </div>
                            <button class="btn btn-primary" id="shopping_cart">Zum Warenkorb</button>
                        </div>

                    </ul>
                </li>
            </ul>
        {/if}
    </div>
</nav>
<div class="wrapper">

    <!-- Sidebar -->
    <nav class="navbar-light bg-light" id="sidebar">
        <ul class="list-unstyled components">
            <li>
                <a onclick="{$href}">Home</a>
            </li>
            <li class="active">
                <a href="#" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle sub-btn">Kategorie</a>
                <div class="sub-menu">
                    <a class="sub-item" onclick="window.location.href='index.php?page=elektronik_computer'">Elektronik & Computer</a>
                    <a class="sub-item" onclick="window.location.href='index.php?page=spielzeug_baby'">Spielzeug & Baby</a>
                    <a class="sub-item" onclick="window.location.href='index.php?page=haushalt_garten'">Haushalt & Garten</a>
                    <a class="sub-item" onclick="window.location.href='index.php?page=sport_freizeit'">Sport & Freizeit</a>
                    <a class="sub-item" onclick="window.location.href='index.php?page=bekleidung'">Bekleidung</a>
                </div>
            </li>
            <li>
                <a href="#">Bestellungen</a>
            </li>
            {if $admin eq admin}
            <li>
                <a href="#" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle sub-btn">Einstellungen</a>
                <div class="sub-menu">
                    <a class="sub-item" onclick="window.location.href='index.php?page=account'">Konto</a>
                    <a class="sub-item" onclick="window.location.href='index.php?page=accepted_orders'">Alle Aufträge</a>
                    <a class="sub-item" onclick="window.location.href='index.php?page=all_orders'">Alle Bestellungen</a>
                    <a class="sub-item" onclick="window.location.href='index.php?page=neuer_artikel'">Artikel/Warengruppe anlegen</a>
                    <a class="sub-item" onclick="window.location.href='index.php?page=artikel_verwalten'">Artikel verwalten</a>
                    <a class="sub-item" onclick="window.location.href='index.php?page=warengruppen'">Warengrp. verwalten</a>
                </div>
            </li>
            {/if}
            <li>
                <a onclick="window.location.href='index.php?page=hilfe'">Hilfe</a>
            </li>
            <li>
                <a onclick="window.location.href='index.php?page=kontakt'">Kontakt</a>
            </li>
        </ul>
    </nav>

    <!-- Page Content -->
    <div id="content">
        <div class="container-fluid">
            <button class="menu-btn position-fixed" id="sidebarCollapse">
                <i class="material-icons">menu</i>
            </button>
        </div>
    </div>
