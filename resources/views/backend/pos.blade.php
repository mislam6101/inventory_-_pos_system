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
        }
    </style>
</head>

<body>

    <div class="container-fluid p-3">
        <div class="row">

            <!-- CART -->
            <div class="col-md-5">
                <!-- TOP HEADER -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <a href="{{url('')}}" class="logo">
                        <img src="{{url('assets/images/logo-dark.png')}}" alt="Logo" height="40">
                    </a>
                    <div class="d-flex align-items-center gap-3">
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
                        <a href="{{ url('dashboard') }}" class="btn btn-sm btn-outline-primary">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </div>
                </div><br>

                <!-- CART CARD WITH FORM -->
                <form action="{{ route('pos.store') }}" method="POST" id="cartForm">
                    @csrf
                    <div class="card shadow-sm mb-3" style="background:#fff;">
                        <div class="card-header fw-bold" style="background:#f1f3f5;">Customer's Details</div>
                        <div style="margin: 10px 15px 10px;">
                            <input type="text" name="c_name" placeholder="Name">
                            <input style="margin: 0 10px;" type="text" name="cont" placeholder="Contact">
                        </div>
                    </div>
                    <div class="card shadow-sm mb-3" style="background:#fff;">
                        <div class="card-header fw-bold" style="background:#f1f3f5;">Cart</div>
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
                                    <td colspan="5" class="text-center text-muted">No Data Available</td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="card-footer d-flex justify-content-between align-items-center" style="background:#f1f3f5;">
                            <div class="fw-bold">Total: <span id="total">0</span> ৳</div>
                            <input type="hidden" name="total" id="formTotal" value="0">
                            <button type="submit" class="btn btn-success" id="payBtn">Pay Now</button>
                        </div>
                    </div>
                </form>
            </div>

            <!-- PRODUCTS -->
            <div class="col-md-7">
                <div class="row mb-3">
                    <div class="col-md-8">
                        <input type="text" id="searchProduct" class="form-control rounded-3" placeholder="Search product...">
                    </div>
                    <div class="col-md-4">
                        <input type="text" id="barcode" class="form-control rounded-3" placeholder="Scan barcode">
                    </div>
                </div>

                <!-- CATEGORY -->
                <div class="mb-3">
                    <select name="category_id" class="form-select rounded-3" id="category">
                        <option value="">All Categories</option>
                        @foreach($cats as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- PRODUCTS GRID -->
                <div class="row g-3" id="products">
                    @foreach($prods as $prod)
                    <div class="col-md-3 product" data-category="{{ $prod->category_id }}" data-barcode="{{ $prod->sku }}">
                        <div class="card product-card add-product shadow-sm"
                            data-id="{{ $prod->id }}"
                            data-name="{{ $prod->name }}"
                            data-price="{{ $prod->price }}"
                            style="background:#fff;">
                            <div class="product-img-wrap">
                                @if($prod->image)
                                <img src="{{ asset('storage/products/'.$prod->image) }}" class="card-img-top" style="height:150px;" alt="{{ $prod->name }}">
                                @endif
                                <span class="stock-badge">
                                    Stock: <span class="stock-count" data-id="{{ $prod->id }}">{{ $prod->quantity }}</span>
                                </span>
                            </div>
                            <div class="card-body text-center">
                                <h6>{{ $prod->name }}</h6>
                                <span class="badge bg-primary">{{ $prod->price }}৳</span>
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
            let cat = $(this).val();
            if (!cat) $('.product').show();
            else $('.product').hide().filter(`[data-category="${cat}"]`).show();
        });

        // ADD TO CART + AJAX STOCK DECREASE
        $(document).on('click', '.add-product', function() {
            let card = $(this);
            let productBox = card.closest('.product');
            let stockSpan = productBox.find('.stock-count');
            let stock = parseInt(stockSpan.text());
            let productId = card.data('id');
            let name = card.data('name');
            let price = parseFloat(card.data('price'));

            if (stock <= 0) {
                alert('Out of stock!');
                return;
            }

            // AJAX decrease stock
            $.post('/product/decrease-stock', {
                _token: '{{ csrf_token() }}',
                id: productId
            }, function(res) {
                stockSpan.text(res.quantity);
                if (res.quantity == 0) {
                    card.addClass('disabled');
                    productBox.find('.stock-badge').addClass('out-stock');
                }
            });

            // Add to cart UI
            let row = $('#cart').find(`tr[data-name="${name}"]`);
            if (row.length) {
                let qty = parseInt(row.find('.qty').val()) + 1;
                row.find('.qty').val(qty);
                row.find('.sub').text(qty * price);
            } else {
                $('#empty').remove();
                $('#cart').append(`
            <tr data-name="${name}">
                <td>${name}</td>
                <td><input type="number" class="form-control form-control-sm qty" value="1" min="1"></td>
                <td>${price}</td>
                <td class="sub">${price}</td>
                <td class="text-center"><i class="bi bi-x-circle-fill text-danger remove-item"></i></td>
            </tr>
        `);
            }
            calculateTotal();
        });

        // REMOVE ITEM + AJAX STOCK INCREASE
        $(document).on('click', '.remove-item', function() {
            let row = $(this).closest('tr');
            let name = row.data('name');
            let qty = parseInt(row.find('.qty').val());

            let productBox = $('.add-product[data-name="' + name + '"]').closest('.product');
            let stockSpan = productBox.find('.stock-count');
            let productId = productBox.find('.add-product').data('id');

            $.post('/product/increase-stock', {
                _token: '{{ csrf_token() }}',
                id: productId,
                qty: qty
            }, function(res) {
                stockSpan.text(res.quantity);
                productBox.find('.add-product').removeClass('disabled');
                productBox.find('.stock-badge').removeClass('out-stock');
            });

            row.remove();
            calculateTotal();
            if ($('#cart tr').length === 0) {
                $('#cart').html(`<tr id="empty"><td colspan="5" class="text-center text-muted">No Data Available</td></tr>`);
            }
        });

        // QTY CHANGE
        $(document).on('input', '.qty', function() {
            let row = $(this).closest('tr');
            let price = parseFloat(row.find('td:eq(2)').text());
            let qty = parseInt($(this).val());
            row.find('.sub').text(price * qty);
            calculateTotal();
        });

        // TOTAL
        function calculateTotal() {
            total = 0;
            $('.sub').each(function() {
                total += parseFloat($(this).text());
            });
            $('#total').text(total);
        }

        // PAY NOW FORM SUBMIT -> hidden inputs generate
        // PAY NOW FORM SUBMIT -> hidden inputs generate
        $('#cartForm').on('submit', function(e) {

            let rows = $('#cart tr').not('#empty');

            if (rows.length === 0) {
                alert('Cart is empty!');
                e.preventDefault();
                return;
            }

            // Remove old hidden inputs
            $('#cartForm input[name^="cart"]').remove();

            // 🔹 common data 
            let commonId = 'POS-' + Date.now();
            let c_name = $('input[name="c_name"]').val();
            let cont = $('input[name="cont"]').val();

            // common hidden inputs
            $('#cartForm').append(`
        <input type="hidden" name="cart[common_id]" value="${commonId}">
        <input type="hidden" name="cart[c_name]" value="${c_name}">
        <input type="hidden" name="cart[cont]" value="${cont}">
    `);

            // 🔹 items array 
            rows.each(function(index) {
                let row = $(this);
                let name = row.find('td:eq(0)').text();
                let qty = row.find('.qty').val();
                let price = row.find('td:eq(2)').text();
                let subtotal = row.find('.sub').text();

                $('#cartForm').append(`
            <input type="hidden" name="cart[items][${index}][name]" value="${name}">
            <input type="hidden" name="cart[items][${index}][qty]" value="${qty}">
            <input type="hidden" name="cart[items][${index}][price]" value="${price}">
            <input type="hidden" name="cart[items][${index}][subtotal]" value="${subtotal}">
        `);
            });

            // total
            $('#formTotal').val($('#total').text());
        });
        $('#cartForm').on('submit', function(e) {
            e.preventDefault(); // normal submit prevent

            let form = $(this);
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: form.serialize(),
                success: function(res) {
                    // 🔹 res = invoice URL
                    window.open(res.invoice_url, '_blank'); // new tab
                    alert('Payment Successful!');
                    window.location.reload(); // page refresh
                }
            });
        });
    </script>
</body>

</html>