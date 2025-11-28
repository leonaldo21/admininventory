<div class="row">
    <div class="col-md-6 mb-3">
        <label for="nama" class="form-label">Nama Lengkap</label>
        <input type="text" 
               class="form-control @error('nama') is-invalid @enderror" 
               id="nama" 
               name="nama" 
               value="{{ old('nama', isset($pegawai) ? $pegawai->nama : '') }}" 
               required>
        @error('nama')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="nik_ktp" class="form-label">NIK KTP</label>
        <input type="text" 
               class="form-control @error('nik_ktp') is-invalid @enderror" 
               id="nik_ktp" 
               name="nik_ktp" 
               value="{{ old('nik_ktp', isset($pegawai) ? $pegawai->nik_ktp : '') }}" 
               required>
        @error('nik_ktp')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="no_kk" class="form-label">No. Kartu Keluarga</label>
        <input type="text" 
               class="form-control @error('no_kk') is-invalid @enderror" 
               id="no_kk" 
               name="no_kk" 
               value="{{ old('no_kk', isset($pegawai) ? $pegawai->no_kk : '') }}">
        @error('no_kk')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="no_bpjs" class="form-label">No. BPJS</label>
        <input type="text" 
               class="form-control @error('no_bpjs') is-invalid @enderror" 
               id="no_bpjs" 
               name="no_bpjs" 
               value="{{ old('no_bpjs', isset($pegawai) ? $pegawai->no_bpjs : '') }}">
        @error('no_bpjs')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="no_jmo" class="form-label">No. JMO</label>
        <input type="text" 
               class="form-control @error('no_jmo') is-invalid @enderror" 
               id="no_jmo" 
               name="no_jmo" 
               value="{{ old('no_jmo', isset($pegawai) ? $pegawai->no_jmo : '') }}">
        @error('no_jmo')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="no_npwp" class="form-label">No. NPWP</label>
        <input type="text" 
               class="form-control @error('no_npwp') is-invalid @enderror" 
               id="no_npwp" 
               name="no_npwp" 
               value="{{ old('no_npwp', isset($pegawai) ? $pegawai->no_npwp : '') }}">
        @error('no_npwp')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="row">
    <div class="col-md-6 mb-3">
        <label for="badge_id" class="form-label">Badge ID</label>
        <input type="text" 
               class="form-control @error('badge_id') is-invalid @enderror" 
               id="badge_id" 
               name="badge_id" 
               value="{{ old('badge_id', isset($pegawai) ? $pegawai->badge_id : '') }}" 
               required>
        @error('badge_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6 mb-3">
        <label for="role" class="form-label">Role</label>
        <select class="form-select @error('role') is-invalid @enderror" id="role" name="role" required>
            <option value="">Pilih Role</option>
            @foreach($roles as $role)
                <option value="{{ $role }}" {{ old('role', isset($pegawai) ? $pegawai->role : '') == $role ? 'selected' : '' }}>
                    {{ ucfirst($role) }}
                </option>
            @endforeach
        </select>
        @error('role')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

<div class="mb-3">
    <label for="dokumen_file" class="form-label">Unggah Dokumen (PDF)</label>
    <input type="file" 
           class="form-control @error('dokumen_file') is-invalid @enderror" 
           id="dokumen_file" 
           name="dokumen_file" 
           accept="application/pdf">
    <div class="form-text">Maksimum ukuran file: 2MB.</div>
    @error('dokumen_file')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror

    @if(isset($pegawai) && $pegawai->dokumen_url)
        <p class="mt-2">
            Dokumen saat ini: 
            <a href="{{ $pegawai->dokumen_url }}" target="_blank" class="btn btn-sm btn-success">Lihat Dokumen</a>
        </p>
    @endif
</div>
