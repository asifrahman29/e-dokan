<form id="importForm" class="form" action="{{ route('import.invoice.store') }}" method="POST"
enctype="multipart/form-data">
@csrf
<div class="row mb-3 border-bottom border-info-subtle border-5 pb-4">
    <div class="col-md-4">
        <label for="supplier" class="form-label">Select Supplier</label>
        <select class="form-control" id="supplier" name="supplier_id" required>
            @if ($supplier)
            <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                {{ $supplier->name }}
            </option>
        @endif
    
        <option value="">Select</option>
        @if ($suppliers)
            @foreach ($suppliers as $supplier)
                <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                    {{ $supplier->name }}
                </option>
            @endforeach
        @endif
        </select>
    </div>
    <div class="col-md-4">
        <label for="invoice_number" class="form-label">Invoice Number</label>
        <input type="text" class="form-control" id="invoice_number" name="invoice_number" value="{{ old('invoice_number') }}" >
    </div>
    <div class="col-md-4">
        <label for="invoice_date" class="form-label">Invoice Date</label>
        <input type="date" class="form-control" id="invoice_date" name="invoice_date" value="{{ old('invoice_date') }}" required>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <div class="input-group mb-3">
            <input type="text" id="search-product" placeholder="Search Product" class="form-control">
            <button id="clear-search" class="btn btn-outline-secondary" type="button">Clear</button>
        </div>
        <ul class="list-group product-select">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                No products found.
            </li>
        </ul>
    </div>
    <div class="col-md-8">
        <table class="table responsive table-responsive-sm" id="products-table">
            <thead>
                <tr>
                    <th style="width:40%">Product</th>
                    <th style="width:15%">Quantity</th>
                    <th style="width:15%">Price</th>
                    <th style="width:30%">Total</th>
                </tr>
            </thead>
            <tbody>
                @if (old('products'))
                    @foreach (old('products') as $product)
                        <tr>
                            <td>
                                <input type="text" class="form-control" name="products[{{ $loop->index }}][name]" value="{{ $product['name'] }}" readonly>
                                <input type="hidden" class="productId" name="products[{{ $loop->index }}][id]" value="{{ $product['id'] }}">
                            </td>
                            <td>
                                <input type="number" class="form-control quantity" name="products[{{ $loop->index }}][quantity]" value="{{ $product['quantity'] }}" min="1" required>
                            </td>
                            <td>
                                <input type="number" class="form-control price" name="products[{{ $loop->index }}][price]" value="{{ $product['price'] }}" min="0" required>
                            </td>
                            <td>
                                <div class="d-flex gap-3">
                                    <input type="text" class="form-control total-amount p-0" name="products[{{ $loop->index }}][total]" value="{{ $product['total'] }}" readonly>
                                    <button type="button" class="btn btn-danger btn-sm m-0 p-2 remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
<div class="d-flex justify-content-center border-info-subtle gap-5 border-top border-5 pt-4 mt-4">
    <div>
        <div class="input-group">
            <span class="input-group-text"><strong>Final Total Amount</strong></span>
            <input type="number" class="form-control" id="final_total" name="final_total" value="{{ old('final_total') }}" readonly>
        </div>
    </div>
    <div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
</form>
