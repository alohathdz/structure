@extends('layouts.app')
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
@section('content')
<div class="container-fluid">
    <table class="table table-striped table-bordered table-hover align-middle text-center">
        <thead>
            <tr>
                <th scope="col" class="text-center">ลำดับ</th>
                <th scope="col" class="text-center">ตำแหน่ง</th>
                <th scope="col" class="text-center">เหล่า</th>
                <th scope="col" class="text-center">ชกท.</th>
                <th scope="col" class="text-center">อัตรา</th>
                <th scope="col" class="text-center">จำนวน</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
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