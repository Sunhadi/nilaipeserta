<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Fasilitator</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Data Fasilitator</h2>
        <a href="#" class="btn btn-primary mb-3" data-toggle="modal" data-target="#fasilitatorModal">Tambah Data Fasilitator</a>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>NIDN</th>
                    <th>Nama Lengkap</th>
                    <th>Prodi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($fasilitators as $fasilitator)
                    <tr>
                        <td>{{ $fasilitator->id }}</td>
                        <td>{{ $fasilitator->NIDN }}</td>
                        <td>{{ $fasilitator->nama_lengkap }}</td>
                        <td>{{ $fasilitator->prodi }}</td>
                        <td>
                            <a href="#" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#fasilitatorModal" data-id="{{ $fasilitator->id }}" data-nidn="{{ $fasilitator->NIDN }}" data-nama="{{ $fasilitator->nama_lengkap }}" data-prodi="{{ $fasilitator->prodi }}">Edit</a>
                            <form action="{{ route('fasilitators.destroy', $fasilitator->id) }}" method="post" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin ingin menghapus?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if(session('success'))
            <div class="alert alert-success mt-3">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <div class="modal fade" id="fasilitatorModal" tabindex="-1" role="dialog" aria-labelledby="fasilitatorModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="fasilitatorModalLabel">Tambah/Edit Fasilitator</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="fasilitatorForm" action="{{ route('fasilitators.store') }}" method="post">
                        @csrf
                        <input type="hidden" name="_method" id="formMethod" value="POST">
                        <div class="mb-3">
                            <label for="NIDN" class="form-label">NIDN</label>
                            <input type="text" class="form-control" id="NIDN" name="NIDN" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required>
                        </div>
                        <div class="mb-3">
                            <label for="prodi" class="form-label">Prodi</label>
                            <input type="text" class="form-control" id="prodi" name="prodi" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $('#fasilitatorModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var modal = $(this);

            if (button.data('id')) {
                modal.find('.modal-title').text('Edit Fasilitator');
                modal.find('#fasilitatorForm').attr('action', '/fasilitators/' + button.data('id'));
                modal.find('#formMethod').val('PUT');
                modal.find('#NIDN').val(button.data('nidn'));
                modal.find('#nama_lengkap').val(button.data('nama'));
                modal.find('#prodi').val(button.data('prodi'));
            } else {
                modal.find('.modal-title').text('Tambah Fasilitator');
                modal.find('#fasilitatorForm').attr('action', '{{ route('fasilitators.store') }}');
                modal.find('#formMethod').val('POST');
                modal.find('#NIDN').val('');
                modal.find('#nama_lengkap').val('');
                modal.find('#prodi').val('');
            }
        });
    </script>
</body>
</html>
