@extends('admin.layout.template')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div>
                <ol class="breadcrumb">
                    <li><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="active">Редактировать пост</li>
                </ol>
            </div>
        </section>

        <!-- Main content -->
        {!! Form::open(['route' => ['post.update', $post->getId()], 'files'	=>	true, 'method'=>'put']) !!}
        <section class="content">
        <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Редактировать пост</h3>
                    @include('admin.layout.errors')
                </div>
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Название</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder=""
                                   value="{{$post->getTitle()}}" name="title">
                        </div>

                        <div class="form-group">
                            <img src="{{\App\Components\Image::getPath($post->getImage())}}" alt="" class="img-responsive" width="200">
                            <label for="exampleInputFile">Лицевая картинка</label>
                            <input type="file" id="exampleInputFile" name="image">

                            <p class="help-block">
                                Сохраняйте картинки больше 1000px в ширину, они автоматически обрежутся до размера
                                {{config('image.post.width')}} x {{config('image.post.height')}}
                            </p>
                        </div>

                        <div class="form-group">
                            <label>Категория</label>
                            {{Form::select('category',
                                $categories,
                                $post->getCategory()->getId(),
                                ['class' => 'form-control select2'])
                            }}
                        </div>
                        <div class="form-group">
                            <label>Теги</label>
                            {{Form::select('tags[]',
                                $tags,
                                $post->selectedTagsId(),
                                ['class' => 'form-control select2', 'multiple'=>'multiple','data-placeholder'=>'Выберите теги'])
                            }}
                        </div>
                        <!-- Date -->
                        <div class="form-group">
                            <label>Дата:</label>

                            <div class="input-group date">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="datepicker" value="{{ $post->getDate() }}" name="date">
                            </div>
                            <!-- /.input group -->
                        </div>

                        <!-- checkbox -->
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="is_featured" value="0"  style='display:none;' checked>
                                {{ Form::checkbox('is_featured', '1', $post->getIsFeatured(),['class'=>'minimal']) }}
                            </label>
                            <label>
                                Рекомендовать
                            </label>
                        </div>
                        <!-- checkbox -->
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="is_public" value="0"  style='display:none;' checked>
                                {{ Form::checkbox('is_public', '1', $post->getIsPublic(),['class'=>'minimal']) }}
                            </label>
                            <label>
                                Черновик
                            </label>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Описание</label>
                            <textarea name="description" id="" cols="30" rows="10"
                                      class="form-control">{{$post->getDescription()}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Полный текст</label>
                            <textarea name="content" id="" cols="30" rows="10"
                                      class="form-control">{{$post->getContent()}}</textarea>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-default">Назад</button>
                    <button class="btn btn-warning pull-right">Изменить</button>
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->

        </section>
    {!! Form::close() !!}
    <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection