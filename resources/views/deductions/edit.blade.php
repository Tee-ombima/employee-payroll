@extends('layouts.app')

@section('content')
@include('deductions.form', [
    'title' => 'Edit Deduction',
    'action' => route('deductions.update', $deduction),
    'deduction' => $deduction,
    'buttonText' => 'Update Deduction'
])
@endsection