@extends('layouts.admin', ['title' => 'Dashboard | Products Details'])
@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Import</h3>
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
                    <a href="{{ route('ImportsupplyInvoiceCreate')}}">Import Product</a>
                </li>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="#">Invoice</a>
                </li>
            </ul>
        </div>
        <div class="row" id="">
<div>
    <table class="table">
        <thead>
            <tr>
                <th>Date</th>
                <th>Invoice Number</th>
                <th>Supplier</th>
                <th>Company Name</th>
                <th>Items</th>
                <th>Item Quantity</th>
                <th>Total Amount</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($invoices as $invoice)
                <tr>
                    <td>{{ $invoice->invoice_date }}</td>
                    <td>{{ $invoice->invoice_number }}</td>
                    <td>{{ $invoice->supplier->company_name }}</td>
                    <td>{{ $invoice->supplier->name }}</td>
                    <td>{{ $invoice->items_count }}</td>
                    <td>{{ $invoice->items_sum_quantity }}</td>
                    <td>{{ $invoice->total_amount }}</td>
                    <td>
                        <span class="badge badge-{{ $invoice->status == 'composed' ? 'info' : ($invoice->status == 'stocked' ? 'success' : 'danger') }}">{{ ucfirst(__($invoice->status)) }}</span>
                    </td>
                    {{-- action show --}}
                    <td>
                        <div class="btn-group dropstart">
                            <button type="button" class="btn bg-info dropdown-toggle m-0" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-mouse-pointer"></i>
                            </button>
                            <ul class="dropdown-menu border border-2 p-2 shadow-lg p-3 mb-5 bg-body-tertiary rounded">
                                <li><a class="dropdown-item bg-info rounded mt-1 mb-1" href="{{ route('supplyInvoice.show', $invoice) }}"><i class="fas fa-eye"></i> Show</a></li>
                                <li><a class="dropdown-item bg-danger rounded mt-1 mb-1" href="{{ route('supplyInvoice.edit', $invoice) }}" ><i class="fas fa-edit"></i> Stock Now!</a></li>
                            </ul>
                        </div>                        
                    </td>
                </tr>
                
            @empty
                
            @endforelse

        </tbody>
    </table>
</div>
        </div>
    </div>
@endsection
@section('scripts')
    <script></script>
@endsection

@section('style')
@endsection
