@extends('layouts.main')

@section('title', 'Dashboard')


@section('content')
    <div class="content-wrapper">
        @include('pages.dashboard.components.header')

        <section class="content">
            <div class="container-fluid">
                @include('pages.dashboard.components.overview')

                <div class="row">
                    <div class="col-md-12">

                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
