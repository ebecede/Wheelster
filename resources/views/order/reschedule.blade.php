@extends('layouts.product_layout')

@section('content')

<div class="container col-md-4 backblue my-5">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <a href="{{ url()->previous() }}" style="color: black"><i class="bi bi-arrow-left"></i></a>
        <h1 class="text-center flex-grow-1">Reschedule Form</h1>
    </div>
    <hr style="border-color: black;"> <br>
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('reschedule_order', $order) }} " method="POST" enctype="multipart/form-data">
                @method('patch')
                @csrf
                <div class="form-group">
                    <label for="schedule">Select a Schedule</label>
                    <input type="date" name="scheduleDate" class="form-control" required min="{{ now()->addDays(7)->toDateString() }}">
                </div>
                <button type="submit" class="btn-darkblue btn-block mt-4" style="padding: 5px 5px">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection
