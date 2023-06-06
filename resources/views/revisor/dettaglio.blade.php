<x-layout>
    <div class="bg-light pt-5 pb-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8 offset-md-2">
                    <div class="card  shadow-lg">
                        <div class="card-body d-flex justify-content-between">
                            <form class="m-0" action="{{ route('revisor.accept_product', ['product' => $product]) }}"
                                method="POST">@csrf @method('PATCH')
                                <button type="submit" class="btn btn-lg rounded-5 btn-success">
                                    <i class="fa-regular fa-circle-check"></i>
                                </button>
                            </form>
                            <div class="d-flex align-items-center">
                                <h1 class="fs-4 fw-bolder ms-3 align-self-center">Id-Prodotto:{{ $product->id }}</h1>
                            </div>
                            <form class="m-0" action="{{ route('revisor.reject_product', ['product' => $product]) }}"
                                method="POST">@csrf @method('PATCH')
                                <button type="submit" class="btn btn-lg rounded-5 btn-danger">
                                    <i class="fa-regular fa-circle-xmark"></i>
                                </button>
                            </form>
                        </div>
                        <div id="splide" class="splide detailsImg d-none d-lg-block">
                            <div class="splide__track">
                                <ul class="splide__list ">
                                    @foreach ($product->images as $image)
                                    <li class="splide__slide">
                                        <div class="card  ">
                                            <div class="row p-2">
                                                <div class="col-12">
                                                    <img src="{{ $image->getUrl() }}"
                                                    class="img-fluid p-3 rounded" alt="">
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div id="splide" class="splide detailsImgThumb d-none d-lg-block ">
                            <div class="splide__track">
                                <ul class="splide__list  ">
                                    @foreach ($product->images as $image)
                                    <li class="splide__slide">
                                        <img src="{{ $image->getUrl() }}" class="img-fluid" alt="..." />
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @if ($product)
                        <div class="container d-block">
                            <div class="row justify-content-center">
                                <div class="card-body">
                                    <h3 class="fs-2">{{ $product->name }}</h3>
                                    @if ($product->is_in_promotion)
                                    <p class="fs-5 fw-light text-danger">
                                        Prezzo Iniziale: <span class=" text-decoration-line-through ">{{ number_format($product->price, 2) }}</span>€ Sconto dell'{{ number_format($product->is_in_promotion, 0) }}%
                                    </p>
                                    <h3 class="fs-5 fw-light ">Ora {{ $product->getPriceInPromotion() }}€ </h3>
                                    @else
                                    <h3 class="fs-5 fw-light">{{ $product->price }} EUR</h3>
                                    @endif
                                    <div class="d-flex align-items-center mt-3">
                                        <a class="w-50" href="{{ route('categoryShow', $product->category) }}">
                                            <img src="{{ $product->category->img }}" class="logo-deliver-comp" alt="" />
                                            {{ $product->category->name }}
                                        </a>
                                        <a href="{{ route('regionShow', $product->region) }}" class="w-50  m-0 text-end">
                                            {{ $product->region->name }} 
                                        </a>
                                    </div>
                                    <p class="fs-4 border-top pt-4">
                                        {{ $product->description }}
                                    </p>
                                    <p class="fs-5 border-top py-4 border-bottom">
                                        Pubblicato il {{ $product->created_at->format('d/m/Y') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
