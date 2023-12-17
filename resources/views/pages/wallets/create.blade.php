@extends('layouts.main')

@section('title', 'Wallets | Create')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Wallets | Create</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <form method="POST" action="{{ route('wallets.store') }}">
                            @csrf
                            <div class="form-group">
                                <label class="font-weight-normal">Name</label>
                                <input class="form-control" placeholder="Name" name="name" value="{{ old('name') }}">
                                @error('name')
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
