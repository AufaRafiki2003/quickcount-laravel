@extends('layouts.app', ['title' => 'Edit kecamatan - Admin'])
@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
    <div class="container mx-auto px-6 py-8">
        <div class="p-6 bg-white rounded-md shadow-md"> 
            <h2 class="text-lg text-gray-700 font-semibold capitalize">EDIT KECAMATAN</h2>
         <hr class="mt-4">
        <form action="{{ route('admin.kecamatan.update', $kecamatan->id_kec) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT') 
            <div class="grid grid-cols-1 gap-6 mt-4"> 
                
                <div> 
                    <label class="text-gray-700" for="id_kec">ID KECAMATAN</label>
                    <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text" name="id_kec" value="{{ old('id_kec',$kecamatan->id_kec) }}" readonly>
                    @error('id_kec')
                    <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                        <div class="px-4 py-2">
                            <p class="text-gray-600 text-sm">{{$message }}</p>
                        </div>
                    </div>
                    @enderror
                </div>

                <div> 
                    <label class="text-gray-700" for="nama_kec">NAMA_KECAMATAN</label>
                    <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text" name="nama_kec" value="{{ old('nama_kec',$kecamatan->nama_kec) }}" placeholder="Nama Kategori">
                    @error('nama_kec')
                    <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                        <div class="px-4 py-2">
                            <p class="text-gray-600 text-sm">{{$message }}</p>
                        </div>
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="id_kab" class="block text-gray-600 text-sm font-medium mb-2">KABUPATEN</label>
                    <select name="id_kab" id="id_kab" class="form-select w-full">
                        @foreach($kabupatens as $kabupaten)
                            <option value="{{ $kabupaten->id_kab }}" {{ $kecamatan->id_kab == $kabupaten->id_kab ? 'selected' : '' }}>
                                {{ $kabupaten->nama_kabupaten }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_kab')
                    <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                        <div class="px-4 py-2">
                            <p class="text-gray-600 text-sm">{{$message }}</p>
                        </div>
                    </div>
                    @enderror
                </div>
                
            </div>
            <div class="flex justify-start mt-4">
                <button type="submit" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">UPDATE</button>
            </div>
        </form>
    </div>
</div>
</main>
@endsection