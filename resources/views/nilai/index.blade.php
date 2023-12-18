<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ isset($nilai) ? 'Edit' : 'Tambah' }} Nilai Peserta</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>{{ isset($nilai) ? 'Edit' : 'Tambah' }} Nilai Peserta</h2>
        <form method="POST" action="{{ isset($nilai) ? '/nilai/'.$nilai->id : '/nilai' }}">
            @csrf
            @if(isset($nilai))
                <input type="hidden" name="_method" value="PUT">
            @endif

            <div class="form-group">
                <label for="nim">NIM:</label>
                <input type="text" class="form-control" id="nim" name="nim" value="{{ isset($nilai) ? $nilai->nim : old('nim') }}" required>
            </div>

            <div class="form-group">
                <label for="nama_peserta">Nama Peserta:</label>
                <input type="text" class="form-control" id="nama_peserta" name="nama_peserta" value="{{ isset($nilai) ? $nilai->nama_peserta : old('nama_peserta') }}" required>
            </div>

            <div class="form-group">
                <label for="nama_fasilitator">Nama Fasilitator:</label>
                <input type="text" class="form-control" id="nama_fasilitator" name="nama_fasilitator" value="{{ isset($nilai) ? $nilai->nama_fasilitator : old('nama_fasilitator') }}" required>
            </div>

            <div class="form-group">
                <label for="nilai_akhir">Nilai Akhir:</label>
                <input type="number" class="form-control" id="nilai_akhir" name="nilai_akhir" value="{{ isset($nilai) ? $nilai->nilai_akhir : old('nilai_akhir') }}" required>
            </div>

            <div class="form-group">
                <label for="presensi">Presensi:</label>
                <input type="number" class="form-control" id="presensi" name="presensi" value="{{ isset($nilai) ? $nilai->presensi : old('presensi') }}" required>
            </div>

            <div class="form-group">
                <label for="total_nilai">Total Nilai:</label>
                <input type="number" class="form-control" id="total_nilai" name="total_nilai" value="{{ isset($nilai) ? $nilai->total_nilai : old('total_nilai') }}" required>
            </div>

            <div class="form-group">
                <label for="konversi_nilai">Konversi Nilai:</label>
                <input type="text" class="form-control" id="konversi_nilai" name="konversi_nilai" value="{{ isset($nilai) ? $nilai->konversi_nilai : '' }}" required readonly>
            </div>

            <div class="form-group">
                <label for="tahun">Tahun:</label>
                <select class="form-control" id="tahun" name="tahun">
                    @for ($i = date('Y'); $i >= 2021; $i--)
                        <option value="{{ $i }}" {{ isset($nilai) && $nilai->tahun == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>

            <div class="form-group">
                <label for="level">Level:</label>
                <select class="form-control" id="level" name="level">
                    @foreach(['A', 'B', 'C'] as $grade)
                        <option value="{{ $grade }}" {{ isset($nilai) && $nilai->level == $grade ? 'selected' : '' }}>{{ $grade }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">{{ isset($nilai) ? 'Perbarui' : 'Simpan' }}</button>
        </form>

        <h2 class="mt-5">Data Nilai Peserta</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>NIM</th>
                    <th>Nama Peserta</th>
                    <th>Nama Fasilitator</th>
                    <th>Nilai Akhir</th>
                    <th>Presensi</th>
                    <th>Total Nilai</th>
                    <th>Konversi Nilai</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($nilaiList as $data)
                    <tr>
                        <td>{{ $data->nim }}</td>
                        <td>{{ $data->nama_peserta }}</td>
                        <td>{{ $data->nama_fasilitator }}</td>
                        <td>{{ $data->nilai_akhir }}</td>
                        <td>{{ $data->presensi }}</td>
                        <td>{{ $data->total_nilai }}</td>
                        <td>{{ $data->konversi_nilai }}</td>
                        <td>
                            <a href="{{ route('nilai.edit', $data->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('nilai.destroy', $data->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus nilai peserta ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
