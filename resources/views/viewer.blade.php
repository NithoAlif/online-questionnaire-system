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
                                    {{ $form->title }}
                                <hr>
                                    @foreach ( $questions as $question )
                                        <?php $id = $question->q_id ?>

                                        {{ $question->questions }}
                                        <br>
                                        {{ $question->sidenote }}
                                        <br>
                                        
                                        <?php $type = $question->type; ?>

                                        @if ($type == 'dropdown')
                                            <select name='a_<?php echo $id; ?>' class='form-control'>
                                        @elseif ($type == 'short')
                                            <input type='text' name='a_<?php echo $id; ?>'>
                                        @elseif ($type == 'long')
                                            <textarea rows='5' cols='50' name='a_<?php echo $id; ?>'></textarea>
                                        @endif

                                        @foreach ( $choices as $choice ) 
                                            @if ( $choice->q_id == $id )
                                                <?php $text = $choice->answer; ?>

                                                @if ($type == 'checkbox')
                                                    <div class='checkbox'>
                                                        <label>
                                                            <input type='checkbox' name='a_<?php echo $id; ?>' value='{{$text}}'>{{$text}}
                                                        </label>
                                                    </div>
                                                @elseif ($type == 'multiple_choice')
                                                    <div class='radio'>
                                                        <label>
                                                            <input type='radio' name='a_<?php echo $id; ?>' value='{{$text}}'>{{$text}}                                              
                                                        </label>
                                                    </div>
                                                @elseif ($type == 'dropdown')
                                                    <option value='{{$text}}'>{{$text}}</option>
                                                @endif
                                                

                                            @endif
                                        @endforeach

                                        @if ($type == 'dropdown')
                                            </select>
                                        @endif

                                        <br>
                                    @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
