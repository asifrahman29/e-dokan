@extends('layouts.admin', ['title' => 'Dashboard | Products Details'])
@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Invoice Details</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('products.index') }}">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('suppliers.index') }}">Suppliers</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('ImportsupplyInvoiceCreate') }}">Import Product</a>
                </li>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('supplyInvoice.index') }}">Invoice List</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-6">
                            <h3>Invoice #{{ $invoice->invoice_number }}</h3>
                        </div>
                        <div class="col-md-6">
                            <p class="text-end"><strong>Supplier:</strong> {{ $invoice->supplier->name }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Company Name:</strong> {{ $invoice->supplier->company_name ?? 'N/A' }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-end"><strong>Invoice Date:</strong> {{ $invoice->invoice_date }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Total Amount:</strong> {{ $invoice->total_amount }}</p>
                        </div>
                        <div class="col-md-6">
                            <p class="text-end"><strong>Status:</strong> <i class="p-2 pe-3 rounded bg-{{$invoice->status == 'composed'?'danger':'success'}}">{{ ucfirst($invoice->status) }}</i></p>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <h5 class="card-title">Invoice Items</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Slug</th>
                                <th>Quantity</th>
                                <th>Cost Price</th>
                                <th>Total Price</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoice->items as $key => $item)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $item->product->name }}</td>
                                    <td>{{ $item->product->slug }}</td>
                                    <td class="text-end">{{ $item->quantity }}</td>
                                    <td class="text-end">{{ number_format($item->cost_price, 2) }}</td>
                                    <td class="text-end">{{ number_format($item->quantity * $item->cost_price, 2) }}</td>
                                    <td class="text-center"><span class="badge rounded-pill bg-{{ $item->status == 'composed' ? 'info' : ($item->status == 'stocked' ? 'success' : 'danger') }}">{{ ucfirst($item->status) }}</span></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div>
            <div class="d-flex justify-content-between mt-3">
                    <a href="{{ route('supplyInvoice.index') }}" class="btn btn-danger">Back</a>
                    <a href="{{ route('supplyInvoice.edit', $invoice) }}" class="btn btn-success">Stock Now! <i class="fas fa-check"></i></a>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script></script>
@endsection

@section('style')
@endsection
