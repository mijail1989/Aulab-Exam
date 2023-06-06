<x-layout>
    <h1 class="text-center">{{ __('category.' . strtolower($category->name)) }}</h1>
    <div class="container my-5 ">
        @if ($products->count() > 0)
        <div class="row d-flex flex-wrap ">
            @foreach ($products as $product)
            <div class="col-12 col-md-6 col-lg-3 mb-4">
                <x-card :product="$product" />
            </div>
            @endforeach
        </div>
        @else
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-12">
                <p class="h2">{{ __('categoryshow.nessunAnnuncio') }} {{ __('categoryshow.pubblicato') }}</p>
                    <a href="{{ route('product.create') }}" class=" btn btn-primary text-white text-decoration-none">
                        {{ __('categoryshow.nuovo') }}
                    </a>
            </div>
        </div>
        @endif
        <div class="mt-4 prova">
            {{ $products->fragment('product-list')->links() }}
        </div>
    </div>
</x-layout>
