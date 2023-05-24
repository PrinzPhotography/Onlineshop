{include file="header.tpl"}
<link rel="stylesheet" type="text/css" href="../css/registration.css">
<link rel="stylesheet" type="text/css" href="../css/login.css">
{*<div class="wrapper ">
    <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->

        <!-- Login Form -->
        <form>
            <input type="email" id="exampleInputEmail2" placeholder="Anmelden">
            <input type="password" id="exampleInputPassword2"   placeholder="Passwort">
            <input type="button"  id="btn_login" value="Anmelden">
        </form>

        <!-- Remind Passowrd -->
        <div id="formFooter">
            <a class="underlineHover" href="#">Forgot Password?</a>
        </div>
    </div>
</div>*}
<div class="container">
    <div class="card" id="card_registrieren">
        <h5 class="card-header">Registrieren</h5>
        <div class="card-body">
            <div class="col-lg-8
           m-auto d-block">
                <form id="form_registrieren">
                    <div class="form-group">
                        <label for="firstname">Vorname:</label>
                        <input type="text" name="firstname" id="firstname" class="form-control">
                        <h6 id="usercheck1" style="color: red;">**Vorname ist nicht ausgefüllt</h6>
                    </div>

                    <div class="form-group">
                        <label for="lastname">Nachname:</label>
                        <input type="text" name="lastname" id="lastname" class="form-control">
                        <h6 id="usercheck2" style="color: red;">**Nachname ist nicht ausgefüllt</h6>
                    </div>

                    <div class="form-group">
                        <label for="user">Email:</label>
                        <input type="email" name="email" id="email" required class="form-control">
                        <small id="emailvalid" class="form-text
                 invalid-feedback">
                            Ihre Email muss eine gültige Email sein
                        </small>
                        <h6 id="emailcheck" style="color: red;">**Bitte Email einfügen</h6>
                        <h6 id="email_not_available" style="color: red; display: none">**Email ist bereits vergeben</h6>
                    </div>

                    <div class="form-group">
                        <label for="password">Passwort:</label><br>
                        <p>Passwort muss mind. aus 8 Zeichen, einer Zahl,<br>
                            einem Groß- und Kleinbuchstaben und Sonderzeichen ("!",".","_") bestehen.
                        </p>
                        <input type="password" name="pass" id="password" class="form-control">
                        <h6 id="passcheck" style="color: red;">**Bitte füllen sie ihr Passwort aus</h6>
                        <h6 id="is_invalid" style="color: red; "></h6>
                    </div>

                    <div class="form-group">
                        <label for="conpassword">Passwort wiederholen:</label>
                        <input type="password" name="conpassword" id="conpassword" class="form-control">
                        <h6 id="conpasscheck" style="color: red;">**Passwörter stimmen nicht miteinander überein</h6>
                    </div>

                    <input type="button" id="rgn_btn" value="Registrieren" class="btn btn-primary">
                    <input id="btn_lgn" type="button"  class="btn btn-secondary" value="Anmelden">
                </form>
            </div>
        </div>
    </div>
</div>
{include file="footer.tpl"}

