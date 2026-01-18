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
                        <h4 class="page-title">Create New Purchase</h4>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="header-title">Add Purchase</h4>

                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form method="POST" action="{{route('purchase.store')}}" enctype="multipart/form-data">
                                        @csrf

                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Ref. No. <span style="color: red;">*</span></label>
                                            <input type="text" id="simpleinput" class="form-control" name="ref">
                                        </div>

                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Product Name <span style="color: red;">*</span></label>
                                            <input type="text" id="simpleinput" class="form-control" name="prod_name">
                                        </div>

                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Product Category <span style="color: red;">*</span></label>
                                            <select name="category_id" class="form-control" required>
                                                <option value="">-- Select Category --</option>
                                                @foreach($cats as $cat)
                                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Supplier <span style="color: red;">*</span></label>
                                            <select name="supplier_id" class="form-control" required>
                                                <option value="">-- Select Supplier --</option>
                                                @foreach($supp as $sup)
                                                <option value="{{ $sup->id }}">{{ $sup->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Price Per Product <span style="color: red;">*</span></label>
                                            <input type="number" id="price" class="form-control" name="prod_price">
                                        </div>
                                        <div class="mb-3">
                                            <label for="simpleinput" class="form-label">Quantity <span style="color: red;">*</span></label>
                                            <input type="text" id="quantity" class="form-control" name="prod_quantity">
                                        </div>


                                </div> <!-- end col -->
                                <div class="col-lg-6">
                                    <div class="mb-3">
                                        <label for="simpleinput" class="form-label">SKU <span style="color: red;">*</span></label>
                                        <input type="text" id="simpleinput" class="form-control" name="prod_sku">
                                    </div>
                                    @php
                                    $createdBy = '';
                                    if (Auth::guard('web')->check()) {
                                    $createdBy = Auth::guard('web')->user()->name . ' (Admin)';
                                    } elseif (Auth::guard('manager')->check()) {
                                    $createdBy = Auth::guard('manager')->user()->name . ' (Manager)';
                                    }
                                    @endphp
                                    <div class="mb-3">
                                        <label for="simpleinput" class="form-label">Created By <span style="color: red;">*</span></label>
                                        <input type="text" value="{{ $createdBy }}" id="simpleinput" class="form-control" name="created_by" readonly>
                                    </div>
                                    <div class="mb-3">
                                        <label for="simpleinput" class="form-label">Discount Price</label>
                                        <input type="text" id="discount" class="form-control" name="prod_dis_price">
                                    </div>

                                    <div class="mb-3">
                                        <label for="simpleinput" class="form-label">Shipping Cost</label>
                                        <input type="number" id="shipping" class="form-control" name="shipping_cost">
                                    </div>

                                    <div class="mb-3">
                                        <label for="simpleinput" class="form-label">Grand Total <span style="color: red;">*</span></label>
                                        <input type="number" id="grand_total" class="form-control" name="grand_total" readonly>
                                    </div>
                                </div>
                                <button class="btn btn-success">CREATE</button>
                                </form>
                            </div>
                            <!-- end row-->
                        </div> <!-- end card-body -->
                    </div> <!-- end card -->
                </div><!-- end col -->
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
<script src="{{url('')}}/assets/vendor/datatables.net-select/js/dataTables.select.min.js"></script>

<!-- Datatable Demo Aapp js -->
<script src="{{url('')}}/assets/js/pages/datatable.init.js"></script>

<!-- App js -->
<script src="{{url('')}}/assets/js/app.min.js"></script>
<script>
    function calculateTotal() {
        let price = parseFloat(document.getElementById('price').value) || 0;
        let quantity = parseFloat(document.getElementById('quantity').value) || 0;
        let discount = parseFloat(document.getElementById('discount').value) || 0;
        let shipping = parseFloat(document.getElementById('shipping').value) || 0;

        let total = (price * quantity) - discount + shipping;

        document.getElementById('grand_total').value = total.toFixed(2);
    }

    document.querySelectorAll('#price, #quantity, #discount, #shipping')
        .forEach(input => {
            input.addEventListener('input', calculateTotal);
        });
</script>

@endsection