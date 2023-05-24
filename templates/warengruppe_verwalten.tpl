{include file="header.tpl"}
<script src="/js/warengruppe_verwalten.js"></script>
<link rel="stylesheet" type="text/css" href="../css/warengruppe_verwalten.css">
<div class="container-fluid" id="warengruppe">

<div class="card" id="card_warengrp">
    <h5 class="card-header">Warengruppe bearbeiten</h5>
    <div class="card-body">
            <div id="warengruppe_neu" class="container-sm-6">
                <form {*action="../php/artikel_verwalten.php" method="post"*} id="warengruppe_bearbeiten">
                    <label for="warengruppe" class="label_artikel_verwalten">Warengruppe:</label>
                    <div class="form-group">
                        <input class="form-control" type="text" name="warengruppe" id="warengruppe_id" value="{$detail.Warengruppe.warengruppe}"
                                readonly>
                    </div>
                    <label for="mwst" class="label_artikel_verwalten">Mehrwehrtsteuer:</label>
                    <div class="form-group">
                        <label for="Mwst_edit" class="label_artikel_anlegen">Mwst. %:</label>
                        <select class="form-control" name="Mwst_edit" id="Mwst_edit">
                            {foreach $detail.steuer as $rab}
                                {if $detail.Warengruppe.mehrwertsteuer eq $rab.Mwst_id}
                                    <option value="{$rab.Mwst_id}" selected="selected">{$rab.Mwst}</option>
                                {else}
                                <option value="{$rab.Mwst_id}">{$rab.Mwst}</option>
                                {/if}
                            {/foreach}
                        </select>
                    </div>
                    <label for="edit_rabatt" class="label_artikel_verwalten">Rabatt %:</label>
                    <div class="form-group">
                        <select class="form-control" name="edit_rabatt" id="edit_rabatt" required>
                            {foreach $detail.alleRab as $rab}
                                {if {$detail.Warengruppe.rab_id} eq {$rab.rab_id} }
                                    <option value="{$rab.rab_id}" selected="selected">{$rab.rabatt}</option>
                                {else}
                                    <option value="{$rab.rab_id}">{$rab.rabatt}</option>
                                {/if}
                            {/foreach}
                        </select>
                    </div>
                    <input class="btn btn-primary" id="warengruppe_speichern" type="button" value="Speichern">
                    <input class="btn btn-secondary" id="zurück" type="button" value="Zurueck"
                           onclick="window.location.href='index.php?page=warengruppen'">
                </form>
            </div>
        </div>
    </div>
</div>
{include file="footer.tpl"}
