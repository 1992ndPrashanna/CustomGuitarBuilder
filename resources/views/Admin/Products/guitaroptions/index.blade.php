{{-- For Guitars --}}

<x-app-layout>
    {{-- 
        'brands','types','positions','activepassive','coverings','magnets'    
    --}}
    <style>
        table, th, td {
        border: 1px solid black;
    }
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
    $route=$info_array[0];
    @endphp
    <div class="container-fluid mt-10">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        All {{$name}}
                    </div>
                </div>
                
                        <table class="table table-hover" style="text-align: center; width:100%;">
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
                            @else
                                <tr>
                                    <th scope="col">{{$name}}</th>
                                    <th scope="col">Description</th>
                                    <th scope="col" colspan="2">Action</th>
                                </tr>
                            @endif
                            
                            </thead>
                            <tbody>
                            @foreach ($all_data as $data)
                                <tr>
                                    <td><strong>{{$data->type}}</strong></td>
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
                                    @endif
                                    <td>
                                       @php
                                           echo substr($data->description,0,50)."...";
                                       @endphp
                                    </td>
                                    <td><a href="#" class="btn btn-info btn-sm">Edit</a></td>
                                    <td><a href="#" class="btn btn-danger btn-sm">Delete</a></td>
                              </tr>    
                            @endforeach
                              
                            </tbody>
                          </table>
                          {{$all_data->links()}}
            </div>
            <div class="col-md-4 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h4>Create {{$name}}</h4>
                    </div>
                    <div class="card-body">

                        <form action="{{route($route)}}" method="POST">
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
                            @if($type!='defaults')
                            <div class="mb-3">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter Description"></textarea>
                            </div>
                            @endif
                            {{-- for default options --}}
                            @if ($type=='defaults')
                                <div class="mb-3">
                                    <select class="form-select" name="feature_for" aria-label="Default select example">
                                        <option selected>Default Option For</option>
                                        <option value="Guitar">Guitar</option>
                                        <option value="Neck">Neck</option>
                                      </select>
                                </div>
                            @endif

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
        </div>
    </div>

    <script type="text/javascript" src="{{URL::asset('js/trix.js')}}"></script>
</x-app-layout>








