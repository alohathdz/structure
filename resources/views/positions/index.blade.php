@extends('layouts.app')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
@section('content')
<div class="container">
    <div class="row justify-content-center bg-light p-2 rounded">
        <div class="d-flex gap-2">
            <div class="me-auto">
                <h5>ทำเนียบ</h5>
            </div>
            <div class="ms-auto">
                <!-- ปุ่ม Home -->
                <a href="{{ route('home') }}" class="btn btn-primary btn-sm"><i class="bi bi-house-door"></i></a>
            </div>
        </div>
        <hr>
        <table class="table table-secondary table-striped table-bordered table-hover align-middle text-center"
            id="myTable">
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
                @foreach ($positions as $position)
                <tr @if ($position->status == 0)
                    class="table-dark"
                    @endif>
                    <th scope="row">{{ ++$i }}</th>
                    <td class="text-start">{{ $position->shortname }}<br>( {{ $position->name }} )<br>{{ $position->id
                        }}</td>
                    <td>{{ $position->expert }}</td>
                    <td>{{ $position->rate }}</td>
                    <td>{{ $position->corps }}</td>
                    <td>
                        @php
                        $employee = ('App\Models\Employee')::select('rank', 'firstname', 'lastname', 'id_number',
                        'soldier_number')
                        ->join('positions', 'employees.position_id', '=', 'positions.id')
                        ->where('position_id', $position->id)
                        ->get();
                        @endphp
                        @if (!$employee->first())
                        <p style="color:red">ว่าง</p>
                        @else
                        @foreach ($employee as $emp)
                        {{ $emp->rank . $emp->firstname }}&ensp;{{ $emp->lastname }}<br>
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
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script>
    $(document).ready( function () {
    $('#myTable').DataTable();
} );
</script>
@endsection