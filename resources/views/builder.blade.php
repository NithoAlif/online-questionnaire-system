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
        $("#questions").val(0);        
        addQuestion();

        function addQuestion() {
            var id = parseInt($("#questions").val()) + 1;

            $( "#form-content" )
            .append(           
                "<div class='well form-group'>" +
                    "<a id='del-this' class='add_a btn btn-default' onclick='delQuestion(this)'>X</a>" +

                    "<label> Question </label>" +
                    "<input type='text' name='question[]' id='question' class='form-control'>" +

                    "<label> Note </label>" +
                    "<input type='text' name='sidenote[]' id='sidenote' class='form-control'>" +

                    "<label> Type </label>" +
                    "<select class='type-selector form-control' name='type[]' id='type' onchange='changeType(this, " + id + ")'>" +
                        "<option value='short'>Short answer</option>" +
                        "<option value='long'>Long answer</option>" +
                        "<option value='checkbox'>Checkbox</option>" +
                        "<option value='multiple_choice'>Multiple Choice</option>" +
                        "<option value='dropdown'>Dropdown</option>" +
                    "</select>" +

                    "<label> Possible Answer </label>" +
                    "<input type='hidden' id='total-possible-" + id + "' name='tpanswers[]' value='1'>" +
                    "<span id='possible-answer-" + id + "'>" +
                        "<div class='form-inline'>" +
                            "<input type='text' name='panswers[]' id='panswer' class='form-control' value='user input' disabled>" +
                        "</div>" +
                    "</span>" +
                    "<a id='add-p-" + id + "' class='add_a btn btn-default' onclick='addAnswer(" + id + ")' style='display: none'>Add Possible Answer</a>" +
                "</div>"
            );

            $("#questions").val(id);

        }

        function delQuestion(thing) {

            var total = parseInt($("#questions").val());

            if ( ( total > 1 ) && ( total <= 55 ) ) {
                console.log($($(thing).parent()).remove());
                $("#questions").val(total - 1);
            }

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

            if ( ( total > 1 ) && ( total <= 35 ) ) {
                console.log($($(thing).parent()).remove());
                $("#total-possible-" + id).val(total - 1);
            }

        }

        function delAllAnswer(id) {

            $("#possible-answer-" + id + " > .form-inline:not(:first)").remove();

        }

        function changeType(thing, id) {
            if ( ( $(thing).val() == "short" ) || ( $(thing).val() == "long" ) ) {
                
                delAllAnswer(id);
                $("#add-p-" + id).hide();
                $("#possible-answer-" + id + " > .form-inline:first > #panswer").val("user input");
                $("#possible-answer-" + id + " > .form-inline:first > #panswer").prop('disabled', true);
            
            } else {

                $("#possible-answer-" + id + " > .form-inline:first > #panswer").prop('disabled', false); 
                $("#possible-answer-" + id + " > .form-inline:first > #panswer").val("");   
                if ( !($("#add-p-" + id).is(":visible")) ) {
                    delAllAnswer(id);
                    $("#add-p-" + id).show();
                }

            }
        }

        $('#add_q').on('click',function(){
            addQuestion();   
            console.log($(this));
        });


    </script>
@endsection