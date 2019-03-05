<div class="col-md-4" data-sticky_column>
    <div class="primary-sidebar">

        <aside class="widget news-letter">
            <h3 class="widget-title text-uppercase text-center">Получать новости</h3>
            <form action="{{route('subscribe')}}" method="post">
                {{csrf_field()}}
                <div>
                    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           name="email" value="{{ old('email') }}" placeholder="Your email address" required>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>

                <input type="submit" value="Подписаться сейчас"
                       class="text-uppercase text-center btn btn-subscribe">
            </form>

        </aside>
        <aside class="widget">
            <h3 class="widget-title text-uppercase text-center">Рекомендованные посты</h3>

            <div id="widget-feature" class="owl-carousel">
                @foreach($featuredPosts as $post)
                    <div class="item">
                        <div class="feature-content">
                            <img src="{{\App\Components\Image::getPath($post->getImage())}}" alt="">

                            <a href="{{route('frontend.post.show', $post->getSlug())}}"
                               class="overlay-text text-center">
                                <h5 class="text-uppercase">{{$post->getTitle()}}</h5>

                                <p>{!!$post->getDescription()!!}</p>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </aside>
        <aside class="widget pos-padding">
            <h3 class="widget-title text-uppercase text-center">Недавние посты</h3>
            @foreach($recentPosts as $post)
                <div class="thumb-latest-posts">


                    <div class="media">
                        <div class="media-left">
                            <a href="{{route('frontend.post.show', $post->getSlug())}}" class="popular-img"><img
                                        src="{{\App\Components\Image::getPath($post->getImage())}}" alt="">
                                <div class="p-overlay"></div>
                            </a>
                        </div>
                        <div class="p-content">
                            <a href="{{route('frontend.post.show', $post->getSlug())}}"
                               class="text-uppercase">{{$post->getTitle()}}</a>
                            <span class="p-date">{{$post->getDate()}}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </aside>
        <aside class="widget border pos-padding">
            <h3 class="widget-title text-uppercase text-center">Categories</h3>
            <ul>
                @foreach($categories as $category)
                    <li>
                        <a href="{{route('frontend.category.show', $category->getSlug())}}">{{$category->getTitle()}}</a>
                    </li>
                @endforeach
            </ul>
        </aside>
    </div>
</div>