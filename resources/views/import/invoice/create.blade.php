@extends('layouts.admin', ['title' => 'Dashboard | Import Products'])

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
                    <a href="#">Import Product</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-12">
                <form id="importForm" class="form" action="{{ route('import.invoice.store') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3 border-bottom border-info-subtle border-5 pb-4">
                        <div class="col-md-4">
                            <label for="supplier" class="form-label">Select Supplier</label>
                            <select class="form-control" id="supplier" name="supplier_id" required>
                                @if ($supplier)
                                    <option selected value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                @endif
                                @if ($suppliers)
                                    <option value="">Select</option>
                                    @foreach ($suppliers as $supplierItem)
                                        <option value="{{ $supplierItem->id }}">{{ $supplierItem->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label for="invoice_number" class="form-label">Invoice Number</label>
                            <input type="text" class="form-control" id="invoice_number" name="invoice_number" required>
                        </div>
                        <div class="col-md-4">
                            <label for="invoice_date" class="form-label">Invoice Date</label>
                            <input type="date" class="form-control" id="invoice_date" name="invoice_date" required>
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
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center border-info-subtle gap-5 border-top border-5 pt-4 mt-4">
                        <div>
                            <div class="input-group">
                                <span class="input-group-text"><strong>Final Total Amount</strong></span>
                                <input type="number" class="form-control" id="final_total" name="final_total" readonly>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            function initProductSearch() {
                $('#search-product').on('keyup', function() {
                    let query = $(this).val();
                    fetchProducts(query);
                });

                $('#clear-search').on('click', function() {
                    $('#search-product').val('');
                    fetchProducts('');
                });
            }

            function fetchProducts(query) {
                $.ajax({
                    url: "{{ route('ImportsupplyInvoiceCreate') }}", // Ensure the correct route is used
                    method: "GET",
                    data: {
                        q: query
                    },
                    success: function(response) {
                        $('.product-select').empty();
                        if (response.length > 0) {
                            $.each(response, function(index, product) {
                                let productItem = `
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                ${product.slug} | ${product.name} 
                                <button type="button" class="btn btn-sm btn-success add-product" data-slug="${product.slug}" data-id="${product.id}" data-name="${product.name}">
                                    Add
                                </button>
                            </li>`;
                                $('.product-select').append(productItem);
                            });
                        } else {
                            $('.product-select').append(
                                '<li class="list-group-item">No products found.</li>');
                        }
                    },
                    error: function() {
                        alert('Failed to load products');
                    }
                });
            }

            $(document).on('click', '.add-product', function() {
                let productId = $(this).data('id');
                let productSlug = $(this).data('slug');
                let productName = $(this).data('name');
                let $existingRow = $('table tbody tr').filter(function() {
                    return $(this).find('.productId').val() === String(productId);
                });


                if ($existingRow.length > 0) {
                    let quantityInput = $existingRow.find('.quantity');
                    let newQuantity = parseInt(quantityInput.val()) + 1;
                    quantityInput.val(newQuantity);
                    $existingRow.find('.price').focus();
                } else {
                    let newRow = `
                <tr>
                    <td>
                        <input type="text" class="form-control product" name="products[${productId}][name]" value="${productSlug} | ${productName}" readonly>
                        <input type="hidden" class="productId" name="products[${productId}][id]" value="${productId}">
                    </td>
                    <td>
                        <input type="number" class="form-control quantity" name="products[${productId}][quantity]" value="1" min="1" required>
                    </td>
                    <td>
                        <input type="number" class="form-control price" name="products[${productId}][price]" min="0" required>
                    </td>
                    <td>
                        <div class="d-flex gap-3">
                            <input type="text" class="form-control total-amount p-0" name="products[${productId}][total]" readonly>
                            <button type="button" class="btn btn-danger btn-sm m-0 p-2 remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </td>
                </tr>`;
                    $('#products-table tbody').append(newRow);
                }
                calculateTotals();
            });

            $(document).on('click', '.remove', function() {
                $(this).closest('tr').remove();
                calculateTotals();
            });

            $(document).on('input', '.quantity, .price', function() {
                calculateTotals();
            });

            function calculateTotals() {
                let finalTotal = 0;
                $('#products-table tbody tr').each(function() {
                    let quantity = parseFloat($(this).find('.quantity').val()) || 0;
                    let price = parseFloat($(this).find('.price').val()) || 0;
                    let total = quantity * price;
                    $(this).find('.total-amount').val(total.toFixed(2));
                    finalTotal += total;
                });
                $('#final_total').val(finalTotal.toFixed(2));
            }

            $('#importForm').on('submit', function(e) {
                e.preventDefault();
                if ($('#products-table tbody tr').length === 0) {
                    alert('Please add at least one product to the invoice.');
                    return;
                }
                this.submit();
            });

            initProductSearch();
        });
    </script>
@endsection
