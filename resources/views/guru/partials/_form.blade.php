<form action="{{ isset($guru) ? route('guru.update', $guru->id) : route('guru.store') }}" method="POST">
    @csrf
    @if(isset($guru))
        <input type="hidden" name="_method" value="PUT">
    @endif
    <div class="form-group">
        <label for="nama" class="font-poppins font-14">Nama <span class="text-danger">*</span></label>
        <input type="text" class="form-control font-poppins font-14" id="nama" name="nama" value="{{ isset($guru) ? $guru->nama : old('nama') }}" required>
    </div>
    <div class="form-group">
        <label for="username" class="font-poppins font-14">Username <span class="text-danger">*</span></label>
        <input type="text" class="form-control font-poppins font-14 @error('username') is-invalid @enderror" id="username" name="username" value="{{ isset($guru) ? $guru->username : old('username') }}" required>
        @error('username')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    @if(empty($guru))
        <div class="form-group">
            <label for="password" class="font-poppins font-14">Password <span class="text-danger">*</span></label>
            <input type="password" class="form-control font-poppins font-14 @error('password') is-invalid @enderror" id="password" name="password" required>
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group">
            <label for="password_confirmation" class="font-poppins font-14">Konfirmasi Password <span class="text-danger">*</span></label>
            <input type="password" class="form-control font-poppins font-14" id="password_confirmation" name="password_confirmation" required>
        </div>
    @endif
    <div class="form-group">
        <a href="{{ route('guru.index') }}" class="btn btn-sm btn-light">Kembali</a>
        <button type="submit" class="btn btn-sm btn-success">Simpan</button>
    </div>
</form>