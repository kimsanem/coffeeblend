@extends('layouts.admins')

@section('content')

    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title mb-5 d-inline">Edit Order</h5>
                    <p>Current Status is <b>{{ $order->status }}</b> </p>
                    <form method="POST" action="{{route('update.order',$order->id)}}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-outline mb-4 mt-4">

                            <select name="status" class="form-select  form-control" aria-label="Default select example">
{{--                                <option >Status</option>--}}
                                <optgroup label="Status">

                                    <option value="processing"
                                        {{ $order->status === 'processing' ? 'selected disabled' : '' }}>
                                        Processing
                                    </option>

                                    <option value="completed"
                                        {{ $order->status === 'completed' ? 'selected disabled' : '' }}>
                                        Delivered
                                    </option>
                                </optgroup>
                            </select>
                        </div>

                        <br>

                        <!-- Submit button -->
                        <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">Edit</button>

                    </form>

                </div>
            </div>
        </div>

@endsection
