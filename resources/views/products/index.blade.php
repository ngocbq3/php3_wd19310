@extends('layout')

@section('title', 'Danh sách sản phẩm')

@section('content')
    @foreach ($products as $product)
        <div>
            <a href="{{ route('products.show', $product->id) }}">
                <h2>{{ $product->name }}</h2>
            </a>
            <hr>
        </div>
    @endforeach

    {{ $products->links() }}
@endsection
