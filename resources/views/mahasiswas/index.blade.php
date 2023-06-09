@extends('mahasiswas.layout') @section('content')
<div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left mt-2">
            <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
        </div>
        <div class="float-right my-2">
            <form class="d-flex" role="search" method="GET" action="/search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            <a class="btn btn-success" href="{{ route('mahasiswas.create') }}"> Input Mahasiswa</a>
        </div>
    </div>
</div>

@if ($message = Session::get('success'))
<div class="alert alert-success">
    <p>{{ $message }}</p>
</div> @endif
<table class="table table-bordered">
    <tr>
        <th>Nim</th>
        <th>Nama</th>
        <th>Foto</th>
        <th>Kelas</th>
        <th>Jurusan</th>
        <!-- <th>No_Handphone</th>
        <th>Email</th>
        <th>Ttl</th> -->
        <th width="280px">Action</th>
    </tr>
    @foreach ($mahasiswas as $Mahasiswa)
    <tr>

        <td>{{ $Mahasiswa->nim }}</td>
        <td>{{ $Mahasiswa->nama }}</td>
        <td><img width="100px" height="100px" src="{{ asset('storage/' . $Mahasiswa->foto) }}" style="object-fit: cover"></td>
        <td>{{ $Mahasiswa->kelas->nama_kelas }}</td>
        <td>{{ $Mahasiswa->jurusan }}</td>
        <!-- <td>{{ $Mahasiswa->no_handphone }}</td>
        <td>{{ $Mahasiswa->email }}</td>
        <td>{{ $Mahasiswa->ttl }}</td> -->
        <td>
            <form action="{{ route('mahasiswas.destroy',$Mahasiswa->nim ) }}" method="POST">

                <a class="btn btn-info" href="{{ route('mahasiswas.show',$Mahasiswa->nim) }}">Show</a>

                <a class="btn btn-primary" href="{{ route('mahasiswas.edit',$Mahasiswa->nim) }}">Edit</a> @csrf

                @method('DELETE')

                <button type="submit" class="btn btn-danger">Delete</button>
                <a class="btn btn-primary mt-3" href="{{route('mahasiswa.khs', $Mahasiswa->nim) }}">Nilai</a>
            </form>
        </td>
    </tr> @endforeach

</table>
@endsection