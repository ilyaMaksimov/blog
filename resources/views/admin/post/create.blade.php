@extends('admin.layout.template')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div>
                <ol class="breadcrumb">
                    <li><a href="{{ route('dashboard') }}">Home</a></li>
                    <li><a href="{{ route('post.index') }}">Посты</a></li>
                    <li class="active">Добавить пост</li>
                </ol>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
        {{Form::open([
            'route'	=> 'post.store',
            'files'	=>	true
        ])}}
        <!-- Default box -->
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Добавить пост</h3>
                    @include('admin.layout.errors')
                </div>
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Название</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" name="title"
                                   value="{{old('title')}}">
                        </div>

                        <div class="form-group">
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
                                 collect($categories)->pluck('title','id'),
                                null,
                                ['class' => 'form-control select2'])
                            }}
                        </div>
                        <div class="form-group">
                            <label>Теги</label>
                            {{Form::select('tags[]',
                                 collect($tags)->pluck('title','id'),
                                null,
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
                                <input type="text" class="form-control pull-right" id="datepicker" name="date"
                                       value="{{old('date')}}">
                            </div>
                            <!-- /.input group -->
                        </div>

                        <!-- checkbox -->
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="is_featured" value="0" style='display:none;' checked>
                                <input type="checkbox" class="minimal" name="is_featured" value="1">
                            </label>
                            <label>
                                Рекомендовать
                            </label>
                        </div>

                        <!-- checkbox -->
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="is_public" value="1" style='display:none;' checked>
                                <input type="checkbox" name="is_public" class="minimal" value="0">
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
                                      class="form-control">{{old('description')}}</textarea>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Полный текст</label>
                            <textarea name="content" id="" cols="30" rows="10"
                                      class="form-control">{{old('content')}}</textarea>
                        </div>
                    </div>
                </div>
                <!-- /.box-body -->
                <div class="box-footer">
                    <button class="btn btn-default">Назад</button>
                    <button class="btn btn-success pull-right">Добавить</button>
                </div>
                <!-- /.box-footer-->
            </div>
            <!-- /.box -->
            {{Form::close()}}
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection