{include file="header.tpl"}
<script src="../js/artikelseite.js"></script>
<div class="container">
    <div class="row">
        <h5>Neue Artikel:</h5>
        <div class="col">
            <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    {foreach $newArticle as $keyvalue => $article}
                        {if $keyvalue eq 0}
                            <div class="carousel-item active">
                                <div class="card" style="max-height: 300px">
                                    <div class="row g-0">
                                        <div class="col-md-4" style="height: 200px;width: 200px">
                                            <img src="../img/{$article.produktbild}" class="rounded-start img-thumbnail" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">{$article.artikelname}</h5>
                                                <p class="card-text">{$article.artikelbeschreibung}</p>
                                                <p class="card-text"><span class="text-black">{$article.preis}€</span></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-primary zum_artikel" value="{$article.artikelnr}">Zum Artikel</button>
                                    </div>
                                </div>
                            </div>
                        {/if}
                        {if $keyvalue neq 0}
                            <div class="carousel-item">
                                <div class="card" style="max-height: 300px">
                                    <div class="row g-0">
                                        <div class="col-md-4" style="height: 200px;width: 200px">
                                            <img src="../img/{$article.produktbild}" class="rounded-start img-thumbnail" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">{$article.artikelname}</h5>
                                                <p class="card-text">{$article.artikelbeschreibung}</p>
                                                <p class="card-text"><span class="text-black">{$article.preis}€</span> </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary zum_artikel" value="{$article.artikelnr}">Zum Artikel</button>
                                </div>
                            </div>
                        {/if}
                    {/foreach}
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
    <div class="row">
        <h5>Besonders beliebte Artikel in den letzten 30 Tagen:</h5>
        <div class="col">
            <div id="carouselExampleControls2" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    {foreach $favorites as $keyvalue => $favorite}
                        {if $keyvalue eq 0}
                            <div class="carousel-item active">
                                <div class="card" style="max-height: 450px">
                                    <div class="row g-0">
                                        <div class="col-md-4" style="height: 200px;width: 200px">
                                            <img src="../img/{$favorite.produktbild}" class="rounded-start img-thumbnail" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">{$favorite.artikelname}</h5>
                                                <p class="card-text">{$favorite.artikelbeschreibung}</p>
                                                <p class="card-text"><span class="text-black">{$favorite.preis}€</span></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button class="btn btn-primary zum_artikel" value="{$favorite.artikelnr}">Zum Artikel</button>
                                    </div>
                                </div>
                            </div>
                        {/if}
                        {if $keyvalue neq 0}
                            <div class="carousel-item">
                                <div class="card" style="max-height: 450px">
                                    <div class="row g-0">
                                        <div class="col-md-4" style="height: 200px;width: 200px">
                                            <img src="../img/{$favorite.produktbild}" class="rounded-start img-thumbnail" alt="...">
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title">{$favorite.artikelname}</h5>
                                                <p class="card-text">{$favorite.artikelbeschreibung}</p>
                                                <p class="card-text"><span class="text-black">{$favorite.preis}€</span> </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button class="btn btn-primary zum_artikel" value="{$favorite.artikelnr}">Zum Artikel</button>
                                </div>
                            </div>
                        {/if}
                    {/foreach}
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls2" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls2" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</div>

{include file="footer.tpl"}