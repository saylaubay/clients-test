@extends('layouts.site')

@section('content')


    <div class="container-fluid">

        <h4>Dashboard</h4>
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Clients
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$clientCount}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-users text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Shares
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{$sharesCount}}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fa fa-shopping-cart fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- /.container-fluid -->

    </div>

@endsection
