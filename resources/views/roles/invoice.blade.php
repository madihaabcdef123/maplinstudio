@extends('layouts.main') @section('content')

<main>
    <div class="container-fluid site-width">
        <!-- START: Breadcrumbs-->
        <div class="row">
            <div class="col-12 align-self-center">
                <div class="sub-header mt-3 py-3 align-self-center d-sm-flex w-100 rounded">
                    <div class="w-sm-100 mr-auto"><h4 class="mb-0">Invoice List</h4></div>

                    {{--
                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                        <li class="breadcrumb-item">Home</li>
                        <li class="breadcrumb-item">App</li>
                        <li class="breadcrumb-item active"><a href="#">Invoice List</a></li>
                    </ol>
                    --}}
                </div>
            </div>
        </div>
        <!-- END: Breadcrumbs-->

        <!-- Edit Invoice -->
        <div class="modal fade" id="editinvoice">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="icon-pencil"></i> Edit Invoice</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="icon-close"></i>
                        </button>
                    </div>
                    <form class="edit-invoice-form">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="due-date" class="col-form-label">Due Date</label>
                                <input type="text" id="due-date" class="form-control" required="" />
                            </div>

                            <div class="form-group">
                                <label for="status" class="col-form-label">Status</label>
                                <select class="form-control" id="status">
                                    <option value="generated-invoice">Generated</option>
                                    <option value="paid-invoice">Paid</option>
                                    <option value="pending-invoice">Pending</option>
                                    <option value="canceled-invoice">Canceled</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="edit-date" />
                            <button type="submit" class="btn btn-primary add-todo">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- START: Card Data-->
        <div class="row row-eq-height" style="height: 70%;">
            <div class="col-12 col-lg-2 mt-3 todo-menu-bar flip-menu pr-lg-0">
                <a href="#" class="d-inline-block d-lg-none mt-1 flip-menu-close"><i class="icon-close"></i></a>
                <div class="card border h-100 invoice-menu-section">
                    <ul class="nav flex-column invoice-menu">
                        <li class="nav-item">
                            <a class="nav-link active" href="#" data-invoicetype="invoice"><i class="fas fa-list-alt"></i> All </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#" data-invoicetype="paid-invoice"><i class="fas fa-money-check-alt"></i> Paid </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#" data-invoicetype="pending-invoice"><i class="far fa-money-bill-alt"></i> Pending </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#" data-invoicetype="canceled-invoice"><i class="far fa-window-close"></i> Canceled </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-12 col-lg-10 mt-3 pl-lg-0">
                <div class="card border h-100 invoice-list-section">
                    <div class="view-invoice">
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="card border-0">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <a href="#" class="bg-primary float-left mr-3 py-1 px-2 rounded text-white back-to-invoice">
                                            Back
                                        </a>
                                        <h4 class="card-title">Invoice# <span class="inv-no"></span></h4>
                                    </div>
                                    <div class="card-body table-responsive">
                                        <table class="table table-borderless">
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        @if(Helper::config('address') != "")
                                                        <address>
                                                            <strong>Invoice</strong><br />
                                                            {{Helper::config('address')}}
                                                        </address>
                                                        @endif
                                                        @if(Helper::config('contactnumber') != "")
                                                        <b>Contact Number:</b> {{Helper::config('contactnumber')}}<br />
                                                        @endif
                                                        @if(Helper::config('emailaddress') != "")
                                                        <b>E-Mail:</b> {{Helper::config('emailaddress')}}<br />
                                                        @endif
                                                        @if(Helper::config('websitesurl') != "")
                                                        <b>Web Site:</b> <a href="{{Helper::config('websitesurl')}}" target="_blank">{{Helper::config('websitename')}}</a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <b>Date Added:</b> <span class="creation_date">01/01/2022 </span><br />
                                                        <b>Invoice ID:</b> <span class="invoice_number">CC-0000 </span><br />
                                                        <b>Payment Method:</b> Online<br />
                                                        <b>Paid Date:</b> <span class="paid_date">2022-01-01 </span><br />
                                                        <b>Transaction ID:</b> <span class="transaction_id">2022-01-01 </span><br />

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 col-md-12">
                                <div class="card border-0">
                                    <div class="card-body table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <td><b>Service</b></td>
                                                    <td><b>Mode</b></td>
                                                    <td class="text-right"><b>Quantity</b></td>
                                                    <td class="text-right"><b>Unit Price</b></td>
                                                    <td class="text-right"><b>Total</b></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <span class=package_name></span> <br />
                                                        &nbsp;<small> - Due Date: <span class="due_date"></span></small>
                                                    </td>
                                                    <td>One time payment</td>
                                                    <td class="text-right">1</td>
                                                    <td class="text-right package_amount">$0.00</td>
                                                    <td class="text-right package_amount">$0.00</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-right" colspan="4"><b>Sub-Total</b></td>
                                                    <td class="text-right package_amount">$0.00</td>
                                                </tr>
                                                
                                                
                                                <tr>
                                                    <td class="text-right" colspan="4"><b>Total</b></td>
                                                    <td class="text-right package_amount">$0.00</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div id="payment-setup">
                                <div class="col-12 col-md-12">
                                    <h3 class="float-center">Paynow</h3>
                                </div>
                                <div class="col-12 col-md-12">
                                    <div class="card redial-border-light redial-shadow">
                                        <div class="card-body table-responsive">
                                            <form id="order-place">
                                            @csrf
                                            <input type="hidden" name="order_id" id="order_id">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <td><b>Card Number</b></td>
                                                    
                                                        <td><b>Expiration Month</b></td>
                                                    
                                                        <td><b>Expiration Year</b></td>
                                                        <td><b>CVV Code</b></td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>
                                                            <input autocomplete='off' class='form-control card-number valid' size='20' type='text' name="card_number" id="card_number" min="16" max="16" placeholder="1234 5678 9012 3456" maxlength="16" data-creditcard="true" required>
                                                        </td>
                                                    
                                                        <td>
                                                            <select class='form-control card-expiry-month' name="ex_month" id="ex_month" required>
                                                                <option value="01">January</option>
                                                                <option value="02">February </option>
                                                                <option value="03">March</option>
                                                                <option value="04">April</option>
                                                                <option value="05">May</option>
                                                                <option value="06">June</option>
                                                                <option value="07">July</option>
                                                                <option value="08">August</option>
                                                                <option value="09">September</option>
                                                                <option value="10">October</option>
                                                                <option value="11">November</option>
                                                                <option value="12">December</option>
                                                            </select>
                                                        </td>
                                                    
                                                        <td>
                                                            <select class='form-control valid' name="ex_year" id="ex_year" required>
                                                                @php $year = date('Y'); $limit = 10 + $year; @endphp
                                                                @for($i = $year;$i < $limit; $i++)
                                                                    <option value="{{$i}}">{{$i}}</option>
                                                                @endfor
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input class='form-control valid' type='text' maxlength="4" name="card_code" id="card_code" required>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <a href="javascript:void(0)" id="form_submit" class="bg-primary float-center mr-3 py-1 px-2 rounded text-white back-to-invoice"> Pay Now </a>  
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-header border-bottom p-1 d-flex">
                        <a href="#" class="d-inline-block d-lg-none flip-menu-toggle"><i class="icon-menu"></i></a>
                        <input type="text" class="form-control border-0 p-2 w-100 h-100 invoice-search" placeholder="Search ..." />
                    </div>

                    <div class="card-body p-0">
                        <div class="invoices list">
                            @if($all_orders)
                            @foreach($all_orders as $order)
                            @php 

                            if($order->payment_status == 0){
                                $status = "pending";
                            }elseif($order->payment_status == 1){
                                 $status = "paid";
                            }else{
                                 $status = "canceled";
                            }
                            
                            @endphp
                            <div class="invoice {{$status}}-invoice" data-status="{{$status}}-invoice">
                                <div class="invoice-content">
                                    <div class="invoice-info" data-order_id="{{$order->id}}" data-user_name="{{$order->user->name}}" data-package_name="{{$order->package->name}}" data-package_amount="{{$order->amount}}" data-paid_status="{{$status}}" data-invoice_date="{{date('d-M-Y' , strtotime($order->created_at))}}" data-due_date="{{date('d-M-Y' , strtotime($order->due_date))}}" data-paid_date="{{ ($order->paid_date != null)?date('d-M-Y' , strtotime($order->paid_date)):'Not Paid'}}"  data-invoice_num="CC-{{Helper::invoice_num($order->id)}}" data-transaction_id="{{($order->transaction_id != null)?$order->transaction_id:'Not Paid'}}">
                                        <p class="mb-0 small">Invoice Number:</p>
                                        <p class="invoice-no">CC-{{Helper::invoice_num($order->id)}}</p>
                                    </div>

                                    <div class="invoice-info_">
                                        <p class="mb-0 small">Service:</p>
                                        <p class="cliname package_name">{{$order->package->name}}</p>
                                    </div>

                                    <div class="invoice-info_">
                                        <p class="mb-0 small">Amount:</p>
                                        <p class="cliname package_amount">{{$order->amount}}</p>
                                    </div>

                                    <div class="invoice-info_">
                                        <p class="mb-0 small">Client:</p>
                                        <p class="cliname client_name">{{$order->user->name}}</p>
                                    </div>

                                    <div class="invoice-info_">
                                        <p class="mb-0 small">Invoice Date:</p>
                                        <p class="invocie-date invoice_date">{{date("d-M-Y" , strtotime($order->created_at))}}</p>
                                    </div>

                                    <div class="invoice-info_">
                                        <p class="mb-0 small">Due Date:</p>
                                        <p class="invocie-date due_date">{{date("d-M-Y" , strtotime($order->due_date))}}</p>
                                    </div>

                                    <div class="invoice-status-info">
                                        <p class="mb-0 small">Status</p>
                                        <p class="invoice-status"></p>
                                    </div>

                                    <div class="line-h-1 h5">
                                        
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Card DATA-->
    </div>
