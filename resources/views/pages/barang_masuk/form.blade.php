<div class="mb-3">
    <label for="id_barang" class="form-label">Nama Barang</label>
    <select class="form-control" id="id_barang" name="id_barang" required>
        <option value="">-- Pilih Barang --</option>
        @foreach($barang as $item)
            <option value="{{ $item->id_barang }}" {{ old('id_barang') == $item->id_barang ? 'selected' : '' }}>
                {{ $item->nama_barang }}
            </option>
        @endforeach
    </select>
</div>

<div class="mb-3">
    <label for="jumlah" class="form-label">Jumlah</label>
    <input type="number" class="form-control" id="jumlah" name="jumlah"
        value="{{ old('jumlah') }}" min="1" required>
</div>

<div class="mb-3">
    <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
    <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk"
        value="{{ old('tanggal_masuk') }}" required>
</div>

<div class="mb-3">
    <label for="lokasi" class="form-label">Lokasi</label>
    <input type="text" class="form-control" id="lokasi" name="lokasi"
        value="{{ old('lokasi') }}">
</div>

<div class="mb-3">
    <label for="diterima_oleh" class="form-label">Diterima Oleh</label>
    <select class="form-control" id="diterima_oleh" name="diterima_oleh" required>
        <option value="">-- Pilih Pegawai --</option>
        @foreach($pegawai as $p)
            <option value="{{ $p->id_pegawai }}" {{ old('diterima_oleh') == $p->id_pegawai ? 'selected' : '' }}>
                {{ $p->nama_pegawai }}
            </option>
        @endforeach
    </select>
</div>
