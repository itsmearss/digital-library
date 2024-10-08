@extends('layouts.app')

@section('title', 'Tambah Kategori')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/select2/dist/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-timepicker/css/bootstrap-timepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Tambah Kategori</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{route('categories.index')}}">Kategori</a></div>
                    <div class="breadcrumb-item">Tambah Kategori</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Kategori</h2>
                <div class="row px-3">
                    <div class="card col-md-6">
                        <form action="{{ route('categories.store') }}" method="POST">
                            @csrf
                            <div class="card-header">
                                <h4>Tambah Kategori Baru</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Nama Kategori</label>
                                    <input type="text"
                                        class="form-control @error('name') is-invalid @enderror"
                                        name="name" value="{{old('name')}}">
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </section>
    </div>
@endsection

@push('scripts')
@endpush
