{{-- resources/views/pages/barang_keluar/form.blade.php --}}
<div class="mb-3">
    <label for="id_barang" class="form-label">Nama Barang</label>
    <select class="form-control" id="id_barang" name="id_barang" required>
        <option value="" disabled {{ old('id_barang', $barangkeluar->id_barang ?? '') == '' ? 'selected' : '' }}>
            Pilih Barang
        </option>
        @foreach($barang as $item)
            <option value="{{ $item->id_barang }}"
                {{ old('id_barang', $barangkeluar->id_barang ?? '') == $item->id_barang ? 'selected' : '' }}>
                {{ $item->nama_barang }}
            </option>
        @endforeach
    </select>
    @error('id_barang')
        <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="jumlah" class="form-label">Jumlah</label>
    <input type="number" class="form-control" id="jumlah" name="jumlah"
        value="{{ old('jumlah', $barangkeluar->jumlah ?? '') }}" required min="1">
    @error('jumlah')
        <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="tanggal_keluar" class="form-label">Tanggal Keluar</label>
    <input type="date" class="form-control" id="tanggal_keluar" name="tanggal_keluar"
        value="{{ old('tanggal_keluar', (isset($barangkeluar) && $barangkeluar->tanggal_keluar) 
            ? \Carbon\Carbon::parse($barangkeluar->tanggal_keluar)->format('Y-m-d') : '') }}"
        required>
    @error('tanggal_keluar')
        <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="lokasi" class="form-label">Lokasi</label>
    <input type="text" class="form-control" id="lokasi" name="lokasi"
        value="{{ old('lokasi', $barangkeluar->lokasi ?? '') }}">
    @error('lokasi')
        <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="tujuan" class="form-label">Tujuan (Opsional)</label>
    <input type="text" class="form-control" id="tujuan" name="tujuan"
        value="{{ old('tujuan', $barangkeluar->tujuan ?? '') }}"
        placeholder="Isi tujuan atau biarkan kosong">
    @error('tujuan')
        <div class="text-danger mt-1">{{ $message }}</div>
    @enderror
</div>

{{-- Catatan:
- Field "dikeluarkan_oleh" tidak ditampilkan di form.
- Akan diisi otomatis di controller menggunakan Auth::user()->id.
--}}
