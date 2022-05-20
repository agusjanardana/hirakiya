@extends('layouts.app')

@section('title')
Store Detail Page
@endsection

@section('content')
<!-- Page Content -->
<div class="page-content page-details">
    <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">
                                Product Details
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section class="store-gallery mb-3" id="gallery">
        <div class="container">
            <div class="row">
                <div class="col-lg-8" data-aos="zoom-in">
                    <transition name="slide-fade" mode="out-in">
                        <img :key="photos[activePhoto].id" :src="photos[activePhoto].url" class="w-100 main-image"
                            alt="" />
                    </transition>
                </div>
                <div class="col-lg-2">
                    <div class="row">
                        <div class="col-3 col-lg-12 mt-2 mt-lg-0" v-for="(photo, index) in photos" :key="photo.id"
                            data-aos="zoom-in" data-aos-delay="100">
                            <a href="#" @click="changeActive(index)">
                                <img :src="photo.url" class="w-100 thumbnail-image"
                                    :class="{ active: index == activePhoto }" alt="" />
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="store-details-container" data-aos="fade-up">
        <section class="store-heading">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8">
                        <h1>{{ $product->name }}</h1>
                        <div class="owner">By {{ $product->user->store_name }}</div>
                        <div class="price">{{ number_format($product->price) }}</div>
                    </div>
                    <div class="col-lg-3" data-aos="zoom-in">
                        @auth
                        <form action="{{ route('detail-add', $product->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <button class="
                                                btn btn-success
                                                nav-link
                                                px-4
                                                text-white
                                                btn-block
                                                mb-3
                                                " type="submit">Add to Cart</button>
                        </form>
                        <form action="{{ route('wishlist-store', $product->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <input name="products_id" value={{ $product->id }} hidden />
                            <button class="
                                btn btn-warning
                                nav-link
                                px-4
                                text-white
                                btn-block
                                mb-3
                                " type="submit" {{ $wishlist ? 'disabled' : '' }}>Add to Wishlist</button>
                        </form>
                        @else
                        <a class="
                                                btn btn-success
                                                nav-link
                                                px-4
                                                text-white
                                                btn-block
                                                mb-3
                                                " href="{{ route('login') }}">Sign in to Add</a>
                        @endauth

                    </div>
                </div>
            </div>
        </section>
        <section class="store-description">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-lg-8">
                        {!! $product->description !!}
                    </div>
                </div>
            </div>
        </section>
        <section class="store-review">
            <div class="container">
                @if (count($comment) > 0)
                <div class="row">
                    <div class="col-12 col-lg-8 mt-3 mb-3">
                        <h5>Customer Review ({{ count($comment) }})</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-lg-8">
                        <ul class="list-unstyled">
                            @foreach ($comment as $item)
                            <li class="media {{ $loop->index % 2 == 0 ? 'my-4' : '' }}">
                                <img src="{{ Storage::url($item['user']['user_photo']) ?? '/images/icon-testimonial-1.png'}}"
                                    class="mr-3 rounded-circle" alt="" />
                                <div class="media-body">
                                    <h5 class="mt-2 mb-1">{{ $item['user']['name'] }}</h5>
                                    {{ $item['description'] }}
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @else
                There are no comment yet about this product yet.
                @endif

            </div>
        </section>
    </div>
</div>
@endsection

@push('addon-script')
<script src="/vendor/vue/vue.js"></script>
<script>
    var gallery = new Vue({
            el: '#gallery',
            mounted() {
                AOS.init();
            },
            data: {
                activePhoto: 0,
                photos: [
                    @foreach($product->galleries as $gallery)
                        {
                            id: {{ $gallery->id }},
                            url: "{{ Storage::url($gallery->photos) }}",
                        },
                    @endforeach
                ],
            },
            methods: {
                changeActive(id) {
                    this.activePhoto = id;
                },
            },
        });
</script>
@endpush