@extends('layouts.app', ['title' => 'Edit Caleg - Admin'])
@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
    <div class="container mx-auto px-6 py-8">
        <div class="p-6 bg-white rounded-md shadow-md"> 
            <h2 class="text-lg text-gray-700 font-semibold capitalize">EDIT CALEG</h2>
         <hr class="mt-4">
        <form action="{{ route('admin.caleg.update', $caleg->id_caleg) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT') 
            <div class="grid grid-cols-1 gap-6 mt-4"> 
                
                <div> 
                    <label class="text-gray-700" for="id_caleg">ID CALEG</label>
                    <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text" name="id_caleg" value="{{ old('id_caleg',$caleg->id_caleg) }}" readonly>
                    @error('id_caleg')
                    <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                        <div class="px-4 py-2">
                            <p class="text-gray-600 text-sm">{{$message }}</p>
                        </div>
                    </div>
                    @enderror
                </div>

                <div> 
                    <label class="text-gray-700" for="nama_caleg">NAMA CALEG</label>
                    <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text" name="nama_caleg" value="{{ old('nama_caleg',$caleg->nama_caleg) }}" placeholder="Nama Caleg">
                    @error('nama_caleg')
                    <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                        <div class="px-4 py-2">
                            <p class="text-gray-600 text-sm">{{$message }}</p>
                        </div>
                    </div>
                    @enderror
                </div>

                <div> 
                    <label class="text-gray-700" for="no_urut_caleg">NOMOR URUT CALEG</label>
                    <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text" name="no_urut_caleg" value="{{ old('no_urut_caleg',$caleg->no_urut_caleg) }}" placeholder="No Urut Caleg">
                    @error('no_urut_caleg')
                    <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                        <div class="px-4 py-2">
                            <p class="text-gray-600 text-sm">{{$message }}</p>
                        </div>
                    </div>
                    @enderror
                </div>

                <div class="form-group"> <label class="font-weightbold">FOTO CALEG</label>
                <input type="file" class="formcontrol" name="foto">

                <div class="mb-4">
                    <label for="id_partai" class="block text-gray-600 text-sm font-medium mb-2">Pilih partai</label>
                    <select name="id_partai" id="id_partai" class="form-select w-full">
                        @foreach($partais as $partai)
                            <option value="{{ $partai->id_partai }}" {{ $caleg->id_partai == $partai->id_partai ? 'selected' : '' }}>
                                {{ $partai->nama_partai }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_partai')
                    <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                        <div class="px-4 py-2">
                            <p class="text-gray-600 text-sm">{{$message }}</p>
                        </div>
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="id_dapil" class="block text-gray-600 text-sm font-medium mb-2">Pilih dapil</label>
                    <select name="id_dapil" id="id_dapil" class="form-select w-full">
                        @foreach($dapils as $dapil)
                            <option value="{{ $dapil->id_dapil }}" {{ $caleg->id_dapil == $dapil->id_dapil ? 'selected' : '' }}>
                                {{ $dapil->nama_dapil }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_dapil')
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