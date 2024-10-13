@extends('layouts.admin', ['title' => 'Dashboard | Products Details'])
@section('content')
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Products</h3>
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
                    <a href="#">Details</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="row gx-5">
                <aside class="col-lg-6">
                    <div class="border rounded-4 mb-3 d-flex justify-content-center">
                        <a data-fslightbox="mygalley" class="rounded-4" target="_blank" data-type="image"
                            href="{{ $product->product_image }}">
                            <img style="max-width: 100%; max-height: 100vh; margin: auto;" class="rounded-4 fit"
                                src="{{ $product->product_image }}">
                        </a>
                    </div>
                    <div class="d-flex justify-content-center mb-3">
                        <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image"
                            href="https://mdbcdn.b-cdn.net/img/bootstrap-ecommerce/items/detail1/big1.webp">
                            <img width="60" height="60" class="rounded-2"
                                src="https://mdbcdn.b-cdn.net/img/bootstrap-ecommerce/items/detail1/big1.webp">
                        </a>
                        <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image"
                            href="https://mdbcdn.b-cdn.net/img/bootstrap-ecommerce/items/detail1/big2.webp">
                            <img width="60" height="60" class="rounded-2"
                                src="https://mdbcdn.b-cdn.net/img/bootstrap-ecommerce/items/detail1/big2.webp">
                        </a>
                        <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image"
                            href="https://mdbcdn.b-cdn.net/img/bootstrap-ecommerce/items/detail1/big3.webp">
                            <img width="60" height="60" class="rounded-2"
                                src="https://mdbcdn.b-cdn.net/img/bootstrap-ecommerce/items/detail1/big3.webp">
                        </a>
                        <a data-fslightbox="mygalley" class="border mx-1 rounded-2" target="_blank" data-type="image"
                            href="https://mdbcdn.b-cdn.net/img/bootstrap-ecommerce/items/detail1/big4.webp">
                            <img width="60" height="60" class="rounded-2"
                                src="https://mdbcdn.b-cdn.net/img/bootstrap-ecommerce/items/detail1/big4.webp">
                        </a>
                    </div>
                </aside>
                <main class="col-lg-6">
                    <div class="ps-lg-3">
                        <h4 class="title text-dark">
                            {{ ucfirst($product->name) }}
                        </h4>
                        <div class="d-flex flex-row my-3">
                            <span class="text-muted"><i
                                    class="fas fa-shopping-basket fa-sm mx-1"></i>{{ $product->quantity }}</span>
                            <span class="text-success ms-2">In stock</span>
                        </div>

                        <div class="mb-3">
                            <span class="h5">{{ $product->price }}</span>
                        </div>

                        <p>
                            {{ $product->description }}
                        </p>

                        <div class="row">
                            <dt class="col-3">Type:</dt>
                            <dd class="col-9">{{ $product->type }}</dd>

                            <dt class="col-3">Color</dt>
                            <dd class="col-9">{{ $product->color }}</dd>

                            <dt class="col-3">Material</dt>
                            <dd class="col-9">{{ $product->material }}</dd>

                            <dt class="col-3">Category</dt>
                            <dd class="col-9">{{ $product->category->name }}</dd>

                            <dt class="col-3">Subcategory</dt>
                            <dd class="col-9">{{ $product->subcategory->name }}</dd>
                            <dt class="col-3">Brand</dt>
                            <dd class="col-9">{{ $product->brand->name }}</dd>

                            <dt class="col-3">Status</dt>
                            <dd class="col-9 bg-{{ $product->status ? 'success' : 'danger' }} text-black rounded-1">
                                {{ $product->status ? 'Active' : 'Deactive' }}</dd>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <div>
            {{-- next and previas link --}}
            <div class="d-flex justify-content-between">
                <a href="{{ $product->previous }}"
                    class="btn px-5 {{ !$product->previous ? 'disabled btn-danger' : 'btn-primary' }}">Previous</a>
                <a href="{{ $product->next }}"
                    class="btn px-5 {{ !$product->next ? 'disabled btn-danger' : 'btn-primary' }}">Next</a>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
    </script>
@endsection

@section('style')
@endsection
