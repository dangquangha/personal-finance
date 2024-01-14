@extends('layouts.main')

@section('title', 'Dashboard')

@section('css')

@endsection

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
                    <div class="col-md-6">
                        <canvas id="chart-by-months"></canvas>
                    </div>
                    <div class="col-md-6">
                        <canvas id="chart-by-budgets"></canvas>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('script')
    <script>
        const CHART_BY_MONTHS = JSON.parse('{!! $monthsInYear !!}');
    </script>"
    <script src="{{ asset('js/pages/dashboard/index.js') }}"></script>
@endsection
