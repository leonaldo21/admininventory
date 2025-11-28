<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Dokumen</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <h2 class="mb-4 text-center">Upload Dokumen</h2>

    {{-- Pesan sukses --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Form Upload --}}
    <form action="{{ route('documents.upload') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow">
        @csrf

        <div class="mb-3">
            <label class="form-label">MCU</label>
            <input type="file" name="mcu" class="form-control">
            @error('mcu') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">BPJS</label>
            <input type="file" name="bpjs" class="form-control">
            @error('bpjs') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">SKCK</label>
            <input type="file" name="skck" class="form-control">
            @error('skck') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">KTP</label>
            <input type="file" name="ktp" class="form-control">
            @error('ktp') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">CV</label>
            <input type="file" name="cv" class="form-control">
            @error('cv') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100">Upload</button>
    </form>

    <hr class="my-5">

    {{-- List File --}}
    <h4 class="mb-3">📂 Dokumen yang sudah diupload:</h4>
    <div class="row">
        <div class="col-md-6">
            <h5>MCU</h5>
            <ul>
                @foreach($mcuFiles as $file)
                    <li>{{ basename($file) }}</li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-6">
            <h5>BPJS</h5>
            <ul>
                @foreach($bpjsFiles as $file)
                    <li>{{ basename($file) }}</li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-6">
            <h5>SKCK</h5>
            <ul>
                @foreach($skckFiles as $file)
                    <li>{{ basename($file) }}</li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-6">
            <h5>KTP</h5>
            <ul>
                @foreach($ktpFiles as $file)
                    <li>{{ basename($file) }}</li>
                @endforeach
            </ul>
        </div>
        <div class="col-md-6">
            <h5>CV</h5>
            <ul>
                @foreach($cvFiles as $file)
                    <li>{{ basename($file) }}</li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

</body>
</html>
