@extends('admin.layout.template')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div>
                <ol class="breadcrumb">
                    <li><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="active">Комментарии</li>
                </ol>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Комментарии</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    {{--<div class="form-group">
                        <a href="create.html" class="btn btn-success">Добавить</a>
                    </div>--}}
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Текст</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($comments as $comment)
                            <tr>
                                <td>{{$comment->getId()}}</td>
                                <td>{{$comment->getText()}}
                                </td>
                                <td>
                                    @if($comment->isStatus() == \App\Entities\Comment::STATUS_WAITING_VERIFICATION)
                                        <a href="{{route('comment.toggle', $comment->getId())}}" class="fa fa-lock"></a>
                                    @else
                                        <a href="{{route('comment.toggle', $comment->getId())}}" class="fa fa-thumbs-o-up"></a>
                                    @endif
                                    {{Form::open(['route'=>['comment.destroy', $comment->getId()], 'method'=>'delete'])}}
                                    <button onclick="return confirm('Точно удалить?')" type="submit" class="delete">
                                        <i class="fa fa-remove"></i>
                                    </button>

                                {{Form::close()}}
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