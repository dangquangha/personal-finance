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
                    @if (session('status'))
                        @include('components.main.toast-success', ['message' => session('status')])
                    @endif

                    <div class="col-md-5 mb-3">
                        <form>
                            <div class="d-flex">
                                <input class="form-control mr-2" placeholder="Search" name="keyword">
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
                                    <th scope="col" width="80%">Name</th>
                                    <th scope="col" width="20%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @for ($i = 1; $i <= 10; $i++)
                                    <tr>
                                        <th scope="row">{{ $i }}</th>
                                        <td>Mark</td>
                                        <td>
                                            <a class="btn btn-success" href="{{ route('packages.edit', ['id' => $i]) }}">
                                                <i class="fas fa-pen"></i>
                                            </a>

                                            <div class="btn btn-danger">
                                                <i class="fas fa-trash"></i>
                                            </div>
                                        </td>
                                    </tr>
                                @endfor
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
