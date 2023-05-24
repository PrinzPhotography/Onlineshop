{include file="header.tpl"}

<link rel="stylesheet" href="/css/profile.css">
<div class="container" >
    <div class="spacing">
        <div class="headliner">
            Mein Profil
        </div>
        <div class="row">
            <div class="col-3">
                <div class="card" onclick="window.location.href='index.php?page=my_orders'">
                    <div class="card-body">
                        <span>Meine Bestellungen</span>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card" onclick="window.location.href='index.php?page=delivery_addresses'">
                    <div class="card-body">
                        <span >Lieferadressen</span>
                    </div>
                </div>
            </div>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        3
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{include file="footer.tpl"}