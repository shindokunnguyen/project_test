<?php
/**
 * Created by PhpStorm.
 * User: Nguyen Manh Hung
 * Date: 11/18/2017
 * Time: 11:49 PM
 */
?>
@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4>Add new article</h4>
                </div>
            </div>
        </div>
        <?php if (count($errors)) { ?>
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <?php } else { ?>
            <div class="alert alert-danger" id="area_show_err" style="display: none"></div>
        <?php } ?>

        {{--{{ Form::open(array('route' => 'articles.store','method'=>'POST')) }}--}}
            {{--@include('members.form')--}}
        {{--{{ Form::close() }}--}}
        <form action="{{route('articles.store')}}" method="POST" class="form-horizontal">
            {{csrf_field()}}
            @include('article.form')
        </form>
    </div>

    <script type="text/javascript">
        CKEDITOR.replace('art_content'); // <textarea> is #foo, error will be thrown
    </script>

@endsection

