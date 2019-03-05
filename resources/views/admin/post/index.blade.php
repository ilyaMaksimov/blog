@extends('admin.layout.template')

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div>
                <ol class="breadcrumb">
                    <li><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="active">Посты</li>
                </ol>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Посты</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="form-group">
                        <a href="{{route('post.create')}}" class="btn btn-success">Добавить</a>
                    </div>
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Название</th>
                            <th>Категория</th>
                            <th>Теги</th>
                            <th>Картинка</th>
                            <th>Статус</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $post)
                            <tr>
                                <td>{{$post->getId()}}</td>
                                <td>{{$post->getTitle()}}</td>
                                <td>{{$post->getCategory()->getTitle()}}</td>
                                <td>{{$post->getTagsTitles()}}</td>

                                <td>
                                    <img src="{{\App\Components\Image::getPath($post->getImage())}}" alt=""
                                         class="img-responsive" width="100">
                                </td>
                                <td>
                                    @if($post->isPublic())
                                        <span class="label label-success">Публичный</span>

                                    @else
                                        <span class="label label-warning">Черновик</span>

                                    @endif
                                    @if($post->isFeatured())
                                        <span class="label label-primary">Рекомендуемый</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('post.edit', $post->getId())}}" class="fa fa-pencil"></a>
                                    {{Form::open(['route'=>['post.destroy', $post->getId()], 'method'=>'delete'])}}
                                    <button onclick="return confirm('Точно удалить?')" type="submit" class="delete">
                                        <i class="fa fa-remove"></i>
                                    </button>

                                    {{Form::close()}}
                                </td>
                            </tr>
                        @endforeach
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection