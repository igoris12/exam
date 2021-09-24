<?php

namespace App\Http\Controllers;

use App\Models\Statuse;
use Illuminate\Http\Request;
use Validator;


class StatuseController extends Controller
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
    public function index()
    {
        $statuses = Statuse::orderBy('name', 'desc')->paginate(self::RESULTS_IN_PAGE)->withQueryString();
        return view('statuse.index', ['statuses' => $statuses]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('statuse.create');
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
                'statuse_name' => ['required', 'min:2', 'max:16'],
               
            ]

            );
            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }

        $statuse = new Statuse;
        $statuse->name = $request->statuse_name;
       

        $statuse->save();
        return redirect()->route('statuse.index')->with('success_message', 'New Statuse added successful.');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\statuse  $statuse
     * @return \Illuminate\Http\Response
     */
    public function edit(statuse $statuse)
    {
        return view('statuse.edit', ['statuse' => $statuse]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\statuse  $statuse
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, statuse $statuse)
    {

          $validator = Validator::make($request->all(),
            [
                'statuse_name' => ['required', 'min:2', 'max:16'],
               
            ]

            );
            if ($validator->fails()) {
                $request->flash();
                return redirect()->back()->withErrors($validator);
            }


        $statuse->name = $request->statuse_name;
       

        $statuse->save();
        return redirect()->route('statuse.index')->with('success_message', 'New Statuse added successful.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\statuse  $statuse
     * @return \Illuminate\Http\Response
     */
    public function destroy(statuse $statuse)
    {
        if($statuse->getTask->count()){
       return redirect()->route('statuse.index')->with('info_message', 'Statuse cant be deleted.');


       }
       $statuse->delete();
       return redirect()->route('statuse.index')->with('success_message', 'Delete was successful.');
    }
}
