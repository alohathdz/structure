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
    public function edit(Employee $employee)
    {
        return view('employees.edit', compact('employee'));
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
    public function update(Request $request)
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

        return redirect()->route('employees.edit', ['id' => $request->id])->with('success', 'แก้ไขข้อมูลเรียบร้อย');
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

    public function report()
    {
        $data['report'] = Employee::select('rank', 'education', DB::raw("COUNT(id) as num"))
            ->whereIn('education', ['อื่น ๆ', 'มัธยมศึกษาตอนต้น', 'มัธยมศึกษาตอนปลาย', 'ประกาศนียบัตรวิชาชีพ', 'ประกาศนียบัตรวิชาชีพชั้นสูง', 'อนุปริญญา', 'ปริญญาตรี', 'ปริญญาโท', 'ปริญญาเอก'])
            ->orderByRaw("CASE rank WHEN 'พ.ท.' THEN 1 
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
            ELSE 13 END")
            ->groupBy('rank', 'education')
            ->get();

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

        return view('employees.report', $data);
    }
}
