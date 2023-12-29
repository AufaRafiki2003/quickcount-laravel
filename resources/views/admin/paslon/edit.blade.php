@extends('layouts.app', ['title' => 'Edit paslon - Admin'])
@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
    <div class="container mx-auto px-6 py-8">
        <div class="p-6 bg-white rounded-md shadow-md"> 
            <h2 class="text-lg text-gray-700 font-semibold capitalize">EDIT paslon</h2>
         <hr class="mt-4">
        <form action="{{ route('admin.paslon.update', $paslon->id_paslon) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT') 
            <div class="grid grid-cols-1 gap-6 mt-4"> 
                
                <div> 
                    <label class="text-gray-700" for="id_paslon">ID PASLON</label>
                    <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text" name="id_paslon" value="{{ old('id_paslon',$paslon->id_paslon) }}" readonly>
                    @error('id_paslon')
                    <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                        <div class="px-4 py-2">
                            <p class="text-gray-600 text-sm">{{$message }}</p>
                        </div>
                    </div>
                    @enderror
                </div>

                <div> 
                    <label class="text-gray-700" for="no_urut">NOMOR URUT paslon</label>
                    <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text" name="no_urut" value="{{ old('no_urut',$paslon->no_urut) }}" placeholder="No Urut paslon">
                    @error('no_urut')
                    <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                        <div class="px-4 py-2">
                            <p class="text-gray-600 text-sm">{{$message }}</p>
                        </div>
                    </div>
                    @enderror
                </div>


                <div> 
                    <label class="text-gray-700" for="nama_ketua">NAMA paslon</label>
                    <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text" name="nama_ketua" value="{{ old('nama_ketua',$paslon->nama_ketua) }}" placeholder="Nama paslon">
                    @error('nama_ketua')
                    <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                        <div class="px-4 py-2">
                            <p class="text-gray-600 text-sm">{{$message }}</p>
                        </div>
                    </div>
                    @enderror
                </div>

                
                <div> 
                    <label class="text-gray-700" for="nama_wakil">NAMA paslon</label>
                    <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text" name="nama_wakil" value="{{ old('nama_wakil',$paslon->nama_wakil) }}" placeholder="Nama paslon">
                    @error('nama_wakil')
                    <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                        <div class="px-4 py-2">
                            <p class="text-gray-600 text-sm">{{$message }}</p>
                        </div>
                    </div>
                    @enderror
                </div>
                
                
                <div class="form-group"> 
                    <label class="font-weightbold">FOTO paslon</label>
                    <input type="file" class="formcontrol" name="foto">
                </div>

            <div class="flex justify-start mt-4">
                <button type="submit" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 focus:outline-none focus:bg-gray-700">UPDATE</button>
            </div>
        </form>
    </div>
</div>
</main>
@endsection