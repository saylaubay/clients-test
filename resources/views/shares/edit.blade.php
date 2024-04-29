@extends('layouts.site')

@section('content')

    <h1>Share update</h1>

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Share edit</h6>
            </div>
            <div class="card-body">
                @if(session()->has('message'))
                    <div class='alert alert-success'>
                        {{ session('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                @endif

                <form action="{{ route('shares.update', $share->id) }}" method="post">
                    @method('PUT')
                    @csrf

                    <label for="name">Name</label>
                    <input required value="{{ $share->name }}" type="text" class="form-control" id="name" name="name" aria-describedby="emailHelp">

                    <label class="mt-2" for="startDiscount">StartDiscount</label>
                    <input required type="date" value="{{$share->startDiscount}}" id="startDiscount" name="startDiscount" class="form-control">

                    <label class="mt-2" for="endDiscount">EndDiscount</label>
                    <input required type="date" value="{{$share->endDiscount}}" id="endDiscount" name="endDiscount" class="form-control">

                    <label class="mt-2" for="percent">Percent</label>
                    <input required value="{{ $share->percent }}" type="text" class="form-control" id="percent" name="percent" aria-describedby="emailHelp">

                    <label class="mt-2" for="reqPoint">Requirement point</label>
                    <input required value="{{ $share->reqPoint }}" type="text" class="form-control" id="reqPoint" name="reqPoint" aria-describedby="emailHelp">

                    <button type="submit" class="mt-4 btn btn-primary">update</button>
                </form>
            </div>
        </div>

    </div>

@endsection
