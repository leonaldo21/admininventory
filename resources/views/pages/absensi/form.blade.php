<div class="mb-3">
    <label for="id_pegawai" class="form-label">Pegawai</label>
    <select class="form-select @error('id_pegawai') is-invalid @enderror" id="id_pegawai" name="id_pegawai" required>
        <option value="">-- Pilih Pegawai --</option>
        @foreach($pegawai as $p)
            <option value="{{ $p->id_pegawai }}" 
                {{ old('id_pegawai', $absensi->id_pegawai ?? '') == $p->id_pegawai ? 'selected' : '' }}>
                {{ $p->id_badge ?? '-' }} - {{ $p->nama }}
            </option>
        @endforeach
    </select>
    @error('id_pegawai')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="tanggal_absensi" class="form-label">Tanggal Absensi</label>
    <input type="date" class="form-control @error('tanggal_absensi') is-invalid @enderror" id="tanggal_absensi" name="tanggal_absensi" 
        value="{{ old('tanggal_absensi', (isset($absensi) && $absensi->tanggal_absensi) ? \Carbon\Carbon::parse($absensi->tanggal_absensi)->format('Y-m-d') : date('Y-m-d')) }}" required>
    @error('tanggal_absensi')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="waktu_masuk" class="form-label">Waktu Masuk</label>
    <input type="time" class="form-control @error('waktu_masuk') is-invalid @enderror" id="waktu_masuk" name="waktu_masuk" 
        value="{{ old('waktu_masuk', $absensi->waktu_masuk ?? date('H:i')) }}" required>
    @error('waktu_masuk')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="waktu_keluar" class="form-label">Waktu Keluar (Opsional)</label>
    <input type="time" class="form-control @error('waktu_keluar') is-invalid @enderror" id="waktu_keluar" name="waktu_keluar" 
        value="{{ old('waktu_keluar', $absensi->waktu_keluar ?? '') }}">
    <div class="form-text">Biarkan kosong jika pegawai belum keluar.</div>
    @error('waktu_keluar')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="keterangan" class="form-label">Keterangan (Remarks)</label>
    <select class="form-select @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" required>
        <option value="Hadir" {{ old('keterangan', $absensi->keterangan ?? '') == 'Hadir' ? 'selected' : '' }}>Hadir</option>
        <option value="Sakit" {{ old('keterangan', $absensi->keterangan ?? '') == 'Sakit' ? 'selected' : '' }}>Sakit</option>
        <option value="Izin" {{ old('keterangan', $absensi->keterangan ?? '') == 'Izin' ? 'selected' : '' }}>Izin</option>
        <option value="Tanpa Keterangan" {{ old('keterangan', $absensi->keterangan ?? '') == 'Tanpa Keterangan' ? 'selected' : '' }}>Tanpa Keterangan</option>
    </select>
    @error('keterangan')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>