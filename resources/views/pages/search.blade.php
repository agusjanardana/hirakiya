@extends('layouts.app')

@section('title')
Searching {{ request()->search }}
@endsection

@section('content')
<div class="page-content page-home">
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-5 mb">
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
        <section class="store-new-products mt-5">
            <div class="container">
                <div class="row">
                    <div class="col-12" data-aos="fade-up">
                        <h5>Found {{ $dataToSearch->count() }} Products</h5>
                    </div>
                </div>
                <div class="row">
                    @php $incrementProduct = 0 @endphp
                    @forelse ($dataToSearch as $product )
                    <div class="col-6 col-md-4 col-lg-3" data-aos="fade-up"
                        data-aos-delay="{{ $incrementProduct += 100 }}">
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