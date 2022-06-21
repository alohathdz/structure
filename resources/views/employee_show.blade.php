@extends('layouts.app')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
@section('content')
<div class="container-fluid">
    <a href="{{ route('employee_create') }}" class="btn btn-primary btn-sm">เพิ่มกำลังพล</a>
    <hr class="my-2">
    <table class="table table-striped table-bordered table-hover align-middle text-center" id="myTable">
        <thead>
            <tr>
                <th scope="col" class="text-center">ลำดับ</th>
                <th scope="col" class="text-center">ยศ</th>
                <th scope="col" class="text-center">ชื่อ</th>
                <th scope="col" class="text-center">สกุล</th>
                <th scope="col" class="text-center">เลขประจำตัวประชาชน</th>
                <th scope="col" class="text-center">เลขประจำตัวทหาร</th>
                <th scope="col" class="text-center">เหล่า</th>
                <th scope="col" class="text-center">กำเนิด</th>
                <th scope="col" class="text-center">วันเกิด</th>
                <th scope="col" class="text-center">วุฒิการศึกษา</th>
                <th scope="col" class="text-center">จัดการ</th>
            </tr>
        </thead>
        <tbody>
            @php
            $i = 0;
            @endphp
            @foreach ($employee as $row)
            <tr>
                <td>{{ ++$i }}</td>
                <td>{{ $row->rank }}</td>
                <td class="text-start">{{ $row->firstname }}</td>
                <td class="text-start">{{ $row->lastname }}</td>
                <td>{{ $row->id_number }}</td>
                <td>{{ $row->soldier_number }}</td>
                <td>{{ $row->corps }}</td>
                <td>{{ $row->origin }}</td>
                <td>{{ age($row->birthday) }}</td>
                <td>{{ $row->education }}</td>
                <td><a href="{{ route('employee_edit', ['id' => $row->id]) }}"
                        class="btn btn-primary btn-sm">แก้ไข</a>&nbsp;<a href="{{ route('employee_destroy', ['id' => $row->id]) }}" class="btn btn-danger btn-sm" onclick="return confirm('คุณต้องการลบข้อมูล ใช่หรือไม่ ?')">ลบ</a>
                </td>
                @endforeach
        </tbody>
    </table>
</div>

<!-- JQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Data Table -->
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
<script>
    $(document).ready( function () {
    $('#myTable').DataTable({
        'ordering': false,
    });
} );
</script>
<!-- Sweet Alert -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('success'))
<script>
    Swal.fire("Success !!",
    "{{ Session::get('success') }}",
    "success"
    );
</script>
@elseif (session('error'))
<script>
    Swal.fire({
    title:"Error !!",
    text:"{{ Session::get('error') }}",
    icon:"error"
    });
</script>
@endif
@endsection