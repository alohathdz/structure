@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <h5 class="card-header text-center">แก้ไขข้อมูลกำลังพล</h5>
                <div class="card-body">
                    <!-- Form -->
                    <form class="row g-3" action="{{ route('employees.update', $employee->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="col-md-3">
                            <label class="form-label" for="rank"><b>ยศ</b></label>
                            <select class="form-select" name="rank" required>
                                <option value="พ.ท." @if ($employee->rank == "พ.ท.") selected @endif>พันโท</option>
                                <option value="พ.ต." @if ($employee->rank == "พ.ต.") selected @endif>พันตรี</option>
                                <option value="ร.อ." @if ($employee->rank == "ร.อ.") selected @endif>ร้อยเอก</option>
                                <option value="ร.ท." @if ($employee->rank == "ร.ท.") selected @endif>ร้อยโท</option>
                                <option value="ร.ต." @if ($employee->rank == "ร.ต.") selected @endif>ร้อยตรี</option>
                                <option value="จ.ส.อ.(พ.)" @if ($employee->rank == "จ.ส.อ.(พ.)") selected @endif>จ่าสิบเอก(พิเศษ)</option>
                                <option value="จ.ส.อ." @if ($employee->rank == "จ.ส.อ.") selected @endif>จ่าสิบเอก</option>
                                <option value="จ.ส.ท." @if ($employee->rank == "จ.ส.ท.") selected @endif>จ่าสิบโท</option>
                                <option value="จ.ส.ต." @if ($employee->rank == "จ.ส.ต.") selected @endif>จ่าสิบตรี</option>
                                <option value="ส.อ." @if ($employee->rank == "ส.อ.") selected @endif>สิบเอก</option>
                                <option value="ส.ท." @if ($employee->rank == "ส.ท.") selected @endif>สิบโท</option>
                                <option value="ส.ต." @if ($employee->rank == "ส.ต.") selected @endif>สิบตรี</option>
                                <option value="" @if ($employee->rank == "") selected @endif>นาย</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="firstname" class="form-label"><b>ชื่อ</b></label>
                            <input type="text" class="form-control @error('firstname') is-invalid @enderror"
                                name="firstname" value="{{ $employee->firstname }}">
                            @error('firstname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-md-5">
                            <label for="lastname" class="form-label"><b>สกุล</b></label>
                            <input type="text" class="form-control @error('lastname') is-invalid @enderror"
                                name="lastname" value="{{ $employee->lastname }}">
                            @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="id_number" class="form-label"><b>เลขประจำตัวประชาชน</b></label>
                            <input type="text" class="form-control @error('id_number') is-invalid @enderror"
                                name="id_number" value="{{ $employee->id_number }}">
                            @error('id_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="soldier_number" class="form-label"><b>เลขประจำตัวทหาร</b></label>
                            <input type="text" class="form-control @error('soldier_number') is-invalid @enderror"
                                name="soldier_number" value="{{ $employee->soldier_number }}">
                            @error('soldier_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label" for="corps"><b>เหล่า</b></label>
                            <select class="form-select @error('corps') is-invalid @enderror" name="corps" required>
                                <option value="ม." @if ($employee->corps == "ม.") selected @endif>ม.</option>
                                <option value="พ." @if ($employee->corps == "พ.") selected @endif>พ.</option>
                                <option value="กง." @if ($employee->corps == "กง.") selected @endif>กง.</option>
                                <option value="" @if ($employee->corps == "") selected @endif>ไม่จำกัดเหล่า</option>
                            </select>
                            @error('corps')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label" for="origin"><b>กำเนิด</b></label>
                            <select class="form-select @error('origin') is-invalid @enderror" name="origin" required>
                                <option value="นร." @if ($employee->origin == "นร.") selected @endif>นร.</option>
                                <option value="นพท." @if ($employee->origin == "นพท.") selected @endif>นพท.</option>
                                <option value="นป." @if ($employee->origin == "นป.") selected @endif>นป.</option>
                                <option value="นนส." @if ($employee->origin == "นนส.") selected @endif>นนส.</option>
                                <option value="นชท." @if ($employee->origin == "นชท.") selected @endif>นชท.</option>
                                <option value="กองหนุน" @if ($employee->origin == "กองหนุน") selected @endif>กองหนุน</option>
                            </select>
                            @error('origin')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="document_date" class="form-label"><b>วันเกิด</b></label>
                            <input type="text" class="form-control" name="birthday" id="birthday"
                                value="{{ formatdateeng($employee->birthday) }}" readonly>
                        </div>

                        <div class="col-md-3">
                            <label for="document_date" class="form-label"><b>วันที่ได้รับยศล่าสุด</b></label>
                            <input type="text" class="form-control" name="rankdate" id="rankdate"
                                value="{{ formatdateeng($employee->rank_date) }}" readonly>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label" for="education"><b>วุฒิการศึกษา</b></label>
                            <select class="form-select @error('education') is-invalid @enderror" name="education"
                                required>
                                <option value="ม.ต้น" @if ($employee->education == "ม.ต้น") selected @endif>มัธยมศึกษาตอนต้น</option>
                                <option value="ม.ปลาย" @if ($employee->education == "ม.ปลาย") selected @endif>มัธยมศึกษาตอนปลาย</option>
                                <option value="ปวช." @if ($employee->education == "ปวช.") selected @endif>ปวช.</option>
                                <option value="ปวส." @if ($employee->education == "ปวส.") selected @endif>ปวส.</option>
                                <option value="อนุปริญญา" @if ($employee->education == "อนุปริญญา") selected @endif>อนุปริญญา</option>
                                <option value="ป.ตรี" @if ($employee->education == "ป.ตรี") selected @endif>ปริญญาตรี</option>
                                <option value="ป.โท" @if ($employee->education == "ป.โท") selected @endif>ปริญญาโท</option>
                                <option value="ป.เอก" @if ($employee->education == "ป.เอก") selected @endif>ปริญญาเอก</option>
                                <option value="" @if ($employee->education == "") selected @endif>อื่น ๆ</option>
                            </select>
                            @error('education')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="position_id" class="form-label"><b>เลขตำแหน่ง</b></label>
                            <input type="text" class="form-control @error('position_id') is-invalid @enderror"
                                name="position_id" value="{{ $employee->position_id }}">
                            @error('position_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-md-12 text-center">
                            <button class="btn btn-sm btn-primary" type="submit">บันทึก</button>
                            <a href="{{ route('employees.index') }}" class="btn btn-sm btn-danger">ยกเลิก</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="{{ asset('bootstrap-datepicker-thai/css/datepicker.css') }}" rel="stylesheet">
<script src="{{ asset('bootstrap-datepicker-thai/js/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('bootstrap-datepicker-thai/js/bootstrap-datepicker-thai.js') }}"></script>
<script src="{{ asset('bootstrap-datepicker-thai/js/locales/bootstrap-datepicker.th.js') }}"></script>
<script>
    $(function() {
                $("#birthday").datepicker({
                    language: 'th-th',
                    format: 'dd/mm/yyyy',
                    autoclose: true
                }),
                $("#rankdate").datepicker({
                    language: 'th-th',
                    format: 'dd/mm/yyyy',
                    autoclose: true
                });
            });
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