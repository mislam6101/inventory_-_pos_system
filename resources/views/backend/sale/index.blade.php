@extends('backend.app')

@section('head')

<head>
    <meta charset="utf-8" />
    <title>Datatables | Velonic - Bootstrap 5 Admin & Dashboard Template</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully responsive admin theme which can be used to build CRM, CMS,ERP etc." name="description" />
    <meta content="Techzaa" name="author" />

    <!-- App favicon -->
    <link rel="shortcut icon" href="{{url('')}}/assets/images/favicon.ico">

    <!-- Datatables css -->
    <link href="{{url('')}}/assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('')}}/assets/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet"
        type="text/css" />
    <link href="{{url('')}}/assets/vendor/datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css" rel="stylesheet"
        type="text/css" />
    <link href="{{url('')}}/assets/vendor/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css" rel="stylesheet"
        type="text/css" />
    <link href="{{url('')}}/assets/vendor/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet"
        type="text/css" />
    <link href="{{url('')}}/assets/vendor/datatables.net-select-bs5/css/select.bootstrap5.min.css" rel="stylesheet"
        type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>




    <!-- Theme Config Js -->
    <script src="{{url('')}}/assets/js/config.js"></script>

    <!-- App css -->
    <link href="{{url('')}}/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- Icons css -->
    <link href="{{url('')}}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
</head>
@endsection

@section('content')
<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Velonic</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                <li class="breadcrumb-item active">Data Tables</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Sale List</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">

                    <div class="card">
                        <div class="card-body">
                            @if(session('success'))
                            <div class="alert alert-success">
                                {{session('success')}}
                            </div>
                            @endif
                            <br>
                            <table id="selection-datatable"
                                class="table table-striped dt-responsive nowrap w-100">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Invoice ID</th>
                                        <th>Customer</th>
                                        <th>Product</th>
                                        <th>Qty</th>
                                        <th>Price</th>
                                        <th>Subtotal</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach($sales as $sale)
                                    @foreach($sale->items as $item)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $sale->common_id }}</td>
                                        <td>{{ $sale->c_name }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>{{ $item->price }} ৳</td>
                                        <td>{{ $item->subtotal }} ৳</td>
                                        <td>{{ $sale->created_at->format('d-M-Y H:i') }}</td>
                                        <td>Return</td>
                                    </tr>
                                    @endforeach
                                    @endforeach
                                </tbody>
                            </table>

                        </div> <!-- end card body-->
                    </div> <!-- end card -->
                </div><!-- end col-->
            </div>
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 text-center">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> © Velonic - by <b>Md. Mahmudul Islam</b>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

    </div>

</div>
@endsection

@section('scripts')
<script>
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "This category will be permanently deleted!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
<script src="{{url('')}}/assets/js/vendor.min.js"></script>

<!-- Datatables js -->
<script src="{{url('')}}/assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="{{url('')}}/assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
<script src="{{url('')}}/assets/vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{url('')}}/assets/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
<script src="{{url('')}}/assets/vendor/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.min.js"></script>
<script src="{{url('')}}/assets/vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
<script src="{{url('')}}/assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{url('')}}/assets/vendor/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
<script src="{{url('')}}/assets/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="{{url('')}}/assets/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
<script src="{{url('')}}/assets/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="{{url('')}}/assets/vendor/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
<!-- <script src="{{url('')}}/assets/vendor/datatables.net-select/js/dataTables.select.min.js"></script> -->

<!-- Datatable Demo Aapp js -->
<script src="{{url('')}}/assets/js/pages/datatable.init.js"></script>

<!-- App js -->
<script src="{{url('')}}/assets/js/app.min.js"></script>
@endsection