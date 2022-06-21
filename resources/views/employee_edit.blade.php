@extends('layouts.app')
@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <h5 class="card-header text-center">แก้ไขข้อมูลกำลังพล</h5>
                <div class="card-body">
                    <!-- Form -->
                    <form class="row g-3" action="{{ route('employee_update', ['id' => $emp->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="col-md-3">
                            <label class="form-label" for="rank"><b>ยศ</b></label>
                            <select class="form-select" name="rank" required>
                                <option value="พ.ท." @if ($emp->rank == "พ.ท.") selected @endif>พันโท</option>
                                <option value="พ.ต." @if ($emp->rank == "พ.ต.") selected @endif>พันตรี</option>
                                <option value="ร.อ." @if ($emp->rank == "ร.อ.") selected @endif>ร้อยเอก</option>
                                <option value="ร.ท." @if ($emp->rank == "ร.ท.") selected @endif>ร้อยโท</option>
                                <option value="ร.ต." @if ($emp->rank == "ร.ต.") selected @endif>ร้อยตรี</option>
                                <option value="จ.ส.อ.(พ.)" @if ($emp->rank == "จ.ส.อ.(พ.)") selected @endif>จ่าสิบเอก(พิเศษ)</option>
                                <option value="จ.ส.อ." @if ($emp->rank == "จ.ส.อ.") selected @endif>จ่าสิบเอก</option>
                                <option value="จ.ส.ท." @if ($emp->rank == "จ.ส.ท.") selected @endif>จ่าสิบโท</option>
                                <option value="จ.ส.ต." @if ($emp->rank == "จ.ส.ต.") selected @endif>จ่าสิบตรี</option>
                                <option value="ส.อ." @if ($emp->rank == "ส.อ.") selected @endif>สิบเอก</option>
                                <option value="ส.ท." @if ($emp->rank == "ส.ท.") selected @endif>สิบโท</option>
                                <option value="ส.ต." @if ($emp->rank == "ส.ต.") selected @endif>สิบตรี</option>
                                <option value="" @if ($emp->rank == "") selected @endif>นาย</option>
                            </select>
                        </div>

                        <div class="col-md-4">
                            <label for="firstname" class="form-label"><b>ชื่อ</b></label>
                            <input type="text" class="form-control @error('firstname') is-invalid @enderror"
                                name="firstname" value="{{ $emp->firstname }}">
                            @error('firstname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-md-5">
                            <label for="lastname" class="form-label"><b>สกุล</b></label>
                            <input type="text" class="form-control @error('lastname') is-invalid @enderror"
                                name="lastname" value="{{ $emp->lastname }}">
                            @error('lastname')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="id_number" class="form-label"><b>เลขประจำตัวประชาชน</b></label>
                            <input type="text" class="form-control @error('id_number') is-invalid @enderror"
                                name="id_number" value="{{ $emp->id_number }}">
                            @error('id_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label for="soldier_number" class="form-label"><b>เลขประจำตัวทหาร</b></label>
                            <input type="text" class="form-control @error('soldier_number') is-invalid @enderror"
                                name="soldier_number" value="{{ $emp->soldier_number }}">
                            @error('soldier_number')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="col-md-3">
                            <label class="form-label" for="corps"><b>เหล่า</b></label>
                            <select class="form-select @error('corps') is-invalid @enderror" name="corps" required>
                                <option value="ม." @if ($emp->corps == "ม.") selected @endif>ม.</option>
                                <option value="พ." @if ($emp->corps == "พ.") selected @endif>พ.</option>
                                <option value="กง." @if ($emp->corps == "กง.") selected @endif>กง.</option>
                                <option value="" @if ($emp->corps == "") selected @endif>ไม่จำกัดเหล่า</option>
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
                                <option value="นร." @if ($emp->origin == "นร.") selected @endif>นร.</option>
                                <option value="นพท." @if ($emp->origin == "นพท.") selected @endif>นพท.</option>
                                <option value="นป." @if ($emp->origin == "นป.") selected @endif>นป.</option>
                                <option value="นนส." @if ($emp->origin == "นนส.") selected @endif>นนส.</option>
                                <option value="นชท." @if ($emp->origin == "นชท.") selected @endif>นชท.</option>
                                <option value="กองหนุน" @if ($emp->origin == "กองหนุน") selected @endif>กองหนุน</option>
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
                                value="{{ formatdateeng($emp->birthday) }}" readonly>
                        </div>

                        <div class="col-md-3">
                            <label for="document_date" class="form-label"><b>วันที่ได้รับยศล่าสุด</b></label>
                            <input type="text" class="form-control" name="rankdate" id="rankdate"
                                value="{{ formatdateeng($emp->rank_date) }}" readonly>
                        </div>
                        
                        <div class="col-md-6">
                            <label class="form-label" for="education"><b>วุฒิการศึกษา</b></label>
                            <select class="form-select @error('education') is-invalid @enderror" name="education"
                                required>
                                <option value="ม.ต้น" @if ($emp->education == "ม.ต้น") selected @endif>มัธยมศึกษาตอนต้น</option>
                                <option value="ม.ปลาย" @if ($emp->education == "ม.ปลาย") selected @endif>มัธยมศึกษาตอนปลาย</option>
                                <option value="ปวช." @if ($emp->education == "ปวช.") selected @endif>ปวช.</option>
                                <option value="ปวส." @if ($emp->education == "ปวส.") selected @endif>ปวส.</option>
                                <option value="อนุปริญญา" @if ($emp->education == "อนุปริญญา") selected @endif>อนุปริญญา</option>
                                <option value="ป.ตรี" @if ($emp->education == "ป.ตรี") selected @endif>ปริญญาตรี</option>
                                <option value="ป.โท" @if ($emp->education == "ป.โท") selected @endif>ปริญญาโท</option>
                                <option value="ป.เอก" @if ($emp->education == "ป.เอก") selected @endif>ปริญญาเอก</option>
                                <option value="" @if ($emp->education == "") selected @endif>อื่น ๆ</option>
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
                                name="position_id" value="{{ $emp->position_id }}">
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