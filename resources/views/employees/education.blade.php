@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="d-flex gap-2">
            <div class="me-auto">
                <h5 class="text-light">คุณวุฒิ</h5>
            </div>
            <div class="ms-auto">
                <!-- ปุ่ม Home -->
                <a href="{{ route('home') }}" class="btn btn-primary btn-sm"><i class="bi bi-house-door"></i></a>
            </div>
        </div>
        <table class="table table-secondary table-hover table-bordered text-center mt-1">
            <thead>
                <tr>
                    <th>ยศ</th>
                    <th>ต่ำกว่าปริญญาตรี</th>
                    <th>ปริญญาตรี</th>
                    <th>ปริญญาโท</th>
                    <th>ปริญญาเอก</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>พ.ท.</td>
                    <td>{{ $punto_under }}</td>
                    <td>{{ $punto_portee }}</td>
                    <td>{{ $punto_porto }}</td>
                    <td>{{ $punto_poraek }}</td>
                </tr>
                <tr>
                    <td>พ.ต.</td>
                    <td>{{ $puntee_under }}</td>
                    <td>{{ $puntee_portee }}</td>
                    <td>{{ $puntee_porto }}</td>
                    <td>{{ $puntee_poraek }}</td>
                </tr>
                <tr>
                    <td>ร.อ.</td>
                    <td>{{ $royaek_under }}</td>
                    <td>{{ $royaek_portee }}</td>
                    <td>{{ $royaek_porto }}</td>
                    <td>{{ $royaek_poraek }}</td>
                </tr>
                <tr>
                    <td>ร.ท.</td>
                    <td>{{ $royto_under }}</td>
                    <td>{{ $royto_portee }}</td>
                    <td>{{ $royto_porto }}</td>
                    <td>{{ $royto_poraek }}</td>
                </tr>
                <tr>
                    <td>ร.ต.</td>
                    <td>{{ $roytee_under }}</td>
                    <td>{{ $roytee_portee }}</td>
                    <td>{{ $roytee_porto }}</td>
                    <td>{{ $roytee_poraek }}</td>
                </tr>
                <tr>
                    <td>จ.ส.อ.(พ.)</td>
                    <td>{{ $japor_under }}</td>
                    <td>{{ $japor_portee }}</td>
                    <td>{{ $japor_porto }}</td>
                    <td>{{ $japor_poraek }}</td>
                </tr>
                <tr>
                    <td>จ.ส.อ.</td>
                    <td>{{ $jasibaek_under }}</td>
                    <td>{{ $jasibaek_portee }}</td>
                    <td>{{ $jasibaek_porto }}</td>
                    <td>{{ $jasibaek_poraek }}</td>
                </tr>
                <tr>
                    <td>จ.ส.ท.</td>
                    <td>{{ $jasibto_under }}</td>
                    <td>{{ $jasibto_portee }}</td>
                    <td>{{ $jasibto_porto }}</td>
                    <td>{{ $jasibto_poraek }}</td>
                </tr>
                <tr>
                    <td>จ.ส.ต.</td>
                    <td>{{ $jasibtee_under }}</td>
                    <td>{{ $jasibtee_portee }}</td>
                    <td>{{ $jasibtee_porto }}</td>
                    <td>{{ $jasibtee_poraek }}</td>
                </tr>
                <tr>
                    <td>ส.อ.</td>
                    <td>{{ $sibaek_under }}</td>
                    <td>{{ $sibaek_portee }}</td>
                    <td>{{ $sibaek_porto }}</td>
                    <td>{{ $sibaek_poraek }}</td>
                </tr>
                <tr>
                    <td>ส.ท.</td>
                    <td>{{ $sibto_under }}</td>
                    <td>{{ $sibto_portee }}</td>
                    <td>{{ $sibto_porto }}</td>
                    <td>{{ $sibto_poraek }}</td>
                </tr>
                <tr>
                    <td>ส.ต.</td>
                    <td>{{ $sibtee_under }}</td>
                    <td>{{ $sibtee_portee }}</td>
                    <td>{{ $sibtee_porto }}</td>
                    <td>{{ $sibtee_poraek }}</td>
                </tr>
                <tr>
                    <td><strong>รวม</strong></td>
                    <td><strong>{{ $under }}</strong></td>
                    <td><strong>{{ $portee }}</strong></td>
                    <td><strong>{{ $porto }}</strong></td>
                    <td><strong>{{ $poraek }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection