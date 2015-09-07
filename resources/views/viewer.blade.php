@extends('layouts.master')

@section('header')
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/form.css">
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-builder">
                    <div class="panel-heading">
                        <a class="active" id="register-form-link">Form Builder</a>
                        <hr>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                @include('errors.error')

                                <form id="builder-form" action="/builder" method="post" role="form" style="display: block;">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" id="questions" name="questions" value="0">

                                    <div id="form-content" class="builder">
                                    </div>

                                    <div class="form-group">
                                        <a id="add_q" class="btn btn-default">Add Question</a>
                                    </div>

                                    <input type="submit" value="Submit" class="form-control btn btn-register">

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
