{include file="header.tpl"}
<script src="/js/artikel_verwalten.js"></script>
<link rel="stylesheet" type="text/css" href="../css/artikel_verwalten.css">
<div class="container-fluid">
    <div class="suche_artikelliste">
    </div>
    <div class="container-sm-10" id="artikelliste">
        <div class="card" id="card_bearbeiten">
             <h5 class="card-header">Artikel bearbeiten</h5>

            <div class="card-body">

                <form action="../php/artikel_verwalten.php" method="post" id="artikel_bearbeiten">
                     <label for="artikel_nr" class="label_artikel_verwalten">Art.-Nr.:</label>

                    <div class="form-group">
                         <input class="form-control" type="text" name="artikel_nr" id="artikel_nr" value="{$articleInfo.art.artikelnr}"
                         required readonly>
                    </div>
                     <label for="artikel_name" class="label_artikel_verwalten">Artikel Name:</label>

                    <div class="form-group">
                         <input class="form-control" type="text" name="artikel_name" id="artikel_name" value="{$articleInfo.art.artikelname}"
                         required>
                    </div>
                     <label for="artikel_bez" class="label_artikel_verwalten">Art.-Bezeichnung:</label>

                    <div class="form-group">
                         <textarea class="form-control" name="artikel_bez" id="artikel_bez"
                         required>
                             {$articleInfo.art.artikelbez}
                         </textarea>
                    </div>
                     <label for="artikelbeschreibung" class="label_artikel_verwalten">Art.-Beschreibung:</label>

                    <div class="form-group">
                         <textarea class="form-control" name="artikelbeschreibung" id="artikelbeschreibung"
                          required>
                             {$articleInfo.art.artikelbeschreibung}
                         </textarea>
                    </div>
                     <label for="hersteller" class="label_artikel_verwalten">Hersteller:</label>

                    <div class="form-group">
                         <input class="form-control" type="text" name="hersteller" id="hersteller" value="{$articleInfo.art.hersteller}"
                    </div>
                    <label for="preis" class="label_artikel_verwalten">Preis €:</label>

                    <div class="form-group">
                         <input class="form-control" type="number" step="any" name="preis" id="preis" value="{$articleInfo.art.preis}"
                         required>
                    </div>
                     <label for="rabatt" class="label_artikel_verwalten">Rabatt %:</label>

                    <div class="form-group">
                         <select class="form-control rabatt" type="number" name="rabatt" id="rabatt"
                         required>
                             {foreach $articleInfo.alleRab as $rabatte}
                                 {if $articleInfo.art.artRabId eq $rabatte.rabatt}
                                     <option value="{$rabatte.rab_id}" selected="selected">{$rabatte.rabatt}</option>
                                 {else}
                                     <option value="{$rabatte.rab_id}">{$rabatte.rabatt}</option>
                                 {/if}
                             {/foreach}
                        </select>
                    </div>
                     <label for="lagerbestand" class="label_artikel_verwalten">Lagerbestand:</label>

                    <div class="form-group">
                         <input class="form-control" type="number" name="lagerbestand" id="lagerbestand" value="{$articleInfo.art.lagerbestand}"
                         required>
                    <div>
                     <label for="warengruppe" class="label_artikel_verwalten">Warengruppe:</label>

                    <div class="form-group">
                         <select class="form-control" name="warengruppe" id="warengruppe" required>
                             {foreach $articleInfo.wareng as $wareng}
                                 {if $articleInfo.art.artRabId eq $rabatte.rabatt}
                                     <option value="{$wareng.id}" selected="selected">{$wareng.warengruppe}</option>
                                 {else}
                                     <option value="{$wareng.id}">{$wareng.warengruppe}</option>
                                 {/if}
                             {/foreach}
                         </select>
                    </div>
                     <label For="image" class="label_artikel_verwalten">Produktfoto:</label>
                    <div class="form-group">
                        <input class="form-control" type="file" name="image" id="image" value="{$articleInfo.art.produktbild}">
                    </div>
                     <label for="verfuegbarkeit" class="label_artikel_verwalten">Verf?gbarkeit:</label>

                    <div class="form-group">
                         <select class="form-control" name="verfuegbarkeit" id="verfuegbarkeit" required>
                             {foreach $status as $lager}
                                 {if $articleInfo.art.verfuegbarkeit eq $lager.Status}
                                     <option value="{$lager.Status}" selected="selected">{$lager.Status}</option>
                                 {else}
                                     <option value="{$lager.Status}">{$lager.Status}</option>
                                 {/if}
                             {/foreach}
                         </select>
                    </div>
                        <button class="btn btn-primary" id="artikel_speichern" value="{$articleInfo.art.artikelnr}">Speichern</button>
                        <input class="btn btn-secondary" id="zurück" type="button" value="Zurück"
                     onclick="window.location.href='index.php?page=artikel_verwalten'">
                </form>
            </div>
        </div>
    </div>
</div>
{include file="footer.tpl"}
