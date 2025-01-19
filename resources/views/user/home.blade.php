<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <style>
            #carouselExampleCaptions .carousel-item img {
                height: 400px;
                object-fit: cover;
            }
        </style>
</head>

<body>
    <section class="product category">
        <div class="container">
            <div class="nav-scroller py-1 mb-3 border-bottom">
                <nav class="nav nav-underline justify-content-between">
                    @foreach ($categorys as $category)
                        <a class="nav-item nav-link link-body-emphasis"
                            href="{{ /*route('user.category',*/ $category->id }}">{{ $category->name }}</a>
                    @endforeach
                </nav>
            </div>
        </div>

    </section>
    <main class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="card">
                    <img src="..." class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">Offer</h5>
                        <a href="#">Link 1</a>
                        <a href="#">Link 2</a>
                    </div>
                </div>
            </div>
            <div class="col-sm-9">        <section class="scroll">
            <div id="carouselExampleCaptions" class="carousel slide h-25" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    @foreach ($topProducts as $key => $topProduct)
                        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{ $key }}"
                            class="{{ $key == 0 ? 'active' : '' }}" aria-current="true" aria-label="Slide {{ $key }}"></button>
                    @endforeach
                </div>
                <div class="carousel-inner">
                    @foreach ($topProducts as $topProduct)
                        <div class="carousel-item {{ $loop->index == 0 ? 'active' : '' }}">
                            <img src="{{ $topProduct->product_image }}" class="d-block w-100" alt="...">
                            <div class="carousel-caption d-none d-md-block">
                                <h5>{{ $topProduct->name }}</h5>
                                <p>
                                    {{ $topProduct->description ? $topProduct->description : 'Lorem ipsum dolor sit amet consectetur adipisicing elit.' }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section></div>
        </div>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
