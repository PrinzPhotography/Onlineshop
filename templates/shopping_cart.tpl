{include file="header.tpl"}
<link type="text/css" rel="stylesheet" href="/css/cart.css">
<script src="/js/shopping_cart.js"></script>
<script src="/js/orders.js"></script>
<div class="container-fluid" id="alle_artikel">
    <div class="container-sm-12">
        <div id="warnings" >

        </div>
    </div>
    {foreach $cartItems as $items}
        <div class="container-sm-12 artikel_spalte">
            <div class="artikel_bild">
                <div class="article_image">
                    <img src="../img/{$items.produktbild}" class="produktbilder">
                </div>
            </div>
            <div class="artikel_name">
                <strong>{$items.artikelname}</strong>
            </div>
            <div class="artikelbez">
                <strong>{$items.artikelbez}</strong>
            </div>
            <div class="bewertung">
                <strong>Bewertung</strong>
            </div>
            <div class="preis">
                <strong>{$items.preis|replace:".":","}€</strong>
            </div>
            <div class="details">
                <ul>
                    <li>Lieferung bis</li>
                    {if $items.verfuegbarkeit eq "Auf Lager"}
                        <li style="color: green">{$items.verfuegbarkeit}</li>
                    {else}
                        <li style="color: red">{$items.verfuegbarkeit}</li>
                    {/if}
                    <li class="cart_quant">{*Menge: {$items.anzahl}*}
                        <label for="quantity_cart">Menge</label>
                        <select class="select" id="quantity_cart">
                        <option value="{$items.anzahl}" selected disabled hidden>{$items.anzahl}</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10+">10+</option>
                        </select>
                    </li>
                </ul>
            </div>
            <button value="{$items.artikel_id}" class="btn btn-primary update" style="display: none">Aktualisieren</button>
            <button type="button" class="btn btn-danger material-icons delete_artikel" value="{$items.artikel_id}">delete_forever</button>
            <input type="hidden" class="art_nr" value="{$items.artikel_id}">
        </div>
    {/foreach}
    <div class="container-sm-12 sum_col">
        <div class="sum_price">
            <span>Summe ({$cartSum.1} Artikel): <strong>{$cartSum.0|replace:".":","}€</strong></span>
        </div>
    </div>
    <div class="container-sm-12 sum_col">
        <button class="btn btn-primary order_send" style="float: right">Zur Kasse</button>
    </div>
</div>

{include file="footer.tpl"}