<form action="{{ isset($pengumuman) ? route('pengumuman.update', $pengumuman->id) : route('pengumuman.store') }}" method="POST">
    @csrf
    @if(isset($pengumuman))
        <input type="hidden" name="_method" value="PUT">
    @endif
    <div class="form-group">
        <label for="judul" class="font-poppins font-14">Judul <span class="text-danger">*</span></label>
        <input type="text" class="form-control font-poppins font-14" id="judul" name="judul" value="{{ isset($pengumuman) ? $pengumuman->judul : old('judul') }}" required>
    </div>
    <div class="form-group">
        <label for="deskripsi" class="font-poppins font-14">Deskripsi <span class="text-danger">*</span></label>
        <textarea type="number" rows="5" min="1" class="form-control font-poppins font-14" id="deskripsi" name="deskripsi" required>{{ isset($pengumuman) ? $pengumuman->deskripsi : old('deskripsi') }}</textarea>
    </div>
    <div class="form-group">
        <a href="{{ route('pengumuman.index') }}" class="btn btn-sm btn-light">Kembali</a>
        <button type="submit" class="btn btn-sm btn-success">Simpan</button>
    </div>
</form>