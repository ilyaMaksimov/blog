@extends('frontend.layout.template')

@section('content')
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        Тут будет информация обо мне
                    </div>
                </div>
                @include('frontend.layout._sidebar')
            </div>
        </div>
    </div>
@endsection