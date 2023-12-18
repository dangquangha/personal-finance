@extends('layouts.main')

@section('title', 'Transactions')

@section('css')
<style>
    .select2-selection__clear {
        font-size: 20px !important;
        margin-top: -5px
    }
</style>
@endsection

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Transactions</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @if (session('status'))
                @include('components.main.toast-success', ['message' => session('status')])
                @endif

                <div class="col-md-8 mb-3">
                    <form>
                        <div class="d-flex">
                            <div class="col-4 pl-0">
                                <select name="wallet" class="form-control" id="wallet-select">
                                    <option></option>
                                    @foreach ($wallets as $w)
                                        <option value="{{ $w->id }}" {!! $wallet_id == $w->id ? 'selected' : '' !!}>
                                            {{ $w->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-4 pl-0">
                                <select name="package" class="form-control" id="package-select">
                                    <option></option>
                                    <optgroup label="Thu">
                                        @foreach ($packages as $p)
                                            @if ($p->type == \App\Models\Package::TYPE_IN)
                                                <option value="{{ $p->id }}" {!! $package_id == $p->id ? 'selected' : '' !!}>
                                                    {{ $p->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </optgroup>
                                    <optgroup label="Chi">
                                        @foreach ($packages as $p)
                                            @if ($p->type == \App\Models\Package::TYPE_OUT)
                                                <option value="{{ $p->id }}" {!! $package_id == $p->id ? 'selected' : '' !!}>
                                                    {{ $p->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </optgroup>
                                    <optgroup label="Cho Vay">
                                        @foreach ($packages as $p)
                                            @if ($p->type == \App\Models\Package::TYPE_LEND)
                                                <option value="{{ $p->id }}" {!! $package_id == $p->id ? 'selected' : '' !!}>
                                                    {{ $p->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </optgroup>
                                    <optgroup label="Đầu Tư">
                                        @foreach ($packages as $p)
                                            @if ($p->type == \App\Models\Package::TYPE_INVEST)
                                                <option value="{{ $p->id }}" {!! $package_id == $p->id ? 'selected' : '' !!}>
                                                    {{ $p->name }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </optgroup>
                                </select>
                            </div>

                            <button class="btn btn-secondary" type="submit">Search</button>
                        </div>
                    </form>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-primary px-3" href="{{ route('transactions.create') }}">Add +</a>
                    </div>
                </div>

                <div class="col-md-12">
                    <table class="table table-bordered table-hover" style="background: #fff">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" width="15%">Date</th>
                                <th scope="col" width="15%">Wallet</th>
                                <th scope="col" width="20%">Package</th>
                                <th scope="col" width="15%">Amount</th>
                                <th scope="col" width="25%">Note</th>
                                <th scope="col" width="10%" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($transactions as $transaction)
                                @php
                                    $itemWallet = $transaction->wallet;
                                    $itemPackage = $transaction->package;
                                    $itempackageType = 'text-secondary';
                                    if ($itemPackage && $itemPackage->type == \App\Models\Package::TYPE_IN) {
                                        $itempackageType = 'text-success';
                                    }
                                    if ($itemPackage && $itemPackage->type == \App\Models\Package::TYPE_OUT) {
                                        $itempackageType = 'text-danger';
                                    }
                                    if ($itemPackage && $itemPackage->type == \App\Models\Package::TYPE_LEND) {
                                        $itempackageType = 'text-warning';
                                    }
                                    if ($itemPackage && $itemPackage->type == \App\Models\Package::TYPE_INVEST) {
                                        $itempackageType = 'text-warning';
                                    }
                                @endphp
                                <tr>
                                    <td scope="row">
                                        {{ (new DateTime($transaction->date))->format("d/m/Y") }}
                                    </td>
                                    <td scope="row">
                                        {{ $itemWallet ? $itemWallet->name : 'Không Xác Định' }}
                                    </td>
                                    <td scope="row">
                                        {{ $itemPackage ? $itemPackage->name : 'Không Xác Định' }}
                                    </td>
                                    <td scope="row" class="{{ $itempackageType }}">
                                        {{ number_format($transaction->amount) }}
                                    </td>
                                    <td scope="row">
                                        {!! textareaBreakLine($transaction->note) !!}
                                    </td>
                                    <td>
                                        <a class="btn btn-success"
                                            href="{{ route('transactions.edit', ['id' => $transaction->id]) }}">
                                            <i class="fas fa-pen"></i>
                                        </a>

                                        <div class="btn btn-danger btn-delete" data-id="{{ $transaction->id }}">
                                            <i class="fas fa-trash"></i>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-end">
                        {{ $transactions->appends(request()->query())->links() }}
                    </div>
                </div>

                <form action="{{ route('transactions.destroy') }}" id="delete-form" method="POST">
                    @csrf
                    <input type="hidden" name="id" id="delete-id">
                </form>
            </div>
        </div>
    </section>
</div>
@endsection

@section('script')
    @include('components.main.toast-delete')
    <script>
        $('#wallet-select').select2({
            placeholder: "Select a wallet",
            allowClear: true
        });
        $('#package-select').select2({
            placeholder: "Select a package",
            allowClear: true
        });
    </script>
@endsection