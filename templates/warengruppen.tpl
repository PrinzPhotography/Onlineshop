{include file="header.tpl"}
<script src="/js/warengruppe_verwalten.js"></script>
<link rel="stylesheet" type="text/css" href="../css/warengruppe_verwalten.css">
<div class="container-fluid" id="warengruppen">
    {foreach $warengruppen as $warengruppe}
    <div class="warengruppe col-md-2">
        <div class="details_warengruppe">
                <ul>
                        <li><b>Warengruppe:</b><br><i>{$warengruppe.warengruppe}</i></li>
                        <li><b>Mehrwertsteuer:</b><br>{$warengruppe.Mwst}</li>
                        <li><b>Rabatt %:</b><br>{$warengruppe.rabatt}</li>
                </ul>
        </div>
        <button class="btn_article_mainsite btn btn-primary" onclick="window.location.href='index.php?page=warengruppe_verwalten&warengruppe={$warengruppe.warengruppe}'" >Bearbeiten</button>
        </div>
    {/foreach}
</div>
{include file="footer.tpl"}