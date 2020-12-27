@extends('layouts.app')


@section('title')
<?= $customer->name ?>: Infos
@endsection



@section('content')

<h1>Customers</h1>

<hr>
<div class="row align-items-center justify-content-center">
    <div class="col-3">
        <a class="btn btn-primary m-2" href="{{ route('customers.edit', $customer) }}">Edit</a>
    </div>
    <div class="col-3">
        <form action="{{ route('customers.destroy', $customer) }}" method="POST" class="inline">
            @csrf
            @method('DELETE')
            <input type="submit" class="btn btn-danger m-2" value="Delete">
        </form>
    </div>



</div>
<div class="row">
    <div class="col-6 border rounded p-4">
        <ul>
            <li><?= $customer->name ?></li>
            <li><?= $customer->email ?></li>
            <li><?= $customer->status ?></li>
            <li><?= $customer->company->name ?></li>
        </ul>
    </div>
</div>
<div class="row p-5">
    @if ($customer->profile_img)
        <img src="{{ asset('storage/' . $customer->profile_img) }}" alt="">    
    @endif
</div>


@endsection