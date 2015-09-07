$("#questions").val(0);  

function addQuestion() {
    var id = parseInt($("#questions").val()) + 1;

    $( "#form-content" )
    .append(           
        "<div class='panel panel-default panel-body form-horizontal builder-component'>" +
            "<div class='row'>" +
                "<div class='col-md-offset-11 col-md-1'>"+
                    "<a id='del-this' class='add_a btn btn-default elegant pull-right' onclick='delQuestion(this)'>X</a>" +
                "</div>" +
            "</div>" +

            "<div class='form-group'>" +                  
                "<label class='col-md-2 control-label'> Question </label>" +
                "<div class='col-md-8'>"+
                    "<input type='text' name='question[]' id='question' class='form-control slim'>" +
                "</div>" +
            "</div>" +

            "<div class='form-group'>" +                  
                "<label class='col-md-2 control-label'> Note </label>" +
                "<div class='col-md-8'>"+
                    "<input type='text' name='sidenote[]' id='sidenote' class='form-control'>" +
                "</div>" +
            "</div>" +

            "<div class='form-group'>" +                  
                "<label class='col-md-2 control-label'> Type </label>" +
                "<div class='col-md-8'>"+
                    "<select class='type-selector form-control' name='type[]' id='type' onchange='changeType(this, " + id + ")'>" +
                        "<option value='short'>Short answer</option>" +
                        "<option value='long'>Long answer</option>" +
                        "<option value='checkbox'>Checkbox</option>" +
                        "<option value='multiple_choice'>Multiple Choice</option>" +
                        "<option value='dropdown'>Dropdown</option>" +
                    "</select>" +
                "</div>" +
            "</div>" +

            "<div class='form-group'>" +                  
                "<label class='col-md-2 control-label'>" +
                    "Answer(s)" +
                "</label>" +
                "<input type='hidden' id='total-possible-" + id + "' name='tpanswers[]' value='1'>" +
                "<div class='col-md-8'>"+
                    "<span id='possible-answer-" + id + "'>" +
                        "<div class='panswer-group input-group narrow-margin'>" +
                            "<div class='front input-group-addon'>" +
                            "</div>" +

                            "<input type='text' name='panswers[]' id='panswer' class='form-control panswer' value='user input' disabled>" +
                        "</div>" +
                    "</span>" +

                    "<a id='add-p-" + id + "' class='add_a btn btn-default elegant' onclick='addAnswer(" + id + ")' style='display: none'>Add Answer</a>" +

                "</div>" +
            "</div>" +

        "</div>"
    );

    $("#questions").val(id);

}

function delQuestion(thing) {

    var total = parseInt($("#questions").val());

    if ( ( total > 1 ) && ( total <= 55 ) ) {
        console.log($($($($(thing).parent()).parent()).parent()).remove());
        $("#questions").val(total - 1);
    }

}

function addAnswer(id) {
    var total = parseInt($("#total-possible-" + id).val());

    $("#possible-answer-" + id)
    .append(     
        "<div class='panswer-group input-group narrow-margin'>" +
            "<div class='front input-group-addon'>" +
            "</div>" +
            "<input type='text' name='panswers[]' id='panswer' class='form-control panswer'>" +
            "<a class='del_a btn btn-default elegant no-border input-group-addon' onclick='delAnswer(this, " + id + ")'>X</a>" +
        "</div>" 
    );

    $("#total-possible-" + id).val(total + 1);
    refreshSelector(id);
}

function delAnswer(thing, id) {

    var total = parseInt($("#total-possible-" + id).val());

    if ( ( total > 1 ) && ( total <= 35 ) ) {
        console.log($($(thing).parent()).remove());
        $("#total-possible-" + id).val(total - 1);
    }

}

function delAllAnswer(id) {

    $("#possible-answer-" + id + " > .panswer-group:not(:first)").remove();

}

function changeType(thing, id) {
    if ( ( $(thing).val() == "short" ) || ( $(thing).val() == "long" ) ) {
        
        delAllAnswer(id);
        $("#add-p-" + id).hide();
        $("#possible-answer-" + id + " > .panswer-group:first > #panswer").val("user input");
        $("#possible-answer-" + id + " > .panswer-group:first > #panswer").prop('disabled', true);
    
    } else {

        $("#possible-answer-" + id + " > .panswer-group:first > #panswer").prop('disabled', false); 

        if ( !($("#add-p-" + id).is(":visible")) ) {
            $("#possible-answer-" + id + " > .panswer-group:first > #panswer").val("");   
            delAllAnswer(id);
            $("#add-p-" + id).show();
        }
    }

    refreshSelector(id);
}

function refreshSelector(id) {

    $("#possible-answer-" + id + " > .panswer-group > .front").empty();
        
    if ( $("#type").val() == "checkbox" ) {
        $("#possible-answer-" + id + " > .panswer-group > .front").html("<input type='checkbox'>");
    } else if ( $("#type").val() == "multiple_choice" )  {
        $("#possible-answer-" + id + " > .panswer-group > .front").html("<input type='radio'>");
    } else if ( $("#type").val() == "dropdown" ) {
        $("#possible-answer-" + id + " > .panswer-group > .front").each(
            function(index) {
                $("#possible-answer-" + id + " > .panswer-group:nth-child(" + (index+1) + ") > .front").html((index+1));
            }
        );
    }

}

$('#add_q').on('click',function(){
    addQuestion();   
    console.log($(this));
});

$(".builder-component").draggable({ 
    stack:".builder", 
    cursor: "move",
    revert: function() {
        return true;
    },
    start: function() {
        return true;
    }
});

$(".builder").droppable({
    activeClass: "activeDroppable",
    hoverClass: "hoverDroppable",
    accept: ":not(.ui-sortable-helper)",
    drop: function (event, ui) {}
});

$(".builder").sortable();
$(".builder").disableSelection();      

addQuestion();
