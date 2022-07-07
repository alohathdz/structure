@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <table class="table table-hover table-border">
        <thead>
            <tr>
                <th>ยศ</th>
                <th>วุฒิ</th>
                <th>จำนวน</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($report as $row)
            <tr>
                <td>{{ $row->rank }}</td>
                <td>{{ $row->education }}</td>
                <td>{{ $row->num }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection