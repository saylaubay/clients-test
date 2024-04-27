@extends('layouts.site')

@section('content')

    <h1>Client update</h1>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Client edit</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('clients.update', $client->id) }}" method="post">
                    @method('PUT')
                    @csrf

                    <label for="fName">Firstname</label>
                    <input required value="{{ $client->firstName }}" type="text" class="form-control" id="fName" name="firstName" aria-describedby="emailHelp"
                           placeholder="Firstname">
                    <label class="mt-2" for="lName">Lastname</label>
                    <input required value="{{ $client->lastName }}" type="text" class="form-control" id="lName" name="lastName" aria-describedby="emailHelp"
                           placeholder="Lastname">
                    <label class="mt-2" for="phone">Phone</label>
                    <input required value="{{ $client->phone }}" type="text" class="form-control" id="phone" name="phone" aria-describedby="emailHelp"
                           placeholder="Phone">

                    <label class="mt-2" for="phone">BirthDate</label>
                    <input required type="date" value="{{$client->birthDate}}" id="birthDate" name="birthDate" class="form-control">

                    <label class="mt-2" for="phone">Points</label>
                    <input value="{{ $client->points }}" type="text" class="form-control" id="points" name="points" aria-describedby="emailHelp"
                           placeholder="Points">

                    <button type="submit" class="mt-4 btn btn-primary">update</button>
                </form>
            </div>
        </div>

    </div>

@endsection
