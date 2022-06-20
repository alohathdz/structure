@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <h5 class="card-header text-center">เพิ่มข้อมูลกำลังพล</h5>
                <div class="card-body">
                    <!-- Form -->
                    <form class="row g-3" action="{{ route('employee_store') }}" method="POST">
                        @csrf

                        <div class="col-md-3">
                            <label class="form-label" for="rank"><b>ยศ</b></label>
                            <select class="form-select" name="rank" required>
                                <option value="" selected disabled hidden>เลือกยศ</option>
                                <option value="พ.ท.">พันโท</option>
                                <option value="พ.ต.">พันตรี</option>
                                <option value="ร.อ.">ร้อยเอก</option>
                                <option value="ร.ท.">ร้อยโท</option>
                                <option value="ร.ต.">ร้อยตรี</option>
                                <option value="จ.ส.อ.(พ.)">จ่าสิบเอก(พิเศษ)</option>
                                <option value="จ.ส.อ.">จ่าสิบเอก</option>
                                <option value="จ.ส.ท.">จ่าสิบโท</option>
                                <option value="จ.ส.ต.">จ่าสิบตรี</option>
                                <option value="ส.อ.">สิบเอก</option>
                                <option value="ส.ท.">สิบโท</option>
                                <option value="ส.ต.">สิบตรี</option>
                                <option value="">นาย</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="firstname" class="form-label"><b>ชื่อ</b></label>
                            <input type="text" class="form-control @error('firstname') is-invalid @enderror"
                                name="firstname" value="{{ old('firstname') }}">
                            @error('firstname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-md-5">
                            <label for="lastname" class="form-label"><b>สกุล</b></label>
                            <input type="text" class="form-control @error('lastname') is-invalid @enderror"
                                name="lastname" value="{{ old('lastname') }}">
                            @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="id_number" class="form-label"><b>เลขประจำตัวประชาชน</b></label>
                            <input type="text" class="form-control @error('id_number') is-invalid @enderror"
                                name="id_number" value="{{ old('id_number') }}">
                            @error('id_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="soldier_number" class="form-label"><b>เลขประจำตัวทหาร</b></label>
                            <input type="text" class="form-control @error('soldier_number') is-invalid @enderror"
                                name="soldier_number" value="{{ old('soldier_number') }}">
                            @error('soldier_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label" for="corps"><b>เหล่า</b></label>
                            <select class="form-select @error('corps') is-invalid @enderror" name="corps" required>
                                <option value="" selected disabled hidden>เลือกเหล่า</option>
                                <option value="ม.">ม.</option>
                                <option value="พ.">พ.</option>
                                <option value="กง.">กง.</option>
                                <option value="">ไม่จำกัดเหล่า</option>
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
                                <option value="" selected disabled hidden>เลือกกำเนิด</option>
                                <option value="นร.">นร.</option>
                                <option value="นพท.">นพท.</option>
                                <option value="นป.">นป.</option>
                                <option value="นนส.">นนส.</option>
                                <option value="นชท.">นชท.</option>
                                <option value="กองหนุน">กองหนุน</option>
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
                                placeholder="เลือกวันเกิด" readonly>
                        </div>

                        <div class="col-md-3">
                            <label for="document_date" class="form-label"><b>วันที่ได้รับยศล่าสุด</b></label>
                            <input type="text" class="form-control" name="rankdate" id="rankdate"
                                placeholder="เลือกวันที่ได้รับยศล่าสุด" readonly>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label" for="education"><b>วุฒิการศึกษา</b></label>
                            <select class="form-select @error('education') is-invalid @enderror" name="education"
                                required>
                                <option value="" selected disabled hidden>เลือกวุฒิการศึกษา</option>
                                <option value="ม.ต้น">มัธยมศึกษาตอนต้น</option>
                                <option value="ม.ปลาย">มัธยมศึกษาตอนปลาย</option>
                                <option value="ปวช.">ปวช.</option>
                                <option value="ปวส.">ปวส.</option>
                                <option value="อนุปริญญา">อนุปริญญา</option>
                                <option value="ป.ตรี">ปริญญาตรี</option>
                                <option value="ป.โท">ปริญญาโท</option>
                                <option value="ป.เอก">ปริญญาเอก</option>
                                <option value="">อื่น ๆ</option>
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
                                name="position_id" value="{{ old('position_id') }}">
                            @error('position_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-md-12 text-center">
                            <button class="btn btn-sm btn-primary" type="submit">บันทึก</button>
                            <a href="#" class="btn btn-sm btn-danger">ยกเลิก</a>
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
@endsection