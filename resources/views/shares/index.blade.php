@extends('layouts.site')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        @if(session()->has('message'))
            <div class='alert alert-success'>
                {{ session('message') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
        @endif

        @if($shares->count() == 0)
            Shares list empty
        @else
        <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Shares</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>StartDiscount</th>
                                <th>EndDiscount</th>
                                <th>Percent</th>
                                <th>reqPoint</th>
                                <th>Send</th>
                                <th></th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($shares as $share)
                                <tr>
                                    <td>{{$share->id}}</td>
                                    <td>{{$share->name}}</td>
                                    <td>{{$share->startDiscount}}</td>
                                    <td>{{$share->endDiscount}}</td>
                                    <td>{{$share->percent}}</td>
                                    <td>{{$share->reqPoint}}</td>
                                    <td>
                                        @if($share->sended == 'NO')

                                            <a href="{{ route('shares.send', $share->id) }}"
                                               class="btn btn-info btn-circle">
                                                <i class="fa fa-paper-plane"></i>
                                            </a>

                                        @else
                                            <i >Sended</i>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('shares.edit', $share->id) }}"
                                           class="btn btn-warning btn-circle">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <form class="btn btn-danger btn-circle"
                                              action="{{ route('shares.destroy', $share->id) }}" method="post">
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


