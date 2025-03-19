@extends('layout')

@section('title', $product->name)

@section('content')
    <div>
        <h2>{{ $product->name }}</h2>
        <div>
            Category Name: <b>{{ $product->cate_name }}</b>
        </div>
        <div>Price: {{ $product->price }}</div>
        <div>
            <img src="{{ $product->image }}" width="200" alt="">
        </div>
        <p>
            {{ $product->description }}
        </p>
    </div>
@endsection
