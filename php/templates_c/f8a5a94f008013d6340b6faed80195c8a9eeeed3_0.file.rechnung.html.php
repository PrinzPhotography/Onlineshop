<?php
/* Smarty version 3.1.40, created on 2022-05-18 11:47:26
  from 'C:\var\www\azubi-shop\dokumente\rechnung.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_6284c0ae8d3f04_95694860',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f8a5a94f008013d6340b6faed80195c8a9eeeed3' => 
    array (
      0 => 'C:\\var\\www\\azubi-shop\\dokumente\\rechnung.html',
      1 => 1652867245,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_6284c0ae8d3f04_95694860 (Smarty_Internal_Template $_smarty_tpl) {
?><html lang="en">
    <head>
        <link rel="stylesheet" type="text/css" href="../vendor/dompdf/dompdf/src/Css/rechnung.css">
        <title>
            Rechnung
        </title>
        <style>
            .firma {
                text-decoration: underline;
                font-size: 10px;
                width: auto;
            }
            .kunde {
                height: auto;
                width: auto;
                font-size: 15px;
                margin-top: 3%;
            }
            .anschrift {
                float: left;
                margin-top: 5%;
            }
            p {
                margin: 0;
                padding: 0;
            }
            .logo {
                width:  100%;
                height: 100px;
            }
            .logo img{
                width:  100px;
                height: 100px;
                float:  right;
            }
            .ab-infos {
                border: solid black 1px;
                width: 40%;
                height: 160px;
                float:left;
                margin-top: 5%;
                margin-left: 27%;
            }
            .beschreibung {
                border-bottom: solid black 1px;
                text-align: center;
                font-size: 20px;
                padding-top: 2%;
                padding-bottom: 2%;
            }
            .daten {
                margin-top: 2%;
                margin-bottom: 1%;
            }
            .unsere-daten {
                font-size: 13px;
            }
            .text {
                font-size: 13px;
            }
            .content table {
                width: 100%;
                margin-top: 3%;
            }
            .content thead {
                font-size: 13px;
                border: solid black 1px;
            }
            .content th {
                margin: 0;
            }
            .footer {
                font-size: 10px;
                position: absolute;
                bottom: 1%;
                width: 100%;
                height: auto;
            }
            .address {
                float: left;
            }
            .contact {
                float: left;
                margin-left: 7%;
            }
            .bank {
                float: left;
                margin-left: 7%;
            }
            .gesellschaft {
                float: left;
                margin-left: 7%;
            }
            .infos {
                font-size: 15px;
                width: 100%;
                margin-left: 4%;
                margin-top: 2%;
            }
        </style>
    </head>
    <body>
        <div class="logo">
            <img src="../vendor/dompdf/dompdf/src/Image/shoplogo.png">
        </div>
        <div class="anschrift">
            <div class="firma">
                Azubi-Shop GmbH, <?php echo $_smarty_tpl->tpl_vars['address']->value['strasse'];?>
, <?php echo $_smarty_tpl->tpl_vars['address']->value['plz'];?>
 <?php echo $_smarty_tpl->tpl_vars['address']->value['stadt'];?>

            </div>

            <div class="kunde">
                    <p><?php echo $_smarty_tpl->tpl_vars['kundenadresse']->value['vorname'];?>
 <?php echo $_smarty_tpl->tpl_vars['kundenadresse']->value['nachname'];?>
</p>
                    <p><?php echo $_smarty_tpl->tpl_vars['kundenadresse']->value['strasse'];?>
</p>
                    <p><?php echo $_smarty_tpl->tpl_vars['kundenadresse']->value['plz'];?>
 <?php echo $_smarty_tpl->tpl_vars['kundenadresse']->value['stadt'];?>
</p>
            </div>
        </div>

        <div class="ab-infos">
            <div class="beschreibung">
                <b>Rechnung</b>
            </div>
            <div class="infos">
                <table>
                    <tr>
                        <td style="text-align: left;">
                            <div>Kunden-Nr.</div>
                            <div><?php echo $_smarty_tpl->tpl_vars['kundennummer']->value['id'];?>
</div>
                        </td>
                        <td style="text-align: left;">
                            <div>Rechnungs-Nr.</div>
                            <div><?php echo $_smarty_tpl->tpl_vars['rechnungsnummer']->value['rechnungsnummer'];?>
</div>
                        </td>
                        <td style="text-align: right;">
                            <div>Datum</div>
                            <div><?php echo $_smarty_tpl->tpl_vars['datum']->value;?>
</div>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">
                            <div>Auftrags-Nr.</div>
                            <div><?php echo $_smarty_tpl->tpl_vars['auftragsnummer']->value['auftragsnummer'];?>
</div>
                        </td>
                        <td style="text-align: left;">
                            <div>Lieferschein-Nr.</div>
                            <div>34545673</div>
                        </td>
                        <td style="text-align: right;">
                            <div>Lieferdatum</div>
                            <div>18.05.2002</div>
                        </td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">
                            <div>&nbsp;</div>
                        </td>
                        <td style="text-align: left;">
                            <div>&nbsp;</div>
                        </td>
                        <td style="text-align: right;">
                            <div></div>
                            <div></div>
                        <td style="text-align: right;">
                            <div></div>
                            <div></div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <div style="clear:both;"></div>
        <div class="daten">
            <div class="unsere-daten">
                <table>
                    <tr>
                        <td><b>Sachbearbeiter</b></td>
                        <td>:</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['sachbearbeiter']->value['nachname'];?>
</td>
                    </tr>
                    <tr>
                        <td><b>Telefon</b></td>
                        <td>:</td>
                        <td>01636123321</td>
                    </tr>
                    <tr>
                        <td><b>E-Mail</b></td>
                        <td>:</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['sachbearbeiter']->value['email'];?>
</td>
                    </tr>
                    <tr>
                        <td><b>Bestelldatum</b></td>
                        <td>:</td>
                        <td><?php echo $_smarty_tpl->tpl_vars['kundennummer']->value['bestell_datum'];?>
</td>
                    </tr>
                    <tr>
                        <td><b>Auftrag/Lief.</b></td>
                        <td>:</td>
                        <td>12345/1</td>
                    </tr>
                    <tr>
                        <td><b>Versandart</b></td>
                        <td>:</td>
                        <td>DHL</td>
                    </tr>
                    <tr>
                        <td><b>Verpackungsart</b></td>
                        <td>:</td>
                        <td>Paket</td>
                    </tr>
                    <tr>
                        <td><b>Lieferbedingung</b></td>
                        <td>:</td>
                        <td>Kostenloser Versand</td>
                    </tr>
                    <tr>
                        <td><b>Lieferschein</b></td>
                        <td>:</td>
                        <td>344434533 / 11.05.2022</td>
                    </tr>
                </table>
            </div>
                    </div>
        <div class="text">
            <p>Wir danken für Ihren Auftrag, den wir zu unseren Allgemeinen Verkaufsbedingungen, einsehbar unter www.demandsoftware.de ->
                AGB, wie folgt ausführten. Bezüglich der Entgeltminderung verweisen wir auf unsere aktuellen Zahlungs- und
                Konditionsvereinbarungen.</p>
        </div>
        <div class="text">
            <p></p>
        </div>
        <div class="content">
            <table>
                <thead>
                    <tr>
                        <th style="width: 10mm; text-align: left">Pos</th>
                        <th style="text-align: left">Artikel / Bezeichnung</th>
                        <th style="width: 25mm; text-align: right;">Menge</th>
                        <th style="width: 15mm; text-align: right;">ME</th>
                        <th style="width: 35mm; text-align: right;">Einzelpreis EUR</th>
                        <th style="width: 35mm; text-align: right;">Gesamtpreis EUR</th>
                    </tr>
                </thead>
                <tbody>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['positionen']->value, 'position');
$_smarty_tpl->tpl_vars['position']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['position']->value) {
$_smarty_tpl->tpl_vars['position']->do_else = false;
?>
                    <tr>
                        <td>1</td>
                        <td style="text-align: left;">
                            <p><?php echo $_smarty_tpl->tpl_vars['position']->value['artikelnr'];?>
</p>
                            <p><?php echo $_smarty_tpl->tpl_vars['position']->value['artikelname'];?>
</p>
                            <p><?php echo $_smarty_tpl->tpl_vars['position']->value['artikelbez'];?>
</p>
                        </td>
                        <td style="text-align:right"><?php echo $_smarty_tpl->tpl_vars['position']->value['menge'];?>
</td>
                        <td style="text-align:right">Stück</td>
                        <td style="text-align:right"><?php echo $_smarty_tpl->tpl_vars['position']->value['preis'];?>
</td>
                        <td style="text-align:right"><?php echo $_smarty_tpl->tpl_vars['position']->value['Gesamtpreis'];?>
</td>
                    </tr>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </tbody>
            </table>
            <div style="height: 120px;">
                <div  style="float: right; width:90mm; height: 70px; margin-top:5mm; border-bottom: solid black 1px; border-top: solid black 1px">
                    <table style="margin:0">
                        <tr>
                            <td style="text-align:right; padding: 1%"><b>Nettowert:</b></td>
                            <td style="text-align:right; padding: 1%"><b><?php echo $_smarty_tpl->tpl_vars['nettowert']->value;?>
</b></td>
                        </tr>
                        <tr>
                            <td style="text-align:right; border-bottom: solid black 2px; padding: 1%"><b>zzgl. 19% MWST:</b></td>
                            <td style="text-align:right; border-bottom: solid black 2px; padding: 1%"><b><?php echo $_smarty_tpl->tpl_vars['mwst']->value;?>
</b></td>
                        </tr>
                        <tr>
                            <td style="text-align:right; padding: 3%"><b>Rechnungsbetrag EUR:</b></td>
                            <td style="text-align:right; padding: 3%"><b><?php echo $_smarty_tpl->tpl_vars['rechnungsbetrag']->value;?>
</b></td>
                        </tr>
                    </table>
                </div>
            </div>

        </div>
        <div class="text" style="width: 100%">
            <p>Zahlungsbedingungen</p>
            <p>5 Tage 5% Skonto</p>
        </div>
        <div class="footer">
            <div class="address">
                <p style="color: orangered">Azubi-Shop GmbH</p>
                <p>Am Tannenkamp 27, 49479 Steinfeld</p>
            </div>
            <div class="contact">
                <p>Tel: 01636123321</p>
                <p>info@azubi-shop.com</p>
                <p>www.azubi-shop.com</p>
            </div>
            <div class="bank">
                <p>Oldenburgische Landesbank</p>
                <p>IBAN: DE90 2802 0050 3108 4288 00</p>
                <p>BIC : OLBODEH0XXX</p>
            </div>
            <div class="gesellschaft">
                <p>Sitz der Gesellschaft: Steinfeld/Oldb</p>
                <p>HRB-Nr. 207997 Amtsgericht Oldenburg</p>
                <p>Geschäftsführer: Reinhard Wagner</p>
                <p>Ust-ID-Nr : DE 239 585 877</p>
            </div>
        </div>
    </body>
</html><?php }
}
