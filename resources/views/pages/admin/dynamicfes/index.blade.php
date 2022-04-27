@extends('layouts.admin')

@section('title')
Manage Frontend
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Dynamic Frontend</h2>
            <p class="dashboard-subtitle">List of Image Slider</p>
            <small>YKamu dapat upload maksimal 3 banner saja.</small>
        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{route('dynamicfe.store')}}" class="btn btn-primary mb-3">
                                +
                            </a>
                            <div class="table-responsive">
                                <table class="table table-hover scroll-horizontal-vertical w-100" id="tabelFe">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Photo</th>
                                            <th>Tanggal Upload</th>
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
        var datatable = $('#tabelFe').DataTable({
            processing : true,
            serverSide : true,
            orderin : true,
            ajax : {
                url : '{!! url()->current()!!}'
            },
            columns : [
                { data : 'id' , nama : 'id'},
                { data : 'photos', nama: 'photos'},
                { data : 'created_at' , nama : 'created_at'}, 
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