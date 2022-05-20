@extends('layouts.dashboard')

@section('title')
Store Dashboard Comment
@endsection

@section('content')

<div class="section-content section-dashboard-home" data-aos="fade-up">

    <div class="container-fluid">
        <div class="dashboard-heading">
            <h2 class="dashboard-title">{{ $datas['name']}}</h2>
            <p class="dashboard-subtitle">Make comment to Product.</p>
        </div>
        <div class="dashboard-content" id="transactionDetails">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <form action={{ route('comment.store') }} method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="col-md-6">
                                <div class="form-group mx-3 my-3">
                                    <input name="products_id" value="{{ $datas['id'] }} " hidden />
                                    <label for="exampleFormControlTextarea1">Make comment to {{ $datas['name']
                                        }}</label>
                                    <textarea name="description" class="form-control" id="exampleFormControlTextarea1"
                                        rows="5"></textarea>

                                    <button class="btn btn-dark mt-4" type="submit">Submit</button>
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