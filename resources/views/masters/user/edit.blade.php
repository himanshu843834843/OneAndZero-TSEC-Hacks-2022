@extends('layout.app')


@section('toolbar-title', 'Profile')


@section('page-content')


<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="container d-flex justify-content-center">

        @include('general-partials._message')

        <div class="card w-50 rounded-0 rounded-end">
            <div class="card-body d-flex justify-content-center flex-column">
                <form method="POST" action="{{route('users.update',$user)}}">
                    @method("PUT")
                    @csrf
                        <div class="fv-row">
                            <div class="form-group">
                                <label for="name" class="mb-3 required fw-bold mb-2">Name</label>
                                <input type="text"
                                       id="name"
                                       name="name"
                                       class="form-control mb-lg-0 "
                                       placeholder="User Name"
                                       value="{{$user->name}}">
                            </div>
                        </div>
                        <div class="fv-row">
                            <div class="form-group">
                                <label for="email" class="my-3 required fw-bold mb-2">Email</label>
                                <input type="text"
                                       id="email"
                                       name="email"
                                       class="form-control mb-lg-0 "
                                       placeholder="Email"
                                       value="{{$user->email}}">
                            </div>
                        </div>
                    <div class="fv-row mt-7">
                        <div class="form-group">
                            <button type="reset" class="btn btn-secondary me-2">Cancel</button>
                            <input id="update_medium_submit" type="submit" class="btn btn-success">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--end::Content-->
@endsection
