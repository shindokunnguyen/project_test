@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <a href="{{route('articles.create')}}"><button class="">Add Article</button></a>
                </div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                        <table class="table table-bordered">
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th width="280px">Operation</th>
                            </tr>
                            <?php $i = 1; ?>
                            <?php if (!isset($members)) { ?>
                            <tr>
                                <td colspan="4"> Not record to found ! </td>
                            </tr>
                            <?php } else { ?>
                            @foreach($members as $memb)
                                <tr>
                                    <td><?php echo $i; ?></td>
                                    <td>{{$memb->name}}</td>
                                    <td>{{$memb->email}}</td>
                                    <td>
                                        <a class="btn btn-info" href="{{ route('members.show',$memb->id) }}">Show</a>
                                        <a class="btn btn-primary" href="{{ route('members.edit',$memb->id) }}">Edit</a>
                                        {{ Form::open(['method' => 'DELETE','route' => ['members.destroy', $memb->id],'style'=>'display:inline']) }}
                                        {{ Form::submit('Delete', ['class' => 'btn btn-danger']) }}
                                        {{ Form::close() }}
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            @endforeach
                            <?php } ?>

                        </table>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
