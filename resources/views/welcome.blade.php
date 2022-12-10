<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.rtl.min.css" integrity="sha384-DOXMLfHhQkvFFp+rWTZwVlPVqdIhpDVYT9csOnHSgWQWPX0v5MCGtjCJbY6ERspU" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        

    </head>
    <body class=" row">
        <div class="col-12">

       <h1><span class="text-center">To-Do List</span></h1>
        </div>
        <div>

        <div class="container row">

            <div class="card">

                <div class="form-check">

                <input type="checkbox" id="showAll" onclick="showALl(this);" id="flexCheckDefault"/>
                <label class="form-check-label" for="flexCheckDefault">
                Show all tasks
                </label>
                </div>
          
                <div class="card-body">
                    
                    <input type="text" placeholder="Project # To Do" name="task" id="task"/>
                    <button class="btn btn-success" type="button" nam="save" onclick="saveObj();" >Add</button>
              

                </div>

                
                <div id="full-list">
                </div>

                      
        </div>
            </div>
        </div>

        </div>
    </body>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    <script>
        var showAll = 1;
        $(document).ready(function() {
             getList();
        });
        function showALl(obj){
            let isChecked1 = $(obj).is(':checked');
            if(isChecked1){
                showAll = 0;
            }else{
                showAll = 1;
            }
            getList();
        }
        function getList(){ 
            var htl_set = '';   
            $('#full-list').html('Loading...');
            $.ajax({url: "{{env('APP_URL')}}getList/"+showAll, 
                        success: function(result) {
                            result = JSON.parse(result);
                            htl_set += '<table class="table"><tr><th></th><th></th><th></th><th></th><tr>';
                            $(result).each(function(index,obj){
                                console.log(obj);
                                var checkbox = '<input type="checkbox" name="check" class="check" onclick="changeComplete(this,'+obj.task_id+')" />';
                                var deletein = '<i class="fa fa-trash" aria-hidden="true" type="button" name="button" onclick="deleteRecord('+obj.task_id+')" ></i>';
                                htl_set += '<tr><td>'+checkbox+'</td><td>'+obj.task+'</td><td><a href="#" class="icon" title="User Profile"><i class="fa fa-user"></i></a></td><td>'+deletein+'</td><tr>';
                            });
                            $('#full-list').html(htl_set);
                }});
        }
        
        function changeComplete(obj,id){

            let isChecked = $(obj).is(':checked');
            if(isChecked){

                $.ajax({url: "{{env('APP_URL')}}changeComplete",data : {'id' :id, "_token": "{{ csrf_token() }}"},method: "post" ,
                        success: function(result) { 
                            alert("Status Changed successfully");
                            getList();
                }});

            }
            
        }
        function saveObj(){
            var task = $('#task').val();
            $.ajax({url: "{{env('APP_URL')}}saveTask",data : {'task' :task, "_token": "{{ csrf_token() }}"},method: "post" ,
                        success: function(result) { 
                            if(result=='success'){
                                alert("saved successfully");
                                getList();
                            }else{
                                alert(result);
                                getList();
                            }
                            
                }});
        }
        function deleteRecord(id){
            var x = confirm('Are u sure to delete this task ?');
            if(x){
                $.ajax({url: "{{env('APP_URL')}}deleteRecord",data : {'id' :id, "_token": "{{ csrf_token() }}"},method: "post" ,
                        success: function(result) { 
                            alert("Deleted successfully");
                            getList();
                }});
            }
            
        }
        
    </script>
</html>
