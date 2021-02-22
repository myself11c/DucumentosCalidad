<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{__('Documentos Calidad') }}     
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                Escoja el proceso que desea ver: 
                    <div class="w-full md:w-3/5 mx-auto p-8">
                        @foreach($tree_array as $elemento => $subfolder)
                            <div >
                                <a href="listdir\{{$elemento}}">
                                    <button class="bg-white hover:bg-gray-100 text-gray-800 font-semibold py-2 px-4 border border-gray-400 rounded shadow">
                                        <b>{{$elemento}}</b>
                                    </button>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
</x-app-layout>