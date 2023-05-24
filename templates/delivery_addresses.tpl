{include file="header.tpl"}
<link rel="stylesheet" href="/css/profile.css">
<script src="/js/set_delivery_address.js"></script>
<div class="container" >
    <div class="row">
        <div class="col-3" onclick="window.location.href='index.php?page=delivery_address&status=profil'">
            <div class="card">
                <div class="card-body">
                    <br>
                    <br>
                    <strong>Lieferadressen hinzufügen</strong>
                    <br>
                    <br>
                    <br>
                </div>
            </div>
        </div>
        {foreach $deliveryAddresses as $address}
        <div class="col-3">
            <div class="card">
                <div class="card-body">
                    <ul class="list-unstyled components">
                        <li>{$address.vorname} {$address.nachname}</li>
                        <li>{$address.strasse}</li>
                        <li>{$address.plz}, {$address.stadt}</li>
                        <li>Telefon: {$address.telefon}</li>
                        <li><input type="hidden" class="a_id" value="{$address.adresse_id}"></li>
                    </ul>
                    <a class="card-link edit">Bearbeiten</a>
                    <a class="card-link delete">Löschen</a>
                    {if $address.favorit neq 'favorit'}
                        <a class="card-link favorit">Favorit</a>
                    {else}
                        <a class="card-link" style="color: green">Favorit</a>
                    {/if}
                </div>
            </div>
        </div>
        {/foreach}
    </div>
</div>
{include file="footer.tpl"}