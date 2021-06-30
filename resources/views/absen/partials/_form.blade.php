<form action="{{ isset($absen_siswa) ? route('absen-siswa.update', $absen_siswa->id) : route('absen.store') }}" method="POST">
    @csrf
    @if(isset($absen_siswa))
        <input type="hidden" name="_method" value="PUT">
    @endif
    <div class="form-group">
        <label for="jadwal_id" class="font-poppins font-14">Jadwal <span class="text-danger">*</span></label>
        @if(empty($absen_siswa))
            <select name="jadwal_id" id="jadwal_id" class="form-control font-poppins font-14">
                @foreach($jadwal as $j)
                    <option {{ (isset($absen_siswa) && $absen_siswa->absen->jadwal_id == $j->id) || old('jadwal_id') == $j->id ? 'selected' : '' }} value="{{ $j->id }}">{{ ucfirst($j->hari) }} {{ $j->jam->format('H:i') }}</option>
                @endforeach
            </select>
        @else
            <input readonly type="text" class="form-control font-poppins font-14" value="{{ ucfirst($absen_siswa->absen->jadwal->hari).' '.$absen_siswa->absen->jadwal->jam->format('H:i') }}">
        @endif
    </div>
    <div class="form-group">
        <label for="siswa_id" class="font-poppins font-14">Siswa <span class="text-danger">*</span></label>
        @if(empty($absen_siswa))
            <select name="siswa_id" id="siswa_id" class="form-control font-poppins font-14">
                @foreach($siswa as $s)
                    <option {{ (isset($absen_siswa) && $absen_siswa->siswa_id == $s->id) || old('siswa_id') == $s->id ? 'selected' : '' }} value="{{ $s->id }}">{{ $s->nama }}</option>
                @endforeach
            </select>
        @else
            <input readonly type="text" class="form-control font-poppins font-14" value="{{ $absen_siswa->siswa->nama }}">
        @endif
    </div>
    <div class="form-group">
        <label for="status" class="font-poppins font-14">Status Kehadiran <span class="text-danger">*</span></label>
        <select name="status" id="status" class="form-control font-poppins font-14">
            <option {{ (isset($absen_siswa) && $absen_siswa->status == 'hadir') || old('status') == 'hadir' ? 'selected' : '' }} value="hadir">Hadir</option>
            <option {{ (isset($absen_siswa) && $absen_siswa->status == 'sakit') || old('status') == 'sakit' ? 'selected' : '' }} value="sakit">Sakit</option>
            <option {{ (isset($absen_siswa) && $absen_siswa->status == 'izin') || old('status') == 'izin' ? 'selected' : '' }} value="izin">Izin</option>
            <option {{ (isset($absen_siswa) && $absen_siswa->status == 'alpa') || old('status') == 'alpa' ? 'selected' : '' }} value="alpa">Alpa</option>
        </select>
    </div>
    <div class="form-group">
        <label for="pertemuan_ke" class="font-poppins font-14">Pertemuan Ke <span class="text-danger">*</span></label>
        <input type="number" min="1" class="form-control font-poppins font-14" id="pertemuan_ke" name="pertemuan_ke" value="{{ isset($absen_siswa) ? $absen_siswa->absen->pertemuan_ke : old('pertemuan_ke') }}" {{ isset($absen_siswa) ? 'readonly' : '' }} required>
    </div>
    <div class="form-group">
        <label for="guru" class="font-poppins font-14">guru <span class="text-danger">*</span></label>
        <input type="text" class="form-control font-poppins font-14" id="guru" name="guru" value="{{ isset($absen) ? $absen->guru : old('guru') }}" required>
    </div>
    <div class="form-group">
        <a href="{{ route('absen.index') }}" class="btn btn-sm btn-light">Kembali</a>
        <button type="submit" class="btn btn-sm btn-success">Simpan</button>
    </div>
</form>
