@extends('layouts.app')


@section('title', 'Create Customer')



@section('content')

<h1>Create Customer</h1>
<hr>

<form method="post" action="{{ route('customers.store') }}" enctype="multipart/form-data">
    @include('inc.form')
</form>

@endsection