{include file="header.tpl"}
<script src="/js/artikel_verwalten.js"></script>
<link rel="stylesheet" type="text/css" href="../css/artikel_verwalten.css">
<div class="container-fluid">
    <div class="suche_artikelliste">
        <form class="d-flex" id="suche_artikel">
            <input type="search" class="form-control me-2 suche" id="suche_edit" placeholder="Suche nach Artikel...">
            <button type="button" class="btn btn-primary material-icons" id="btn_search_edit">search</button>
            <button type="button" class="btn btn-secondary material-icons" id="btn_reset_edit" onclick="window.location.href='index.php?page=artikel_verwalten'">close</button>
        </form>
    </div>
    <div class="container-sm-10" id="artikelliste">
        {foreach $articlelist as $article}
        <div class="all_articles col-sm-2">
            <div class="article col-md-2">
                <div class="article_image">
                    <img src="../img/{$article.produktbild}" class="produktbilder">
                </div>
                <div class="details_artikel">
                    <ul>
                        <li><b>Art.-Nr.:</b><i>{$article.artikelnr}</i></li>
                        <li><b>Art.-Name:</b>{$article.artikelname}</li>
                        <li><b>Art.-Bez.:</b>{$article.artikelbez}</li>
                        <li><b>Hersteller:</b>{$article.hersteller}</li>
                        <li><b>Warengruppe:</b>{$article.warengruppe}</li>
                        <li><b>Preis:</b> {$article.preis} € </li>
                        <li><b>Lagerbestand:</b>{$article.lagerbestand} Stk</li>
                        <li><b>Verfügbar:</b> {$article.verfuegbarkeit}</li>
                        <li>
                            <button class="btn_article_mainsite btn btn-primary" onclick="window.location.href='index.php?page=artikel_bearbeiten&artikelnr={$article.artikelnr}'">Artikel bearbeiten</button>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
        {/foreach}
    </div>
</div>
{include file="footer.tpl"}
