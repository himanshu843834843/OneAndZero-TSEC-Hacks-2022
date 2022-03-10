@extends('layout.app')


@section('toolbar-title', 'User')


@section('page-content')


<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <div class="container">


        <div class="card">
            <div class="card-body  text-gray-700">
                <div class="row">
                    <div class="col-md-12">
                        @include('masters.user.partials._index')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--end::Content-->
@endsection
@section('page-level-scripts')
    <script src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery-validator/validate.min.js') }}"></script>
    <script src="{{asset('assets/js/masters/users/datatable.js')}}"></script>
    <script>
        initUsersTable('{{ route('users.getUsersJson') }}',' {{ csrf_token() }}');
    </script>
    <script>
        $(document).on("click",".fetch_user_details",function() {
            let dataUrl = $(this).data('url');
            let id = $(this).parent().parent().attr('id');
            $.ajax({
                url: dataUrl,
                data: {
                    "_token" : "{{ csrf_token() }}",
                },
                method: 'POST',
                success: function (user) {
                    console.log("In success");
                    let badge = "<span class=\"label font-weight-bold label-lg badge badge-light-success label-inline\">Admin</span>";
                    let element = $('#id').first()
                    element.removeClass("btn-danger")
                    element.addClass("btn-success")
                    table.draw();
                },
                error: function (error) {
                    console.log("In err");
                }
            });
        });
    </script>
@endsection
