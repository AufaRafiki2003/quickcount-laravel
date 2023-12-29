@extends('layouts.app', ['title' => 'Tambah desa - Admin'])

@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
    <div class="container mx-auto px-6 py-8">
        <div class="p-6 bg-white rounded-md shadow-md">
            <h2 class="text-lg text-gray-700 font-semibold capitalize">TAMBAH DESA</h2>
            <hr class="mt-4">
            <form action="{{ route('admin.desa.store') }}" method="POST" >
                @csrf
                <div class="grid grid-cols-1 gap-6 mt-4">
                    
                    <div>
                        <label class="text-gray-700" for="nama_desa">NAMA DESA</label>
                        <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text" name="nama_desa" value="{{ old('nama_desa') }}" placeholder="nama_desa">
                        @error('nama_desa')
                        <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                            <div class="px-4 py-2">
                                <p class="text-gray-600 text-sm">{{ $message }}</p>
                            </div>
                        </div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="id_kec" class="block text-gray-600 text-sm font-medium mb-2">PILIH KECAMATAN</label>
                        <select name="id_kec" id="id_kec" class="form-select w-full">
                        @foreach($kecamatans as $kecamatan)
                         <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                            <option value="{{ $kecamatan->id_kec }}">{{ $kecamatan->nama_kec }}</option>
                        @endforeach
                        </select>
                        @error('id_kec')
                        <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                            <div class="px-4 py-2">
                                <p class="text-gray-600 text-sm">{{ $message }}</p>
                            </div>
                        </div>
                        @enderror
                    </div>

                    
                </div>
                <div class="flex justify-start mt-4">
                    <button type="submit" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">SIMPAN</button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection