@extends('layouts.admins')

@section('content')
    <div class="container">
        @if( session( 'success' ))
            <p class="alert {{ Session::get('alert-class', 'alert-primary') }}">
                {{ session( 'success' ) }}
            </p>
        @elseif( session('deleted') )
            <p class="alert {{ Session::get('alert-class', 'alert-success') }}">
                {{ session('deleted' ) }}
            </p>
        @elseif( session('error') )
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif
    </div>

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4 d-inline">Admins</h5>
                    <a  href="{{ route('create.admin') }}" class="btn btn-primary mb-4 text-center float-right">Create Admins</a>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">admin name</th>
                            <th scope="col">email</th>
                            <th scope="col">status</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($allAdmins as $admin)

                        <tr>
                            <th scope="row">{{$admin->id}}</th>
                            <td>{{$admin->name}}</td>
                            <td>{{$admin->email}}</td>

                            <td>
                                <form action="{{ route('delete.admin', $admin->id) }}" method="POST"
                                      onsubmit="return confirm('Are you sure you want to delete this admin?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger text-center">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
