<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>POS with Category Dropdown</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <style>
        body {
            background-color: #dbf3fc;
        }

        .product-card {
            cursor: pointer;
            transition: all .2s ease-in-out;
        }

        .product-card:hover {
            transform: scale(1.03);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        }

        .product-img-wrap {
            position: relative;
        }

        .stock-badge {
            position: absolute;
            top: 8px;
            right: 8px;
            background: #0d6efd;
            color: #fff;
            padding: 3px 8px;
            font-size: 12px;
            border-radius: 12px;
        }

        .out-stock {
            background: #dc3545;
        }

        .disabled {
            pointer-events: none;
            opacity: .6;
        }

        .remove-item {
            cursor: pointer;
            font-size: 16px;
            transition: color .2s;
        }

        .remove-item:hover {
            color: #dc3545;
        }

        .card-body h6 {
            font-size: 14px;
            font-weight: 600;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            /* single line */
        }
    </style>
</head>

<body>

    <div class="container-fluid p-3">
        <div class="row">
            <!-- CART -->
            <div class="col-md-5">
                <!-- TOP HEADER WITH LOGO + USER -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <a href="{{url('')}}" class="logo">
                        <img src="{{url('assets/images/logo-dark.png')}}" alt="Logo" height="40">
                    </a>
                </div>

                <!-- CART CARD -->

            </div>

            <!-- Online -->
            <div class="col-md-7">
                <div class="row mb-3">
                    <div class="col-md-6">
                    </div>
                    <div class="col-md-2">
                        <a href="{{ url('dashboard') }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex align-items-center gap-2">
                            <span class="avatar fs-3">👤</span>
                            <div>
                                <div class="fw-bold text-primary">{{ Auth::user()->name }}</div>
                                <small class="text-secondary d-flex align-items-center gap-2">
                                    <span style="width:10px;height:10px;background:#28a745;border-radius:50%;display:inline-block;"></span>
                                    Online
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br>
        <div>
            <div class="container">
                <div class="card-header fw-bold text-center" style="background:#f1f3f5;">Products</div>
                <table class="table mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Product</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Sub</th>
                            <th>Cancel</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sales as $sale)
                        <tr>
                            <td>{{$sale->name}}</td>
                            <td>{{$sale->qty}}</td>
                            <td>{{$sale->price}} BDT</td>
                            <td>{{$sale->subtotal}} BDT</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="card-footer d-flex justify-content-between align-items-center" style="background:#f1f3f5;">
                    <div class="fw-bold" style="text-align: right;">Total: <span id="total">0</span> ৳</div>
                </div>
            </div>
        </div>

    </div>



</body>

</html>