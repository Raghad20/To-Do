<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Database\Query\Builder as QueryBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class TaskController extends Controller
{
    public function index($id)
    {
        $tasks=Task::with('type')->where('type_id',$id)->get();
        return view('tasks.index',compact('tasks','id'));
    }
    public function store(Request $request ,$typeId)
    {
        $validated= $request->validate(
            [
                'title'=>'required',
                'description'=>'required'

            ]
        );
        Task::create(
            ['title'=> $validated['title'],
            'description'=>$validated['description'],
            'type_id'=>$typeId
    ]);
        return redirect()->back();

    }
    public function assignIndex(Request $request)
    {
       
        $taskId=request()->segment(count(request()->segments()));
        $users=User::where('is_admin','0')->whereDoesntHave('tasks', function ($query) use ($taskId) {
            $query->where('tasks.id', $taskId);
        })->get();
        return view('tasks.assign-user',compact('users','taskId'));
    }
    public function assignUser($taskId,Request $request)
    {
        $data = $request->all();
        $task=Task::find($taskId);
        $task->users()->sync($this->mapUsers($data['ingredients']));
        return redirect()->back();

    }
    private function mapUsers($users)
    {
    return collect($users)->map(function ($i) {
        return ['due_date' => $i];
    });
    }
    public function assignedToMe()
    {
        $user=User::find(auth()->id());
        $tasks=$user->tasks()->get();
        return view('tasks.assigned-to-me',compact('tasks'));
    }
   
    public function completeStatus($taskId)
    {
  
        $task=Task::find($taskId);
        $task->users()->updateExistingPivot(auth()->id(),['is_done'=>1]);
        
        return redirect('assigned-to-me');
    }
    public function incompleteStatus($taskId)
    {
        
        $task=Task::find($taskId);
    
        $result = $task->users()->updateExistingPivot(auth()->id(),['is_done'=>0]);
       
        return redirect('assigned-to-me');
    }
    public function userTask()
    {
        $users_tasks=Task::with('users')->get();
        return view ('tasks.user-task',compact('users_tasks'));
    }

}
