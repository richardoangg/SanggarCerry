<form action="{{ isset($siswa) ? route('siswa.update', $siswa->id) : route('siswa.store') }}" method="POST">
    @csrf
    @if(isset($siswa))
        <input type="hidden" name="_method" value="PUT">
    @endif
    <div class="form-group">
        <label for="nama" class="font-poppins font-14">Nama <span class="text-danger">*</span></label>
        <input type="text" class="form-control font-poppins font-14" id="nama" name="nama" value="{{ isset($siswa) ? $siswa->nama : old('nama') }}" required>
    </div>
    <div class="form-group">
        <label for="umur" class="font-poppins font-14">Umur <span class="text-danger">*</span></label>
        <input type="number" min="1" class="form-control font-poppins font-14" id="umur" name="umur" value="{{ isset($siswa) ? $siswa->umur : old('umur') }}" required>
    </div>
    <div class="form-group">
        <label for="wali" class="font-poppins font-14">Nama Wali <span class="text-danger">*</span></label>
        <input type="text" class="form-control font-poppins font-14" id="wali" name="wali" value="{{ isset($siswa) ? $siswa->wali : old('wali') }}" required>
    </div>
    <div class="form-group">
        <label for="alamat" class="font-poppins font-14">Alamat <span class="text-danger">*</span></label>
        <input type="text" class="form-control font-poppins font-14" id="alamat" name="alamat" value="{{ isset($siswa) ? $siswa->alamat : old('alamat') }}" required>
    </div>
    <div class="form-group">
        <label for="hari" class="font-poppins font-14">Hari <span class="text-danger">*</span></label>
        <select name="hari" id="hari" class="form-control font-poppins font-14">
            <option {{ (isset($siswa) && $siswa->status == 'aktif') || old('status') == 'aktif' ? 'selected' : '' }} value="aktif">aktif</option>
            <option {{ (isset($siswa) && $siswa->status == 'alumni') || old('status') == 'alumni' ? 'selected' : '' }} value="alumni">alumni</option>
        </select>
    </div>
    <div class="form-group">
        <a href="{{ route('siswa.index') }}" class="btn btn-sm btn-light">Kembali</a>
        <button type="submit" class="btn btn-sm btn-success">Simpan</button>
    </div>
</form>
