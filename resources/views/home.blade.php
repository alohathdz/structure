@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <a href="{{ route('position_index') }}" class="btn btn-primary btn-sm">ทำเนียบหน่วย</a><br>
    <a href="{{ route('employee_index') }}" class="btn btn-primary btn-sm">ทำเนียบกำลังพล</a>
</div>
@endsection