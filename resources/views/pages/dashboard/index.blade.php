@extends('layouts.main')

@section('title', 'Dashboard')


@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div>

                    {{-- <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div> --}}
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                @include('pages.dashboard.components.overview')

                <div class="row">
                    <div class="col-md-5">
                        <table class="table table-bordered table-hover" style="background: #fff">
                            <thead>
                                <tr class="bg-danger">
                                    <th scope="col" width="50%">Temporary Deposit</th>
                                    <th scope="col" width="50%">Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Hải</td>
                                    <td>{{ number_format(1000000) }}</td>
                                </tr>
                                <tr>
                                    <td>Hải</td>
                                    <td>{{ number_format(1000000) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-7">
                        <table class="table table-bordered table-hover" style="background: #fff">
                            <thead>
                                <tr class="bg-success">
                                    <th scope="col" width="25%">Package</th>
                                    <th scope="col" width="25%">Amount</th>
                                    <th scope="col" width="25%" class="bg-danger">Amount Used</th>
                                    <th scope="col" width="25%">Amount Left</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Mark</td>
                                    <td>{{ number_format(1000000) }}</td>
                                    <td>{{ number_format(1000000) }}</td>
                                    <td>{{ number_format(1000000) }}</td>
                                </tr>
                                <tr>
                                    <td>Jacob</td>
                                    <td>{{ number_format(1000000) }}</td>
                                    <td>{{ number_format(1000000) }}</td>
                                    <td>{{ number_format(1000000) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
