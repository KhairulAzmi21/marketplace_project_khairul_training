@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h4>{{ $products->total() }} total product </h4>
        </div>
    </div>
    <div class="row">
        @foreach($products as $product)
            <div class="col-md-3 mt-4">
                <div class="card">
                  <div class="card-body">
                      <h6 class="card-title">{{ $product->created_at->diffForHumans() }} by <b>{{ $product->user->name }}</b> </h6>
                  </div>
                  <img src="{{ !is_null($product->image_path) ? asset(str_replace('public','storage', $product->image_path)) : "https://dummyimage.com/400x400/000/fff" }}"
                  class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">{{ $product->title}}</h5>
                    <h6 class="card-title">Price : RM{{ $product->price }}</h6>
                    <h6 class="card-title">Category : <span class="badge badge-primary">{{ $product->category }}</span> </h6>
                    <h6 class="card-title">Status :  <span class="badge badge-primary">{{ $product->status }}</span> </h6>
                    <p class="card-text">{{ substr($product->body,0,20) }}...</p>
                    <a href="/products/{{ $product->id }}" class="btn btn-primary">See Details</a>
                  </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-12 mt-4">
            {{ $products->appends(request()->input())->links() }}
        </div>
    </div>
</div>
@endsection
