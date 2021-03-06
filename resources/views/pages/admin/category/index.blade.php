@extends('layouts.admin')

@section('title')
    Category
@endsection

@section('content')
<div
    class="section-content section-dashboard-home"
    data-aos="fade-up"
    >
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Category</h2>
            <p class="dashboard-subtitle">List of Category</p>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{route('category.create')}}" class="btn btn-primary mb-3">
                                + Tambah Kategori Baru
                            </a>
                            <div class="table-responsive">
                                <table class="table table-hover scroll-horizontal-vertical w-100" id ="crudTable">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Foto</th>
                                            <th>Slug</th>
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
                { data : 'name' , nama : 'name'},
                { data : 'photo' , nama : 'photo'},
                { data : 'slug' , nama : 'slug'},
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
