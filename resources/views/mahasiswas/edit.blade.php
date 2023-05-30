@extends('mahasiswas.layout')

@section('content')

<div class="container mt-5">

    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 24rem;">
            <div class="card-header">
                Edit Mahasiswa
            </div>
            <div class="card-body">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your i
                    nput.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <form method="post" action="{{ route('mahasiswas.update', $Mahasiswa->nim) }}" id="myForm">
                    @csrf
                    @method('PUT')<div class="form-group">
                        <label for="Nim">Nim</label>
                        <input type="text" name="nim" class="formcontrol" id="nim" value="{{ $Mahasiswa->nim }}" ariadescribedby="Nim">
                    </div>
                    <div class="form-group">
                        <label for="Nama">Nama</label>
                        <input type="text" name="nama" class="formcontrol" id="nama" value="{{ $Mahasiswa->nama }}" ariadescribedby="Nama">
                    </div>
                    <div class="form-group">
                        <label for="Kelas">Kelas</label>
                        <select class="form-control" name="kelas_id">@foreach($kelas as $kls)
                            <option value="{{$kls->id}}" {{ $Mahasiswa->kelas_id == $kls->id ? 'selected' : ''}}>
                                {{$kls->nama_kelas}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Jurusan">Jurusan</label>
                        <input type="Jurusan" name="jurusan" class="formcontrol" id="jurusan" value="{{ $Mahasiswa->jurusan }}" ariadescribedby="Jurusan">
                    </div>
                    <!-- <div class="form-group">
                        <label for="No_Handphone">No_Handphone</label>

                        <input type="No_Handphone" name="no_handphone" class="formcontrol" id="no_handphone"
                            value="{{ $Mahasiswa->no_handphone }}" ariadescribedby="No_Handphone">
                    </div>
                    <div class="form-group">
                        <label for="Email">Email</label>
                        <input type="text" name="email" class="formcontrol" id="email" aria-describedby="Email"
                            value="{{ $Mahasiswa->email }}" ariadescribedby="Email"">
                    </div>
                    <div class=" form-group">
                        <label for="Ttl">TTL</label>
                        <input type="date" name="ttl" class="formcontrol" id="ttl" aria-describedby="Ttl"
                            value="{{ $Mahasiswa->ttl }}" ariadescribedby="Ttl">
                    </div> -->
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection