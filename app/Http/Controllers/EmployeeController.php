<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::all();
        return view('employee_show', compact('employee'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $position = Position::whereNotIn('id', function ($query) {
            $query->select('position_id')->from('employees');
        })->where('status', true)->get();

        return view('employee_add', compact('position'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'id_number' => 'required|min:13|max:13|unique:employees',
            'soldier' => 'min:10|max:10|unique:employees',
            'corps' => 'required',
            'origin' => 'required',
            'education' => 'required'
        ]);

        $position = Position::select('id')->where('number', $request->position)->first();
        if (Employee::where('position_id', $position)->first()) {
            $emp = Employee::create([
                'rank' => $request->rank,
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'id_number' => $request->id_number,
                'soldier_number' => $request->soldier_number,
                'corps' => $request->corps,
                'origin' => $request->origin,
                'birthday' => dateeng($request->birthday),
                'rank_date' => dateeng($request->rankdate),
                'education' => $request->education,
                'position_id' => $position
            ]);
        }

        // $emp = new Employee();
        // $emp->rank = $request->rank;
        // $emp->firstname = $request->firstname;
        // $emp->lastname = $request->lastname;
        // $emp->id_number = $request->id_number;
        // $emp->soldier_number = $request->soldier_number;
        // $emp->corps = $request->corps;
        // $emp->origin = $request->origin;
        // $emp->birthday = dateeng($request->birthday);
        // $emp->rank_date = dateeng($request->rankdate);
        // $emp->education = $request->education;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
