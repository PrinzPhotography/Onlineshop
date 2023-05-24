<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>PDF</title>
    <link rel="stylesheet" type="text/css" href="../vendor/dompdf/dompdf/src/Css/pdf.css">
</head>
<body>
        <div class="logo">
            <img src="../vendor/dompdf/dompdf/src/Image/shoplogo.png">
        </div>
        <div class="anschrift">
            <div class="firma">
                <span>Azubi-Webshop  &bull;</span> Musteradresse  &bull; {$test}
            </div>

            <div class="kunde">
                <p>{$info['Vorname']} {$info['Nachname']}</p>
                <p>{$info['Strasse']}</p>
                <p>{$info['Plz']} {$info['Stadt']}</p>
                <p>0{$info['Telefon']}</p>
            </div>
        </div>
        <div class="ab-infos">
            <div class="beschreibung">
                Auftragsbest&auml;tigung
            </div>
            <div class="infos">
                <table>
                    <tr>
                        <td style="text-align: left;">Kunden-Nr</td>
                        <td style="text-align: left;">Auftrags-Nr</td>
                        <td style="text-align: right;">Datum</td>
                    </tr>
                    <tr>
                        <td style="text-align: left;">{$info['Kunden-Nr']}</td>
                        <td style="text-align: left;">{$info['Bestell-Nr']}</td>
                        <td style="text-align: right;">{$info['Bestelldatum']|date_format:"%e.%m.%Y"}</td>
                    </tr>
                </table>
            </div>
        </div>
        <div style="clear:both;"></div>
        <div class="ihre-daten">
            <p>ifdgsfdg</p>
            {*        <p>hsfgsf</p>
                    <p>rsfgsg</p>
                    <p>esfgs</p>
                    <p>dfggsdfg</p>
                    <p>asfgsfgsfg</p>*}
        </div>

        <div class="daten">
            <div class="unsere-daten">
                <table>
                    <tr>
                        <td><b>etwas</b></td>
                        <td>:</td>
                        <td>Gutes</td>
                    </tr>
                </table>
            </div>
        </div>
        <div class="text">

        </div>

        <div class="content">
            <table>
                <thead>
                <tr>
                    <th style="width: 5mm; text-align: center;">Pos.</th>
                    <th>Artikel/Bezeichnung</th>
{*                    <th style="width: 15mm;">Termin</th>*}
                    <th style="width: 15mm; text-align: right;">Menge</th>
                    <th style="width: 15mm; text-align: center;">ME</th>
                    <th style="width: 25mm; text-align: right;">Einzelpreis EUR</th>
                    <th style="width: 25mm; text-align: right;">Gesammtpreis EUR</th>
                </tr>
                </thead>
                <tbody>
                {foreach $info['Artikel'] as $art}
                    <tr>
                        <td style="padding-top: 5px; text-align: center;">{$art['Position']}</td>
                        <td style="text-align: left;">
                            <p>{$art['Artikel-Nr']}</p>
                            <p>{$art["Artikel-Name"]}</p>
                            <p>{$art["Artikel-Bez"]}</p>
                        </td>
{*                        <td style="text-align: left;">{$art['Artikel-Nr']}</td>*}
                        <td colspan="4" style="padding-top: 0; padding-right: 0; padding-left: 0">
                            <table style="padding: 0; margin: 0 0 0 0; width: 100%">
                                <tr>
                                    <td style="text-align: center; width: 15mm">{number_format({$art["Menge"]}, 2, ",", ".")}</td>
                                    <td style="width: 5mm">ST</td>
                                    <td style="width: 21mm; text-align: right">{number_format({$art["PE"]}, 2, ",", ".")}</td>
                                    <td style="padding-right: 0; width: 23mm; text-align: right">{number_format({$art["PG"]}, 2, ",", ".")}</td>
                                </tr>
                                {if $art['Rabatt'] != 0}
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td colspan="2">{number_format({$art["Rabatt"]}, 2, ",", ".")}% Rabatt</td>
                                        <td style="text-align: right; padding-right:0;">-{number_format({$art["RbG"]}, 2, ",", ".")}</td>
                                    </tr>
                                {/if}
                            </table>
                        </td>

                    </tr>
                {/foreach}
                </tbody>
            </table>
            <div  style="float: right; width:90mm; margin-top:3mm;">
{*                <table class="rechnungsbetrag" style="border: 0px">
                    <tr>
                        <td style="width: 50mm; text-align: right;">
                            Rabatt:</td>
                        <td style="text-align: right; width: 30mm; padding-right:0;">
                            EUR
                            *}{*{number_format({$headData["ERM_POSWERT_I"]}, 2, ",", ".")}*}{*
                        </td>
                    </tr>
                </table>*}
                <table class="rechnungsbetrag" style="margin-top:0; border-bottom: 2px solid #000;">
                    <tr>
                        <td style="width: 50mm; text-align: right;">
                            Nettowert:
                        </td>
                        <td style="text-align: right; width: 30mm; padding-right:0;">
                            {number_format(($info['Nettopreis']), 2, ",", ".")}
                        </td>
                    </tr>

                    {if $info['Mwsts'][7] != 0}
                        <tr>
                            <td style="width: 50mm; text-align: right;">
                                7% MwSt auf {number_format(($info['Nettopreis']), 2, ",", ".")}:
                            </td>
                            <td style="text-align: right; width: 30mm; padding-right:0;">
                                {number_format(($info['Mwsts'][7]), 2, ",", ".")}
                            </td>
                        </tr>
                    {/if}
                    {if $info['Mwsts'][19] != 0}
                        <tr>
                            <td style="width: 50mm; text-align: right;">
                                19% MwSt auf {number_format(($info['Nettopreis']), 2, ",", ".")}:
                            </td>
                            <td style="text-align: right; width: 30mm; padding-right:0;">
                                {number_format(($info['Mwsts'][19]), 2, ",", ".")}
                            </td>
                        </tr>
                    {/if}
                </table>
                <table class="rechnungsbetrag" style="margin-top:0; margin-bottom: 5mm; border-top: 0px solid #000;">
                    <tr>
                        <td style="width: 50mm; text-align: right;">
                            Gesammtbetrag in EUR:
                        </td>
                        <td style="text-align: right; width: 30mm; padding-right:0;">
                            {$gesammt = $info['Mwst-Zusatz'] + $info['Nettopreis']}
                            {number_format(($gesammt), 2, ",", ".")}
                        </td>
                    </tr>
                </table>
            </div>
        </div>

</body>
</html>