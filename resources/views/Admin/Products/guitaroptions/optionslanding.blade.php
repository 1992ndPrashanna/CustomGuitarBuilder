<x-app-layout>
    {{-- 
        'brands','types','positions','activepassive','coverings','magnets'    
    --}}
    <style>

    
        table {
            background-color:#fff;
        }

        .btn-outline-success:hover {
            background-color:rgb(126, 241, 126);
        }

    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Products / Guitars / Add Guitar Option') }}
        </h2>
    </x-slot>
    <x-guitar-options-bar/>
    @php
        $name=$info_array[2];
        $type=$info_array[1];
        $create_route=$info_array[0];
    @endphp
    <div class="container-fluid mt-10">
        <div class="row">
            <div class="col-md-8 mx-auto">
            @if ($type!='neck')
                <div class="card">
                    <div class="card-header">
                        All {{$name}}
                    </div>
                </div>
                
                {{-- tables component here --}}
               
                <table class="table table-hover table-bordered" style="text-align: center; width:100%;">
                    <thead class="table-dark">
                        @if ($type=="wood" )
                            <tr>
                                <th scope="col" rowspan="2">{{$name}}</th>
                                <th scope="col" colspan="4">Category</th>
                                <th scope="col" rowspan="2">Description</th>
                                <th scope="col" colspan="2" rowspan="2">Action</th>
                            </tr>
                            <tr>
                                <th scope="col">Body</th>
                                <th scope="col">Top</th>
                                <th scope="col">Fretboard</th>
                                <th scope="col">Neck</th>
                                
                            </tr>
                        @elseif($type=="fret brands" || $type=="bridge brands" || $type=="tuner brands")
                            <tr>
                                <th scope="col">Brand Name</th>
                                <th scope="col">Brand Logo</th>
                                <th scope="col" colspan="2">Actions</th>
                            </tr>
                        @else
                            <tr>
                                <th scope="col">{{$name}}</th>
                                @if ($type=="frets" || $type=="bridge" || $type=="tuners")
                                <th scope="col" >Brand</td>
                                @endif
                                <th scope="col">Description</th>
                                <th scope="col" colspan="2">Action</th>
                            </tr>
                        @endif
                            
                    </thead>
                    <tbody>
                    @foreach ($all_data as $data)
                        <tr>
                            @if ($type=="fret brands" || $type=="bridge brands" || $type=="tuner brands")
                            <td><strong>{{$data->name}}</strong></td>
                            @else
                            <td><strong>{{$data->type}}</strong></td>
                            @endif
                            
                            @if ($type=="wood")
                                <td>
                                    {{-- Body Wood --}}
                                    @if ($data->is_body === "Yes")
                                    <i class="fas fa-check"></i>
                                    @else
                                    <i class="fas fa-times"></i>
                                    @endif
                                </td>
                                <td>
                                    @if ($data->is_top === "Yes")
                                    <i class="fas fa-check"></i>
                                    @else
                                    <i class="fas fa-times"></i>
                                    @endif
                                </td>
                                <td>
                                    @if ($data->is_fretboard === "Yes")
                                    <i class="fas fa-check"></i>
                                    @else
                                    <i class="fas fa-times"></i>
                                    @endif
                                </td>
                                <td>
                                    @if ($data->is_neck === "Yes")
                                    <i class="fas fa-check"></i>
                                    @else
                                    <i class="fas fa-times"></i>
                                    @endif
                                </td>
                                <td>
                                    @php
                                   echo substr($data->description,0,50)."...";
                               @endphp
                                </td>
                            
                            @elseif ($type=="frets" || $type=="bridge" || $type=="tuners")
                                <td>{{$data->fretBrand->name}}</td>
                            @elseif ($type=="fret brands" || $type=="bridge brands" || $type=="tuner brands")
                                <td><img src="{{asset($data->image_url)}}" alt=""></td>
                            
                            @elseif ($type!="fret brands" || $type!="bridge brands" || $type!="tuner brands" )
                            <td>
                               @php
                                   echo substr($data->description,0,50)."...";
                               @endphp
                            </td>
                            @endif
                            <td><a href="{{url('/products/guitar/'.str_replace(" ","",$type).'/edit/'.$data->id)}}" class="btn btn-info btn-sm">Edit</a></td>           
                            <td><button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#{{'delete-'.$data->id}}">Delete</button></td>
                      </tr>
                          {{-- delete modal for each item --}}
                            <!-- Modal -->
                            <div class="modal fade" id="{{'delete-'.$data->id}}" tabindex="-1" aria-labelledby="" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="">Delete {{$data->type}} Permanently?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <strong>{{$data->type}}</strong> will be permanenly deleted!
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <a href="{{url('/products/guitar/'.str_replace(" ","",$type).'/delete/'.$data->id)}}" class="btn btn-danger">Delete</a>
                                    </div>
                                </div>
                                </div>
                            </div>
                    @endforeach
                    </tbody>
                </table>
                  {{$all_data->links()}}
                  @endif

                  {{-- table for necks --}}
                  @if ($type=="neck")
                    <div class="card">
                        <div class="card-header">
                            All {{$name}}
                        </div>
                    </div>
                    <table class="table table-hover table-bordered" style="text-align: center; width:100%;">
                        <thead class="table-dark">
                           <tr>
                               <th>
                                   Neck Piece(s)
                               </th>
                               <th>
                                   Woods
                               </th>
                               <th colspan="2">Actions</th>
                           </tr>

                        </thead>
                        <tbody>
                            @foreach ($all_data as $data)
                            <tr>
                                <td>{{$data->piece}}</td>
                                <td>@php echo $data->neck_woods @endphp</td>
                                <td><a href="{{url('/products/guitar/'.str_replace(" ","",$type).'/edit/'.$data->id)}}" class="btn btn-info btn-sm">Edit</a></td>           
                                <td><button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#{{'delete-'.$data->id}}">Delete</button></td>
                            </tr>
                            {{-- delete modal for each item --}}
                            <!-- Modal -->
                            <div class="modal fade" id="{{'delete-'.$data->id}}" tabindex="-1" aria-labelledby="" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="">Delete {{$type}} Permanently?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <strong>@php
                                            echo $data->piece.' piece "'.$data->neck_woods.'"';
                                        @endphp</strong> neck will be permanenly deleted!
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                    <a href="{{url('/products/guitar/'.str_replace(" ","",$type).'/delete/'.$data->id)}}" class="btn btn-danger">Delete</a>
                                    </div>
                                </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                  @endif
            `</div>
            
                @if ($type!="neck")
                    <div class="col-md-4 mx-auto">
                        <div class="card">
                            <div class="card-header">
                                <h4>Create {{$name}}</h4>
                            </div>
                            <div class="card-body">
        
                                <form action="{{route($create_route)}}" method="POST" @php if ($type=="fret brands" || $type=="bridge brands" || $type=="tuner brands") echo "enctype=multipart/form-data"; @endphp>
                                    @csrf
                                    <div class="mb-3">
                                        <label for="type">Enter {{$name}} type</label>
                                        <input class="form-control" type="text" name="type" id="type" placeholder="Enter {{$info_array[2]}} Type">
                                    </div>
                                    {{-- extra wood option "Category" --}}
                                    @if ($type=="wood" ||$type=="body wood" ||$type=="top wood" || $type=="fretboard wood" || $type=="neck wood")
                                    {{-- checkboxes --}}
                                    <div class="mb-3 container-fluid" style="margin:0px;padding:0px;">
                                        <label>Wood Category (Select All Applicable)</label>
                                            <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                                                <input type="checkbox" class="btn-check" name="bodywood" id="bodywood" value="Yes" autocomplete="off" @php
                                                    if($type=="body wood")
                                                    echo "checked";
                                                @endphp>
                                                <label class="btn btn-outline-success" for="bodywood">Body Wood</label>
                                            
                                                <input type="checkbox" class="btn-check" name="topwood" id="topwood" value="Yes" autocomplete="off"@php
                                                if($type=="top wood")
                                                echo "checked";
                                                @endphp>
                                                <label class="btn btn-outline-success" for="topwood">Top Wood</label>
        
                                                <input type="checkbox" class="btn-check" name="neckwood" id="neckwood" value="Yes" autocomplete="off" @php
                                                if($type=="neck wood")
                                                echo "checked";
                                            @endphp>
                                                <label class="btn btn-outline-success" for="neckwood">Neck Wood</label>
        
                                                <input type="checkbox" class="btn-check" name="fretboardwood" id="fretboardwood" value="Yes" autocomplete="off" @php
                                                if($type=="fretboard wood")
                                                echo "checked";
                                            @endphp>
                                                <label class="btn btn-outline-success" for="fretboardwood">Fretboard Wood</label>
                                            </div>
                                    </div>
                                    @endif
                                    @if ($type=="fret brands" || $type=="bridge brands" || $type=="tuner brands")
                                        
                                        <div class="mb-3">
                                            <label for=""></label>
                                            <input type="file" class="form-control" name="brand_image" id="brand_image">
                                        </div>
                                    @endif
                                    @if ($type=="frets")
                                    <label for="brand">Brand</label>
                                        <div class="mb-3">
                                            <select class="form-select" name="brand" id="brand" >
                                                    <option value="">Select Brand</option>
                                                @foreach ($brands as $brand)
                                                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif

                                    <div class="mb-3">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter Description"></textarea>
                                    </div>
                                    <button class="btn btn-success btn-lg">Create {{$name}}</button>
                                </form>
                                @if(session('success'))
                                    <div class="alert alert-warning alert-dismissible fade show w-100" role="alert" style="text-align: center;">
                                    <strong>{{session('success')}}</strong>
                                    <button type="button" class="btn-sm btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>  
                                @endif
                                @error('type')
                                    <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
        
                    </div>

                    @else
                    <div class="col-md-4 mx-auto">
                        <div class="card">
                            <div class="card-header">
                                <h4>Create {{$name}}</h4>
                            </div>
                            <div class="card-body">
        
                                <form action="{{route($create_route)}}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        Neck Piece(s)
                                    
                                        <input class="form-check-input" type="radio" name="piece" id="onepiece" value="1" onchange="createNeckPieceForm(1)">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                        1-piece
                                        </label>
                                    
                                        <input class="form-check-input" type="radio" name="piece" id="threepiece" value="3" onchange="createNeckPieceForm(3)">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                        3-piece
                                        </label>
                                    
                                        <input class="form-check-input" type="radio" name="piece" id="fivepiece" value="5" onchange="createNeckPieceForm(5)">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                        5-piece
                                        </label>
                                        
                                        <div id="wood-select-div" class="col-md-10 mx-auto">
                                            
                                        </div>
                                        
                                    </div>
                                </form>
                                @if(session('success'))
                                    <div class="alert alert-warning alert-dismissible fade show w-100" role="alert" style="text-align: center;">
                                    <strong>{{session('success')}}</strong>
                                    <button type="button" class="btn-sm btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>  
                                @endif
                                @error('type')
                                    <div class="text-danger">{{$message}}</div>
                                @enderror
                            </div>
                        </div>
        
                    </div>
                    
                @endif
        </div>
    </div>

    <script type="text/javascript" src="{{URL::asset('js/trix.js')}}"></script>
    @if ($type=="neck")
    @php
    $woods_array_php=array();
    $wood_ids=array();
        $i=0;
        foreach ($neck_woods as $neckwood) {
            $woods_array_php[$i]=$neckwood->type;
            $wood_ids[$i]=$neckwood->id;
            $i++;
        }

    @endphp
    <script>
        //one form method
        function createNeckPieceForm(pieces){
            var neck_piece=pieces;
    
            var i=0;
            var j=0;
            var w=0;
            var woods={!! json_encode($woods_array_php,JSON_HEX_TAG) !!};
            var wood_ids={!! json_encode($wood_ids,JSON_HEX_TAG) !!};
            // var woods=json_encode($neck_woods);
            var selector_div='<h5 class="my-3">Select Neck Woods</h5>';
            for(i=0;i<neck_piece;i++){
                selector_div+="<div id='added_selector_"+(i+1)+"' class='added_selector'><select class='form-select mb-3' name='piece_"+ (i+1) +"'><option value=''>Select Piece "+ (i+1) +"</option>"
                for(j=0;j<woods.length;j++){
                    selector_div +='<option value="' + woods[j] + '">' + woods[j] +'</option>';
                }
                selector_div +='</select></div>';
            }
            console.log(woods[1]);
            selector_div += '<input type="hidden" name="looper" value='+ pieces +'>'+'<button class="btn btn-success my-3">Create Neck Profile</button>';
            document.getElementById("wood-select-div").innerHTML=selector_div;
            console.log(woods);
        }
        </script>
    @endif
</x-app-layout>