</main>

@endsection @section('css')

<link rel="stylesheet" href="{{asset('vendors/datatable/css/dataTables.bootstrap4.min.css')}}" />
<link rel="stylesheet" href="{{asset('vendors/datatable/buttons/css/buttons.bootstrap4.min.css')}}" />

@endsection @section('js')

<script src="{{asset('vendors/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('vendors/datatable/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="https://cdn.ckeditor.com/4.17.1/standard/ckeditor.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="{{asset('js/datatable.script.js')}}"></script>

<script>
    $("#form_submit").click(function () {
      var order_id = $("#order_id").val();
      var card_number = $("#card_number").val();
      var ex_month = $("#ex_month").val();
      var ex_year = $("#ex_year").val();
      var card_code = $("#card_code").val();

      $.ajax({
        type: 'post',
        dataType : 'json',
        url: "{{route('payout')}}",  
        data: {order_id:order_id ,card_number:card_number,ex_month:ex_month,ex_year:ex_year,card_code:card_code , _token: '{{csrf_token()}}'},
        success: function (response) {
            if (response.stat == 0) {
                toastr.error(response.message);
            }else{
                  toastr.success(response.message);
            }
        }
      });


        $.ajax({
            beforeSend: function() { 
                $("#myDiv").addClass("show")
                $("#loading-image").show();

            },
            type: 'post',
            dataType : 'json',
            url: "{{route('payout')}}",  
            data: {order_id:order_id ,card_number:card_number,ex_month:ex_month,ex_year:ex_year,card_code:card_code , _token: '{{csrf_token()}}'},
            success: function(response){  
                if (response.stat == 0) {
                    $("#loading-image").hide();
                    $("#myDiv").removeClass("show")
                    toastr.error(response.message);
                }else{
                    $("#loading-image").hide();
                    $("#myDiv").removeClass("show")
                    toastr.success(response.message);
                }
            
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                $("#loading-image").hide();
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
            }       
        });


    });
