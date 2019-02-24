@extends('frontend.layout.template')

@section('content')
    <!--main content start-->
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <article class="post">
                        <div class="post-thumb">
                            <a href="{{route('frontend.post.show', $post->getSlug())}}"><img
                                        src="{{\App\Components\Image::getPath($post->getImage())}}" alt=""></a>
                        </div>
                        <div class="post-content">
                            <header class="entry-header text-center text-uppercase">
                                <h6>
                                    <a href="{{route('frontend.category.show', $post->getCategory()->getSlug())}}"> {{$post->getCategory()->getTitle()}}</a>
                                </h6>
                                <h1 class="entry-title"><a
                                            href="{{route('frontend.post.show', $post->getSlug())}}">{{$post->getTitle()}}</a>
                                </h1>


                            </header>
                            <div class="entry-content">
                                {!! $post->getContent() !!}
                            </div>
                            <div class="decoration">
                                @foreach($post->getTags() as $tag)
                                    <a href="{{route('frontend.tag.show', $tag->getSlug())}}"
                                       class="btn btn-default">{{$tag->getTitle()}}</a>
                                @endforeach
                            </div>

                            <div class="social-share">
							<span
                                    {{--class="social-share-title pull-left text-capitalize">By {{$post->author->name}} On {{$post->getDate()}}</span>--}}
                                    class="social-share-title pull-left text-capitalize"> Автор: {{env('NAME_AUTHOR')}}
                                br
                                Дата: {{$post->getDate()}}</span>
                                @include('frontend.layout.social_networks')
                            </div>
                        </div>
                    </article>
                    {{--<div class="top-comment"><!--top comment-->
                        <img src="/images/comment.jpg" class="pull-left img-circle" alt="">
                        <h4>Rubel Miah</h4>

                        <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy hello ro mod tempor
                            invidunt ut labore et dolore magna aliquyam erat.</p>
                    </div>--}}<!--top comment end-->
                {{-- <div class="row"><!--blog next previous-->
                     <div class="col-md-6">
                         @if($post->hasPrevious())
                             <div class="single-blog-box">
                                 <a href="{{route('post.show', $post->getPrevious()->slug)}}">
                                     <img src="{{$post->getPrevious()->getImage()}}" alt="">

                                     <div class="overlay">

                                         <div class="promo-text">
                                             <p><i class=" pull-left fa fa-angle-left"></i></p>
                                             <h5>{{$post->getPrevious()->title}}</h5>
                                         </div>
                                     </div>


                                 </a>
                             </div>
                         @endif
                     </div>
                     <div class="col-md-6">
                         @if($post->hasNext())
                             <div class="single-blog-box">
                                 <a href="{{route('post.show', $post->getNext()->slug)}}">
                                     <img src="{{$post->getNext()->getImage()}}" alt="">

                                     <div class="overlay">
                                         <div class="promo-text">
                                             <p><i class=" pull-right fa fa-angle-right"></i></p>
                                             <h5>{{$post->getNext()->title}}</h5>

                                         </div>
                                     </div>
                                 </a>
                             </div>
                         @endif
                     </div>
                 </div>--}}<!--blog next previous end-->
                    @if(!empty($relatedPosts))
                        <div class="related-post-carousel"><!--related post carousel-->
                            <div class="related-heading">
                                <h4>Вам так же может понравиться:</h4>
                            </div>
                            <div class="items">
                                @foreach($relatedPosts as $post)
                                    <div class="single-item">
                                        <a href="{{route('frontend.post.show', $post->getSlug())}}">
                                            <img src="{{\App\Components\Image::getPath($post->getImage())}}" alt="">

                                            <p>{{$post->getTitle()}}</p>
                                        </a>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    @endif
                <!--related post carousel-->
                    {{--@if(!$post->comments->isEmpty())
                        @foreach($post->getComments() as $comment)
                            <div class="bottom-comment"><!--bottom comment-->
                                <div class="comment-img">
                                    <img class="img-circle" src="{{$comment->author->getImage()}}" alt="" width="75" height="75">
                                </div>

                                <div class="comment-text">
                                    <h5>{{$comment->author->name}}</h5>

                                    <p class="comment-date">
                                        {{$comment->created_at->diffForHumans()}}
                                    </p>


                                    <p class="para">{{$comment->text}}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif--}}

                <!-- end bottom comment-->

                    {{-- @if(Auth::check())
                         <div class="leave-comment"><!--leave comment-->
                             <h4>Leave a reply</h4>


                             <form class="form-horizontal contact-form" role="form" method="post" action="/comment">
                                 {{csrf_field()}}
                                 <input type="hidden" name="post_id" value="{{$post->id}}">
                                 <div class="form-group">
                                     <div class="col-md-12">
                                             <textarea class="form-control" rows="6" name="message"
                                                       placeholder="Write Massage"></textarea>
                                     </div>
                                 </div>
                                 <button class="btn send-btn">Post Comment</button>
                             </form>
                         </div><!--end leave comment-->
                     @endif--}}

                </div>
                @include('frontend.layout._sidebar')
            </div>
        </div>
    </div>
    <!-- end main content-->
@endsection