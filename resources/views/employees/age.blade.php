@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="d-flex gap-2">
            <div class="me-auto">
                <h5 class="text-light">อายุ</h5>
            </div>
            <div class="ms-auto">
                <!-- ปุ่ม Home -->
                <a href="{{ route('home') }}" class="btn btn-primary btn-sm"><i class="bi bi-house-door"></i></a>
            </div>
        </div>
        <table class="table table-secondary table-hover table-bordered text-center mt-1">
            <thead>
                <tr>
                    <th scope="col" class="text-center align-middle" rowspan="2">ยศ</th>
                    <th scope="col" class="text-center" colspan="4">อายุ</th>
                    <th scope="col" class="text-center" colspan="5">เกษียณอายุห้วง 6 ปี</th>
                </tr>
                <tr>
                    <th>18-29 ปี</th>
                    <th>30-39 ปี</th>
                    <th>40-49 ปี</th>
                    <th>50-60 ปี</th>
                    <th>ต.ค. {{ (date('y') +43) }}</th>
                    <th>ต.ค. {{ (date('y') +44) }}</th>
                    <th>ต.ค. {{ (date('y') +45) }}</th>
                    <th>ต.ค. {{ (date('y') +46) }}</th>
                    <th>ต.ค. {{ (date('y') +47) }}</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>พ.ท.</td>
                </tr>
                <tr>
                    <td>พ.ต.</td>
                </tr>
                <tr>
                    <td>ร.อ.</td>
                </tr>
                <tr>
                    <td>ร.ท.</td>
                </tr>
                <tr>
                    <td>ร.ต.</td>
                </tr>
                <tr>
                    <td>จ.ส.อ.(พ.)</td>
                </tr>
                <tr>
                    <td>จ.ส.อ.</td>
                </tr>
                <tr>
                    <td>จ.ส.ท.</td>
                </tr>
                <tr>
                    <td>จ.ส.ต.</td>
                </tr>
                <tr>
                    <td>ส.อ.</td>
                </tr>
                <tr>
                    <td>ส.ท.</td>
                </tr>
                <tr>
                    <td>ส.ต.</td>
                </tr>
                <tr>
                    <td><strong>รวม</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection