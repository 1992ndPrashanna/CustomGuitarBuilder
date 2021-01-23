<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Products') }}
        </h2>
    </x-slot>


    <div class="container mt-10">
        <div class="row">
            <div class="col-md-8 my-10">
                <div class="card">
                    <h5 class="card-header">Product Types</h5>
                    <div class="card-body">
                        <table class="table table-hover" style="text-align: center">
                            <thead>
                                <tr>
                                    <th scope="col">Type</th>
                                    <th scope="col">Description</th>

                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>
                                        <a href="{{route('products.guitars')}}"> Guitars </a>
                                    </td>
                                    <td>
                                        Electric Guitars
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <a href="{{route('products.pickups')}}"> Pickups </a>
                                    </td>
                                    <td>
                                        Electric Guitar Pickups
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

            {{-- <div class="col-md-4 my-10 ">
                <div class="card">
                    <div class="card-header">
                        Add Product
                    </div>
                    <div class="card-body">
                        <form action="{{route('create.product')}}" method="POST">
                            @csrf
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Product Name">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="description" id="description" placeholder="Description or Tags">
                                </div>
                            </div>
                            <div class="form-group row">

                                <div class="col-sm-10">
                                    <label for="" lass="col-sm-2 col-form-label">Select Category </label><br>
                                    <select id="category" name="category">

                                        @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-primary">Add Product</button>
                                </div>
                            </div>
                        </form>

                        @if(session('success'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            {{session('success')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                </div>
            </div> --}}

            {{-- end card --}}



        </div>
    </div>
    </div>

    <script>


    </script>
</x-app-layout>