</script>

<script>
    $(".invoice-menu a").on("click", function () {
        $(".invoice-menu a").removeClass("active");

        $(this).addClass("active");

        $(".invoice").hide();

        $("." + $(this).data("invoicetype")).show(500);

        return false;
    });

    $(".invoice-info").on("click", function () {
        //$(".inv-no").html($(this).closest(".invoice").find(".invoice-no").html());

        

        // user_name = user_name.toLowerCase().replace(/\b[a-z]/g, function (letter) {
        //     return letter.toUpperCase();
        // });
        if($(this).data("paid_status") == "paid"){
            $("#payment-setup").hide();
        }else{
            $("#payment-setup").show();
        }
        
        var user_name = $(this).data("user_name");

        $("#order_id").val($(this).data("order_id"));
        $(".inv-no").text($(this).data("invoice_num"));
        $(".invoice_number").text($(this).data("invoice_num"));
        $(".creation_date").text($(this).data("invoice_date"));
        $(".package_name").text($(this).data("package_name"));
        $(".due_date").text($(this).data("due_date"));
        $(".paid_date").text($(this).data("paid_date"));
        $(".transaction_id").text($(this).data("transaction_id"));

        //$("#userName").text(user_name);
        $(".package_amount").text("$"+$(this).data("package_amount"));
        $("#form_submit").text("Pay $"+$(this).data("package_amount"));
        

        $(".view-invoice").fadeIn(1000);
    });

    $(".back-to-invoice").on("click", function () {
        $(".view-invoice").fadeOut();
    });

    $(".invoice-search").on("keyup", function () {
        var v = $(".invoice-search").val().toLowerCase();

        var rows = $("." + $(".invoice-menu li a.active").data("invoicetype"));

        for (var i = 0; i < rows.length; i++) {
            var fullname = rows[i].getElementsByClassName("invoice-content");
            fullname = fullname[0].innerHTML.toLowerCase();
            if (fullname) {
                if (v.length == 0 || (v.length < 1 && fullname.indexOf(v) == 0) || (v.length >= 1 && fullname.indexOf(v) > -1)) {
                    rows[i].style.animation = "fadein 7s";
                    rows[i].style.display = "block";
                } else {
                    rows[i].style.display = "none";
                    rows[i].style.animation = "fadeout 7s";
                }
            }
        }
    });
</script>

@endsection
