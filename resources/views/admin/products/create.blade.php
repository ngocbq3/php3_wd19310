@extends('admin.layout')

@section('title', 'Danh sách sản phẩm')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="" class="form-label">Name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control">
            @error('name')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Category</label>
            <select name="category_id" id="" class="form-control">
                <option value="0">Chọn danh mục</option>
                @foreach ($categories as $cate)
                    <option value="{{ $cate->id }}" @selected(old('category_id') == $cate->id)>
                        {{ $cate->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Image</label>
            <input type="file" name="image" id="" class="form-control">
        </div>
        @if ($errors->has('image'))
            <div class="text-danger">{{ $errors->first('image') }}</div>
        @endif
        <div class="mb-3">
            <label for="" class="form-label">Price</label>
            <input type="number" name="price" value="{{ old('price') }}" class="form-control">
            @error('price')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="" class="form-label">Stock</label>
            <input type="number" name="stock" value="{{ old('stock') }}" class="form-control">
            @error('stock')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Description</label>
            <textarea name="description" rows="10" class="form-control">{{ old('description') }}</textarea>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Create</button>
        </div>
    </form>
@endsection
