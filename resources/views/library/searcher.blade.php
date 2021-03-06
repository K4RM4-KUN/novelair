<!DOCTYPE html>
<html lang="esp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="icon" href="{{ URL::asset('favicon.ico') }}" type="image/x-icon"/>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jquery/jquery-3.5.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script id="functions" src="{{ asset('js/searcherJS.js') }}" defer></script>
</head>
<body class="bg-gradient-to-br from-gray-700 to-gray-900 min-h-screen">
    
    @include('layouts.navigationNew')
    @include('cookieConsent::index')
    
    <div class="flex flex-wrap w-11/12 sm:w-10/12 mx-auto bg-black bg-opacity-30">
        <div class="flex | w-full | bg-black bg-opacity-60">
            <div class="w-1/1 | my-5">
                <p class="font-bold text-ourBlue text-3xl | pl-5"> Buscador avanzado</p>
            </div>
        </div>
        <!-- Folmualrio -->
        <div class="w-full sm:w-4/12 | text-white">
            <div class="bg-white bg-opacity-25 | m-1 sm:m-4 | w-1/1">
                <form action="{{route('goLibraryResult')}}" method="post" class="p-3 w-1/1">
                    @csrf
                    <div>
                        <input type="text" name="type" hidden value="{{$type}}">
                        <input class="shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                        type="text"
                        name="searcher"
                        placeholder="Buscar..."
                        value="{{$filters['text']}}">
                        <input class="my-2 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" 
                        type="submit"
                        value="Acceptar">
                    </div>
                    <div class="my-2">
                        <div class="my-2">
                            <input class="form-checkbox h-4 w-4 text-blue"
                            name="more" 
                            id="more" 
                            type="checkbox" 
                            @if ($filters["more"] != 0) checked @endif>
                            <label for="more">
                                Buscador avanzado
                            </label>
                        </div>
                        <div id="moreDiv" class="my-2 flex flex-col">

                            <hr class="w-9/12 mx-auto justify-items-center">

                            <!-- Orden -->
                            <div class="my-4 ml-3">
                                <label for="order">Order</label>
                                <select name="order" class="text-black w-full" id="order">
                                    <option value="desc" @if ($filters["order"] == 0) selected @endif>M??s nuevos</option>
                                    <option value="asc" @if ($filters["order"] == 1) selected @endif>M??s viejos</option>
                                    <option value="more" @if ($filters["order"] == 2) selected @endif>M??s capitulos</option>
                                    <option value="minus" @if ($filters["order"] == 3) selected @endif>Menos capitulos</option>
                                    <option value="alfa" @if ($filters["order"] == 4) selected @endif>Alfabetico</option>
                                    <option value="alfaC" @if ($filters["order"] == 5) selected @endif>Contrario al alfabetico</option>
                                    <option value="moreMark" @if ($filters["order"] == 6) selected @endif>M??s buenos</option>
                                    <option value="minMark" @if ($filters["order"] == 7) selected @endif>M??s malos</option>
                                </select>
                            </div>

                            <!--VisualNovel type-->
                            @if($type == 1)
                                <hr class="w-9/12 mx-auto justify-items-center">
                                <div class="my-4 ml-3">
                                    <div>
                                        <p>Tipo de Visual Novel</p>
                                        <input type="checkbox" name="all" id="all" value="all" @if ($filters["type"]["all"] == 0) checked @endif>
                                        <label for="all">Todos</label>
                                        <div id="novelVisualType" class="flex flex-wrap ml-3">
                                            <div class="bg-manhwa p-1 pr-2 rounded-full mr-3 mb-3">
                                                <input type="radio" name="typeVN" id="manhwa" value="manhwa" @if ($filters["type"]["typeVN"] == "manhwa") checked @endif>
                                                <label for="manhwa">Manhwa</label>
                                            </div>
                                            <div class="bg-manhua p-1 pr-2 rounded-full mr-3 mb-3">
                                                <input type="radio" name="typeVN" id="manhua" value="manhua" @if ($filters["type"]["typeVN"] == "manhua") checked @endif>
                                                <label for="manhua">Manhua</label>
                                            </div>
                                            <div class="bg-manga p-1 pr-2 rounded-full mr-3 mb-3">
                                                <input type="radio" name="typeVN" id="manga" value="manga" @if ($filters["type"]["typeVN"] == "manga") checked @endif>
                                                <label for="manga">Manga</label>
                                            </div>
                                            <div class="bg-oneShot p-1 pr-2 rounded-full mb-3">
                                                <input type="radio" name="typeVN" id="oneShot" value="oneShot" @if ($filters["type"]["typeVN"] == "oneShot") checked @endif>
                                                <label for="oneShot">One Shot</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <hr class="w-9/12 mx-auto justify-items-center">

                            <!-- Finalizado -->
                            <div class="my-4 ml-3">
                                <p>Finalizado</p>
                                <input type="checkbox" name="bothE" id="bothE" value="bothE" @if ($filters["finished"] == 0) checked @endif>
                                <label for="bothE">Todos</label>
                                <div id="finished" class="flex flex-wrap ml-3">
                                    <div class="bg-black p-1 pr-2 rounded-full mr-3 mb-3">
                                        <input type="radio" name="endedRario" id="notEnded" value="notEnded" @if ($filters["finished"] == 2) checked @endif>
                                        <label for="notEnded">No finalizado</label>
                                    </div>
                                    <div class="bg-black p-1 pr-2 rounded-full mb-3">
                                        <input type="radio" name="endedRario" id="ended" value="ended" @if ($filters["finished"] == 1) checked @endif>
                                        <label for="ended">Finalizado</label>
                                    </div>
                                </div>
                            </div>

                            <hr class="w-9/12 mx-auto justify-items-center">

                            <!-- Genero -->
                            <div class="my-4 ml-3">
                                <label for="genre">Genero</label>
                                <select class="mi-selector shadow-lg border-none appearance-none rounded w-full py-2 px-3 text-white leading-tight"
                                    name="genre">
                                        <option value='null'>Todos</option>
                                        @foreach($genres as $genre)
                                            <option value='{{$genre->id}}'  @if ($filters["genre"] == $genre->id) selected @endif>{{strtoupper($genre->name)}}</option>
                                        @endforeach
                                </select>
                            </div>

                            <hr class="w-9/12 mx-auto justify-items-center">

                            <!-- +18 -->
                            <div class="my-4 ml-3">
                                <p>Contenido Adulto</p>
                                <input type="checkbox" name="both" id="both" value="both" @if ($filters["adult_content"] == 0) checked @endif>
                                <label for="both">Todos</label>
                                <div id="18div" class="flex flex-wrap ml-3">
                                    <div class="bg-black p-1 pr-2 rounded-full mr-3 mb-3">
                                        <input type="radio" name="adult_content" id="menos18" value="menos18" @if ($filters["adult_content"] == 1) checked @endif>
                                        <label for="menos18">-18</label>
                                    </div>
                                    <div class="bg-black p-1 pr-2 rounded-full mb-3">
                                        <input type="radio" name="adult_content" id="mas18" value="mas18" @if ($filters["adult_content"] == 2) checked @endif>
                                        <label for="mas18">+18</label>
                                    </div>
                                </div>
                            </div>

                            <hr class="w-9/12 mx-auto justify-items-center">
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Div de las novelas -->
        <div class="w-1/1 sm:w-8/12 mx-auto text-white">

            <!-- Resultados de la busqueda -->
            @if($results[0]->name != null)   
                <p class="text-2xl font-bold text-white | border-b-2 | my-1 mt-5">Resultados de la Busqueda</p>&nbsp
                <div class="w-1/1 | mb-12 | flex flex-wrap">
            
                    @foreach($results as $result)
                        <a class="w-1/2 sm:w-4/12 lg:w-3/12 xl:w-2/12" href="{{url('novel/'.$result->id)}}">
                                
                            <div class="flex flex-col | h-60 lg:h-42 xl:h-56 | m-2 | bg-cover bg-no-repeat bg-center" style="background-image:url('{{asset($result->novel_dir.'/cover'.$result->imgtype)}}');">
                                <div class=" w-full | h-full">

                                    <div class="w-full">
                                        
                                        <p class="bg-black bg-opacity-60 | py-0.5 px-2 | w-1/1 | text-center text-xs md:text-sm lg:text-xs text-white font-bold | truncate">{{$result->name}}</p>

                                    </div>

                                    <div class="w-1/1 | flex justify-between | |">
                                        
                                        <p class="bg-{{$result->novel_type}} bg-purple-700 | px-1 m-0.5 | rounded | text-xs text-white font-bold | truncate">{{strtoupper($result->novel_type)}}</p>
                                        <p class="hidden sm:block bg-black bg-opacity-60 | px-1 py-0.5 | text-xs text-white font-bold">{{$result->mark}}/10</p>

                                    </div>
                                    
                                </div>
                            
                                <div class="w-full">
                                    
                                    <p class="bg-black bg-opacity-60 | py-2 px-2 | w-1/1 | text-center text-xs text-white font-bold | truncate">
                                        @foreach($genres as $genre) @if($genre->id == $result->genre) {{strtoupper($genre->name)}} @endif @endforeach
                                    </p>
 
                                </div>
                            </div>

                        </a>
                    @endforeach

                </div>
            @endif
            
            <!-- Ultimas a??adidas -->
            <p class="text-2xl font-bold text-white | border-b-2 | my-1 mt-5">??ltimas a??adidas</p>&nbsp
            
            <div class="w-1/1 flex flex-wrap">
                @foreach($novels as $result)
                    <a class="w-1/2 sm:w-4/12 lg:w-3/12 xl:w-2/12" href="{{url('novel/'.$result->id)}}">
                            
                        <div class="flex flex-col | h-60 lg:h-42 xl:h-56 | m-2 | bg-cover bg-no-repeat bg-center" style="background-image:url('{{asset($result->novel_dir.'/cover'.$result->imgtype)}}');">
                            <div class=" w-full | h-full">

                                <div class="w-full">
                                    
                                    <p class="bg-black bg-opacity-60 | py-0.5 px-2 | w-1/1 | text-center text-xs md:text-sm lg:text-xs text-white font-bold | truncate">{{$result->name}}</p>

                                </div>

                                <div class="w-1/1 | flex justify-between | |">
                                    
                                    <p class="bg-{{$result->novel_type}} bg-purple-700 | px-1 m-0.5 | rounded | text-xs text-white font-bold | truncate">{{strtoupper($result->novel_type)}}</p>
                                    <p class="hidden sm:block bg-black bg-opacity-60 | px-1 py-0.5 | text-xs text-white font-bold">{{$result->mark}}/10</p>

                                </div>
                                
                            </div>
                        
                            <div class="w-full">
                                
                                <p class="bg-black bg-opacity-60 | py-2 px-2 | w-1/1 | text-center text-xs text-white font-bold | truncate">
                                    @foreach($genres as $genre) @if($genre->id == $result->genre) {{strtoupper($genre->name)}} @endif @endforeach
                                </p>

                            </div>
                        </div>

                    </a>
                @endforeach
            </div>
        </div>
    </div>

    @include('layouts.footer')
    
    <script id="functions" src="{{ asset('js/recomendedAuthorsJS.js') }}" defer></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    
</body>
</html>