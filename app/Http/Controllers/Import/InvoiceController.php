<?php

namespace App\Http\Controllers\Import;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\SupplyInvoice;
use App\Models\SupplyInvoiceItem;
use Hamcrest\Type\IsNumeric;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, $encryptedId = null)
    {
        if (request()->ajax()) {
            $searchTerm =  request()->input('q');
            return $this->getProducts($searchTerm);
        }
        try {
            $supplier = $encryptedId ? Supplier::findOrFail(Crypt::decryptString($encryptedId)) : null;
        } catch (DecryptException $e) {
            abort(404, 'Invalid supplier ID');
        }

        $suppliers = $encryptedId ? null : Supplier::all();

        return view('import.invoice.create', compact('supplier', 'suppliers'));
    }

    private function getProducts($searchTerm)
    {
        $products = Product::search($searchTerm)
            ->select('id', 'name', 'slug')
            ->active()
            ->orderBy('id')
            ->limit(10)
            ->get();

        return response()->json($products);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'supplier_id' => 'required|exists:suppliers,id',
            'invoice_number' => 'required|string|max:255|unique:supply_invoices,invoice_number',
            'invoice_date' => 'required|date|date_format:Y-m-d|before_or_equal:today',
            'final_total' => 'required|numeric|min:0',

            'products' => 'required|array|min:1',
            'products.*.id' => 'required|exists:products,id',
            'products.*.name' => 'required|string|max:255',
            'products.*.quantity' => 'required|integer|min:1',
            'products.*.price' => 'required|numeric|min:0',
            'products.*.total' => 'required|numeric|min:0',
        ]);
        try {
            $totalPrice = 0;
            foreach ($request->products as $product) {
                $totalPrice += floatval($product['total']);
            }
            $totalPri = number_format($totalPrice, 2);
            $final_total =  number_format($validatedData['final_total'], 2);
            if ($totalPri !== $final_total) {
                throw new \Exception('Total price does not match with final total');
            }

            $invoice = SupplyInvoice::create([
                'supplier_id' => $validatedData['supplier_id'],
                'invoice_number' => $validatedData['invoice_number'],
                'invoice_date' => $validatedData['invoice_date'],
                'total_amount' => $validatedData['final_total'],
            ]);

            foreach ($validatedData['products'] as $id => $product) {
                SupplyInvoiceItem::create([
                    'supply_invoice_id' => $invoice->id,
                    'product_id' => $product['id'],
                    'quantity' => $product['quantity'],
                    'cost_price' => $product['price'],
                ]);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
        return redirect()->route('ImportsupplyInvoiceCreate')->with('success', 'Invoice created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
