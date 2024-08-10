<table class="table-striped table">
    <tr>
        <th>Nomor</th>
        <th>Judul Buku</th>
        <th>Kategori</th>
        <th>Jumlah</th>
        <th>Sampul</th>
        <th>File Buku</th>
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
                {{ $book->cover }}
            </td>
            <td>
                {{ $book->file }}
            </td>
        </tr>
    @endforeach
</table>
