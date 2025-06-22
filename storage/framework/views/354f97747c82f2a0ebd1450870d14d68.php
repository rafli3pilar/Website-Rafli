

<?php $__env->startSection('content'); ?>
    <h3>Data Mahasiswa</h3>
    <button type="button" class="btn btn-primary mb-3" id="btn-tambah">Tambah Mahasiswa</button>
    <table class="table table-bordered" id="table-mahasiswa">
        <thead>
            <tr>
                <th>NIM</th>
                <th>Nama</th>
                <th>Jenis Kelamin</th>
                <th>Tanggal Lahir</th>
                <th>Jurusan</th>
                <th>Alamat</th>
                <th>Aksi</th>
            </tr>
        </thead>
    </table>

    <!-- Modal Form -->
    <div class="modal fade" id="modal-mahasiswa" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="form-mahasiswa">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalLabel">Tambah Mahasiswa</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="form-method" value="POST">
                        <div class="mb-3">
                            <label for="nim" class="form-label">NIM</label>
                            <input type="text" class="form-control" id="nim" name="nim" required maxlength="10">
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" required maxlength="255">
                        </div>
                        <div class="mb-3">
                        <label for="jk" class="form-label">Jenis Kelamin</label>
                        <select class="form-select" id="jk" name="jk" required >
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                        </select>
                        <div class="mb-3">
                            <label for="tgl_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir" required>
                        </div>
                        <div class="mb-3">
                       <label for="jurusan" class="form-label">Jurusan</label>
                        <select class="form-select" id="jurusan" name="jurusan" required>
                          <option value="">Pilih Jurusan</option>
                          <option value="Teknik Informatika">Teknik Informatika</option>
                          <option value="Sistem Informasi">Sistem Informasi</option>
                          <option value="DKV">DKV</option>
                          <option value="Teknik Elektro">Teknik Elektro</option>
                          <option value="Teknik Sipil">Teknik Sipil</option>
                          <option value="Akuntansi">Akuntansi</option>
                        </select>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat" required maxlength="255"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary" id="btn-save">Simpan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('scripts'); ?>
<script>
    let table;
    let modalMahasiswa;

    $(document).ready(function () {
        // Inisialisasi modal
        modalMahasiswa = new bootstrap.Modal(document.getElementById('modal-mahasiswa'));

        // Setup CSRF token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        // Inisialisasi DataTable
        table = $('#table-mahasiswa').DataTable({
            ajax: {
                url: "/api/mahasiswa",
                dataSrc: 'data',
                data: function (d) {
                    d._ = new Date().getTime(); // mencegah cache
                }
            },
            columns: [
                { data: 'nim' },
                { data: 'nama' },
                { data: 'jk' },
                { data: 'tgl_lahir' },
                { data: 'jurusan' },
                { data: 'alamat' },
                {
                    data: 'nim',
                    render: function (nim) {
                        return `
                            <button class="btn btn-warning btn-sm btn-edit" data-id="${nim}">Edit</button>
                            <button class="btn btn-danger btn-sm btn-delete" data-id="${nim}">Hapus</button>
                        `;
                    }
                }
            ]
        });

        // Tombol tambah mahasiswa
        $('#btn-tambah').click(function () {
            $('#form-mahasiswa')[0].reset();
            $('#form-method').val('POST');
            $('#nim').prop('readonly', false);
            $('#modalLabel').text('Tambah Mahasiswa');
            modalMahasiswa.show();
        });

        // Submit form
        $('#form-mahasiswa').submit(function (e) {
            e.preventDefault();
            let method = $('#form-method').val();
            let nim = $('#nim').val();
            let url = '/api/mahasiswa' + (method === 'PUT' ? '/' + nim : '');
            let data = {
                nim: $('#nim').val(),
                nama: $('#nama').val(),
                jk: $('#jk').val(),
                tgl_lahir: $('#tgl_lahir').val(),
                jurusan: $('#jurusan').val(),
                alamat: $('#alamat').val()
            };

            $.ajax({
                url: url,
                method: method,
                data: data,
                success: function (response) {
                    console.log('Data berhasil disimpan:', response);
                    modalMahasiswa.hide();
                    setTimeout(() => {
                        console.log('Reloading DataTable...');
                        table.ajax.reload(null, false);
                    }, 300);
                    alert(response.message || 'Berhasil menyimpan data.');
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    alert(xhr.responseJSON?.message || 'Terjadi kesalahan saat menyimpan data.');
                }
            });
        });

        // Edit data
        $('#table-mahasiswa').on('click', '.btn-edit', function () {
            let nim = $(this).data('id');
            $.get('/api/mahasiswa/' + nim, function (response) {
                const m = response.data;
                $('#form-method').val('PUT');
                $('#nim').val(m.nim).prop('readonly', true);
                $('#nama').val(m.nama);
                $('#jk').val(m.jk);
                $('#tgl_lahir').val(m.tgl_lahir);
                $('#jurusan').val(m.jurusan);
                $('#alamat').val(m.alamat);
                $('#modalLabel').text('Edit Mahasiswa');
                modalMahasiswa.show();
            }).fail(() => {
                alert('Gagal mengambil data.');
            });
        });

        // Hapus data
        $('#table-mahasiswa').on('click', '.btn-delete', function () {
            if (!confirm('Yakin ingin menghapus data ini?')) return;
            let nim = $(this).data('id');
            $.ajax({
                url: '/api/mahasiswa/' + nim,
                method: 'DELETE',
                success: function (response) {
                    table.ajax.reload(null, false);
                    alert(response.message || 'Berhasil menghapus data.');
                },
                error: function (xhr) {
                    console.error(xhr.responseText);
                    alert(xhr.responseJSON?.message || 'Terjadi kesalahan saat menghapus data.');
                }
            });
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\rest-api\resources\views/siswa.blade.php ENDPATH**/ ?>