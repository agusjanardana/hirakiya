@extends('layouts.admin')

@section('title')
    Product Gallery
@endsection

@section('content')
<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
    >
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title"> Product Gallery</h2>
            <p class="dashboard-subtitle">List of Product Gallery</p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{route('product-gallery.create')}}" class="btn btn-primary mb-3">
                                + Tambah Gallery Baru
                            </a>
                            <div class="table-responsive">
                                <table class="table table-hover scroll-horizontal-vertical w-100" id ="crudTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Produk</th>
                                            <th>Foto</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
@endsection

@push('addon-script')
    <script>
        var datatable = $('#crudTable').DataTable({
            processing : true,
            serverSide : true,
            orderin : true,
            ajax : {
                url : '{!! url()->current()!!}'
            },
            columns : [
                { data : 'id' , nama : 'id'},
                { data : 'product.name' , nama : 'product.name'},
                { data : 'photos', nama : 'photos'},
                {
                    data : 'action',
                    nama : 'action',
                    orderable : 'false',
                    width : '15%'
                },
            ]
        })
    </script>
@endpush
