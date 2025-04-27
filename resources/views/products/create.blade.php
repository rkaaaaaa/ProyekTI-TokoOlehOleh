@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6">Tambah Produk Baru</h1>
        
        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
            <ul class="list-disc pl-5">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="mb-4">
                <label for="name" class="block text-gray-700 font-medium mb-2">Nama Produk</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-red" required>
            </div>
            
            <div class="mb-4">
                <label for="variant" class="block text-gray-700 font-medium mb-2">Varian (opsional)</label>
                <input type="text" name="variant" id="variant" value="{{ old('variant') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-red">
            </div>
            
            <div class="mb-4">
                <label for="price" class="block text-gray-700 font-medium mb-2">Harga (Rp)</label>
                <input type="number" name="price" id="price" value="{{ old('price') }}" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-brand-red" required>
            </div>
            
            <div class="mb-6">
                <label for="image" class="block text-gray-700 font-medium mb-2">Gambar Produk</label>
                <input type="file" name="image" id="image" class="w-full" required>
                <p class="text-sm text-gray-500 mt-1">Format: JPG, PNG, GIF. Maksimal 2MB.</p>
            </div>
            
            <div class="flex justify-end">
                <a href="{{ route('products.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md mr-2 hover:bg-gray-600">Batal</a>
                <button type="submit" class="bg-brand-red text-white px-4 py-2 rounded-md hover:bg-red-700">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
