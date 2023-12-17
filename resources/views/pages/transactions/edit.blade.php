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
                                <label class="font-weight-normal">Name</label>
                                <input class="form-control" placeholder="Name" name="name"
                                    value="{{ old('name') ?? $name }}">
                                @error('name')
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
