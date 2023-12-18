@extends('layouts.main')

@section('title', 'Packages | Edit')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Packages | Edit</h1>
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
                    <form method="POST" action="{{ route('packages.update', ['id' => $id]) }}">
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

                            @php
                                $packageModel = new \App\Models\Package();
                                $type = old('type') ? old('type') : $type;
                            @endphp
                            <label class="font-weight-normal mt-4">Type</label>
                            <select name="type" class="form-control">
                                <option>Type</option>
                                <option value="{{ $packageModel::TYPE_IN }}" {!! $type==$packageModel::TYPE_IN ? 'selected' : '' !!}>
                                    Thu
                                </option>
                                <option value="{{ $packageModel::TYPE_OUT }}" {!! $type==$packageModel::TYPE_OUT ? 'selected' : '' !!}>
                                    Chi
                                </option>
                            </select>
                            @error('type')
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