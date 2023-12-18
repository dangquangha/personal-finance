@extends('layouts.main')

@section('title', 'Transactions | Edit')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Transactions | Edit</h1>
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

                <div class="col-md-6">
                    <form method="POST" action="{{ route('transactions.update', ['id' => $id]) }}">
                        @csrf
                        <div class="form-group">
                            @php
                                $wallet = old('wallet') ? old('wallet') : $transaction->wallet_id;
                            @endphp
                            <label class="font-weight-normal">Wallet</label>
                            <select name="wallet" class="form-control" id="wallet-select">
                                <option></option>
                                @foreach ($wallets as $w)
                                    <option value="{{ $w->id }}" {!! $wallet == $w->id ? 'selected' : '' !!}>
                                        {{ $w->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('wallet')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                            @php
                                $package = old('package') ? old('package') : $transaction->package_id;
                            @endphp
                            <label class="font-weight-normal mt-4">Package</label>
                            <select name="package" class="form-control" id="package-select">
                                <option></option>

                                <optgroup label="Thu">
                                    @foreach ($packages as $p)
                                        @if ($p->type == \App\Models\Package::TYPE_IN)
                                            <option value="{{ $p->id }}" {!! $package == $p->id ? 'selected' : '' !!}>
                                                {{ $p->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </optgroup>

                                <optgroup label="Chi">
                                    @foreach ($packages as $p)
                                        @if ($p->type == \App\Models\Package::TYPE_OUT)
                                            <option value="{{ $p->id }}" {!! $package == $p->id ? 'selected' : '' !!}>
                                                {{ $p->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </optgroup>

                                <optgroup label="Cho Vay">
                                    @foreach ($packages as $p)
                                        @if ($p->type == \App\Models\Package::TYPE_LEND)
                                            <option value="{{ $p->id }}" {!! $package == $p->id ? 'selected' : '' !!}>
                                                {{ $p->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </optgroup>

                                <optgroup label="Đầu Tư">
                                    @foreach ($packages as $p)
                                        @if ($p->type == \App\Models\Package::TYPE_INVEST)
                                            <option value="{{ $p->id }}" {!! $package == $p->id ? 'selected' : '' !!}>
                                                {{ $p->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </optgroup>
                            </select>
                            @error('package')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                            <label class="font-weight-normal mt-4">Amount</label>
                            <input name="amount" class="form-control" id="amount" value="{{ old('amount') ? old('amount') : $transaction->amount }}"/>
                            @error('amount')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                            <label class="font-weight-normal mt-4">Date</label>
                            <input type="date" name="date" class="form-control" value="{{ old('date') ? old('date') : $transaction->date }}">
                            @error('date')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                            <label class="font-weight-normal mt-4">Note</label>
                            <textarea name="note" rows="5" class="form-control">{{ old('note') ? old('note') : $transaction->note }}</textarea>
                            @error('note')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@section('script')
<script src="{{ asset('js/pages/transactions/index.js') }}"></script>
@endsection