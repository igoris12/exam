<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\Statuse;
use Validator;

class TaskController extends Controller
{
   const RESULTS_IN_PAGE = 5;

    public function __construct()
    {
        $this->middleware('auth');
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   

            if ($request->sort) {
                if ('task_name' == $request->sort && 'asc' == $request->sort_dir) {
                    $tasks = Task::orderBy('task_name')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
                }
                else if ('task_name' == $request->sort && 'desc' == $request->sort_dir) {
                    $tasks = Task::orderBy('task_name', 'desc')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
                }
                else if ('status_id' == $request->sort && 'asc' == $request->sort_dir) {
                    $tasks = Task::orderBy('status_id')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
                }
                else if ('status_id' == $request->sort && 'desc' == $request->sort_dir) {
                    $tasks = Task::orderBy('status_id', 'desc')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
                }
                else if ('completed_data' == $request->sort && 'asc' == $request->sort_dir) {
                    $tasks = Task::orderBy('completed_data')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
                }
                else if ('completed_data' == $request->sort && 'desc' == $request->sort_dir) {
                    $tasks = Task::orderBy('completed_data', 'desc')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
                }
                else {
                    $tasks = Task::paginate(self::RESULTS_IN_PAGE)->withQueryString();
                }

            }
            else if ($request->filter && 'statuse' == $request->filter) { 
                $tasks = Task::where('status_id', $request->statuse_id)->paginate(self::RESULTS_IN_PAGE)->withQueryString();
            }else {
                $tasks = Task::orderBy('created_at', 'desc')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
            }
        
        $statuses = Statuse::orderBy('name', 'desc')->get();
        return view('task.index', ['tasks' => $tasks,
         'statuses' => $statuses,
         'sortDirection' => $request->sort_dir ?? 'asc',
        'statuse_id' => $request->statuse_id ?? '0'
        ]
    );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = Statuse::orderBy('name', 'desc')->get();
        return view('task.create', ['statuses' => $statuses]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        

         $validator = Validator::make($request->all(),
            [
                'task_name' => ['required', 'min:3', 'max:100'],
                'task_completed_data' => ['required',],
                'task_description' => ['required'],
                'statuse_id' => ['required' ,'integer', 'min:1'],
            ]

            );
            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }


        $task = new Task;
        $task->task_name = $request->task_name;
        $task->completed_data = $request->task_completed_data;
        $task->task_description = $request->task_description;
        $task->status_id = $request->statuse_id;

        $task->save();
       return redirect()->route('task.index')->with('success_message', 'New Task added successful.');

    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(task $task)
    {
       $statuses  =Statuse::orderBy('name')->get();
       return view('task.edit', ['task' => $task, 'statuses' => $statuses]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, task $task)
    {

                   

         $validator = Validator::make($request->all(),
            [
                'task_name' => ['required', 'min:3', 'max:100'],
                'task_completed_data' => ['required',],
                'task_description' => ['required'],
                'statuse_id' => ['required' ,'integer', 'min:1'],
            ]

            );
            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }



        $task->task_name = $request->task_name;
        $task->completed_data = $request->task_completed_data;
        $task->task_description = $request->task_description;
        $task->status_id = $request->statuse_id;

        $task->save();
       return redirect()->route('task.index')->with('success_message', 'New Task added successful.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(task $task)
    {
    $task->delete();
       return redirect()->route('task.index')->with('success_message', 'Delete was successful.');;

    }
}
