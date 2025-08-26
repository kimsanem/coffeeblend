@extends('layouts.admins')
@section('title','All Bookings')

@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-4 d-inline">Bookings</h5>

                    <br><br>
                    <div class="container">
                        @if( session( 'delete' ))
                            <p class="alert {{ Session::get('alert-class', 'alert-success') }}">
                                {{ session( 'delete' ) }}
                            </p>
                        @elseif( session( 'update' ))
                            <p class="alert {{ Session::get('alert-class', 'alert-success') }}">
                                {{ session( 'update' ) }}
                            </p>
                        @endif
                    </div>

                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">first_name</th>
                            <th scope="col">last_name</th>
                            <th scope="col">date</th>
                            <th scope="col">time</th>
                            <th scope="col">phone</th>
                            <th scope="col">message</th>
                            <th scope="col">status</th>
                            <th scope="col">change status</th>
                            <th scope="col">created_at</th>
                            <th scope="col">delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($allBookings as $booking)
                        <tr>
                                <th scope="row">{{$booking->user_id}}</th>
                                <td>{{$booking->first_name}}</td>
                                <td>{{$booking->last_name}}</td>
                                <td>{{$booking->date}} </td>
                                <td>{{$booking->time}}</td>
                                <td>{{$booking->phone}}</td>
                                <td>{{$booking->message}}</td>
                                <td>{{$booking->status}}</td>
                                <td><a href="{{route('edit.booking',$booking->id)}}" class="btn btn-warning  text-center ">change status</a></td>
                                <td>{{$booking->created_at}}</td>
                                <td><a href="{{route('delete.booking',$booking->id)}}" class="btn btn-danger  text-center ">delete</a></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


@endsection
