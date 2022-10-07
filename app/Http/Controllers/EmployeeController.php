<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Position;
use ErrorException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
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
        $data['employees'] = Employee::orderByRaw("CASE rank WHEN 'พ.ท.' THEN 1 
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
        return view('employees.index', $data);
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

        return view('employees.create', compact('position'));
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

            if (Position::where('id', '=', $request->id)->first()) {
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

                return redirect()->route('employees.index')->with('success', 'เพิ่มข้อมูลกำลังพลเรียบร้อย');
            } else {
                return redirect()->route('employees.create')->with('fail', 'เลขที่ตำแหน่งไม่ถูกต้อง');
            }
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
        $data['employee'] = Employee::find($id);
        return view('employees.edit', $data);
        // if (Employee::find($id)) {
        //     $emp = Employee::find($id);
        //     return view('employees.edit', compact('emp'));
        // } else {
        //     return redirect()->route('employees.index')->with('error', 'ไม่พบข้อมูล');
        // }
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
        $request->validate([
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'id_number' => 'required|digits:13',
            'soldier_number' => 'digits:10',
            'corps' => 'required',
            'origin' => 'required',
            'education' => 'required',
            'position_id' => 'digits:12'
        ]);

        Employee::where('id', $id)
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

        return redirect()->route('employees.edit', $id)->with('success', 'แก้ไขข้อมูลเรียบร้อย');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Employee::find($id)->delete()) {
            return redirect()->route('employees.index')->with('success', 'ลบข้อมูลเรียบร้อย');
        }
    }

    public function education()
    {
        $data['punto_poraek'] = Employee::where('education', '=', 'ปริญญาเอก')->where('rank', '=', 'พ.ท.')->count();
        $data['punto_porto'] = Employee::where('education', '=', 'ปริญญาโท')->where('rank', '=', 'พ.ท.')->count();
        $data['punto_portee'] = Employee::where('education', '=', 'ปริญญาตรี')->where('rank', '=', 'พ.ท.')->count();
        $data['punto_under'] = Employee::whereNotIn('education', ['ปริญญาเอก', 'ปริญญาโท', 'ปริญญาตรี'])->where('rank', '=', 'พ.ท.')->count();
        
        $data['puntee_poraek'] = Employee::where('education', '=', 'ปริญญาเอก')->where('rank', '=', 'พ.ต.')->count();
        $data['puntee_porto'] = Employee::where('education', '=', 'ปริญญาโท')->where('rank', '=', 'พ.ต.')->count();
        $data['puntee_portee'] = Employee::where('education', '=', 'ปริญญาตรี')->where('rank', '=', 'พ.ต.')->count();
        $data['puntee_under'] = Employee::whereNotIn('education', ['ปริญญาเอก', 'ปริญญาโท', 'ปริญญาตรี'])->where('rank', '=', 'พ.ต.')->count();

        $data['royaek_poraek'] = Employee::where('education', '=', 'ปริญญาเอก')->where('rank', '=', 'ร.อ.')->count();
        $data['royaek_porto'] = Employee::where('education', '=', 'ปริญญาโท')->where('rank', '=', 'ร.อ.')->count();
        $data['royaek_portee'] = Employee::where('education', '=', 'ปริญญาตรี')->where('rank', '=', 'ร.อ.')->count();
        $data['royaek_under'] = Employee::whereNotIn('education', ['ปริญญาเอก', 'ปริญญาโท', 'ปริญญาตรี'])->where('rank', '=', 'ร.อ.')->count();

        $data['royto_poraek'] = Employee::where('education', '=', 'ปริญญาเอก')->where('rank', '=', 'ร.ท.')->count();
        $data['royto_porto'] = Employee::where('education', '=', 'ปริญญาโท')->where('rank', '=', 'ร.ท.')->count();
        $data['royto_portee'] = Employee::where('education', '=', 'ปริญญาตรี')->where('rank', '=', 'ร.ท.')->count();
        $data['royto_under'] = Employee::whereNotIn('education', ['ปริญญาเอก', 'ปริญญาโท', 'ปริญญาตรี'])->where('rank', '=', 'ร.ท.')->count();

        $data['roytee_poraek'] = Employee::where('education', '=', 'ปริญญาเอก')->where('rank', '=', 'ร.ต.')->count();
        $data['roytee_porto'] = Employee::where('education', '=', 'ปริญญาโท')->where('rank', '=', 'ร.ต.')->count();
        $data['roytee_portee'] = Employee::where('education', '=', 'ปริญญาตรี')->where('rank', '=', 'ร.ต.')->count();
        $data['roytee_under'] = Employee::whereNotIn('education', ['ปริญญาเอก', 'ปริญญาโท', 'ปริญญาตรี'])->where('rank', '=', 'ร.ต.')->count();

        $data['japor_poraek'] = Employee::where('education', '=', 'ปริญญาเอก')->where('rank', '=', 'จ.ส.อ.(พ.)')->count();
        $data['japor_porto'] = Employee::where('education', '=', 'ปริญญาโท')->where('rank', '=', 'จ.ส.อ.(พ.)')->count();
        $data['japor_portee'] = Employee::where('education', '=', 'ปริญญาตรี')->where('rank', '=', 'จ.ส.อ.(พ.)')->count();
        $data['japor_under'] = Employee::whereNotIn('education', ['ปริญญาเอก', 'ปริญญาโท', 'ปริญญาตรี'])->where('rank', '=', 'จ.ส.อ.(พ.)')->count();

        $data['jasibaek_poraek'] = Employee::where('education', '=', 'ปริญญาเอก')->where('rank', '=', 'จ.ส.อ.')->count();
        $data['jasibaek_porto'] = Employee::where('education', '=', 'ปริญญาโท')->where('rank', '=', 'จ.ส.อ.')->count();
        $data['jasibaek_portee'] = Employee::where('education', '=', 'ปริญญาตรี')->where('rank', '=', 'จ.ส.อ.')->count();
        $data['jasibaek_under'] = Employee::whereNotIn('education', ['ปริญญาเอก', 'ปริญญาโท', 'ปริญญาตรี'])->where('rank', '=', 'จ.ส.อ.')->count();

        $data['jasibto_poraek'] = Employee::where('education', '=', 'ปริญญาเอก')->where('rank', '=', 'จ.ส.ท.')->count();
        $data['jasibto_porto'] = Employee::where('education', '=', 'ปริญญาโท')->where('rank', '=', 'จ.ส.ท.')->count();
        $data['jasibto_portee'] = Employee::where('education', '=', 'ปริญญาตรี')->where('rank', '=', 'จ.ส.ท.')->count();
        $data['jasibto_under'] = Employee::whereNotIn('education', ['ปริญญาเอก', 'ปริญญาโท', 'ปริญญาตรี'])->where('rank', '=', 'จ.ส.ท.')->count();

        $data['jasibtee_poraek'] = Employee::where('education', '=', 'ปริญญาเอก')->where('rank', '=', 'จ.ส.ต.')->count();
        $data['jasibtee_porto'] = Employee::where('education', '=', 'ปริญญาโท')->where('rank', '=', 'จ.ส.ต.')->count();
        $data['jasibtee_portee'] = Employee::where('education', '=', 'ปริญญาตรี')->where('rank', '=', 'จ.ส.ต.')->count();
        $data['jasibtee_under'] = Employee::whereNotIn('education', ['ปริญญาเอก', 'ปริญญาโท', 'ปริญญาตรี'])->where('rank', '=', 'จ.ส.ต.')->count();

        $data['sibaek_poraek'] = Employee::where('education', '=', 'ปริญญาเอก')->where('rank', '=', 'ส.อ.')->count();
        $data['sibaek_porto'] = Employee::where('education', '=', 'ปริญญาโท')->where('rank', '=', 'ส.อ.')->count();
        $data['sibaek_portee'] = Employee::where('education', '=', 'ปริญญาตรี')->where('rank', '=', 'ส.อ.')->count();
        $data['sibaek_under'] = Employee::whereNotIn('education', ['ปริญญาเอก', 'ปริญญาโท', 'ปริญญาตรี'])->where('rank', '=', 'ส.อ.')->count();

        $data['sibto_poraek'] = Employee::where('education', '=', 'ปริญญาเอก')->where('rank', '=', 'ส.ท.')->count();
        $data['sibto_porto'] = Employee::where('education', '=', 'ปริญญาโท')->where('rank', '=', 'ส.ท.')->count();
        $data['sibto_portee'] = Employee::where('education', '=', 'ปริญญาตรี')->where('rank', '=', 'ส.ท.')->count();
        $data['sibto_under'] = Employee::whereNotIn('education', ['ปริญญาเอก', 'ปริญญาโท', 'ปริญญาตรี'])->where('rank', '=', 'ส.ท.')->count();

        $data['sibtee_poraek'] = Employee::where('education', '=', 'ปริญญาเอก')->where('rank', '=', 'ส.ต.')->count();
        $data['sibtee_porto'] = Employee::where('education', '=', 'ปริญญาโท')->where('rank', '=', 'ส.ต.')->count();
        $data['sibtee_portee'] = Employee::where('education', '=', 'ปริญญาตรี')->where('rank', '=', 'ส.ต.')->count();
        $data['sibtee_under'] = Employee::whereNotIn('education', ['ปริญญาเอก', 'ปริญญาโท', 'ปริญญาตรี'])->where('rank', '=', 'ส.ต.')->count();

        $data['poraek'] = Employee::where('education', '=', 'ปริญญาเอก')->count();
        $data['porto'] = Employee::where('education', '=', 'ปริญญาโท')->count();
        $data['portee'] = Employee::where('education', '=', 'ปริญญาตรี')->count();
        $data['under'] = Employee::whereNotIn('education', ['ปริญญาเอก', 'ปริญญาโท', 'ปริญญาตรี'])->count();

        //return $data;

        return view('employees.education', $data);
    }
    
    public function age()
    {
        $data['ranks'] = Employee::select('rank')->get();
        $data['punto_18_29'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [18, 29])->where('rank', '=', 'พ.ท.')->count();
        $data['punto_30_39'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [30, 39])->where('rank', '=', 'พ.ท.')->count();
        $data['punto_40_49'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [40, 49])->where('rank', '=', 'พ.ท.')->count();
        $data['punto_50_60'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [50, 60])->where('rank', '=', 'พ.ท.')->count();

        $data['puntee_18_29'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [18, 29])->where('rank', '=', 'พ.ต.')->count();
        $data['puntee_30_39'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [30, 39])->where('rank', '=', 'พ.ต.')->count();
        $data['puntee_40_49'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [40, 49])->where('rank', '=', 'พ.ต.')->count();
        $data['puntee_50_60'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [50, 60])->where('rank', '=', 'พ.ต.')->count();

        $data['royaek_18_29'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [18, 29])->where('rank', '=', 'ร.อ.')->count();
        $data['royaek_30_39'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [30, 39])->where('rank', '=', 'ร.อ.')->count();
        $data['royaek_40_49'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [40, 49])->where('rank', '=', 'ร.อ.')->count();
        $data['royaek_50_60'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [50, 60])->where('rank', '=', 'ร.อ.')->count();

        $data['royto_18_29'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [18, 29])->where('rank', '=', 'ร.ท.')->count();
        $data['royto_30_39'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [30, 39])->where('rank', '=', 'ร.ท.')->count();
        $data['royto_40_49'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [40, 49])->where('rank', '=', 'ร.ท.')->count();
        $data['royto_50_60'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [50, 60])->where('rank', '=', 'ร.ท.')->count();

        $data['roytee_18_29'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [18, 29])->where('rank', '=', 'ร.ต.')->count();
        $data['roytee_30_39'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [30, 39])->where('rank', '=', 'ร.ต.')->count();
        $data['roytee_40_49'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [40, 49])->where('rank', '=', 'ร.ต.')->count();
        $data['roytee_50_60'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [50, 60])->where('rank', '=', 'ร.ต.')->count();

        $data['japor_18_29'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [18, 29])->where('rank', '=', 'จ.ส.อ.(พ.)')->count();
        $data['japor_30_39'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [30, 39])->where('rank', '=', 'จ.ส.อ.(พ.)')->count();
        $data['japor_40_49'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [40, 49])->where('rank', '=', 'จ.ส.อ.(พ.)')->count();
        $data['japor_50_60'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [50, 60])->where('rank', '=', 'จ.ส.อ.(พ.)')->count();

        $data['jasibaek_18_29'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [18, 29])->where('rank', '=', 'จ.ส.อ.')->count();
        $data['jasibaek_30_39'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [30, 39])->where('rank', '=', 'จ.ส.อ.')->count();
        $data['jasibaek_40_49'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [40, 49])->where('rank', '=', 'จ.ส.อ.')->count();
        $data['jasibaek_50_60'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [50, 60])->where('rank', '=', 'จ.ส.อ.')->count();

        $data['jasibto_18_29'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [18, 29])->where('rank', '=', 'จ.ส.ท.')->count();
        $data['jasibto_30_39'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [30, 39])->where('rank', '=', 'จ.ส.ท.')->count();
        $data['jasibto_40_49'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [40, 49])->where('rank', '=', 'จ.ส.ท.')->count();
        $data['jasibto_50_60'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [50, 60])->where('rank', '=', 'จ.ส.ท.')->count();

        $data['jasibtee_18_29'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [18, 29])->where('rank', '=', 'จ.ส.ต.')->count();
        $data['jasibtee_30_39'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [30, 39])->where('rank', '=', 'จ.ส.ต.')->count();
        $data['jasibtee_40_49'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [40, 49])->where('rank', '=', 'จ.ส.ต.')->count();
        $data['jasibtee_50_60'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [50, 60])->where('rank', '=', 'จ.ส.ต.')->count();

        $data['sibaek_18_29'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [18, 29])->where('rank', '=', 'ส.อ.')->count();
        $data['sibaek_30_39'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [30, 39])->where('rank', '=', 'ส.อ.')->count();
        $data['sibaek_40_49'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [40, 49])->where('rank', '=', 'ส.อ.')->count();
        $data['sibaek_50_60'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [50, 60])->where('rank', '=', 'ส.อ.')->count();

        $data['sibto_18_29'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [18, 29])->where('rank', '=', 'ส.ท.')->count();
        $data['sibto_30_39'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [30, 39])->where('rank', '=', 'ส.ท.')->count();
        $data['sibto_40_49'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [40, 49])->where('rank', '=', 'ส.ท.')->count();
        $data['sibto_50_60'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [50, 60])->where('rank', '=', 'ส.ท.')->count();

        $data['sibtee_18_29'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [18, 29])->where('rank', '=', 'ส.ต.')->count();
        $data['sibtee_30_39'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [30, 39])->where('rank', '=', 'ส.ต.')->count();
        $data['sibtee_40_49'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [40, 49])->where('rank', '=', 'ส.ต.')->count();
        $data['sibtee_50_60'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [50, 60])->where('rank', '=', 'ส.ต.')->count();

        $data['age18_29'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [18, 29])->count();
        $data['age30_39'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [30, 39])->count();
        $data['age40_49'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [40, 49])->count();
        $data['age50_60'] = Employee::whereBetween(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), [50, 60])->count();

        $data['punto60'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 60)->where('rank', '=', 'พ.ท.')->count();
        $data['punto59'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 59)->where('rank', '=', 'พ.ท.')->count();
        $data['punto58'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 58)->where('rank', '=', 'พ.ท.')->count();
        $data['punto57'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 57)->where('rank', '=', 'พ.ท.')->count();
        $data['punto56'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 56)->where('rank', '=', 'พ.ท.')->count();

        $data['puntee60'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 60)->where('rank', '=', 'พ.ต.')->count();
        $data['puntee59'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 59)->where('rank', '=', 'พ.ต.')->count();
        $data['puntee58'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 58)->where('rank', '=', 'พ.ต.')->count();
        $data['puntee57'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 57)->where('rank', '=', 'พ.ต.')->count();
        $data['puntee56'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 56)->where('rank', '=', 'พ.ต.')->count();

        $data['royaek60'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 60)->where('rank', '=', 'ร.อ.')->count();
        $data['royaek59'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 59)->where('rank', '=', 'ร.อ.')->count();
        $data['royaek58'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 58)->where('rank', '=', 'ร.อ.')->count();
        $data['royaek57'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 57)->where('rank', '=', 'ร.อ.')->count();
        $data['royaek56'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 56)->where('rank', '=', 'ร.อ.')->count();

        $data['royto60'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 60)->where('rank', '=', 'ร.ท.')->count();
        $data['royto59'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 59)->where('rank', '=', 'ร.ท.')->count();
        $data['royto58'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 58)->where('rank', '=', 'ร.ท.')->count();
        $data['royto57'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 57)->where('rank', '=', 'ร.ท.')->count();
        $data['royto56'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 56)->where('rank', '=', 'ร.ท.')->count();

        $data['roytee60'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 60)->where('rank', '=', 'ร.ต.')->count();
        $data['roytee59'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 59)->where('rank', '=', 'ร.ต.')->count();
        $data['roytee58'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 58)->where('rank', '=', 'ร.ต.')->count();
        $data['roytee57'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 57)->where('rank', '=', 'ร.ต.')->count();
        $data['roytee56'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 56)->where('rank', '=', 'ร.ต.')->count();

        $data['japor60'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 60)->where('rank', '=', 'จ.ส.อ.(พ.)')->count();
        $data['japor59'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 59)->where('rank', '=', 'จ.ส.อ.(พ.)')->count();
        $data['japor58'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 58)->where('rank', '=', 'จ.ส.อ.(พ.)')->count();
        $data['japor57'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 57)->where('rank', '=', 'จ.ส.อ.(พ.)')->count();
        $data['japor56'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 56)->where('rank', '=', 'จ.ส.อ.(พ.)')->count();

        $data['jasibaek60'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 60)->where('rank', '=', 'จ.ส.อ.')->count();
        $data['jasibaek59'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 59)->where('rank', '=', 'จ.ส.อ.')->count();
        $data['jasibaek58'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 58)->where('rank', '=', 'จ.ส.อ.')->count();
        $data['jasibaek57'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 57)->where('rank', '=', 'จ.ส.อ.')->count();
        $data['jasibaek56'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 56)->where('rank', '=', 'จ.ส.อ.')->count();

        $data['jasibto60'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 60)->where('rank', '=', 'จ.ส.ท.')->count();
        $data['jasibto59'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 59)->where('rank', '=', 'จ.ส.ท.')->count();
        $data['jasibto58'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 58)->where('rank', '=', 'จ.ส.ท.')->count();
        $data['jasibto57'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 57)->where('rank', '=', 'จ.ส.ท.')->count();
        $data['jasibto56'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 56)->where('rank', '=', 'จ.ส.ท.')->count();

        $data['jasibtee60'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 60)->where('rank', '=', 'จ.ส.ต.')->count();
        $data['jasibtee59'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 59)->where('rank', '=', 'จ.ส.ต.')->count();
        $data['jasibtee58'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 58)->where('rank', '=', 'จ.ส.ต.')->count();
        $data['jasibtee57'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 57)->where('rank', '=', 'จ.ส.ต.')->count();
        $data['jasibtee56'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 56)->where('rank', '=', 'จ.ส.ต.')->count();

        $data['sibaek60'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 60)->where('rank', '=', 'ส.อ.')->count();
        $data['sibaek59'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 59)->where('rank', '=', 'ส.อ.')->count();
        $data['sibaek58'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 58)->where('rank', '=', 'ส.อ.')->count();
        $data['sibaek57'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 57)->where('rank', '=', 'ส.อ.')->count();
        $data['sibaek56'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 56)->where('rank', '=', 'ส.อ.')->count();

        $data['sibto60'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 60)->where('rank', '=', 'ส.ท.')->count();
        $data['sibto59'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 59)->where('rank', '=', 'ส.ท.')->count();
        $data['sibto58'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 58)->where('rank', '=', 'ส.ท.')->count();
        $data['sibto57'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 57)->where('rank', '=', 'ส.ท.')->count();
        $data['sibto56'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 56)->where('rank', '=', 'ส.ท.')->count();

        $data['sibtee60'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 60)->where('rank', '=', 'ส.ต.')->count();
        $data['sibtee59'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 59)->where('rank', '=', 'ส.ต.')->count();
        $data['sibtee58'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 58)->where('rank', '=', 'ส.ต.')->count();
        $data['sibtee57'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 57)->where('rank', '=', 'ส.ต.')->count();
        $data['sibtee56'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 56)->where('rank', '=', 'ส.ต.')->count();

        $data['age60'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 60)->count();
        $data['age59'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 59)->count();
        $data['age58'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 58)->count();
        $data['age57'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 57)->count();
        $data['age56'] = Employee::where(DB::raw('(YEAR(NOW()) - YEAR(birthday))'), '=', 56)->count();

        $data['punto'] = Employee::where('rank', '=', 'พ.ท.')->count();
        $data['puntee'] = Employee::where('rank', '=', 'พ.ต.')->count();
        $data['royaek'] = Employee::where('rank', '=', 'ร.อ.')->count();
        $data['royto'] = Employee::where('rank', '=', 'ร.ท.')->count();
        $data['roytee'] = Employee::where('rank', '=', 'ร.ต.')->count();
        $data['japor'] = Employee::where('rank', '=', 'จ.ส.อ.(พ.)')->count();
        $data['jasibaek'] = Employee::where('rank', '=', 'จ.ส.อ.')->count();
        $data['jasibto'] = Employee::where('rank', '=', 'จ.ส.ท.')->count();
        $data['jasibtee'] = Employee::where('rank', '=', 'จ.ส.ต.')->count();
        $data['sibaek'] = Employee::where('rank', '=', 'ส.อ.')->count();
        $data['sibto'] = Employee::where('rank', '=', 'ส.ท.')->count();
        $data['sibtee'] = Employee::where('rank', '=', 'ส.ต.')->count();

        $data['rank_sum'] = Employee::whereIn('rank' , ['พ.ท.', 'พ.ต.', 'ร.อ.', 'ร.ท.', 'ร.ต.', 'จ.ส.อ.(พ.)', 'จ.ส.อ.', 'จ.ส.ท.', 'จ.ส.ต.', 'ส.อ.', 'ส.ท.', 'ส.ต.'])->count();

        return view('employees.age', $data);
    }
}
