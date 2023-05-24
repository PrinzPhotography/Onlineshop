{include file="header.tpl"}
<link rel="stylesheet" type="text/css" href="/css/login.css">
<div class="container">
    <div class="card" id="card_login">
        <h5 class="card-header">Login</h5>
        <div class="card-body">
            <div class="col-lg-8
           m-auto d-block">
                <form id="form_login">

                    <div class="form-group">
                        <label for="email">
                            Email:
                        </label>
                        <input type="email" name="email"
                               id="email" required
                               class="form-control">
                        <small id="emailvalid" class="form-text
                text-muted invalid-feedback">
                            Ihre Email muss eine gültige Email sein
                        </small>
                        <h6 id="emailcheck" style="color: red;" >
                            **Bitte Email einfügen
                        </h6>
{*                        <h6 id="email_is_wrong" style="color: red; display: none" >
                            **Email ist nicht vergeben
                        </h6>*}
                    </div>

                    <div class="form-group">
                        <label for="password">
                            Passwort:
                        </label>
                        <input type="password" name="pass"
                               id="password" class="form-control">
                        <h6 id="passcheck" style="color: red;">
                            **Bitte füllen sie ihr Passwort aus
                        </h6>
                        <h6 id="userdata_is_wrong" style="color: red; display: none">
                            **Benutzerdaten sind falsch
                        </h6>
                    </div>

                    <input type="button" id="lgn_btn"
                           value="Anmelden" class="btn btn-primary">
                    <input id="btn_rgn" type="button"  class="btn btn-secondary" value="Registrieren">
                </form>
            </div>
        </div>
    </div>
</div>
{include file="footer.tpl"}