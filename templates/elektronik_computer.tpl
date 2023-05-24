{include file="header.tpl"}
<script src="../js/alle_artikel.js"></script>
<link rel="stylesheet" type="text/css" href="../css/index.css">
<link rel="stylesheet" type="text/css" href="../css/elektronik_computer.css">
<div class="container-fluid">
    <div class="headline">
        <p>Elektronik & Computer</p>
    </div>
    <div class="suche_artikelliste">
        <form class="d-flex" id="suche_artikel">
            <input type="search" class="form-control me-2 suche" id="suche_alle" placeholder="Suche nach Artikel...">
            <button type="button" class="btn btn-primary" id="btn_suche">Suche</button>
            <button type="button" class="btn btn-secondary btn_reset" id="btn_reset" onclick="window.location.href='index.php?page=elektronik_computer'">Zurücksetzen</button>
        </form>
    </div>
    <div class="container-fluid" id="alle_artikel">

    </div>
</div>
{include file="footer.tpl"}