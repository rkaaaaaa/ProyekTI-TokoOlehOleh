@extends('layouts.app')

@section('content')
<style>
    .btn-custom {
        background-color: red;
        color: white;
        border-radius: 25px;
        padding: 10px 30px;
        font-weight: bold;
        border: none;
    }

    .preview-card {
        border: 2px solid #ddd;
        border-radius: 25px;
        padding: 20px;
        background-color: #fafafa;
        text-align: center;
    }

    .preview-img {
        max-height: 200px;
        object-fit: contain;
        border: 1px dashed #ccc;
        border-radius: 15px;
        margin-bottom: 10px;
    }

    .form-control {
        border-radius: 20px;
        padding: 10px 15px;
    }
</style>

<div class="container mt-4">
    <h4 class="fw-bold text-danger mb-4">Tambah Testimoni</h4>
    <div class="row">
        <div class="col-md-7">
            <div class="rounded-box">
                <form action="{{ route('testimoni.store') }}" method="POST" enctype="multipart/form-data" oninput="updatePreview()">
                    @csrf

                    {{-- Input ID User manual --}}
                    {{-- <div class="mb-3">
                        <input type="number" name="idUser" class="form-control" placeholder="ID User" required>
                    </div> --}}
                    
                    <div class="mb-3">
                        <label class="form-label">ID User</label>
                        <input type="text" class="form-control" value="{{ Auth::id() }}" readonly>
                        <input type="hidden" name="idUser" value="{{ Auth::id() }}">
                    </div>
                    

                    <div class="mb-3">
                        <label for="gambarTestimoni" class="form-label">Gambar</label>
                        <input type="file" class="form-control" name="gambarTestimoni" id="gambarTestimoni" accept="image/*" onchange="previewImage(event)" required>
                    </div>

                    <div class="mb-3">
                        <label for="tanggalTestimoni" class="form-label">Tanggal</label>
                        <input type="date" class="form-control" name="tanggalTestimoni" id="tanggalTestimoni" required>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-custom">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="col-md-5">
            <div class="preview-card">
                <h5>Preview</h5>
                <img id="previewImage" src="{{ asset('assets/placeholder.png') }}" class="preview-img" alt="Preview">
                <p><strong>Tanggal:</strong> <span id="previewTanggal">-</span></p>
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
