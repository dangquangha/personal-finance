@extends('layouts.main')

@section('title', 'Packages')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Packages</h1>
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
                        <a class="btn btn-primary px-3" href="{{ route('packages.create') }}">Add +</a>
                    </div>
                </div>

                <div class="col-md-12">
                    <table class="table table-bordered table-hover" style="background: #fff">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col" width="10%">Id</th>
                                <th scope="col" width="50%">Name</th>
                                <th scope="col" width="30%">Type</th>
                                <th scope="col" width="20%" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($packages as $package)
                            <tr>
                                <th scope="row">{{ $package->id }}</th>
                                <td>{{ $package->name }}</td>
                                <td>
                                    @if ($package->type == \App\Models\Package::TYPE_IN)
                                    <button class="btn btn-outline-success" disabled>Thu</button>
                                    @elseif ($package->type == \App\Models\Package::TYPE_OUT)
                                    <button class="btn btn-outline-danger" disabled>Chi</button>
                                    @else
                                    <button class="btn btn-outline-secondary">Không Xác Định</button>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn btn-success"
                                        href="{{ route('packages.edit', ['id' => $package->id]) }}">
                                        <i class="fas fa-pen"></i>
                                    </a>

                                    <div class="btn btn-danger btn-delete" data-id="{{ $package->id }}">
                                        <i class="fas fa-trash"></i>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="d-flex justify-content-end">
                        {{ $packages->links() }}
                    </div>
                </div>

                <form action="{{ route('packages.destroy') }}" id="delete-form" method="POST">
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