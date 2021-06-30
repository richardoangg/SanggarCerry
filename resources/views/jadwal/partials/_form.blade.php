<form action="{{ isset($jadwal) ? route('jadwal.update', $jadwal->id) : route('jadwal.store') }}" method="POST">
    @csrf
    @if(isset($jadwal))
        <input type="hidden" name="_method" value="PUT">
    @endif
    <div class="form-group">
        <label for="hari" class="font-poppins font-14">Hari <span class="text-danger">*</span></label>
        <select name="hari" id="hari" class="form-control font-poppins font-14">
            <option {{ (isset($jadwal) && $jadwal->hari == 'senin') || old('hari') == 'senin' ? 'selected' : '' }} value="senin">Senin</option>
            <option {{ (isset($jadwal) && $jadwal->hari == 'selasa') || old('hari') == 'selasa' ? 'selected' : '' }} value="selasa">Selasa</option>
            <option {{ (isset($jadwal) && $jadwal->hari == 'rabu') || old('hari') == 'rabu' ? 'selected' : '' }} value="rabu">Rabu</option>
            <option {{ (isset($jadwal) && $jadwal->hari == 'kamis') || old('hari') == 'kamis' ? 'selected' : '' }} value="kamis">Kamis</option>
            <option {{ (isset($jadwal) && $jadwal->hari == 'jumat') || old('hari') == 'jumat' ? 'selected' : '' }} value="jumat">Jumat</option>
            <option {{ (isset($jadwal) && $jadwal->hari == 'sabtu') || old('hari') == 'sabtu' ? 'selected' : '' }} value="sabtu">Sabtu</option>
            <option {{ (isset($jadwal) && $jadwal->hari == 'minggu') || old('hari') == 'minggu' ? 'selected' : '' }} value="minggu">Minggu</option>
        </select>
    </div>
    <div class="form-group">
        <label for="jam" class="font-poppins font-14">Jam <span class="text-danger">*</span></label>
        <input type="text" class="form-control font-poppins font-14 @error('jam') is-invalid @enderror" id="jam" name="jam" placeholder="Misal: 14:30" value="{{ isset($jadwal) ? $jadwal->jam->format('H:i') : old('jam') }}" required>
        @error('jam')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="form-group">
        <a href="{{ route('jadwal.index') }}" class="btn btn-sm btn-light">Kembali</a>
        <button type="submit" class="btn btn-sm btn-success">Simpan</button>
    </div>
</form>