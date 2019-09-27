@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center">
                <img src="https://dummyimage.com/400x400/000/fff" alt="...">
            </div>
            <div class="card mb-3">
              <div class="card-body">
                <h5 class="card-title">
                    {{ $product->title }}
                    <span class="badge badge-primary"> {{ $product->status }} </span>
                </h5>
                <p class="card-text">{{ $product->body }}</p>
                <p class="card-text"><h4 class="text-muted">Price <b>RM{{ $product->price }}</b> </h4></p>
                <p class="card-text"><small class="text-muted">Last updated {{ $product->updated_at->diffForHumans() }}</small></p>
              </div>
            </div>
        </div>
        @auth
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <form class="" action="" method="post">
                        <div class="form-group">
                            <label for="">Comment</label>
                            <textarea name="name" class="form-control" rows="8" cols="80"></textarea>
                            <a href="#" class="btn btn-primary mt-2">Add Comment</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mt-4">
                <div class="card-body">
                    <h4>All Comments</h4>
                    @for ($i=0; $i < 10; $i++)
                        <div class="card mt-3">
                            <div class="card-header">
                                User name
                                <span class="float-right">23 Jan 2019</span>
                            </div>
                            <div class="card-body">

                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
        @else
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4>To comment, you need to login first <a href="/login">click here</a> </h4>
                    </div>
                </div>
            </div>
        @endauth
    </div>
</div>
@endsection
