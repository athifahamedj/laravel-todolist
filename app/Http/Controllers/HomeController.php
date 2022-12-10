<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request; 
use App\Task;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    }

     /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function getList($status)
    {
        if($status==1){
            $get_all =  Task::where('status',0)->get();
        }else{
            $get_all =  Task::all();
        }
        
       return json_encode($get_all);
    }
    public function saveTask(Request $request)
    {
      
        $details = $request->all();
        $taskInfo = $details['task'];
        $taskCheck = Task::where('task',$taskInfo)->count();
        if($taskCheck>0){
            return "Task Already Created";
        }
        $task = new Task;  
        $task->task = $details['task'];
        $task->user = 1;
        $task->save();
        return 'success';
        //    print_r($request->all());
    }
    public function changeComplete(Request $request)
    {
      
        $details = $request->all();
        $id = $details['id'];
        $task = Task::where('task_id',$id)->first();
         
        $task->status = 1;
        $task->save();
       
    }
    public function deleteRecord(Request $request)
    {
      
        $details = $request->all();
        $id = $details['id'];
        $task = Task::where('task_id',$id)->delete();
          
    }
    
    
    
}