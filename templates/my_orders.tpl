{include file="header.tpl"}

<style>
    .col-md-3 span{
        color: black;
    }
    .col-md-3 span span{
        color: orange;
    }
</style>
<div class="container">

    {foreach $userOrders as $userOrder}
    <div class="row">
        <div class="card">
            <div class="card-body active">
                <div>
                    <div class="row">
                        <div class="col-md-3">
                            <span>Bestellung vom: {$userOrder.bestell_datum|date_format:"%e.%m.%Y"}</span>
                        </div>
                        <div class="col-md-3">
                            <span>Bestellnr: {$userOrder.id}</span>
                        </div>
                        <div class="col-md-3">
                            <span>Status: <span>{$userOrder.status}</span></span>
                        </div>
                        <div class="col-md-3">
                            <button class="btn btn-secondary pdf"> PDF </button>
                        </div>
                        <div class="col-md-3">
                            <span>Kunde: {$userOrder.kunden_nr}</span>
                        </div>
                    </div>
                </div>
{*                    <a href="#" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle sub-btn">Kategorie</a>*}
                    <div class="sub-menu" style="display: block;">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Artikelnr</th>
                                <th scope="col">Artikel</th>
                                <th scope="col">Artikelbez</th>
                                <th scope="col">Menge</th>
                                <th scope="col">Preis ST</th>
                                <th scope="col">Mwst</th>
                                <th scope="col">Rabatt</th>
                                <th scope="col">Preis (inkl. Rabatt)</th>
                                <th scope="col">Preis (inkl. Mwst)</th>
                            </tr>
                            </thead>
                            <tbody>
                            {foreach $userOrderHistory as $orderHistory}
                                {foreach $orderHistory as $position}
                                    {if $userOrder.id eq $position.bestell_nr}
                                        <tr>
                                            <td>{$position.artikel_nr}</td>
                                            <td>{$position.artikelname}</td>
                                            <td>{$position.artikelbez}</td>
                                            <td>{$position.menge}</td>
                                            <td>{$position.preis_stueck}€</td>
                                            <td>{$position.mws}%</td>
                                            <td>{$position.rabatt_bestelldetails}%</td>
                                            <td>{$position.discountPrice|string_format:"%.2f"}€</td>
                                            <td>{$position.total|string_format:"%.2f"}€</td>
                                        </tr>
                                    {/if}
                                {/foreach}
                            {/foreach}
                            {foreach $totalPrices as $price}
                                {if $userOrder.id eq $price.key}
                                    <tr>
                                        <th scope="col">Gesammtpreis alle:(inkl. Mws)</th>
                                        <td>id: {$price.key}</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <th scope="col">{$price.total|string_format:"%.2f"}€</th>
                                    </tr>
                                {/if}
                            {/foreach}

                            </tbody>
                        </table>
                    </div>

            </div>
        </div>
    </div>
    {/foreach}
</div>

{include file="footer.tpl"}