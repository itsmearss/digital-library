@extends('layouts.app')

@section('title', 'Books')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/selectric/public/selectric.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <section class="section">
            <div class="section-header">
                <h1>Buku</h1>
                <div class="section-header-button">
                    <a href="{{ route('books.create') }}" class="btn btn-primary">Tambah Buku Baru</a>
                    <a href="{{ url('export') }}" class="btn btn-success">Export Excel</a>
                </div>
                <div class="section-header-breadcrumb">
                    <div class="breadcrumb-item active"><a href="{{route('home')}}">Dashboard</a></div>
                    <div class="breadcrumb-item"><a href="#">Buku</a></div>
                    <div class="breadcrumb-item">Semua Buku</div>
                </div>
            </div>
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        @include('layouts.alert')
                    </div>
                </div>
                <h2 class="section-title">Buku</h2>
                <p class="section-lead">
                    Anda dapat mengelola data buku, seperti menambah, mengubah, menghapus dan lainnya.
                </p>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Semua Buku</h4>
                            </div>
                            <div class="card-body">
                                <div class="float-right">
                                    <form method="GET" action="{{ route('books.index') }}">
                                        <div class="input-group">
                                            {{-- <input type="text" class="form-control" placeholder="Search" name="name"> --}}
                                            <select name="category_id" class="form-control selectric @error('category_id') is-invalid @enderror">
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

                                <div class="clearfix mb-3"></div>

                                <div class="table-responsive">
                                    <table class="table-striped table">
                                        <tr>
                                            <th>Nomor</th>
                                            <th>Judul Buku</th>
                                            <th>Kategori</th>
                                            <th>Jumlah</th>
                                            <th>Sampul</th>
                                            <th>File Buku</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                        @foreach ($books as $book)
                                            <tr>
                                                <td>
                                                    {{ $loop->iteration }}
                                                </td>
                                                <td>
                                                    {{ $book->title }}
                                                </td>
                                                <td>
                                                    {{ $book->category->name }}
                                                </td>
                                                <td>
                                                    {{ $book->amount }}
                                                </td>
                                                <td>
                                                    @if ($book->cover)
                                                        <img src="{{ asset('storage/covers/' . $book->cover) }}" alt="cover"
                                                            style="width: 100px" class="img-thumbnail">
                                                    @else
                                                        No Photo
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href='{{ asset('storage/books/' . $book->file) }}'
                                                        class="btn btn-sm btn-success btn-icon" target="_blank">
                                                        <i class="fas fa-book"></i>
                                                        Lihat File
                                                    </a>
                                                </td>
                                                <td>
                                                    <div class="d-flex justify-content-center">
                                                        <a href='{{ route('books.show', $book->id) }}'
                                                            class="btn btn-sm btn-success btn-icon">
                                                            <i class="fas fa-eye"></i>
                                                            Show
                                                        </a>

                                                        <a href='{{ route('books.edit', $book->id) }}'
                                                            class="btn btn-sm btn-info btn-icon ml-2">
                                                            <i class="fas fa-edit"></i>
                                                            Edit
                                                        </a>

                                                        <form action="{{ route('books.destroy', $book->id) }}" method="POST"
                                                            class="ml-2">
                                                            <input type="hidden" name="_method" value="DELETE" />
                                                            <input type="hidden" name="_token"
                                                                value="{{ csrf_token() }}" />
                                                            <button class="btn btn-sm btn-danger btn-icon confirm-delete" onclick="return confirm('Are you sure?')">
                                                                <i class="fas fa-times"></i> Delete
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                                <div class="float-right">
                                    {{ $books->withQueryString()->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/selectric/public/jquery.selectric.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/features-posts.js') }}"></script>
@endpush
