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
                    <div class="w-full md:w-3/5 mx-auto p-8">

                        @foreach($tree_array as $elemento => $subfolder)
                        <ul>
                            <li>
                                @foreach($subfolder as $folder => $files)
                                    <ul>
                                        <li>
                                        <div class="shadow-md">
                                            <div class="tab w-full overflow-hidden border-t">
                                                <input class="absolute opacity-0" id="{{$folder}}" type="radio" name="tabs">
                                                <label class="block p-5 leading-normal cursor-pointer" for="{{$folder}}">
                                                    <b>{{$folder}}</b>
                                                </label>
                                                <div class="tab-content overflow-hidden border-l-2 bg-gray-100 border-indigo-500 leading-normal">
                                                    @foreach($files as $file)
                                                    <ul>
                                                        <li>
                                                            <div >
                                                                <a href="{{$file['url']}}">
                                                                    <div class="inline-block"> 
                                                                        <img src="{{$file['ico']}}" alt="" height="25" width="25"> 
                                                                    </div>
                                                                    <div class="inline-block"> 
                                                                        {{$file['filename']}}
                                                                    </div>
                                                                </a>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>                                            
                                        </li>
                                    </ul>
                                @endforeach
                            </li>
                        </ul>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
      </div>
    </div>
    <script>
      /* Optional Javascript to close the radio button version by clicking it again */
      var myRadios = document.getElementsByName('tabs');
      var setCheck;
      var x = 0;
      for(x = 0; x < myRadios.length; x++){
          myRadios[x].onclick = function(){
              if(setCheck != this){
                   setCheck = this;
              }else{
                  this.checked = false;
                  setCheck = null;
          }
          };
      }
   </script>
</x-app-layout>