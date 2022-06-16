@extends('layouts.app')

@section('content')
<table class="table table-striped table-bordered align-middle">
    <thead>
        <tr class="text-center">
            <th scope="col" style="width:2%">ลำดับ</th>
            <th scope="col" style="width:20%">ตำแหน่ง</th>
            <th scope="col" style="width:5%">ชกท.</th>
            <th scope="col" style="width:5%">อัตรา</th>
            <th scope="col" style="width:5%">เหล่า</th>
            <th scope="col" style="width:20%">คนบรรจุ</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($position as $row)
        <tr>
            <th scope="row" class="text-center">{{ $row->id }}</th>
            <td>{{ $row->name }}</td>
            <td class="text-center">{{ $row->expert }}</td>
            <td class="text-center">{{ $row->rate }}</td>
            <td class="text-center">{{ $row->corps }}</td>
            <td class="text-center">
                @php
                    $employee = ('App\Models\Employee')::select('firstname', 'lastname', 'id_number', 'soldier_number')
                    ->join('positions', 'employees.position_id', '=', 'positions.id')
                    ->where('position_id', $row->id)
                    ->get();
                @endphp
                @if (!$employee->first())
                <p style="color:red">ว่าง</p>
                @else
                @foreach ($employee as $emp)
                    {{ $emp->firstname }}&ensp;{{ $emp->lastname }}<br>
                    {{ $emp->id_number }}<br>
                    {{ $emp->soldier_number }}
                @endforeach
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection