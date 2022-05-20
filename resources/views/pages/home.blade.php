@extends('layouts.app')

@section('title')
Store Homepage
@endsection

@section('content')
{{-- check if any error --}}
<div class="page-content page-home">
    <section class="store-carousel">
        <div class="container">
            @if ($errors->any())
            <div class="alert alert-danger">
                <a>
                    {{ $errors->first() }}
                </a>
            </div>
            @endif
            <div class="row">
                <div class="col-lg-12" data-aos="zoom-in">
                    <div id="storeCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#storeCarousel" data-slide-to="0" class="active"></li>
                            <li data-target="#storeCarousel" data-slide-to="1"></li>
                            <li data-target="#storeCarousel" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            @foreach ($sliders as $slider )
                            <div class="carousel-item {{ $loop->index == 0 ? 'active' : '' }}">
                                <img src=" {{ Storage::url($slider->photos) ?? 'images/banner.jpg' }}"
                                    class="d-block w-100" alt="Carousel Image" style="width:1904px;height:720px;" />
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="store-trend-categories">
        <div class="container">
            <div class="row mt-5">
                <div class="col-md-5 mx-auto">
                    <form action="{{ route('search') }}" method="GET" enctype="multipart/form-data">
                        <div class="input-group">
                            <input name="search" class="form-control border-end-0 border" type="search product"
                                placeholder="search product..." value="" id="example-search-input">
                            <span class="input-group-append">
                                <button
                                    class="btn btn-outline-secondary bg-white border-start-0 border-bottom-0 border ms-n5"
                                    type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                    <h5>Trend Categories</h5>
                </div>
            </div>
            <div class="row">
                @php $incrementCategory = 0 @endphp
                @forelse ( $categories as $category )
                <div class="col-6 col-md-3 col-lg-2" data-aos="fade-up"
                    data-aos-delay="{{ $incrementCategory += 100 }}">
                    <a class="component-categories d-block" href="{{ route('categories-detail', $category->slug) }}">
                        <div class="categories-image">
                            <img src="{{ Storage::url($category->photo) }}" alt="Gadgets Categories" class="w-100" />
                        </div>
                        <p class="categories-text">{{ $category->name }}</p>
                    </a>
                </div>
                @empty
                <div class="col-12 text-center py-4" data-aos="fade-up" data-aos-delay="100">
                    Currectly no categories found in database.
                </div>
                @endforelse
            </div>
        </div>
    </section>
    <section class="store-new-products">
        <div class="container">
            <div class="row">
                <div class="col-12" data-aos="fade-up">
                    <h5>New Products</h5>
                </div>
            </div>
            <div class="row">
                @php $incrementProduct = 0 @endphp
                @forelse ($products as $product )
                <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up" data-aos-delay="{{ $incrementProduct += 100 }}">
                    <a class="component-products d-block" href="{{ route('detail', $product->slug) }}">
                        <div class="products-thumbnail">
                            <div class="products-image" style="
                                                @if ($product->galleries->count()) background-image :
                                        url('{{ Storage::url($product->galleries->first()->photos) }}')
                                    @else
                                        background-color : #eee @endif
                                        "></div>
                        </div>
                        <div class="products-text">{{ $product->name }}</div>
                        <div class="products-price">Rp {{ $product->price }}</div>
                    </a>
                </div>
                @empty
                <div class="col-12 text-center py-4" data-aos="fade-up" data-aos-delay="100">
                    No Products Found.
                </div>
                @endforelse
            </div>
        </div>
    </section>
</div>
@endsection