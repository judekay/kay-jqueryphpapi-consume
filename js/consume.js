/**
 * Created by Judekayode on 5/11/2016.
 */

function getTasks()
{
    $.ajax({
       type: 'GET',
        url: 'http://localhost/phillip/task/?a=tasks',
        dataType: 'json',
        success: function(data){
            if(data['status'] == true) {


                $.each(data["data"], function (i, n) {
                    console.log(n.task);
                    $('<input type="checkbox" value=""/>' +
                        '<span >' + n.task + '[' + n.id + ']</span><a  class="pull-right"><i class="glyphicon glyphicon-user"></i></a><br/>').appendTo("#checkboxtasks");
                });
            }

        },
        failure: function(response)
        {

        }

    });
}

function shownewtaskform(){
    $('#shownewtaskform').click(function(){
        $('#newTaskForm').toggle();

    })
}


function filterData()
{
    $.ajax({
        type: 'GET',
        url: 'http://localhost/phillip/task/?a=tasks',
        dataType: 'json',
        success: function(data){
            if(data['status'] == true){
                var myarr =  $.grep(data["data"], function(n, i){
                    return n.task == $("#filtertext").val();
                });
                console.log(myarr);

                $.each(myarr, function (i, n) {
                   $("#checkboxtasks").empty();
                    $('<input type="checkbox" value=""/>' +
                        '<span >'+ n.task +'['+ n.id +']</span><a  class="pull-right"><i class="glyphicon glyphicon-user"></i></a><br/>').appendTo("#checkboxtasks");
                });

            }



        },
        failure: function(response)
        {

        }

    });
}

function postTask()
{
    {

        var posttask_form = $("#newTaskForm");
        posttask_form.submit(function(e){
            e.preventDefault();
            e.returnValue = false;

            if(posttask_form[0].checkValidity()){
                console.log('here bro');
                var task_val =  $("#task").val();
                if(task_val == ""){
                    $('#erroralert').val("task has to be filled").show();
                }

                else{

                    $.ajax({
                        type: "POST",
                        url: 'http://localhost/phillip/task/?a=addtask',

                        data: {

                            "task" : task_val
                        },
                        dataType: 'json',
                        success: function(data){
                            console.log(data);
                            if(data["status"]== true)
                            {
                                console.log("success");
                                posttask_form[0].reset();
                                getTasks();

                            }
                            else{
                                console.log("notsucc");
                                //console.log(confirmpassword_val);
                                //console.log(newpassword);
                               getTasks()
                            }


                            posttask_form[0].reset();

                        },

                        failure: function(){
                            console.log("failure");
                           getTasks();

                        }


                    });





                }


            }

        });
    }

}



$(document).ready(function(){
    $('#newTaskForm').hide();
        getTasks();
    shownewtaskform()


    postTask();

});