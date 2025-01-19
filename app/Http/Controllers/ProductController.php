<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::plucking();
        $subcategories = Subcategory::plucking();
        $brands = Brand::plucking();

        if (request()->ajax()) {

            $searchTerm = request('search')['value'];

            $products = Product::available()
                ->active()
                ->with(['category:id,name', 'subcategory:id,name', 'brand:id,name'])
                ->search($searchTerm);

            return DataTables::of($products)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    // class add d-flex
                    $btn = '<div class="form-button-action">';
                    $btn .= '<a href="' . route('products.show', $row->id) . '" class="btn btn-info btn-sm">View</a>';
                    $btn .= '<a href="' . route('products.edit', $row->id) . '" class="btn btn-success btn-sm">Edit</a>';
                    $btn .= '<a href="javascript:void(0)" data-id="' . $row->id . '" class="btn btn-danger btn-sm deleteBtn">Delete</a>';
                    $btn .= '</div>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('products.index', compact('categories', 'subcategories', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        dd($request->all());
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:subcategories,id',
            'brand_id' => 'required|exists:brands,id',
            'image' => 'required|image'
        ]);

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'brand_id' => $request->brand_id,
        ]);

        $product->product_image = $request->productImage($request->file('image'));
        $product->save();

        return redirect()->route('products.index')
            ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load(['category:id,name', 'subcategory:id,name', 'brand:id,name']);
        $product->previous = $product->previousRoute('products.show');
        $product->next = $product->nextRoute('products.show');

        if (request()->ajax()) {
            return response()->json($product);
        }

        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    /**
     * product view in frontend by category, subcategory, brand, search, single product, cart, wishlist, checkout
     */
    public function category($category, Request $request)
    {
        $brandQuery = $request->query('brand');
        $req_brands = [];

        if ($brandQuery) {
            $decodedBrands = urldecode($brandQuery);
            $req_brands = array_unique(explode('|', $decodedBrands));
            $req_brands = Brand::whereIn('name', $req_brands)->pluck('name')->toArray();
        }


        $categories = Category::withCount(['products'=>function($query){
            $query->active()->available();
        }])
        ->with('subcategories')
        ->withCount('subcategories')
        ->get();

        $brands = Brand::plucking();

        $productsQuery = Product::with('category:id,name', 'subcategory:id,name', 'brand:id,name');
        $productsQuery->filter(['whereHas' => 'category', 'where' => 'name', 'value' => $category]);
        $req_brands? $productsQuery->filter(['whereHas' => 'brand', 'where' => 'name', 'values' => $req_brands]): '';
        $products = $productsQuery->active()->available()->paginate(10);

        return view('products.category', compact('categories', 'brands', 'products', 'req_brands'));
    }

    public function subcategory($category, $subcategory, Request $request)
    {
        $brandQuery = $request->query('brand');
        $req_brands = [];

        if ($brandQuery) {
            $decodedBrands = urldecode($brandQuery);
            $req_brands = array_unique(explode('|', $decodedBrands));
            $req_brands = Brand::whereIn('name', $req_brands)->pluck('name')->toArray();
        }

        $categories = Category::withCount(['products'=>function($query){
            $query->active()->available();
        }])
        ->with('subcategories')
        ->get();
        $brands = Brand::plucking();

        $productsQuery = Product::with('category:id,name', 'subcategory:id,name', 'brand:id,name');
        $productsQuery->filter(['whereHas' => 'category', 'where' => 'name', 'value' => $category]);
        $productsQuery->filter(['whereHas' => 'subcategory', 'where' => 'name', 'value' => $subcategory]);
        $req_brands? $productsQuery->filter(['whereHas' => 'brand', 'where' => 'name', 'values' => $req_brands]): '';
        $products = $productsQuery->active()->available()->paginate(10);

        return view('products.category', compact('categories', 'brands', 'products' , 'req_brands'));
    }

    public function brand($category, $subcategory, $brand)
    {
        $categories = Category::withCount(['products'=>function($query){
            $query->active()->available();
        }])
        ->with('subcategories')
        ->get();
        $brands = Brand::plucking();

        dd($brand);

        $productsQuery = Product::with('category:id,name', 'subcategory:id,name', 'brand:id,name');
        $productsQuery->filter(['whereHas' => 'category', 'where' => 'name', 'value' => $category]);
        $productsQuery->filter(['whereHas' => 'subcategory', 'where' => 'name', 'value' => $subcategory]);
        $productsQuery->filter(['whereHas' => 'brand', 'where' => 'name', 'values' => $brand]);
        $products = $productsQuery->active()->available()->paginate(10);

        return view('products.category', compact('categories', 'brands', 'products'));
    }
}
