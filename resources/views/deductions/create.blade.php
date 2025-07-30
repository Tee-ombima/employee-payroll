@extends('layouts.app')

@section('content')
@include('deductions.form', [
    'title' => 'Add New Deduction',
    'action' => route('deductions.store'),
    'buttonText' => 'Save Deduction'
])
@endsection