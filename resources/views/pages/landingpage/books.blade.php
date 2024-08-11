@extends('pages.landingpage.app')

@section('title', 'Beranda')

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
  <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
    <h1 class="display-4">Buku</h1>
    <div class="row my-4 ">
        <div class="col-md-6">
            <form action="{{ url('/') }}">
                <div class="input-group">
                    <input type="text" class="form-control" name="title" placeholder="Cari berdasarkan judul" name="name">
                    <div class="input-group-append">
                        <button class="btn btn-primary">Cari</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6">
            <form action="">
                <div class="input-group">
                    <select name="category_id" id="">
                        <option value="">Pilih Kategori</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
  </div>

  <div class="container">
    <div class="card-deck mb-3 text-center">

        @foreach ($books as $book )
          <div class="card mb-4 box-shadow">
            <div class="card-header">
              <h4 class="my-0 font-weight-normal">{{ $book->category->name }}</h4>
            </div>
            <div class="card-body">
                <img src="{{ asset('storage/covers/' . $book->cover) }}" alt="" class="img-thumbnail" style="max-height: 300px">
                <div class="my-2">
                    <p class="font-weight-bold">{{ $book->title }}</p>
                    <p class="card-text">{{ $book->description }}</p>
                </div>
              <a href="{{ asset('storage/books/' . $book->file) }}" target="_blank" class="btn btn-lg btn-block btn-outline-primary text-primary">Baca Buku</a>
            </div>
          </div>
        @endforeach

    </div>
    <div class="">
        {{ $books->withQueryString()->links() }}
    </div>
  </div>
@endsection

@push('scripts')
@endpush
