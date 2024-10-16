<?php

namespace App\Http\Controllers\Import;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\Facades\DataTables;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $suppliers = Supplier::all();

        // dd($suppliers);
        if (request()->ajax()) {

            $searchTerm = request('search')['value']; // DataTables search value
    
            // Using a search method in the Supplier model (assuming you have a search scope implemented)
            $suppliers = Supplier::search($searchTerm);
    
            return DataTables::of($suppliers)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="btn-group" role="group" aria-label="Basic example">';
                    $btn .= '<a href="' . route('suppliers.show', $row->id) . '" class="btn btn-sm btn-outline-primary"><i class="fas fa-eye"></i></a>';
                    $btn .= '<a href="' . route('suppliers.edit', $row->id) . '" class="btn btn-sm btn-outline-primary"><i class="fas fa-edit"></i></a>';
                    $btn .= '<a href="' . route('ImportsupplyInvoiceCreate', Crypt::encryptString($row->id)) . '" class="btn btn-sm btn-outline-primary bg-success"><i class="fas fa-dolly-flatbed"></i></a>';
                    $btn .= '</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('import.suppliers.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        //
    }
}
