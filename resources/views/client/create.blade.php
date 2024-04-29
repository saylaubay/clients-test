@extends('layouts.site')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        @if(session()->has('message'))
            <div class="alert alert-danger">
                {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
        @endif

    <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Create new client</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('clients.store') }}" method="post">
                    @csrf

                    <label for="fName">Firstname</label>
                    <input required type="text" class="form-control" id="fName" name="firstName"
                           aria-describedby="emailHelp"
                           placeholder="Firstname">
                    <label class="mt-2" for="lName">Lastname</label>
                    <input required type="text" class="form-control" id="lName" name="lastName"
                           aria-describedby="emailHelp"
                           placeholder="Lastname">
                    <label class="mt-2" for="phone">Phone</label>
                    <input required type="text" class="form-control" id="phone" name="phone"
                           aria-describedby="emailHelp"
                           placeholder="Phone">

                    <label class="mt-2" for="phone">BirthDate</label>
                    <input required type="date" id="birthDate" name="birthDate" class="form-control">

                    <label class="mt-2" for="phone">Points</label>
                    <input required type="text" class="form-control" id="points" name="points" aria-describedby="emailHelp"
                           placeholder="Points">

                    <button type="submit" class="btn btn-primary mt-4">Save</button>
                </form>
            </div>
        </div>

    </div>

@endsection
