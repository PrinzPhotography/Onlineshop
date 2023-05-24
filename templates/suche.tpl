{include file='header.tpl'}
<script src="../js/shopping_cart.js"></script>
<script src="../js/suche.js"></script>
<script src="../js/artikelseite.js"></script>
<script src="../js/artikel_verwalten.js"></script>
<link rel="stylesheet" type="text/css" href="../css/index.css">
<div class="container-fluid">
    <div class="container-fluid" id="alle_artikel">
        {foreach $suche as $ergebnis}
            {assign var="bez" value=","|explode:$ergebnis.artikelbez}
            <div class="container-sm-12 artikel_spalte">
                <input type="hidden" id="hidden" value="{$ergebnis.artikelnr}">
                <div class="artikel_bild">
                    <div class="article_image">
                        <img src="../img/{$ergebnis.produktbild}" class="produktbilder">
                    </div>
                </div>
                <div class="artikel_name">
                    {$ergebnis.artikelname}
                </div>
                <div class="artikel_bez">
                    <ul>
                        {foreach $bez as $bezeichnung}
                            <li>{$bezeichnung}</li>
                        {/foreach}
                    </ul>
                </div>
                <div class="bewertung">
                    Bewertung
                </div>
                <div class="preis">
                    {$ergebnis.preis} €
                </div>
                <div class="details">
                    <ul>
                        <li>Lieferung bis</li>
                        {if $ergebnis.verfuegbarkeit eq "Auf Lager"}
                            <li style="color: green" class="verfuegbarkeit">{$ergebnis.verfuegbarkeit}</li>
                        {elseif $ergebnis.verfuegbarkeit eq "Bald wieder lieferbar"}
                            <li style="color: orange" class="verfuegbarkeit">{$ergebnis.verfuegbarkeit}</li>
                        {else}
                            <li style="color: red" class="verfuegbarkeit">{$ergebnis.verfuegbarkeit}</li>
                        {/if}
                    </ul>
                </div>
                <button type="button" id="zum_artikel" class="btn btn-primary zum_artikel" value="{$ergebnis.artikelnr}">Zum Artikel</button>
                {if $ergebnis.verfuegbarkeit eq "Auf Lager"}
                    <button type="button" class="btn btn-success material-icons shopping_cart" value="{$ergebnis.artikelnr}">add_shopping_cart</button>
                {else}
                    <button type="button" class="btn btn-success material-icons shopping_cart" value="{$ergebnis.artikelnr}" disabled>add_shopping_cart</button>
                {/if}
            </div>
        {/foreach}
    </div>
</div>
{include file='footer.tpl'}