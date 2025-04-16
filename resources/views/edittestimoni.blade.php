@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h4 class="fw-bold text-danger mb-4">Edit Testimoni</h4>
    <div class="row">
        <div class="col-md-7">
            <div class="rounded-box">
                <form action="{{ route('testimoni.update', $testimoni->idTestimoni) }}" method="POST" enctype="multipart/form-data" oninput="updatePreview()">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="gambarTestimoni" class="form-label">Gambar</label>
                        <input type="file" class="form-control" name="gambarTestimoni" id="gambarTestimoni" accept="image/*" onchange="previewImage(event)">
                    </div>

                    <div class="mb-3">
                        <label for="tanggalTestimoni" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" name="tanggalTestimoni" id="tanggalTestimoni" value="{{ $testimoni->tanggalTestimoni }}" required>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-custom">Update</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-5">
            <div class="preview-card">
                <h5>Preview</h5>
                <img id="previewImage" src="{{ asset('uploads/testimoni/' . $testimoni->gambarTestimoni) }}" class="preview-img" alt="Preview">
                <p><strong>Tanggal:</strong> <span id="previewTanggal">{{ $testimoni->tanggalTestimoni }}</span></p>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(event) {
    const preview = document.getElementById('previewImage');
    preview.src = URL.createObjectURL(event.target.files[0]);
}

function updatePreview() {
    const tanggal = document.getElementById('tanggalTestimoni').value;
    document.getElementById('previewTanggal').textContent = tanggal || '-';
}
</script>
@endsection
