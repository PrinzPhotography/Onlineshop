{include file="header.tpl"}
<script src="/js/set_delivery_address.js"></script>
<script src="/js/orders.js"></script>
<div class="container">
    <div class="wrapper card">
        <div class="row card-body" id="liefer">
            <h5>Ihre ausgewählte Lieferadresse ist die Grün hinterlegte!</h5>
            <p>Möchten sie eine andere wählen, so klicken sie auf Wählen bei jener Adresse die sie verwenden wollen!</p>
            {if !$deliveryAddresses}
                <h6 style="color: red">Sie haben noch keine Lieferadressen hinterlegt, bitte tuen sie dies zuerst bevor sie weiter machen</h6>
                <p>Klicken sie <a onclick="window.location.href='index.php?page=delivery_address&status=order'" style="color: #0c63e4">hier</a> </p>
            {else}
                {if $adr eq false}
                    <div class="col-3">
                        <div class="card" style="border-color: red">
                            <div class="card-body">
                                <p>Keine Lieferadresse ausgewählt!</p>
                            </div>
                        </div>
                    </div>
                {/if}
                {foreach $deliveryAddresses as $adress}
                    <div class="col-3">
                        {if $adress.favorit eq 'favorit'}
                            <div class="card" style="border-color: green">
                                <div class="card-body">
                                    <ul style="list-style-type:none;">
                                        <li>{$adress.vorname} {$adress.nachname}</li>
                                        <li>{$adress.strasse}</li>
                                        <li>{$adress.plz}, {$adress.stadt}</li>
                                        <li>{$adress.telefon}</li>
                                    </ul>
                                </div>
                            </div>
                        {else}
                            <div class="card">
                                <div class="card-body">
                                    <ul style="list-style-type:none;">
                                        <li>{$adress.vorname} {$adress.nachname}</li>
                                        <li>{$adress.strasse}</li>
                                        <li>{$adress.plz}, {$adress.stadt}</li>
                                        <li>{$adress.telefon}</li>
                                    </ul>
                                </div>
                                <button class="btn btn-secondary favAdr" value="{$adress.adresse_id}">Wählen</button>
                            </div>
                        {/if}
                    </div>
                {/foreach}
            {/if}
        </div>
        <div class="row card-body" id="zahlung">
            <p>Wählen sie ihre Zahlungsart</p>
            {if $zahlung eq false}
                <div class="col-3">
                    <div class="card" style="border-color: red">
                        <div class="card-body">
                            <p>Keine Zahlungsart ausgewählt!</p>
                        </div>
                    </div>
                </div>
            {/if}
            {*foreach available zahlungsart creat these col-3*}
            {foreach $zahlungsarten as $zahlungsart}
                {if $zahlungsart.zahlungsnr eq $zahlung}
                    <div class="col-3">
                            <div class="card" style="border-color: green">
                                <div class="card-body">
                                    <p>{$zahlungsart.art}</p>
                                </div>
                            </div>
                    </div>
                {else}
                    <div class="col-3">
                        <div class="card">
                            <div class="card-body">
                                <p>{$zahlungsart.art}</p>
                            </div>
                            <button class="btn btn-secondary zahlung_art" value="{$zahlungsart.zahlungsnr}">Wählen</button>
                        </div>
                    </div>
                {/if}
            {/foreach}

        </div>
        <div class="row card-body">
            <p>Klicken sie auf weiter um ihren Bestellvorgang fortzuführen!</p>
            <div class="col-4"></div>
            <div class="col-4"></div>
            <div class="col-4">
            <button class="btn btn-primary" style="float: right" id="send_order">Weiter</button>
            </div>
        </div>
    </div>
</div>

{include file="footer.tpl"}