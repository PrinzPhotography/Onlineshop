<?php
/* Smarty version 3.1.40, created on 2021-10-27 13:02:15
  from 'C:\var\www\uebungen\testSmarty\footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.40',
  'unifunc' => 'content_617931b746a802_22803762',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b1499c0c5ad5b020778257d01114c5a93f65791f' => 
    array (
      0 => 'C:\\var\\www\\uebungen\\testSmarty\\footer.tpl',
      1 => 1635332533,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_617931b746a802_22803762 (Smarty_Internal_Template $_smarty_tpl) {
?>    <div id="footer">
        <div id="leftFooter">
            <span id="startseiteFooter" onclick="window.location.href='index.php?page=Plattensammlung_index'">Startseite</span>
            <span id="impressum" onclick="window.location.href='index.php?page=Impressum'">Impressum</span>
        </div>
        <div id="rightFooter">
            <span id="contact" onclick="window.location.href='index.php?page=Kontakt'">Kontakt</span>
            <span id="help" onclick="window.location.href='index.php?page=Hilfe'">Hilfe</span>
        </div>
    </div>
    <div id="fillFooter">
    </div>
    <div id="Az">
    </div>
    <div id="overlay">
        <div id="popup">
            <p id="canceltext">Möchtest du die Platte<br><br><span id="platte"></span><br><br>wirklich aus deiner Sammlung entfernen?</p>
            <div id="buttonPop">
                <input type="button" value="Löschen" class="button3c" id="unsub">
                <input type="button" value="Abbrechen" class="button3c" id="abbrechen" onclick="window.location.href='index.php?page=Plattensammlung_index'"></a>
            </div>
        </div>
        <div id="popup2">
            <p id="canceltext2">Bitte gib dein Passwort zur Bestätigung ein:</p>
            <input type="password" name="passwordDelete" id="passwordDelete" placeholder="Passwort">
            <div id="buttonPop2">
                <input type="button" value="Löschen" class="button3c" id="unsub2">
                <input type="button" value="Abbrechen" class="button3c" id="abbrechen2" onclick="window.location.href='index.php?page=Plattensammlung_index'"></a>
            </div>
        </div>
    </div>
</div>
</body>
</html><?php }
}
