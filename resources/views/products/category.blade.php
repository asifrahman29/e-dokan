<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        @isset($req_brands)
            {{-- {{ $brandQuery }} --}}
            @foreach ($req_brands as $item)
                <li>{{ $item }}</li>
            @endforeach
        @endisset
        <div class="row">
            <div class="col-3">
                <ul class="list-group">
                    @foreach ($categories as $category)
                        @if ($category->products_count > 0)
                            <div
                                class="btn-group row align-items-start {{ request()->is($category->name) | request()->is($category->name . '/*') ? 'bg-primary' : '' }}">
                                <a class="btn text-start border-bottom border-3 col-9"
                                    href="/{{ $category->name }}">{{ $category->name }}
                                </a>
                                <button type="button"
                                    class="btn dropdown-toggle dropdown-toggle-split border-bottom border-3 col-2"
                                    data-bs-toggle="dropdown" data-bs-reference="parent" aria-expanded="false">
                                </button>
                                <ul class="dropdown-menu " style="">
                                    @foreach ($category->subcategories as $subcategory)
                                        <li><a class="dropdown-item {{ request()->is($category->name . '/' . $subcategory->name) ? 'active' : '' }}"
                                                href="/{{ $category->name }}/{{ $subcategory->name }}">{{ $subcategory->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                                <i class="rounded-pill badge bg-primary col-1">{{ $category->products_count }}</i>
                            </div>
                        @endif
                    @endforeach
                </ul>
                <section name="brands">
                    <h5>Brands</h5>
                    <ul>
                        @foreach ($brands as $id => $brand)
                            <li>
                                <a
                                    href="/{{ request()->category }}/{{ request()->subcategory }}?brand={{ urlencode(request()->get('brand') ? request()->get('brand') . '|' : '') }}{{ urlencode($brand) }}">
                                    {{ $brand }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </section>
            </div>
            <div class="col-9">
                <section>
                    <table class="table table-striped-columns table-hover table-bordered table-sm">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Category</th>
                                <th>Subcategory</th>
                                <th>Brand</th>
                                <th>Quantity</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->slug }}</td>
                                    <td>{{ $product->category->name }}</td>
                                    <td>{{ $product->subcategory->name }}</td>
                                    <td>{{ $product->brand->name }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ $product->price }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- pageination --}}
                    <div class="container">
                        {{ $products->links() }}
                    </div>
                </section>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

</body>

</html>
