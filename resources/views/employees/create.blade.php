@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-7">
            @if (session('fail'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('fail') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <div class="card">
                <h5 class="card-header text-center">เพิ่มข้อมูลกำลังพล</h5>
                <div class="card-body">
                    <!-- Form -->
                    <form class="row g-3" action="{{ route('employees.store') }}" method="POST">
                        @csrf

                        <div class="col-md-3">
                            <label class="form-label" for="rank"><b>ยศ</b></label>
                            <select class="form-select" name="rank" required>
                                <option value="" selected disabled hidden>เลือกยศ</option>
                                <option value="พ.ท." {{ old('rank')=='พ.ท.' ? 'selected' : '' }}>พันโท</option>
                                <option value="พ.ต." {{ old('rank')=='พ.ต.' ? 'selected' : '' }}>พันตรี</option>
                                <option value="ร.อ." {{ old('rank')=='ร.อ.' ? 'selected' : '' }}>ร้อยเอก</option>
                                <option value="ร.ท." {{ old('rank')=='ร.ท.' ? 'selected' : '' }}>ร้อยโท</option>
                                <option value="ร.ต." {{ old('rank')=='ร.ต.' ? 'selected' : '' }}>ร้อยตรี</option>
                                <option value="จ.ส.อ.(พ.)" {{ old('rank')=='จ.ส.อ.(พ.)' ? 'selected' : '' }}>
                                    จ่าสิบเอก(พิเศษ)</option>
                                <option value="จ.ส.อ." {{ old('rank')=='จ.ส.อ.' ? 'selected' : '' }}>จ่าสิบเอก</option>
                                <option value="จ.ส.ท." {{ old('rank')=='จ.ส.ท.' ? 'selected' : '' }}>จ่าสิบโท</option>
                                <option value="จ.ส.ต." {{ old('rank')=='จ.ส.ต.' ? 'selected' : '' }}>จ่าสิบตรี</option>
                                <option value="ส.อ." {{ old('rank')=='ส.อ.' ? 'selected' : '' }}>สิบเอก</option>
                                <option value="ส.ท." {{ old('rank')=='ส.ท.' ? 'selected' : '' }}>สิบโท</option>
                                <option value="ส.ต." {{ old('rank')=='ส.ต.' ? 'selected' : '' }}>สิบตรี</option>
                                <option value="นาย" {{ old('rank')=='นาย' ? 'selected' : '' }}>นาย</option>
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
                                name="id_number" value="{{ old('id_number') }}" maxlength="13">
                            @error('id_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="soldier_number" class="form-label"><b>เลขประจำตัวทหาร</b></label>
                            <input type="text" class="form-control @error('soldier_number') is-invalid @enderror"
                                name="soldier_number" value="{{ old('soldier_number') }}" maxlength="10">
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
                                <option value="ม." {{ old('corps')=='ม.' ? 'selected' : '' }}>ม.</option>
                                <option value="พ." {{ old('corps')=='พ.' ? 'selected' : '' }}>พ.</option>
                                <option value="กง." {{ old('corps')=='กง.' ? 'selected' : '' }}>กง.</option>
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
                                <option value="นร." {{ old('origin')=='นร.' ? 'selected' : '' }}>นร.</option>
                                <option value="นพท." {{ old('origin')=='นพท.' ? 'selected' : '' }}>นพท.</option>
                                <option value="นป." {{ old('origin')=='นป.' ? 'selected' : '' }}>นป.</option>
                                <option value="นนส." {{ old('origin')=='นนส.' ? 'selected' : '' }}>นนส.</option>
                                <option value="นชท." {{ old('origin')=='นชท.' ? 'selected' : '' }}>นชท.</option>
                                <option value="กองหนุน" {{ old('origin')=='กองหนุน.' ? 'selected' : '' }}>กองหนุน
                                </option>
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
                                placeholder="เลือกวันเกิด" value="{{ old('birthday') }}" readonly>
                        </div>

                        <div class="col-md-3">
                            <label for="document_date" class="form-label"><b>วันที่ได้รับยศล่าสุด</b></label>
                            <input type="text" class="form-control" name="rankdate" id="rankdate"
                                placeholder="เลือกวันที่ได้รับยศล่าสุด" value="{{ old('rankdate') }}" readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label" for="education"><b>วุฒิการศึกษา</b></label>
                            <select class="form-select @error('education') is-invalid @enderror" name="education"
                                required>
                                <option value="" selected disabled hidden>เลือกวุฒิการศึกษา</option>
                                <option value="มัธยมศึกษาตอนต้น" {{ old('education')=='มัธยมศึกษาตอนต้น' ? 'selected' : '' }}>มัธยมศึกษาตอนต้น
                                </option>
                                <option value="มัธยมศึกษาตอนปลาย" {{ old('education')=='มัธยมศึกษาตอนปลาย' ? 'selected' : '' }}>
                                    มัธยมศึกษาตอนปลาย</option>
                                <option value="ประกาศนียบัตรวิชาชีพ" {{ old('education')=='ประกาศนียบัตรวิชาชีพ' ? 'selected' : '' }}>ประกาศนียบัตรวิชาชีพ</option>
                                <option value="ประกาศนียบัตรวิชาชีพชั้นสูง" {{ old('education')=='ประกาศนียบัตรวิชาชีพชั้นสูง' ? 'selected' : '' }}>ประกาศนียบัตรวิชาชีพชั้นสูง</option>
                                <option value="อนุปริญญา" {{ old('education')=='อนุปริญญา' ? 'selected' : '' }}>
                                    อนุปริญญา</option>
                                <option value="ปริญญาตรี" {{ old('education')=='ปริญญาตรี' ? 'selected' : '' }}>ปริญญาตรี
                                </option>
                                <option value="ปริญญาโท" {{ old('education')=='ปริญญาโท' ? 'selected' : '' }}>ปริญญาโท</option>
                                <option value="ปริญญาเอก" {{ old('education')=='ปริญญาเอก' ? 'selected' : '' }}>ปริญญาเอก
                                </option>
                                <option value="อื่น ๆ" {{ old('education')=='อื่นๆ' ? 'selected' : '' }}>อื่น ๆ</option>
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
                                name="position_id" value="{{ old('position_id') }}" maxlength="12">
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
@endsection