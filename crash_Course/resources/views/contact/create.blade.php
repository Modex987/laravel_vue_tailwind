@extends('layouts.app')



@section('title', 'Contact')



@section('content')

<h1>Contact Us</h1>
<hr>
<div class="row pb-5">
@if(!session()->has('status'))
<form action="{{ route('contact.store') }}" method="POST" class="col-12 px-5">
    @csrf
    <div class="mb-3">
        <label for="name" class="form-label">full name</label>
        <input type="text" name='name' class="form-control" id="name" value="{{ old('name') }}">
    </div>
    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" name='email' class="form-control" id="email" value="{{ old('email') }}">
    </div>
    <div class="mb-3">
        <label for="msg" class="form-label">Message</label>
        <textarea name="msg" id="" cols="30" rows="10" class="form-control">{{ old('msg') }}</textarea>
    </div>
    <input type="submit" name="submit" Value="Submit" class="mt-3 btn btn-primary">
</form>
@endif
</div>
@endsection