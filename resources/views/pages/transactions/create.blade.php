@extends('layouts.main')

@section('title', 'Transactions | Create')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Transactions | Create</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form method="POST" action="{{ route('transactions.store') }}">
                        @csrf
                        <div class="form-group">
                            <label class="font-weight-normal">Wallet</label>
                            <select name="wallet" class="form-control" id="wallet-select">
                                <option></option>
                                @foreach ($wallets as $w)
                                    <option value="{{ $w->id }}" {!! old('wallet') == $w->id ? 'selected' : '' !!}>
                                        {{ $w->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('wallet')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                            <label class="font-weight-normal mt-4">Package</label>
                            <select name="package" class="form-control" id="package-select">
                                <option></option>
                                <optgroup label="Thu">
                                    @foreach ($packages as $p)
                                        @if ($p->type == \App\Models\Package::TYPE_IN)
                                            <option value="{{ $p->id }}" {!! old('package') == $p->id ? 'selected' : '' !!}>
                                                {{ $p->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                </optgroup>
                                <optgroup label="Chi">
                                    @foreach ($packages as $p)
                                        @if ($p->type == \App\Models\Package::TYPE_OUT)
                                            <option value="{{ $p->id }}" {!! old('package') == $p->id ? 'selected' : '' !!}>
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
                            <input name="amount" class="form-control" id="amount" value="{{ old('amount') }}"/>
                            @error('amount')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                            <label class="font-weight-normal mt-4">Date</label>
                            <input type="date" name="date" class="form-control" value="{{ old('date') }}">
                            @error('date')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror

                            <label class="font-weight-normal mt-4">Note</label>
                            <textarea name="note" rows="5" class="form-control">{{ old('note') }}</textarea>
                            @error('note')
                                <div class="text-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Create</button>
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