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
                                    Cart
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
                    <table>asd</table>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection