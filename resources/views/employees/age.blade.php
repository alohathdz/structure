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
                    <th scope="col" class="text-center align-middle" rowspan="2"><strong>รวม</strong></th>
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
                    <td>{{ $punto_18_29 }}</td>
                    <td>{{ $punto_30_39 }}</td>
                    <td>{{ $punto_40_49 }}</td>
                    <td>{{ $punto_50_60 }}</td>
                    <td>{{ $punto60 }}</td>
                    <td>{{ $punto59 }}</td>
                    <td>{{ $punto58 }}</td>
                    <td>{{ $punto57 }}</td>
                    <td>{{ $punto56 }}</td>
                    <td><strong>{{ $punto }}</strong></td>
                </tr>
                <tr>
                    <td>พ.ต.</td>
                    <td>{{ $puntee_18_29 }}</td>
                    <td>{{ $puntee_30_39 }}</td>
                    <td>{{ $puntee_40_49 }}</td>
                    <td>{{ $puntee_50_60 }}</td>
                    <td>{{ $puntee60 }}</td>
                    <td>{{ $puntee59 }}</td>
                    <td>{{ $puntee58 }}</td>
                    <td>{{ $puntee57 }}</td>
                    <td>{{ $puntee56 }}</td>
                    <td><strong>{{ $puntee }}</strong></td>
                </tr>
                <tr>
                    <td>ร.อ.</td>
                    <td>{{ $royaek_18_29 }}</td>
                    <td>{{ $royaek_30_39 }}</td>
                    <td>{{ $royaek_40_49 }}</td>
                    <td>{{ $royaek_50_60 }}</td>
                    <td>{{ $royaek60 }}</td>
                    <td>{{ $royaek59 }}</td>
                    <td>{{ $royaek58 }}</td>
                    <td>{{ $royaek57 }}</td>
                    <td>{{ $royaek56 }}</td>
                    <td><strong>{{ $royaek }}</strong></td>
                </tr>
                <tr>
                    <td>ร.ท.</td>
                    <td>{{ $royto_18_29 }}</td>
                    <td>{{ $royto_30_39 }}</td>
                    <td>{{ $royto_40_49 }}</td>
                    <td>{{ $royto_50_60 }}</td>
                    <td>{{ $royto60 }}</td>
                    <td>{{ $royto59 }}</td>
                    <td>{{ $royto58 }}</td>
                    <td>{{ $royto57 }}</td>
                    <td>{{ $royto56 }}</td>
                    <td><strong>{{ $royto }}</strong></td>
                </tr>
                <tr>
                    <td>ร.ต.</td>
                    <td>{{ $roytee_18_29 }}</td>
                    <td>{{ $roytee_30_39 }}</td>
                    <td>{{ $roytee_40_49 }}</td>
                    <td>{{ $roytee_50_60 }}</td>
                    <td>{{ $roytee60 }}</td>
                    <td>{{ $roytee59 }}</td>
                    <td>{{ $roytee58 }}</td>
                    <td>{{ $roytee57 }}</td>
                    <td>{{ $roytee56 }}</td>
                    <td><strong>{{ $roytee }}</strong></td>
                </tr>
                <tr>
                    <td>จ.ส.อ.(พ.)</td>
                    <td>{{ $japor_18_29 }}</td>
                    <td>{{ $japor_30_39 }}</td>
                    <td>{{ $japor_40_49 }}</td>
                    <td>{{ $japor_50_60 }}</td>
                    <td>{{ $japor60 }}</td>
                    <td>{{ $japor59 }}</td>
                    <td>{{ $japor58 }}</td>
                    <td>{{ $japor57 }}</td>
                    <td>{{ $japor56 }}</td>
                    <td><strong>{{ $japor }}</strong></td>
                </tr>
                <tr>
                    <td>จ.ส.อ.</td>
                    <td>{{ $jasibaek_18_29 }}</td>
                    <td>{{ $jasibaek_30_39 }}</td>
                    <td>{{ $jasibaek_40_49 }}</td>
                    <td>{{ $jasibaek_50_60 }}</td>
                    <td>{{ $jasibaek60 }}</td>
                    <td>{{ $jasibaek59 }}</td>
                    <td>{{ $jasibaek58 }}</td>
                    <td>{{ $jasibaek57 }}</td>
                    <td>{{ $jasibaek56 }}</td>
                    <td><strong>{{ $jasibaek }}</strong></td>
                </tr>
                <tr>
                    <td>จ.ส.ท.</td>
                    <td>{{ $jasibto_18_29 }}</td>
                    <td>{{ $jasibto_30_39 }}</td>
                    <td>{{ $jasibto_40_49 }}</td>
                    <td>{{ $jasibto_50_60 }}</td>
                    <td>{{ $jasibto60 }}</td>
                    <td>{{ $jasibto59 }}</td>
                    <td>{{ $jasibto58 }}</td>
                    <td>{{ $jasibto57 }}</td>
                    <td>{{ $jasibto56 }}</td>
                    <td><strong>{{ $jasibto }}</strong></td>
                </tr>
                <tr>
                    <td>จ.ส.ต.</td>
                    <td>{{ $jasibtee_18_29 }}</td>
                    <td>{{ $jasibtee_30_39 }}</td>
                    <td>{{ $jasibtee_40_49 }}</td>
                    <td>{{ $jasibtee_50_60 }}</td>
                    <td>{{ $jasibtee60 }}</td>
                    <td>{{ $jasibtee59 }}</td>
                    <td>{{ $jasibtee58 }}</td>
                    <td>{{ $jasibtee57 }}</td>
                    <td>{{ $jasibtee56 }}</td>
                    <td><strong>{{ $jasibtee }}</strong></td>
                </tr>
                <tr>
                    <td>ส.อ.</td>
                    <td>{{ $sibaek_18_29 }}</td>
                    <td>{{ $sibaek_30_39 }}</td>
                    <td>{{ $sibaek_40_49 }}</td>
                    <td>{{ $sibaek_50_60 }}</td>
                    <td>{{ $sibaek60 }}</td>
                    <td>{{ $sibaek59 }}</td>
                    <td>{{ $sibaek58 }}</td>
                    <td>{{ $sibaek57 }}</td>
                    <td>{{ $sibaek56 }}</td>
                    <td><strong>{{ $sibaek }}</strong></td>
                </tr>
                <tr>
                    <td>ส.ท.</td>
                    <td>{{ $sibto_18_29 }}</td>
                    <td>{{ $sibto_30_39 }}</td>
                    <td>{{ $sibto_40_49 }}</td>
                    <td>{{ $sibto_50_60 }}</td>
                    <td>{{ $sibto60 }}</td>
                    <td>{{ $sibto59 }}</td>
                    <td>{{ $sibto58 }}</td>
                    <td>{{ $sibto57 }}</td>
                    <td>{{ $sibto56 }}</td>
                    <td><strong>{{ $sibto }}</strong></td>
                </tr>
                <tr>
                    <td>ส.ต.</td>
                    <td>{{ $sibtee_18_29 }}</td>
                    <td>{{ $sibtee_30_39 }}</td>
                    <td>{{ $sibtee_40_49 }}</td>
                    <td>{{ $sibtee_50_60 }}</td>
                    <td>{{ $sibtee60 }}</td>
                    <td>{{ $sibtee59 }}</td>
                    <td>{{ $sibtee58 }}</td>
                    <td>{{ $sibtee57 }}</td>
                    <td>{{ $sibtee56 }}</td>
                    <td><strong>{{ $sibtee }}</strong></td>
                </tr>
                <tr>
                    <td><strong>รวม</strong></td>
                    <td>{{ $age18_29 }}</td>
                    <td>{{ $age30_39 }}</td>
                    <td>{{ $age40_49 }}</td>
                    <td>{{ $age50_60 }}</td>
                    <td>{{ $age60 }}</td>
                    <td>{{ $age59 }}</td>
                    <td>{{ $age58 }}</td>
                    <td>{{ $age57 }}</td>
                    <td>{{ $age56 }}</td>
                    <td><strong>{{ $rank_sum }}</strong></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection