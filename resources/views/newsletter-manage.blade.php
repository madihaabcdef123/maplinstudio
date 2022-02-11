@extends('layouts.main') 
@section('content')
<main>
    <div class="container-fluid site-width">
        <!-- START: Breadcrumbs-->
        <div class="row">
            <div class="col-12 align-self-center">
                <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                    <div class="w-sm-100 mr-auto"><h4 class="mb-0">Contact Inquiry</h4></div>

                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item active"><a href="#">Inquiry</a></li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- END: Breadcrumbs-->

        <!-- START: Card Data-->
        <div class="row">
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-header justify-content-between align-items-center">
                        <h4 class="card-title">User Inquiry</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="display table dataTable table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Type</th>
                                        <th>Email</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($newsletter)
                                    @foreach($newsletter as $val)
                                        <tr>
                                            <td>{{isset($val->user)?'User':'Guest'}}</td>
                                            <td>{{$val->email}}</td>
                                            <td>{{date('M d,Y' , strtotime($val->created_at))}}</td>
                                            <td><button type="button" class="btn btn-danger delete-record" data-model="newsletter" data-id= "{{$val->id}}" >Delete</button></td>
                                        </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                                <tfoot>
                                    <tr>
                                         <th>Type</th>
                                        <th>Email</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Card DATA-->
    </div>
</main>

@endsection 
@section('css')
<style type="text/css"></style>
@endsection 
@section('js') 
<script>
    if ($(".delete-record").length > 0) {

            $(".delete-record").click(function () {

                var id = $(this).data("id");
                var model = $(this).data("model");
                var is_active = 0;
                var is_deleted = 1;

                if (confirm("Are you sure you want to delete this record")) {

                    $.ajax({
                        type: 'post',
                        dataType: 'json',
                        url: "{{route('delete_record')}}",
                        data: {id: id, model: model, is_active: is_active, is_deleted: is_deleted, _token: '{{csrf_token()}}'},
                        success: function (response) {
                            if (response.status == 0) {
                                toastr.error(response.message);
                            } else {
                                toastr.success(response.message);
                                var table = $('#example').DataTable();
                                table.ajax.reload();
                            }
                        }
                    });

                } else {

                }

            });

        }
</script>
@endsection
