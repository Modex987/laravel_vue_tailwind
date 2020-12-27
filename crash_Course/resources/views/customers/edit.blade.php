@extends('layouts.app')


@section('title')
Edit <?= $customer->name ?> Infos
@endsection



@section('content')

<h1>Edit <?= $customer->name ?> Infos</h1>
<hr>

<form method="POST" action="/customers/<?= $customer->id ?>" enctype="multipart/form-data">
    @method('PATCH')
    @include('inc.form')
</form>

@endsection