@extends('layouts.main')

@section('title', 'Wallets')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Wallets</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                @if (session('success'))
                @include('components.main.toast-success', ['message' => session('success')])
                @endif

                @if (session('error'))
                @include('components.main.toast-error', ['message' => session('error')])
                @endif

                <div class="col-md-5 mb-3">
                    <form>
                        <div class="d-flex">
                            <input class="form-control mr-2" placeholder="Search" name="keyword" value="{{ $keyword }}">
                            <button class="btn btn-secondary" type="submit">Search</button>
                        </div>
                    </form>
                </div>

                <div class="col-md-7 mb-3">
                    <div class="d-flex justify-content-end">
                        <a class="btn btn-primary px-3" href="{{ route('wallets.create') }}">Add +</a>
                    </div>
                </div>

                <div class="col-md-12">
                    <table class="table table-bordered table-hover" style="background: #fff">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" width="10%">Id</th>
                                <th scope="col" width="80%">Name</th>
                                <th scope="col" width="20%" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wallets as $wallet)
                                <tr>
                                    <td scope="row">{{ $wallet->id }}</td>
                                    <td>{{ $wallet->name }}</td>
                                    <td>
                                        <a class="btn btn-success"
                                            href="{{ route('wallets.edit', ['id' => $wallet->id]) }}">
                                            <i class="fas fa-pen"></i>
                                        </a>

                                        <div class="btn btn-danger btn-delete" data-id="{{ $wallet->id }}">
                                            <i class="fas fa-trash"></i>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-end">
                        {{ $wallets->links() }}
                    </div>
                </div>

                <form action="{{ route('wallets.destroy') }}" id="delete-form" method="POST">
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
@endsection