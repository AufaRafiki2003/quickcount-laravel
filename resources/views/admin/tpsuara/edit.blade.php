@extends('layouts.app', ['title' => 'Edit tpsuara - Admin'])
@section('content')
<main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-300">
    <div class="container mx-auto px-6 py-8">
        <div class="p-6 bg-white rounded-md shadow-md"> 
            <h2 class="text-lg text-gray-700 font-semibold capitalize">EDIT TPS</h2>
         <hr class="mt-4">
        <form action="{{ route('admin.tpsuara.update', $tpsuara->id_tps) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT') 
            <div class="grid grid-cols-1 gap-6 mt-4"> 
                
                <div> 
                    <label class="text-gray-700" for="id_tps">ID TPS</label>
                    <input class="form-input w-full mt-2 rounded-md bg-gray-200 focus:bg-white" type="text" name="id_tps" value="{{ old('id_tps',$tpsuara->id_tps) }}" readonly>
                    @error('id_tps')
                    <div class="w-full bg-red-200 shadow-sm rounded-md overflow-hidden mt-2">
                        <div class="px-4 py-2">
                            <p class="text-gray-600 text-sm">{{$message }}</p>
                        </div>
                    </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="id_kel" class="block text-gray-600 text-sm font-medium mb-2">Pilih kelurahan</label>
                    <select name="id_kel" id="id_kel" class="form-select w-full">
                        @foreach($kelurahans as $kelurahan)
                            <option value="{{ $kelurahan->id_kel }}" {{ $tpsuara->id_kel == $kelurahan->id_kel ? 'selected' : '' }}>
                                {{ $kelurahan->nama_kel }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_kel')
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