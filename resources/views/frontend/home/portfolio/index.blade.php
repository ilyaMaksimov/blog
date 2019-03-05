@extends('frontend.layout.template')

@section('content')
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        {{--   @foreach($posts as $post)--}}
                        <div class="col-md-6">
                            <article class="post post-grid">
                                <div class="post-thumb">
                                    <a href="http://maksimov-ilya.ru/">
                                        <img src="{{\App\Components\Image::getPath('blog.png')}}" alt=""></a>
                                    <a target="_blank" href="http://maksimov-ilya.ru/" class="post-thumb-overlay text-center">
                                        <div class="text-uppercase text-center">Посмотреть</div>
                                    </a>
                                </div>
                                <div class="post-content">
                                    <header class="entry-header text-center text-uppercase">
                                        <h1 class="entry-title">
                                            <a target="_blank" href="http://maksimov-ilya.ru/">Блог</a>
                                        </h1>
                                    </header>
                                    <div class="entry-content">
                                        <div style="height: 100px">
                                            <i class="fa fa-check-circle" style="color:green" aria-hidden="true"></i>
                                            Laravel 5.7
                                            <br>
                                            <i class="fa fa-check-circle" style="color:green" aria-hidden="true"></i>
                                            PHP 7
                                            <br>
                                            <i class="fa fa-check-circle" style="color:green" aria-hidden="true"></i>
                                            MySQL 5.7
                                            <br>
                                            <i class="fa fa-check-circle" style="color:green" aria-hidden="true"></i>
                                            ORM Doctrine2
                                            <br>
                                            <i class="fa fa-check-circle" style="color:green" aria-hidden="true"></i>
                                            Nginx
                                            <br>
                                        </div>
                                        <hr>
                                        <div class="social-share">

                                            <ul class="text-center pull-right">
                                                <li>
                                                    <a class="s-instagram" target="_blank" href="http://maksimov-ilya.ru/">
                                                        <i class="fa fa-share" aria-hidden="true"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="ion-social-github" href="#">
                                                        <i class="fa fa-github"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </article>
                        </div>
                        <div class="col-md-6">
                            <article class="post post-grid">
                                <div class="post-thumb">
                                    <a href="http://watch.maksimov-ilya.ru/">
                                        <img src="{{\App\Components\Image::getPath('watch.png')}}" alt=""></a>
                                    <a target="_blank" href="http://maksimov-ilya.ru/" class="post-thumb-overlay text-center">
                                        <div class="text-uppercase text-center">Посмотреть</div>
                                    </a>
                                </div>
                                <div class="post-content">
                                    <header class="entry-header text-center text-uppercase">
                                        <h1 class="entry-title">
                                            <a target="_blank" href="http://watch.maksimov-ilya.ru/">Интернет магазин часов</a>
                                        </h1>
                                    </header>
                                    <div class="entry-content">
                                        <div style="height: 100px">
                                            <i class="fa fa-check-circle" style="color:green" aria-hidden="true"></i>
                                            PHP 5.6
                                            <br>
                                            <i class="fa fa-check-circle" style="color:green" aria-hidden="true"></i>
                                            MySQL
                                            <br>
                                            <i class="fa fa-check-circle" style="color:green" aria-hidden="true"></i>
                                            Самописный фреймворк
                                            <br>
                                            <i class="fa fa-check-circle" style="color:green" aria-hidden="true"></i>
                                            Apache
                                            <br>
                                        </div>
                                        <hr>
                                        <div class="social-share">

                                            <ul class="text-center pull-right">
                                                <li>
                                                    <a class="s-instagram" target="_blank" href="http://watch.maksimov-ilya.ru/">
                                                        <i class="fa fa-share" aria-hidden="true"></i>
                                                    </a>
                                                </li>
                                                {{--<li>
                                                    <a class="ion-social-github" href="#">
                                                        <i class="fa fa-github"></i>
                                                    </a>
                                                </li>--}}
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </article>
                        </div>
                        <div class="col-md-6">
                            <article class="post post-grid">
                                <div class="post-thumb">
                                    <a href="http://maksimov-ilya.ru/">
                                        <img src="{{\App\Components\Image::getPath('shop.png')}}" alt=""></a>
                                    <a target="_blank" href="http://maksimov-ilya.ru/" class="post-thumb-overlay text-center">
                                        <div class="text-uppercase text-center">Посмотреть</div>
                                    </a>
                                </div>
                                <div class="post-content">
                                    <header class="entry-header text-center text-uppercase">
                                        <h1 class="entry-title">
                                            <a target="_blank" href="http://maksimov-ilya.ru/">Интернет магазин сотовых телефонов</a>
                                        </h1>
                                    </header>
                                    <div class="entry-content">
                                        <div style="height: 100px">
                                            <i class="fa fa-check-circle" style="color:green" aria-hidden="true"></i>
                                            PHP 5.6
                                            <br>
                                            <i class="fa fa-check-circle" style="color:green" aria-hidden="true"></i>
                                            MySQL
                                            <br>
                                            <i class="fa fa-check-circle" style="color:green" aria-hidden="true"></i>
                                            Apache
                                            <br>
                                        </div>
                                        <hr>
                                        <div class="social-share">

                                            <ul class="text-center pull-right">
                                                <li>
                                                    <a class="s-instagram" target="_blank" href="http://maksimov-ilya.ru/">
                                                        <i class="fa fa-share" aria-hidden="true"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="ion-social-github" href="#">
                                                        <i class="fa fa-github"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </article>
                        </div>
                    </div>
                    {{--<div class="text-center">{{$posts->links()}}</div>--}}
                </div>
                @include('frontend.layout._sidebar')
            </div>
        </div>
    </div>
@endsection