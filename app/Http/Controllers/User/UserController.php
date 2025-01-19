<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home($category = null, $subcategory = null, $brand = null)
    {
        $categorys = Category::paginate(10);
        $topProducts = Product::with('category:id,name', 'subcategory:id,name', 'brand:id,name')
            ->orderBy('quantity', 'desc')
            ->limit(5)
            ->get();
        // Initialize the query
        $productsQuery = Product::with('category:id,name', 'subcategory:id,name', 'brand:id,name');

        // Apply dynamic filters
        if ($category) {
            $productsQuery->filter(['whereHas' => 'category', 'where' => 'name', 'value' => $category]);
        }
        if ($subcategory) {
            $productsQuery->filter(['whereHas' => 'subcategory', 'where' => 'name', 'value' => $subcategory]);
        }
        if ($brand) {
            $productsQuery->filter(['whereHas' => 'brand', 'where' => 'name', 'value' => $brand]);
        }

        // Paginate the filtered products
        $products = $productsQuery->paginate(10);

        // return $products;
        // $users = User::paginate(5);
        return view('user.home', compact('categorys', 'topProducts', 'products'));
    }
    public function index()
    {
        // return 'index';
        return view('user.index');
    }

    public function indexSuparAdmin()
    {
        return 'indexSuparAdmin';
    }
    public function indexAdmin()
    {
        return 'indexAdmin';
    }
    public function indexCustomers()
    {
        return 'indexCustomers';
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
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
