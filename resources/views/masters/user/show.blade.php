@extends('layout.app')


@section('toolbar-title', 'Profile')


@section('page-content')


<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="container d-flex justify-content-center">


        <div class="d-flex">
            <img class="rounded-start" src="{{ asset('assets/media/avatars/150-26.jpg') }}" alt="Profile pic">
            <div class="card rounded-0 rounded-end">
                <div class="card-body d-flex justify-content-center flex-column">
                    <div class="d-flex">
                        <h5 class="card-title d-inline-block">{{$user->name}}</h5>
                        <span class="d-inline-block p-2 ms-2 label font-weight-bold label-lg badge {{$user->isAdmin() ? 'badge-light-success' : 'badge-light-warning'}} ">
                            {{$user->isAdmin()? 'ADMIN' : 'MEMBER'}}
                        </span>
                    </div>
                    <p class="card-text">{{$user->email}}</p>
                    <div class="d-flex">
                        <a href="{{route('users.edit', $user)}}" class="btn-primary p-3 btn">
                            <i class="me-1 la la-edit"></i>Edit
                        </a>
                        <form id="delete-form" action="{{route('users.destroy',$user)}}" method="post">
                            @method('DELETE')
                            @csrf
                            <a class="btn-danger ms-3 p-3 btn" onclick="displayModal()">
                                <i class="me-1 la la-trash"></i>Delete
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--end::Content-->
@endsection

@section('page-level-scripts')

    <script>
        function displayModal(){
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes, submit it!",
                cancelButtonText: "No, cancel!",
                reverseButtons: true
            }).then(function (result) {
                if (result.value) {
                    $("#delete-form").trigger("submit");
                } else if (result.dismiss === "cancel") {

                }
            });
            return false;
        }
    </script>

@endsection
