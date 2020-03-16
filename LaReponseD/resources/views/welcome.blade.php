@extends('layouts.app')

@section('content')
    <div class="content">
        <div class="title m-b-md">
            La Réponse D
        </div>
        <section class="section-content">
            <div class="container">

                <header class="section-heading">
                    <h3 class="section-title mb-3">Catégorie</h3>
                </header><!-- sect-heading -->


                <div class="row">
                    <div class="col-md-3">
                        <div href="/quiz/categorie/jeu" class="card card-product-grid">
                            <a href="/quiz/categorie/jeu" class="img-wrap"> <img src="{{ asset('/images/unidab.PNG')  }}" width="200"> </a>
                            <figcaption class="info-wrap">
                                <a href="/quiz/categorie/jeu">Jeux</a>
                            </figcaption>
                        </div>
                    </div> <!-- col.// -->
                    <div class="col-md-3">
                        <div href="/quiz/categorie/internet" class="card card-product-grid">
                            <a href="/quiz/categorie/internet" class="img-wrap"> <img src="{{ asset('/images/unidab.PNG')  }}" width="200"> </a>
                            <figcaption class="info-wrap">
                                <a href="internet">Internet</a>
                            </figcaption>
                        </div>
                    </div> <!-- col.// -->
                    <div class="col-md-3">
                        <div href="/quiz/categorie/cuisine" class="card card-product-grid">
                            <a href="/quiz/categorie/cuisine" class="img-wrap" > <img src="{{ asset('/images/unidab.PNG')  }}" width="200"> </a>
                            <figcaption class="info-wrap">
                                <a href="/quiz/categorie/cuisine">Cuisine</a>
                            </figcaption>
                        </div>
                    </div> <!-- col.// -->
                    <div class="col-md-3">
                        <div href="/quiz/categorie/sport" class="card card-product-grid">
                            <a href="/quiz/categorie/sport" class="img-wrap"> <img src="{{ asset('/images/unidab.PNG')  }}" width="200"> </a>
                            <figcaption class="info-wrap">
                                <a href="/quiz/categorie/sport">Sport</a>
                            </figcaption>
                        </div>
                    </div> <!-- col.// -->
                </div> <!-- row.// -->


                <div class="row">

                </div><!--row-->
            </div> <!-- container .//  -->
        </section>

    </div>
</div>
@endsection