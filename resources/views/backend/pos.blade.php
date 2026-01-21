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
            background-color: #0a91c2;
        }

        .product-card {
            cursor: pointer;
            transition: all 0.2s ease-in-out;
            height: 220px;
            /* fixed height for all cards */
            display: flex;
            flex-direction: column;
        }

        .card-body {
            flex: 1;
            /* fill remaining space */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            text-align: center;
        }

        .card-body h6 {
            font-size: 14px;
            font-weight: 600;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            /* single line */
        }


        .product-card:hover {
            transform: translateY(-5px) scale(1.03);
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
            opacity: 0.6;
        }

        .remove-item {
            cursor: pointer;
            font-size: 16px;
            transition: color 0.2s;
        }

        .remove-item:hover {
            color: #dc3545;
        }

        .remove-item:hover {
            color: #dc3545;
        }
    </style>
</head>

<body style="background-color: #dbf3fc;">

    <div class="container-fluid p-3">
        <div class="row">

            <!-- CART -->
            <div class="col-md-5">
                <!-- TOP HEADER WITH LOGO -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <!-- Company Logo at top-left -->
                    <a href="{{url('')}}/index.html" class="logo logo-dark">
                        <span class="logo-lg">
                            <img src="{{url('')}}/assets/images/logo-dark.png" alt="dark logo">
                        </span>
                        <span class="logo-sm">
                            <img src="{{url('')}}/assets/images/logo-sm.png" alt="small logo">
                        </span>
                    </a>

                    <!-- User info & Dashboard button -->
                    <div class="d-flex align-items-center gap-3">
                        <div class="d-flex align-items-center gap-2">
                            <span class="avatar fs-3">👤</span>
                            <div>
                                <div class="fw-bold text-primary">
                                    Md. Mahmudul Islam
                                </div>
                                <small class="text-secondary d-flex align-items-center gap-2">
                                    <span
                                        style="display:inline-block; width:10px; height:10px; background-color:#28a745; border-radius:50%;"></span>
                                    Online
                                </small>
                            </div>
                        </div>

                        <!-- Dashboard Button -->
                        <a href="@if(Auth::guard('web')->check())
                                    {{ url('dashboard') }}
                                @elseif (Auth::guard('manager')->check())
                                    {{ url('manager/dashboard') }}
                                @elseif (Auth::guard('executive')->check())
                                    {{ url('executive/dashboard') }}
                                @endif" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </div>
                </div>


                <div class="card shadow-sm mb-3" style="background-color: #ffffff;">
                    <div class="card-header fw-bold" style="background-color: #f1f3f5;">Cart</div>
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
                        <tbody id="cart">
                            <tr id="empty">
                                <td colspan="5" class="text-center text-muted">
                                    No Data Available
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="card-footer d-flex justify-content-between align-items-center"
                        style="background-color: #f1f3f5;">
                        <div class="fw-bold">
                            Total: <span id="total">0</span> ৳
                        </div>
                        <button class="btn btn-success" id="payBtn">
                            Pay Now
                        </button>
                    </div>
                </div>
            </div>

            <!-- PRODUCTS -->
            <div class="col-md-7">
                <div class="row mb-3">
                    <div class="col-md-8">
                        <input type="text" id="searchProduct" class="form-control rounded-3"
                            placeholder="Search product by name...">
                    </div>
                    <div class="col-md-4">
                        <input type="text" id="barcode" class="form-control rounded-3"
                            placeholder="Scan / Enter barcode">
                    </div>
                </div>

                <!-- CATEGORY DROPDOWN -->
                <div class="mb-3">
                    <select name="category_id" class="form-select rounded-3" id="category">
                        <option value="">All Categories</option>
                        @foreach($cats as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="row g-3" id="products">

                    <!-- Fruits -->
                    @foreach($prods as $key => $prod)
                    <div class="col-md-3 product" data-category="{{$prod->category_id}}" data-barcode="{{$prod->sku}}" data-stock="{{$prod->quantity}}">
                        <div class="card product-card add-product shadow-sm" data-name="{{ $prod->name }}" data-price="{{$prod->price}}"
                            style="background-color: #ffffff;">
                            <div class="product-img-wrap">
                                @if($prod->image)
                                <img class="card-img-top rounded-3" src="{{ asset('storage/products/'.$prod->image) }}" alt="{{ $prod->name }}">
                                @else
                                <span>No Image</span>
                                @endif
                                <span class="stock-badge">
                                    Stock: {{$prod->quantity}}
                                </span>
                            </div>
                            <div class="card-body text-center">
                                <h6>{{$prod->name}}</h6>
                                <span class="badge bg-primary">{{$prod->price}}৳</span>
                            </div>
                        </div>
                    </div>
                    @endforeach



                </div>
            </div>
        </div>
    </div>



    <script>
        let total = 0;

        // CATEGORY FILTER
        $('#category').change(function() {
            let cat = $(this).val(); // selected value = category_id or empty

            if (!cat) { // empty value = All Categories
                $('.product').show(); // show all products
            } else {
                $('.product').hide();
                $('.product[data-category="' + cat + '"]').show();
            }
        });


        // ADD TO CART
        $(document).on('click', '.add-product', function() {
            $('#empty').remove();

            let name = $(this).data('name');
            let price = parseFloat($(this).data('price'));

            let row = $('#cart').find(`tr[data-name="${name}"]`);

            if (row.length) {
                let qty = row.find('.qty').val();
                qty++;
                row.find('.qty').val(qty);
                row.find('.sub').text(qty * price);
            } else {
                $('#cart').append(`
                <tr data-name="${name}">
                    <td>${name}</td>
                    <td>
                        <input type="number" class="form-control form-control-sm qty" value="1" min="1">
                    </td>
                    <td>${price}</td>
                    <td class="sub">${price}</td>
                    <td class="text-center">
                <i class="bi bi-x-circle-fill text-danger remove-item"
                title="Remove"></i>
            </td>
                </tr>
            `);

            }
            calculateTotal();
        });

        $(document).on('input', '.qty', function() {
            let row = $(this).closest('tr');
            let price = parseFloat(row.find('td:eq(2)').text());
            let qty = $(this).val();
            row.find('.sub').text(price * qty);
            calculateTotal();
        });

        function calculateTotal() {
            total = 0;
            $('.sub').each(function() {
                total += parseFloat($(this).text());
            });
            $('#total').text(total);
        }
        $('#payBtn').click(function() {

            if ($('#cart tr').length === 0 || $('#empty').length) {
                alert('Cart is empty!');
                return;
            }

            let total = $('#total').text();

            if (confirm('Confirm payment of ' + total + '৳ ?')) {
                alert('Payment Successful 🎉');

                // Reset cart
                $('#cart').html(`
                <tr id="empty">
                    <td colspan="4" class="text-center text-muted">
                        No Data Available
                    </td>
                </tr>
            `);
                $('#total').text(0);
            }
        });
        $('#searchProduct').on('keyup', function() {
            let value = $(this).val().toLowerCase();

            $('.product').filter(function() {
                $(this).toggle(
                    $(this).text().toLowerCase().indexOf(value) > -1
                );
            });
        });
        $('#barcode').on('keypress', function(e) {
            if (e.which === 13) { // Enter key
                let code = $(this).val();
                let product = $('.product[data-barcode="' + code + '"]');

                if (product.length) {
                    product.find('.add-product').click();
                    $(this).val('');
                } else {
                    alert('Product not found!');
                }
            }
        });

        $(document).on('click', '.remove-item', function() {

            let row = $(this).closest('tr');
            let name = row.data('name');
            let qty = parseInt(row.find('.qty').val());

            // find product box
            let product = $('.add-product[data-name="' + name + '"]').closest('.product');
            row.remove();
            calculateTotal();

            if ($('#cart tr').length === 0) {
                $('#cart').html(`
            <tr id="empty">
                <td colspan="5" class="text-center text-muted">
                    No Data Available
                </td>
            </tr>
        `);
            }
        });
    </script>

</body>

</html>