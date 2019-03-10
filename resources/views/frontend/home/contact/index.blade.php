@extends('frontend.layout.template')

@section('content')
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="text-center">Контакты</h3>
                    <div class="row">

                        <article class="post">
                            <br>
                            <div class="post-content">
                                <p><i class="fa fa-envelope" aria-hidden="true"></i> maksimov.ilya1@protonmail.com</p>
                                <p><i class="fa fa-github"></i> <a target="_blank" href="https://github.com/ilyaMaksimov">GitHub</a></p>
                            </div>

                        </article>
                    </div>

                </div>
                @include('frontend.layout._sidebar')
            </div>
        </div>
    </div>
@endsection