{include file="header.tpl"}
<script src="../js/shopping_cart.js"></script>
<script src="../js/suche.js"></script>
<script src="../js/artikelseite.js"></script>
<script src="../js/bewertung.js"></script>
<link rel="stylesheet" type="text/css" href="../css/index.css">
<div class="container-fluid">
{*    <div class="suche_artikelliste">
        <form class="d-flex" id="suche_artikel">
            <input type="search" class="form-control me-2 suche" id="suche_alle" name="suche_alle" placeholder="Suche nach Artikel...">
            <button type="button" class="btn btn-primary material-icons" id="btn_search_all">search</button>
            <button type="button" class="btn btn-secondary material-icons" id="btn_reset_all" onclick="window.location.href='index.php?page=index'">close</button>
        </form>
    </div>*}
    <div class="container-fluid" id="alle_artikel">
        {foreach $alleArtikel as $artikel}
            {assign var="bez" value=","|explode:$artikel.artikelbez}
            <div class="container-sm-12 artikel_spalte">
                <input type="hidden" id="hidden" value="{$artikel.artikelnr}">
                <div class="artikel_bild">
                    <div class="article_image">
                        <img src="../img/{$artikel.produktbild}" class="produktbilder">
                    </div>
                </div>
                <div class="artikel_name">
                    {$artikel.artikelname}
                </div>
                <div class="artikel_bez">
                        <ul>
                            {foreach $bez as $bezeichnung}
                                <li>{$bezeichnung}</li>
                            {/foreach}
                        </ul>
                </div>
                <div class="bewertung">
                    <form>
                        <fieldset>
                    <span class="star-cb-group">
                        <input type="radio" class="rating-5" name="rating" value="5"/>
                        <label for="rating-5" class="material-icons stars">star_border</label>
                        <input type="radio" class="rating-4" name="rating" value="4"/>
                        <label for="rating-4" class="material-icons stars">star_border</label>
                        <input type="radio" class="rating-3" name="rating" value="3"/>
                        <label for="rating-3" class="material-icons stars">star_border</label>
                        <input type="radio" class="rating-2" name="rating" value="2"/>
                        <label for="rating-2" class="material-icons stars">star_border</label>
                        <input type="radio" class="rating-1" name="rating" value="1"/>
                        <label for="rating-1" class="material-icons stars">star_border</label>
                        <input type="radio" class="rating-0 star-cb-clear" name="rating" value="0"/>
                        <label for="rating-0" class="material-icons">star_border</label>
                    </span>
                        </fieldset>
                    </form>
                    {$total = 0}
                    {$count = 0}
                    {foreach $durchschnittsBewertung as $bewertung}
                        {if $artikel.artikelnr eq $bewertung.artikelnr}
                            {$total = $total+$bewertung.sterne}
                            {$count = $count + 1}
                        {/if}
                    {/foreach}
                    {$durchschnitt = $total / $count}

                    <input type="hidden" class="average" value="{$durchschnitt}">
                    <i class="sterne"><span>{$durchschnitt}</span> von 5 Sterne</i>
                </div>
                <div class="preis">
                    {$artikel.preis} €
                </div>
                <div class="details">
                    <ul>
                        <li>Lieferung bis</li>
                            {if $artikel.verfuegbarkeit eq "Auf Lager"}
                                <li style="color: green" class="verfuegbarkeit">{$artikel.verfuegbarkeit}</li>
                            {elseif $artikel.verfuegbarkeit eq "Bald wieder lieferbar"}
                                <li style="color: orange" class="verfuegbarkeit">{$artikel.verfuegbarkeit}</li>
                            {else}
                                <li style="color: red" class="verfuegbarkeit">{$artikel.verfuegbarkeit}</li>
                            {/if}
                    </ul>
                </div>

                <button type="button"  class="btn btn-primary zum_artikel" value="{$artikel.artikelnr}">Zum Artikel</button>
                {if $artikel.verfuegbarkeit eq "Auf Lager"}
                    <button type="button" class="btn btn-success material-icons shopping_cart" value="{$artikel.artikelnr}">add_shopping_cart</button>
                {else}
                    <button type="button" class="btn btn-success material-icons shopping_cart" value="{$artikel.artikelnr}" disabled>add_shopping_cart</button>
                {/if}
            </div>
        {/foreach}
        <div style="    display: flex;justify-content: center;align-items: center;">
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                        <a class="page-link" onclick="window.location.href='index.php?page=index&pageN={$first}'" >Erster</a>
                    </li>
                    {if $pageno eq 1}
                        <li class="page-item active">
                            <a class="page-link" onclick="window.location.href='index.php?page=index&pageN={$pageno}'">{$pageno}</a>
                        </li>
                    {else}
                        <li class="page-item">
                            <a class="page-link" onclick="window.location.href='index.php?page=index&pageN={$pageno - 1}'">{$pageno - 1}</a>
                        </li>
                    {/if}
                    {if $pageno eq 1}
                        <li class="page-item">
                            <a class="page-link" onclick="window.location.href='index.php?page=index&pageN={$pageno + 1}'">{$pageno + 1}</a>
                        </li>
                    {else}
                        <li class="page-item active">
                            <a class="page-link" onclick="window.location.href='index.php?page=index&pageN={$pageno}'">{$pageno}</a>
                        </li>
                    {/if}
                    {if $pageno eq 1}
                        <li class="page-item">
                            <a class="page-link" onclick="window.location.href='index.php?page=index&pageN={$pageno + 2}'">{$pageno + 2}</a>
                        </li>
                    {else}
                        <li class="page-item">
                            <a class="page-link" onclick="window.location.href='index.php?page=index&pageN={$pageno + 1}'">{$pageno +1}</a>
                        </li>
                    {/if}
                    <li class="page-item">
                        <a class="page-link" onclick="window.location.href='index.php?page=index&pageN={$last}'">Letzter</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
{include file="footer.tpl"}

