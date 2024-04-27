@extends('layouts.site')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        @if($clients->count() == 0)
            Client list empty
        @else

        <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Clients</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>FirstName</th>
                                <th>LastName</th>
                                <th>Phone</th>
                                <th>BirthDate</th>
                                <th>Points</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($clients as $client)
                                <tr>
                                    <td>{{$client->id}}</td>
                                    <td>{{$client->firstName}}</td>
                                    <td>{{$client->lastName}}</td>
                                    <td>{{$client->phone}}</td>
                                    <td>{{$client->birthDate}}</td>
                                    <td>{{$client->points}}</td>
                                    <td>
                                        <a href="{{ route('clients.edit', $client->id) }}"
                                           class="btn btn-warning btn-circle">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <form class="btn btn-danger btn-circle"
                                              action="{{ route('clients.destroy', $client->id) }}" method="post">
                                            @method('DELETE')
                                            @csrf
                                            <button class="btn btn-danger btn-circle" type="submit">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>

{{--                <div class="row">--}}
{{--                    <div class="col-sm-12">--}}
{{--                        <div class="float-right p-4">--}}
{{--                            --}}{{--                        {{$users->links()}}--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}

            </div>
        @endif
    </div>

@endsection
