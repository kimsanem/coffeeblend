@extends('layouts.admins')

@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4 d-inline">Products</h5>
                    <a  href="{{route('create.product')}}" class="btn btn-primary mb-4 text-center float-right">Create Products</a>

                    <br><br>
                    <div class="container">
                        @if( session( 'success' ))
                            <p class="alert {{ Session::get('alert-class', 'alert-primary') }}">
                                {{ session( 'success' ) }}
                            </p>
                        @elseif( session( 'deleted' ))
                            <p class="alert {{ Session::get('alert-class', 'alert-success') }}">
                                {{ session( 'deleted' ) }}
                            </p>
                        @endif
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">name</th>
                                <th scope="col">image</th>
                                <th scope="col">price</th>
                                <th scope="col">type</th>
                                <th scope="col">description</th>
                                <th scope="col">status</th>
                            </tr>
                        </thead>

                        <tbody>
                        @foreach($allProducts as $product)
                        <tr>
                            <th scope="row">{{$product->id}}</th>
                            <td>{{$product->name}}</td>
                            <td><img src="{{ asset('assets/images/'.$product->image.'') }}" width="50" height="50"></td>
                            <td>${{$product->price}}</td>
                            <td>{{$product->type}}</td>
                            <td>{{$product->description}}</td>
                            <td><a href="{{route('delete.product',$product->id)}}" class="btn btn-danger  text-center ">delete</a></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
