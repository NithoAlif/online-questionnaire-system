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
                                    <input type="hidden" id="questions" name="questions" value="0">

                                    <span id="form-content">
                                    </span>

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

@section('jscript')
    <script>
        addQuestion();

        function addQuestion() {
            var id = parseInt($("#questions").val()) + 1;

            $( "#form-content" )
            .append(           
                "<div class='form-group'>" +
                    "<label> Question </label>" +
                    "<input type='text' name='question[]' id='question' class='form-control'>" +

                    "<label> Note </label>" +
                    "<input type='text' name='sidenote[]' id='sidenote' class='form-control'>" +

                    "<label> Type </label>" +
                    "<select class='form-control' name='type[]' id='type'>" +
                        "<option>Short answer</option>" +
                        "<option>Long answer</option>" +
                        "<option>Checkbox</option>" +
                        "<option>Multiple Choice</option>" +
                        "<option>Dropdown</option>" +
                    "</select>" +

                    "<label> Possible Answer </label>" +
                    "<input type='hidden' id='total-possible-" + id + "' name='tpanswers[]' value='1'>" +
                    "<span id='possible-answer-" + id + "'>" +
                        "<div class='form-inline'>" +
                            "<input type='text' name='panswers[]' id='sidenote' class='form-control'>" +
                            "<a class='del_a btn btn-default' onclick='delAnswer(this, " + id + ")'>X</a>" +
                        "</div>" +
                    "</span>" +
                    "<a class='add_a btn btn-default' onclick='addAnswer(" + id + ")'>Add Possible Answer</a>" +

                "</div>"
            );

            $("#questions").val(id);

        }

        function addAnswer(id) {
            var total = parseInt($("#total-possible-" + id).val());

            $("#possible-answer-" + id)
            .append(     
                "<div class='form-inline'>" +
                    "<input type='text' name='panswers[]' id='sidenote' class='form-control'>" +
                    "<a class='del_a btn btn-default' onclick='delAnswer(this, " + id + ")'>X</a>" +
                "</div>" 
            );

            $("#total-possible-" + id).val(total + 1);
        }

        function delAnswer(thing, id) {

            var total = parseInt($("#total-possible-" + id).val());

            if (total > 1) {
                console.log($($(thing).parent()).remove());
                $("#total-possible-" + id).val(total - 1);
            }

        }

        $('#add_q').on('click',function(){
            addQuestion();   
            console.log($(this));
        });

    </script>
@endsection