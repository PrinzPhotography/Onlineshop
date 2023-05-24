{include file="header.tpl"}
<link rel="stylesheet" href="/css/delivery_address_form.css">
<script src="/js/set_delivery_address.js"></script>
<div class="container-fluid">
    {foreach $deliveryAddress as $address}
        <div class="container" id="newDeliveryAddress">
            <form>
                <div class="card">
                    <div class="card-header">
                        <strong>Lieferadresse bearbeiten</strong>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="phone">Telefon</label>
                            <input name="phone" type="tel"  class="form-control" id="phone" value="{$address.telefon}">
                        </div>
                        <div class="form-group">
                            <label for="street">Strasse</label>
                            <input name="street"  class="form-control" id="street" value="{$address.strasse}">
                        </div>
                        <div class="form-group">
                            <label for="city">Stadt</label>
                            <input name="city"  class="form-control" id="city" value="{$address.stadt}">
                        </div>
                        <div class="form-group">
                            <label for="zipCode">PLZ</label>
                            <input name="zipCode"  class="form-control" id="zipCode" value="{$address.plz}">
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="button" id="saveEdit" class="btn btn-primary" value="Speichern">
                    </div>
                </div>
            </form>
        </div>
    {/foreach}
</div>

{include file="footer.tpl"}