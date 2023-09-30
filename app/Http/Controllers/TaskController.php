<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Auth::user()->tasks;
        $tasks = $tasks->sortByDesc('id')->values();

        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request)
    {
        //Проверка введёных данных 255 символов макс и обяз поле текст
        $request->validate([
            'text' => 'required|max:255',
        ]);

        $task = new Task();
        $task->text = $request->text;
        $task->is_done = false;
        $task->user_id = Auth::user()->id;
        $task->save();

        return redirect()->route('tasks.index');
    }
    public function api_create(Request $request)
    {
        //Проверка введёных данных 255 символов макс и обяз поле текст
        $request->validate([
            'text' => 'required|max:255',
            'description' => 'required'
        ]);

        $task = new Task();
        $task->text = $request->text;
        $task->description = $request->description;
        
        $task->is_done = false;
        $task->user_id = Auth::user()->id;
        $task->save();

        return response()->json(
            [
                'status' => $task === null ? 'error' : 'success',
                'message' => $task === null ? 'Task not created' : 'Task is created successfully',
                'data' => $task,
            ],
            200,
            array(),
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );
    }
    //Обновления состояния задачи
    public function update(Request $request, Task $task)
    {
        $request->validate([
            'is_done' => 'required|max:1',
        ]);

        $task->is_done = $request->is_done;
        $task->save();

        return redirect()->route('tasks.index');
    }
    //Обновления состояния задачи API
    public function api_update(Request $request, $task)
    {
        $request->validate([
            'text' => 'max:255',
            'is_done' => 'required|max:1|numeric|between:0,1',
        ]);
        
        $task = Task::find($task);

        if ($task != null) {
            if($request->text!=null){
                $task->text = $request->text;
            }
            if($request->description!=null){
                $task->description = $request->description;
            }
            $task->is_done = $request->is_done;
            $task->save();
        }

        return response()->json(
            [
                'status' => $task === null ? 'error' : 'success',
                'message' => $task === null ? 'Task not found' : 'Task updated successfully',
                'data' => $task,
            ],
            200,
            array(),
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );
    }
    //Удаление задачи
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index');
    }
    public function api_destroy(int $taskId,Request $request )
    {
        $taskId = Task::find($taskId);
        if($taskId != null){
            $taskId->delete();
        }
        return response()->json(
            [
                'status' => $taskId === null ? 'error' : 'success',
                'message' => $taskId === null ? 'Task not found' : 'Task deleted successfully',
                'data' => $taskId,
            ],
            200,
            array(),
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );
    }
    //Обновления состояния задачи
    public function toggle(Task $task)
    {
        $task->is_done = !$task->is_done;
        $task->save();

        return redirect()->route('tasks.index');
    }

    public function clear()
    {
        $tasks = Auth::user()->tasks;
        $tasks->where('is_done', true)->each->delete();

        return redirect()->route('tasks.index');
    }

    public function clearAll()
    {
        $tasks = Auth::user()->tasks;
        $tasks->each->delete();

        return redirect()->route('tasks.index');
    }

    public function toggleAll()
    {
        $tasks = Auth::user()->tasks;
        $tasks->each(function ($task) {
            $task->is_done = !$task->is_done;
            $task->save();
        });

        return redirect()->route('tasks.index');
    }
    public function api_getTasks(){
        $tasks = Task::all();
        $tasks = $tasks->sortByDesc('id')->values();
        return response()->json(
            [
                'status' => $tasks === null ? 'error' : 'success',
                'message' => $tasks === null ? 'Tasks not found' : 'All tasks shown',
                'data' => $tasks,
            ],
            200,
            array(),
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );
    }

    public function api_getTask(Request $request,$task){
        
        $task = Task::find($task);

        return response()->json(
            [
                'status' => $task === null ? 'error' : 'success',
                'message' => $task === null ? 'Tasks not found' : 'Task shown',
                'data' => $task,
            ],
            200,
            array(),
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE
        );
    }
}
