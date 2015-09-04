@extends('layouts.master')

@section('header')
    <link rel="stylesheet" href="/css/style.css">
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-login">
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

                                    <div class="form-group">
                                        <label> Question </label> 
                                        <input type="text" name="question[]" id="question" class="form-control">

                                        <label> Note </label> 
                                        <input type="text" name="sidenote[]" id="sidenote" class="form-control">

                                        <label> Type </label> 
                                        <select class="form-control" name="type[]" id="type">
                                            <option>Short answer</option>
                                            <option>Long answer</option>
                                            <option>Checkbox</option>
                                            <option>Multiple Choice</option>
                                            <option>Dropdown</option>
                                        </select>
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
@endsection