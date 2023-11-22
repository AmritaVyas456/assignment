$( document ).ready(function() {
    $('#search_text').keyup(function(){
        var search = $(this).val();
        $.ajax({
            url:'search.php',
            method:'post',
            data:{query:search},
            success:function(response){
               $('#search_table').html(response);
            }
        })
    });
    $('#datepicker').datepicker({
        format: 'yyyy/mm/dd',
        defaultDate: 'now',
        autoclose: true,
        todayHighlight: true,
        startDate: 'today' 
    });

    $('#datepicker').datepicker("setDate", new Date());

    $('#datepickeredit').datepicker({
        format: 'yyyy/mm/dd',
        defaultDate: 'now',
        autoclose: true,
        todayHighlight: true,
        startDate: 'today' 
    });

    $('#loginForm').validate({ // initialize the plugin
        rules: {
            userName: {
                required: true,
                minlength: 5
            },
            userPassword: {
                required: true,
                minlength: 5
            }
        }
    });

    $('#userRecordForm').validate({ // initialize the plugin
        rules: {
            postTitle: {
                required: true,
                minlength: 5
            },
            postDesc: {
                required: true,
                minlength: 5
            },
            postDate: {
                required: true,
                date: true,
            }
        }
    });

    $('#editpostForm').validate({ // initialize the plugin
        rules: {
            postTitle: {
                required: true,
                minlength: 5
            },
            postDesc: {
                required: true,
                minlength: 5
            },
            postDate: {
                required: true,
                date: true,
            }
        }
    });
});

