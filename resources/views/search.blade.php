@extends('layouts.app')

@section('content')
    <form class="form-inline my-2 my-lg-0" action="/search/products" method="get" >
      <button class="btn btn-outline-success my-2 my-sm-0 mr-sm-2" type="submit">Search</button>
      <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
    </form>
@endsection
