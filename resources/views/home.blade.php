@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{route('articles.create')}}" class="btn btn-primary">Create Article</a>
                </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                        <table class="table table-bordered">
                            <colgroup>
                                <col width="25px">
                                <col width="100px">
                                <col width="150px">
                                <col width="50px">
                                <col width="100px">
                            </colgroup>
                            <thead>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Author</th>
                                <th>Operation</th>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php if (!isset($articles)) { ?>
                                <tr>
                                    <td colspan="5"> Not record to found ! </td>
                                </tr>
                                <?php } else { ?>
                                @foreach($articles as $art)
                                    <tr>
                                        <td>{{$art->id}}</td>
                                        <td><div class="oneLine">{{$art->title}}</div></td>
                                        <td><div class="oneLine">{{ strip_tags($art->content)}}</div></td>
                                        <td><div class="oneLine">{{$art->author_name}}</div></td>
                                        <td>
                                            <a class="btn btn-info" href="{{ route('articles.show',$art->id) }}">Show Detail</a>
                                            {{--<a class="btn btn-primary" href="{{ route('articles.edit',$art->art_id) }}">Edit</a>--}}
                                            {{--{{ Form::open(['method' => 'DELETE','route' => ['articles.destroy', $art->art_id],'style'=>'display:inline']) }}--}}
                                            {{--{{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}--}}
                                            {{--{{ Form::close() }}--}}
                                        </td>
                                    </tr>
                                    <?php $i++; ?>
                                @endforeach
                                <?php } ?>

                            </tbody>

                        </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
