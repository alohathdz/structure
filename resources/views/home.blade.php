@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <a href="{{ route('positions.index') }}" class="btn btn-primary btn-sm">ทำเนียบหน่วย</a>
    <a href="{{ route('employees.index') }}" class="btn btn-primary btn-sm">ทำเนียบกำลังพล</a>
</div>
@endsection