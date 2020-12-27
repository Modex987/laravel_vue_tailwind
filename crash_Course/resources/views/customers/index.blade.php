@extends('layouts.app')


@section('title', 'Customers')



@section('content')

<h1>Customers</h1>

<hr>

<div class="row justify-content-center align-items-center">
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th><b> full Name </b></th>
                <th><b> E-mail </b></th>
                <th><b> Status </b></th>
                <th><b> Company </b></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($customers as $customer) : ?>
            <tr>
                {{-- <td> <a href="customers/<?= $customer->id; ?>"><?= $customer->name; ?></a> </td> --}}
                <td>
                    @can('view', $customer)
                        <a href="{{ route('customers.show', $customer) }}">
                            <?= $customer->name; ?>
                        </a>
                    @endcan
                    @cannot('view', $customer)
                        <?= $customer->name; ?>
                    @endcannot
                </td>
                <td> <?= $customer->email; ?> </td>
                <td> <?= $customer->status; ?> </td>
                <td> <?= $customer->company->name; ?> </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

{{ $customers->links() }}


@endsection