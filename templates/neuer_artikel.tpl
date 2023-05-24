{include file="header.tpl"}
<script src="/js/neuer_artikel.js"></script>
<link rel="stylesheet" type="text/css" href="../css/neuer_artikel.css">
<div class="container-fluid">
    <div class="card text-center" id="card">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" role="tab" data-bs-toggle="tab" href="#art_anlegen">Artikel anlegen</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" role="tab" data-bs-toggle="tab" href="#warengrp_anlegen">Warengruppe anlegen</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="art_anlegen">
                    <div id="div_artikel">
                        <form  id="new_article">
                            <label for="artikel_name" class="label_artikel_anlegen">Artikel Name:</label>
                            <div class="form-group">
                                <input class="form-control" type="text" name="artikel_name" id="artikel_name" placeholder="Art.-Name"
                                       required>
                            </div>
                            <label for="artikel_bez" class="label_artikel_anlegen">Art.-Bezeichnung:</label>
                            <div class="form-group">
                                <textarea class="form-control" type="text" name="artikel_bez" id="artikel_bez" placeholder="Art.-Bez." required></textarea>
                            </div>
                            <label for="artikel_beschreibung" class="label_artikel_anlegen">Beschreibung:</label>
                            <div class="form-group">
                                <textarea class="form-control" type="text" name="artikel_beschreibung" id="artikel_beschreibung" placeholder="Beschreibung" required></textarea>
                            </div>
                            <label for="hersteller" class="label_artikel_anlegen">Hersteller:</label>
                            <div class="form-group">
                                <input class="form-control" type="text" name="hersteller" id="hersteller" placeholder="Hersteller"
                                       required>
                            </div>
                            <label for="preis" class="label_artikel_anlegen">Preis:</label>
                            <div class="form-group">
                                <input class="form-control" type="number" step="any" name="preis" id="preis" placeholder="Preis €"
                                       required>
                            </div>
                            <label for="rabatt" class="label_artikel_anlegen">Rabatt:</label>
                            <div class="form-group">
                                <select class="form-control rabatt" type="number" step="any" name="rabatt" id="rabatt_art"
                                       required>
                                    {foreach $Info.alleRab as $rabatte}
                                        <option value="{$rabatte.rab_id}">{$rabatte.rabatt}</option>
                                    {/foreach}
                                </select>
                            </div>
                            <label for="lagerbestand" class="label_artikel_anlegen">Lagerbestand:</label>
                            <div class="form-group">
                                <input class="form-control" type="number" name="lagerbestand" id="lagerbestand" placeholder="Lagerbestand"
                                       required>
                            </div>
                            <label for="verfuegbarkeit" class="label_artikel_anlegen">Verfügbarkeit:</label>
                            <div class="form-group">
                                <select class="form-control" name="verfuegbarkeit" id="verfuegbarkeit" required>
                                    <option>Auf Lager</option>
                                    <option>Bald wieder lieferbar</option>
                                    <option>Zurzeit nicht im Angebot</option>
                                </select>
                            </div>
                            <label for="warengruppeArt" class="label_artikel_anlegen">Warengruppe:</label>
                            <div class="form-group">
                                <select class="form-control" name="warengruppeArt" id="warengruppeArt" required>
                                    {foreach $Info.wareng as $wareng}
                                        <option value="{$wareng.id}">{$wareng.warengruppe}</option>
                                    {/foreach}
                                </select>
                            </div>
                            <label for="image" class="label_artikel_anlegen">Produktfoto:</label>
                            <div class="form-group">
                                <input class="form-control" type="file" name="image" id="image" multiple>
                            </div>
                            <input class="btn btn-primary artikel_anlegen" id="artikel_anlegen" type="button" value="Artikel anlegen">
                            <input class="btn btn-secondary artikel_anlegen" id="zurück" type="button" value="Zurück" onclick="window.location.href='index.php?page=index'">
                        </form>
                    </div>
                </div>
                <div role="tabpanel" class="tab-pane fade" id="warengrp_anlegen">
                    <div id="div_warengruppe">
                        <form id="neue_warengruppe">
                            <label for="warengruppeWg" class="label_artikel_anlegen">Warengruppe:</label>
                            <div class="form-group">
                                <input class="input_field form-control" type="text" name="warengruppeWg" id="warengruppeWg" placeholder="Warengruppe"
                                       required>
                            </div>
                            <label for="mwst" class="label_artikel_anlegen">Mehrwertsteuer %:</label>
                            <div class="form-group">
                                <select class="form-control mws" name="mwst" id="mwst" required>
                                    {foreach $Info.steuer as $steuer}
                                        <option value="{$steuer.Mwst_id}">{$steuer.Mwst}</option>
                                    {/foreach}
                                </select>
                            </div>
                            <label for="rabatt" class="label_artikel_anlegen">Rabatt %:</label>
                            <div class="form-group">
                                <select class="form-control rabatt" name="rabatt" id="rabatt_warengrp" required>
                                    {foreach $Info.alleRab as $rabatte}
                                        <option value="{$rabatte.rab_id}">{$rabatte.rabatt}</option>
                                    {/foreach}
                                </select>
                            </div>
                            <br>
                            <input class="btn btn-primary artikel_anlegen" id="warengruppe_anlegen" type="button" value="Warengruppe anlegen">
                            <input class="btn btn-secondary artikel_anlegen" id="zurück" type="button" value="Zurück" onclick="window.location.href='index.php?page=neuer_artikel'">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{include file="footer.tpl"}