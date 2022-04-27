@extends('layouts.app')

@section('title')
Store Wishlist
@endsection

@section('content')
<div class="page-content page-wrapper">
    <div class="page-content page-wishlist">
        <section class="store-breadcrumbs" data-aos="fade-down" data-aos-delay="100">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Wishlist
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </section>
        <div class="wishlist-wrapper">
            <section class="wishlist-wrapper-title container" data-aos="fade-down" data-aos-delay="100">
                <div class="row">
                    <div class="col-12 d-flex justify-content-center">
                        <p class="title-wishlist">My Wishlist</p>
                    </div>
                </div>
            </section>
            <section class="container mt-5 wishlist-table">
                <div class="row">
                    <div class="table-responsive">
                        <!--Table-->
                        <table class="table">

                            <!--Table head-->
                            <thead>
                                <tr>
                                    <th class=""></th>
                                    <th class="th-lg">Product Name</th>
                                    <th class="th-lg">Price</th>
                                    <th class="th-lg">Seller</th>
                                    <th class="th-lg"></th>
                                </tr>
                            </thead>
                            <!--Table head-->
                            <!--Table body-->
                            <tbody>
                                @forelse ($wishlists as $wishlist )
                                <tr>
                                    <td></td>
                                    <td class="d-flex">
                                        <div class="mx-2 mt-2">
                                            <a href="{{ route('wishlist-delete', $wishlist->id) }}">
                                                <img src="images/delete.png" style="width: 25px;" />
                                            </a>
                                        </div>
                                        <a class="" href="{{ route('detail', $wishlist->product->slug) }}"
                                            style="text-decoration: none; color:black;">
                                            <img src="{{ Storage::url($wishlist->product->galleries->first()->photos ?? '') }}"
                                                style="width: 50px;" />
                                            <span>{{ $wishlist->product->name }}</span>
                                        </a>
                                    </td>
                                    <td>{{ $wishlist->product->price }}</td>
                                    <td>{{ $wishlist->product->user->name }}</td>
                                    {{-- make td and make green button add to cart --}}
                                    <td>
                                        <form action="{{ route('detail-add', $wishlist->product->id) }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <button class="
                                                        btn btn-success
                                                        nav-link
                                                        px-4
                                                        text-white
                                                        btn-block
                                                        mb-3
                                            " type="submit">Add to
                                                Cart</button>
                                        </form>
                                    <td>
                                </tr>
                                @empty
                                <tr class="">
                                    <td>NO DATA</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                                @endforelse

                            </tbody>
                            <!--Table body-->

                        </table>
                        <!--Table-->

                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection