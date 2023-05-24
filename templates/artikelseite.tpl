{include file="header.tpl"}
<link rel="stylesheet" type="text/css" href="../css/artikelseite.css">
<script src="/js/shopping_cart.js"></script>
<script src="/js/bewertung.js"></script>

<div class="container col-sm-12">

    {foreach $artikelseite as $artikel}
        {assign var="bez" value=","|explode:$artikel.artikelbez}

        <div id="artikelbild">
            <img src="../img/{$artikel.produktbild}" class="produktbilder">
        </div>

        <div id="artikelname">
            {$artikel.artikelname}
        </div>

        <div id="artikeldetails">

            <ul>
                {foreach $bez as $bezeichnung}
                    <li>{$bezeichnung}</li>
                {/foreach}
            </ul>

            <div id="div_preis">
                Preis: <b>{$artikel.preis}€</b> <br>
                <i>zzgl. Versandkosten</i> <br>
                {if $artikel.verfuegbarkeit eq "Auf Lager"}
                    <b style="color: limegreen" class="verfuegbarkeit">{$artikel.verfuegbarkeit}</b>
                {elseif $artikel.verfuegbarkeit eq "Bald wieder lieferbar"}
                    <b style="color: orange" class="verfuegbarkeit">{$artikel.verfuegbarkeit}</b>
                {else}
                    <b style="color: red" class="verfuegbarkeit">{$artikel.verfuegbarkeit}</b>
                {/if}
            </div>

            <div id="menge_warenkorb">
                Menge:
                {*<input type="number" name="menge" id="menge">*}
                <select class="selec" id="quantity" {*id="menge"*}>
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
                <input type="number" name="menge" id="menge" style="display: none">
                {if $artikel.verfuegbarkeit eq "Auf Lager"}
                    <button type="button" id="in_den_warenkorb" class="btn btn-primary quantity_shopping_cart" value="{$artikel.artikelnr}">In den Warenkorb</button>
                {else}
                    <button type="button" id="in_den_warenkorb" class="btn btn-primary quantity_shopping_cart" value="{$artikel.artikelnr}" disabled>In den Warenkorb</button>
                {/if}
            </div>

        </div>

        <div id="artikelbeschreibung">
            {$artikel.artikelbeschreibung}
        </div>

        <div id="div_kundenbewertung">
            <h3>Kundenrezensionen</h3>
        </div>

        <div id="div_sterne">

            <form>
                <fieldset>
                    <span class="star-cb-group">
                        <input type="radio" id="rating-5" name="rating" value="5"/>
                        <label for="rating-5" class="material-icons stars">star_border</label>
                        <input type="radio" id="rating-4" name="rating" value="4"/>
                        <label for="rating-4" class="material-icons stars">star_border</label>
                        <input type="radio" id="rating-3" name="rating" value="3"/>
                        <label for="rating-3" class="material-icons stars">star_border</label>
                        <input type="radio" id="rating-2" name="rating" value="2"/>
                        <label for="rating-2" class="material-icons stars">star_border</label>
                        <input type="radio" id="rating-1" name="rating" value="1"/>
                        <label for="rating-1" class="material-icons stars">star_border</label>
                        <input type="radio" id="rating-0" name="rating" value="0" class="star-cb-clear"/>
                        <label for="rating-0" class="material-icons">star_border</label>
                    </span>
                </fieldset>
            </form>

        </div>
        <div id="div_bewertung_text">
            <textarea name="bewertung_text" id="bewertung_text" placeholder="Schreiben Sie eine Rezension..."></textarea><br>
            <button type="button" name="btn_bewertung" id="btn_bewertung" class="btn btn-primary" value="{$artikel.artikelnr}">Bewertung abgeben</button>
        </div>
    {/foreach}
    {foreach $bewertungen as $bewertung}
        <div id="div_bewertung">
            {$bewertung.vorname}

            <div class="div_sterne-name">

                <input type="hidden" class="sterne_user" value="{$bewertung.sterne}">

                <form>
                    <fieldset>
                        <span class="star-cb-group-user">
                            <input type="radio" class="5" name="rating" disabled/>
                            <label for="5" class="material-icons stars">star_border</label>
                            <input type="radio" class="4" name="rating" disabled/>
                            <label for="4" class="material-icons stars">star_border</label>
                            <input type="radio" class="3" name="rating" disabled/>
                            <label for="3" class="material-icons stars">star_border</label>
                            <input type="radio" class="2" name="rating" disabled/>
                            <label for="2" class="material-icons stars">star_border</label>
                            <input type="radio" class="1" name="rating" disabled/>
                            <label for="1" class="material-icons stars">star_border</label>
                            <input type="radio" name="rating" disabled value="0" class="star-cb-clear rating-0"/>
                            <label for="rating-0" class="material-icons">star_border</label>
                        </span>
                    </fieldset>
                </form>

            </div>
            <hr>
            {$bewertung.rezension}
        </div>
        {if $admin eq admin}
        <div class="col-3"></div>
        <div class="col-3"></div>
        <div class="col-3" style="float: right">
            <button type="button" class="btn btn-danger delete_rezi material-icons" style="float: right" value="{$bewertung.id}">delete_forever</button>
        </div>
        {/if}
    {/foreach}

</div>
{include file="footer.tpl"}