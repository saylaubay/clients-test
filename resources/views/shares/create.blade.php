@extends('layouts.site')

@section('content')

    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Create new client</h6>
            </div>
            <div class="card-body">
                @if(session()->has('message'))
                    <div class="alert alert-danger">
                        {{ session('message') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                @endif
                <form action="{{ route('shares.store') }}" method="post">
                    @csrf

                    <label for="fName">Name</label>
                    <input required type="text" class="form-control" id="fName" name="name" aria-describedby="emailHelp"
                           placeholder="Name">

                    <label class="mt-2" for="startDiscount">startDiscount</label>
                    <input required type="date" id="startDiscount" name="startDiscount" class="form-control">

                    <label class="mt-2" for="endDiscount">endDiscount</label>
                    <input required type="date" id="endDiscount" name="endDiscount" class="form-control">

                    <label class="mt-2" for="percent">Percent</label>
                    <input required type="text" class="form-control" id="percent" name="percent" aria-describedby="emailHelp"
                           placeholder="percent">

                    <label class="mt-2" for="reqPoint">Requirement point</label>
                    <input type="text" class="form-control" id="reqPoint" name="reqPoint" aria-describedby="emailHelp"
                           placeholder="0">

                    <div class="mt-2 form-group form-check">
                        <input type="checkbox" class="form-check-input" name="send" value="" id="send">
                        <label class="form-check-label" for="send">Send to clients</label>
                    </div>

                    <button type="submit" class="btn btn-primary mt-4">Save</button>
                </form>
            </div>
        </div>

    </div>

@endsection

{{--<script>--}}
{{--    window.setTimeout(function () {--}}
{{--        $(".alert").fadeTo(500, 0).slideUp(500, function () {--}}
{{--            $(this).remove();--}}
{{--        });--}}
{{--    }, 10000);--}}
{{--</script>--}}
