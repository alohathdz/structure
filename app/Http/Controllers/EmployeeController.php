<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Position;
use ErrorException;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employee = Employee::orderByRaw("CASE rank WHEN 'พ.ท.' THEN 1 
        WHEN 'พ.ต.' THEN 2 
        WHEN 'ร.อ.' THEN 3 
        WHEN 'ร.ท.' THEN 4 
        WHEN 'ร.ต.' THEN 5 
        WHEN 'จ.ส.อ.(พ.)' THEN 6 
        WHEN 'จ.ส.อ.' THEN 7 
        WHEN 'จ.ส.ท.' THEN 8 
        WHEN 'จ.ส.ต.' THEN 9 
        WHEN 'ส.อ.' THEN 10 
        WHEN 'ส.ท.' THEN 11 
        WHEN 'ส.ต.' THEN 12 
        ELSE 13 END")->get();
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
        try {
            $request->validate([
                'firstname' => 'required|string',
                'lastname' => 'required|string',
                'id_number' => 'required|digits:13|unique:employees',
                'soldier_number' => 'digits:10|unique:employees',
                'corps' => 'required',
                'origin' => 'required',
                'education' => 'required',
                'position_id' => 'digits:12|unique:employees'
            ]);
    
            Employee::create([
                'rank' => $request->rank,
                'firstname' => $request->firstname,
                'lastname' => $request->lastname,
                'id_number' => $request->id_number,
                'soldier_number' => $request->soldier_number,
                'corps' => $request->corps,
                'origin' => $request->origin,
                'birthday' => dateeng(formatdatethai($request->birthday)),
                'rank_date' => dateeng(formatdatethai($request->rankdate)),
                'education' => $request->education,
                'position_id' => $request->position_id
            ]);

            return redirect()->route('employee_index')->with('success', 'เพิ่มข้อมูลกำลังพลเรียบร้อย');
        } catch (ErrorException $e) {
            return $e;
        }
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
        $emp = Employee::find($id);
        return view('employee_edit', compact('emp'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        Employee::where('id', $request->id)
        ->update([
            'rank' => $request->rank,
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'id_number' => $request->id_number,
            'soldier_number' => $request->soldier_number,
            'corps' => $request->corps,
            'origin' => $request->origin,
            'birthday' => dateeng(formatdatethai($request->birthday)),
            'rank_date' => dateeng(formatdatethai($request->rankdate)),
            'education' => $request->education,
            'position_id' => $request->position_id
        ]);
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
