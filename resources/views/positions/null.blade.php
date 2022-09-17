@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="d-flex gap-2">
            <div class="me-auto">
                <h5 class="text-light">ตำแหน่งว่าง</h5>
            </div>
            <div class="ms-auto">
                <!-- ปุ่ม Home -->
                <a href="{{ route('home') }}" class="btn btn-primary btn-sm"><i class="bi bi-house-door"></i></a>
            </div>
        </div>
        <table class="table table-secondary table-hover table-bordered text-center mt-1">
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
                @php
                $i = 1;
                @endphp
                @foreach ($report as $position)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $position->shortname }}</td>
                    <td>{{ $position->corps }}</td>
                    <td>{{ $position->expert }}</td>
                    <td>{{ $position->rate }}</td>
                    <td>{{ $position->num }}</td>
                </tr>
                @endforeach
                <tr class="fw-bold">
                    <td colspan="5">รวม</td>
                    <td>{{ $report->sum('num') }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection