@extends('layouts.admin')

@section('title')
Upload Banner Slider
@endsection

@section('content')
<div class="section-content section-dashboard-home" data-aos="fade-up">
    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">Upload Banner</h2>
            <p class="dashboard-subtitle">Add New Banner</p>

        </div>
        <div class="dashboard-content">
            <div class="row">
                <div class="col-md-12">
                    {{-- error handling, jika ada error muncul di atas --}}
                    @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error )
                            <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            <form action="{{route('dynamicfe.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="">Foto Product</label>
                                            <input type="file" name="photos[]" class="form-control" required multiple>
                                            <small>Disarankan untuk upload file dengan gambar ukuran 1900 pixels x 720
                                                pixels untuk membuat banner terlihat
                                                cantik.</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col text-right">
                                        <button type="submit" class="btn btn-success px-4">Save Now!</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection