<!DOCTYPE html>
<html>

<head>
    <title>Invoice</title>
    <style>
        body {
            font-family: 'Helvetica', sans-serif;
            margin: 0;
            padding: 0;
            background: #f0f0f0;
        }

        .invoice-container {
            width: 700px;
            margin: 30px auto;
            background: #fff;
            padding: 20px 30px;
            border-radius: 6px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 2px solid #0d6efd;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .invoice-header h1 {
            color: #0d6efd;
            font-size: 24px;
            margin: 0;
        }

        .invoice-header .date {
            font-size: 14px;
            color: #555;
        }

        .customer-details {
            margin-bottom: 20px;
        }

        .customer-details p {
            margin: 3px 0;
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table thead {
            background: #0d6efd;
            color: #fff;
        }

        table th,
        table td {
            padding: 8px 10px;
            border: 1px solid #ddd;
            text-align: center;
            font-size: 14px;
        }

        table tbody tr:nth-child(even) {
            background: #f9f9f9;
        }

        .total {
            text-align: right;
            font-weight: bold;
            font-size: 16px;
        }

        .invoice-footer {
            text-align: center;
            font-size: 12px;
            color: #777;
            border-top: 1px solid #ddd;
            padding-top: 10px;
        }
    </style>
</head>

<body>
    @php
    $salesList = isset($sales) ? $sales : [$sale];
    @endphp

    @foreach($sales as $sale)
    <div class="invoice-container">
        <div class="invoice-header">
            <h1>Invoice #{{ $sale->common_id }}</h1>
            <div class="date">Date: {{ $sale->created_at->format('d-M-Y H:i') }}</div>
        </div>

        <div class="customer-details">
            <p><strong>Customer Name:</strong> {{ $sale->c_name }}</p>
            <p><strong>Contact:</strong> {{ $sale->cont }}</p>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach($sale->items as $item)
                @php $total += $item->subtotal; @endphp
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->qty }}</td>
                    <td>{{ number_format($item->price, 2) }} ৳</td>
                    <td>{{ number_format($item->subtotal, 2) }} ৳</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="total">
            Total Amount: {{ number_format($total, 2) }} ৳
        </div>

        <div class="invoice-footer">
            Thank you for your purchase!
        </div>
        <a href="{{ route('invoice.download', $sale->common_id) }}" class="btn btn-success mb-3">
            <i class="bi bi-download"></i> Download PDF
        </a>
    </div>

    @endforeach




</body>

</html>