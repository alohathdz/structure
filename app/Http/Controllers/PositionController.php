<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PositionController extends Controller
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
        $data['positions'] = Position::all();
        return view('positions.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function report()
    {
        $data['report'] = Position::select('shortname', 'expert', 'rate', 'corps', DB::raw('COUNT(*) as num'))
            ->where('status', '=', 1)
            ->whereNotIn('id', (function ($query) {
                $query->select('position_id')->from('employees');
            }))
            ->whereNotIn('rate', ['พ.ท.', 'พ.ต.', 'ร.อ.', 'ร.ท.', 'ร.ต.'])
            ->groupBy('shortname', 'expert', 'rate', 'corps')
            ->orderByRaw("CASE rate WHEN 'จ.(พ.)' THEN 1 
            WHEN 'จ.' THEN 2 
            WHEN 'ส.อ.' THEN 3 
            ELSE 13 END")
            ->get();

        return view('positions.null', $data);
    }
}
