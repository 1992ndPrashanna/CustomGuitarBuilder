@php
    $name=$infoarray[0];
    $type=$infoarray[1];
@endphp

<div class="col-md-4 mx-auto">
    <div class="card">
        @if(session('failure'))
            <div class="alert alert-danger alert-dismissible fade show w-100" role="alert" style="text-align: center;">
            <strong>{{session('failure')}}</strong>
            <button type="button" class="btn-sm btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="card-header">
            <h4>Edit {{$name}}</h4>
        </div>
        <div class="card-body">
            <div class="neck-edit">
                <div class="mb-3" style="text-align: center;">Current Values:</div>
                <table class="table table-hover table-bordered" style="text-align: center; width:100%;">
                    <thead class="table-dark">
                        <tr>
                            <th>
                                Pieces
                            </th>
                            <th>
                                Woods
                            </th>
                        </tr>
                        <tr>
                            <td>{{$edit->piece}}</td>
                            <td>@php
                                echo $edit->neck_woods;
                            @endphp</td>
                        </tr>
                    </thead>
                </table>
            </div>
            <form action="{{url('/products/guitar/'.str_replace(" ","",strtolower($type)).'/update/'.$edit->id)}}" method="POST">
                @csrf
                <div class="mb-3">
                    Change/Edit Neck Piece(s)
                    <input class="form-check-input" type="radio" name="piece" id="onepiece" value="1" onchange="createNeckPieceForm(1)" @php
                        if($edit->piece==1){
                            echo "onchange='createNeckPieceEditForm(1)' checked='checked' ";
                        }
                        else {
                            echo "onchange='createNeckPieceForm(1)'";
                        }
                    @endphp> {{-- end input for 1--}}
                    <label class="form-check-label" for="onepiece">
                    1-piece
                    </label>
                 
                    <input class="form-check-input" type="radio" name="piece" id="threepiece" value="3" 
                    @php
                    if($edit->piece==3){
                            echo "onchange='createNeckPieceEditForm(3)' checked='checked'";
                        }
                        else {
                            echo "onchange='createNeckPieceForm(3)'";
                        }
                    @endphp>{{-- end input for 3 --}}
                    <label class="form-check-label" for="threepiece">
                    3-piece
                    </label>
                
                    <input class="form-check-input" type="radio" name="piece" id="fivepiece" value="5" 
                    @php
                    if($edit->piece==5){
                            echo "onchange='createNeckPieceEditForm(5)' checked='checked'";
                        }
                        else {
                            echo "onchange='createNeckPieceForm(5)'";
                        }
                    @endphp >   {{-- end input for 5 --}}
                
                    <label class="form-check-label" for="fivepiece">
                    5-piece
                    </label>
                    <div id="wood-select-div" class="col-md-10 mx-auto" style="margin: 5px;">
                        createNeckPieceEditForm(<?php echo $edit->pieces?>);
                    </div>
                    <a href="{{route('guitar.neck')}}" class="btn btn-info">Cancel</a>
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

@php
    $woods_array_php=array();
    $wood_ids=array();
    $i=0;
    foreach ($neckwoods as $neckwood) {
        $woods_array_php[$i]=$neckwood->type;
        $wood_ids[$i]=$neckwood->id;
        $i++;
                
    }
    //explode currently selected woods peices into an array
    $selected_woods=explode(" &mdash; ",$edit->neck_woods);
@endphp
<script>

    var selected_number_of_pieces={!! json_encode($edit->piece,JSON_HEX_TAG) !!};
    //one form method
    function createNeckPieceEditForm(pieces){
        var neck_piece=pieces;
        var selected_woods={!! json_encode($selected_woods,JSON_HEX_TAG) !!};
        var i=0;
        var j=0;
        var w=0;
        var woods={!! json_encode($woods_array_php,JSON_HEX_TAG) !!};
        var wood_ids={!! json_encode($wood_ids,JSON_HEX_TAG) !!};
        // var woods=json_encode($neck_woods);
        var selector_div='<h5 class="my-3">Select Neck Woods</h5>';
        for(i=0;i<neck_piece;i++){
            selector_div+="<div id='added_selector_"+(i+1)+"' class='added_selector'><select class='form-select mb-3' name='piece_"+ (i+1) +"'><option value='"+ selected_woods[i] +"'>"+ selected_woods[i] + " -  (Currently Selected) </option>"
            for(j=0;j<woods.length;j++){
                selector_div +='<option value="' + woods[j] + '">' + woods[j] +'</option>';
            }
            selector_div +='</select></div>';
        }
        console.log(woods[1]);
        selector_div += '<input type="hidden" name="looper" value='+ pieces +'>'+'<button class="btn btn-success my-3">Update Neck Profile</button>';
        document.getElementById("wood-select-div").innerHTML=selector_div;
        console.log(woods);
    }

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
        selector_div += '<input type="hidden" name="looper" value='+ pieces +'>'+'<button class="btn btn-success my-3">Update Neck Profile</button>';
        document.getElementById("wood-select-div").innerHTML=selector_div;
        console.log(woods);
    }

    window.onload=function(){
        createNeckPieceEditForm(selected_number_of_pieces);
    };
</script> 