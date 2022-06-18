@extends('layouts.app')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
@section('content')
<div class="container-fluid">
    <table class="table table-striped table-bordered table-hover align-middle text-center" id="myTable">
        <thead>
            <tr>
                <th scope="col" class="text-center">ลำดับ</th>
                <th scope="col" class="text-center">ตำแหน่ง</th>
                <th scope="col" class="text-center">ชกท.</th>
                <th scope="col" class="text-center">อัตรา</th>
                <th scope="col" class="text-center">เหล่า</th>
                <th scope="col" class="text-center">คนบรรจุ</th>
            </tr>
        </thead>
        <tbody>
            @php
                $i = 0;
            @endphp
            @foreach ($position as $row)
            <tr @if ($row->status == 0)
                class="table-dark"
                @endif>
                <th scope="row">{{ ++$i }}</th>
                <td class="text-start">{{ $row->shortname }}<br>( {{ $row->name }} )<br>{{ $row->id }}</td>
                <td>{{ $row->expert }}</td>
                <td>{{ $row->rate }}</td>
                <td>{{ $row->corps }}</td>
                <td>
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
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script>
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
@endsection