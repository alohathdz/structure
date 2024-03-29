@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Menu จัดการข้อมูลพื้นฐาน -->
    <div class="row justify-content-center text-center">
        <div class="col-sm-4">
            <div class="card bg-light">
                <div class="card-header">
                    <strong>ข้อมูลพื้นฐาน</strong>
                </div>
                <div class="card-body">
                    <a href="{{ route('employees.index') }}" class="btn btn-primary btn-sm"><i
                            class="bi bi-person"></i> กำลังพล</a>
                    <a href="{{ route('positions.index') }}" class="btn btn-success btn-sm"><i class="bi bi-building"></i>
                        ทำเนียบ</a>
                </div>
            </div>
        </div>
        <div class="col-sm-5">
            <div class="card bg-light">
                <div class="card-header">
                    <strong>สรุปรายงาน</strong>
                </div>
                <div class="card-body">
                    <a href="{{ route('employees.education') }}" class="btn btn-primary btn-sm"><i
                            class="bi bi-file-earmark-text"></i> ข้อมูลคุณวุฒิ</a>
                    <a href="{{ route('positions.null') }}" class="btn btn-primary btn-sm"><i
                            class="bi bi-file-earmark-text"></i> ตำแหน่งว่าง</a>
                            <a href="{{ route('employees.age') }}" class="btn btn-primary btn-sm"><i
                                class="bi bi-file-earmark-text"></i> อายุ</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection