@php
    $name=$infoarray[2];
    $type=$infoarray[1];
    $create_route=$infoarray[0];
@endphp


<div class="col-md-11 mt-10 mx-auto">
    <div class="row">
        <div class="col-md-8">
        
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
                    @foreach ($alldata as $data)
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
        {{$alldata->links()}}
        </div>
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
                    @elseif(session('failure'))
                        <div class="alert alert-danger alert-dismissible fade show w-100" role="alert" style="text-align: center;">
                        <strong>{{session('failure')}}</strong>
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


@php
$woods_array_php=array();
$wood_ids=array();
    $i=0;
    foreach ($neckwoods as $neckwood) {
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

        selector_div += '<input type="hidden" name="looper" value='+ pieces +'>'+'<button class="btn btn-success my-3">Create Neck Profile</button>';
        document.getElementById("wood-select-div").innerHTML=selector_div;

    }
</script>