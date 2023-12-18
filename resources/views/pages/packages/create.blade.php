@extends('layouts.main')

@section('title', 'Packages | Create')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Packages | Create</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form method="POST" action="{{ route('packages.store') }}">
                        @csrf
                        <div class="form-group">
                            <label class="font-weight-normal">Name</label>
                            <input class="form-control" placeholder="Name" name="name" value="{{ old('name') }}">
                            @error('name')
                            <div class="text-danger">
                                {{ $message }}
                            </div>
                            @enderror

                            @php
                            $packageModel = new \App\Models\Package();
                            @endphp
                            <label class="font-weight-normal mt-4">Type</label>
                            <select name="type" class="form-control">
                                <option>Type</option>
                                <option value="{{ $packageModel::TYPE_IN }}" {!! old('type')==$packageModel::TYPE_IN ? 'selected' : '' !!}>
                                    Thu
                                </option>
                                <option value="{{ $packageModel::TYPE_OUT }}" {!! old('type')==$packageModel::TYPE_OUT ? 'selected' : '' !!}>
                                    Chi
                                </option>
                                <option value="{{ $packageModel::TYPE_LEND }}" {!! old('type')==$packageModel::TYPE_LEND ? 'selected' : '' !!}>
                                    Cho Vay
                                </option>
                                <option value="{{ $packageModel::TYPE_INVEST }}" {!! old('type')==$packageModel::TYPE_INVEST ? 'selected' : '' !!}>
                                    Đầu Tư
                                </option>
                            </select>
                            @error('type')
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