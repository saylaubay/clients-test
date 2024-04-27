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


            <div class="card shadow mb-4">
                <div class="card-header py-3">

                    <h6 class="m-0 font-weight-bold text-primary">Klientlerge tuwilg'an ku'nine sms jiberiw waqtin belgilew</h6>
                </div>
                <form action="{{ route('rules.update', $rule->id) }}" method="post">
                @method('PUT')
                        @csrf
                <div class="card-body">
                    <div class="container">



                        <div class="row">
                            <div class="col-md-4">

                            <input required value="{{ $saat }}" type="time" class="form-control" id="time" name="saat" aria-describedby="emailHelp">

                            </div>
                            <div class="col-md-4">
                            <button class="btn btn-success" type="submit">update</button>
                            </div>

                        </div>
                    </div>

                </div>
                </form>

                <div class="row">
                    <div class="col-sm-12">
                        <div class="float-right p-4">
                            {{--                        {{$users->links()}}--}}
                        </div>
                    </div>
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
