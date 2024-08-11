@extends('layouts.app')

@section('title', 'Edit Buku')

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
                <h1>Edit Buku</h1>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="{{route('books.index')}}">Buku</a></div>
                    <div class="breadcrumb-item">Edit Buku</div>
                </div>
            </div>

            <div class="section-body">
                <h2 class="section-title">Buku</h2>
                <div class="card">
                    <form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="card-header">
                            <h4>Edit Buku</h4>
                        </div>
                        <input type="hidden" name="user_id" value="{{ Auth()->user()->id }}">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text"
                                    class="form-control @error('title') is-invalid @enderror"
                                    name="title" value="{{ old('title', $book->title) }}">
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Kategori</label>
                                <select name="category_id"
                                    class="form-control selectric @error('category_id') is-invalid @enderror">
                                    @foreach ($categories as $category)
                                        @if (old('category_id', $book->category_id ) == $category->id)
                                            <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                        @else
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea style="height: 150px" name="description" class="form-control @error('description') is-invalid @enderror" placeholder="Masukkan deskripsi buku">{{old('description', $book->description)}}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Jumlah</label>
                                <input type="number"
                                    class="form-control @error('amount') is-invalid @enderror"
                                    name="amount" value="{{old('amount', $book->amount)}}" placeholder="Masukkan jumlah buku">
                                @error('amount')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group block">
                                <label>File Buku (pdf) | max <i class="mdi mdi-numeric-2-box-multiple-outline:"></i></label>
                                <br>
                                <a href="{{asset('storage/books/' . $book->file)}}" class="btn btn-success btn-icon" target="_blank"><i class="fas fa-book"></i> Lihat file buku</a>
                                <br>
                                <br>
                                <span>Masukkan file baru jika ingin mengubah File</span>
                                <input type="file" class="form-control" @error('file') is-invalid @enderror name="file">
                                @error('file')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Sampul | max 2MB </label>
                                <input type="hidden" name="oldImage" value="{{ $book->cover }}" class="rounded-1">
                                <br>
                                @if ($book->cover)
                                    <img src="{{ asset('storage/covers/' . $book->cover) }}" alt="photo" class="img-preview img-fluid mb-3 col-sm-5">
                                @else
                                    <img class="img-preview img-fluid mb-3 col-sm-5">
                                @endif

                                <input type="file" class="form-control @error('cover') is-invalid @enderror" name="cover" id="photo" onchange="previewImage()">
                                @error('cover')
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
        </section>
    </div>

    <script>
        function previewImage(){
        const image = document.querySelector('#photo');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function(oFReader) {
          imgPreview.src = oFReader.target.result;
        }

      }
  </script>
@endsection

@push('scripts')
@endpush
