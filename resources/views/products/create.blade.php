@extends('layouts.app')

@section('title', 'Add New Item')

@section('content')

    <div class="card">
        <h2>Add New Item</h2>

        @if ($errors->any())
            <div class="alert-error">
                <strong>Nothing was saved.</strong>
                Please correct the {{ $errors->count() }} highlighted
                field(s) below.
            </div>
        @endif

        <form action="{{ route('products.store') }}" method="POST">
            @csrf

            <div class="field">
                <label for="item_name">Item Name</label>
                <input type="text" id="item_name" name="item_name"
                       value="{{ old('item_name') }}">
                @error('item_name')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <label for="category">Category</label>
                <select id="category" name="category">
                    <option value="">-- Select a category --</option>
                    @foreach (['Paper Products', 'Writing Tools', 'Art Materials',
                               'Bags and Cases', 'Other'] as $option)
                        <option value="{{ $option }}"
                            @selected(old('category') == $option)>
                            {{ $option }}
                        </option>
                    @endforeach
                </select>
                @error('category')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <label for="price">Price (₱)</label>
                <input type="text" id="price" name="price"
                       value="{{ old('price') }}">
                @error('price')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <label for="stock_quantity">Stock Quantity</label>
                <input type="text" id="stock_quantity" name="stock_quantity"
                       value="{{ old('stock_quantity') }}">
                @error('stock_quantity')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <label for="reorder_level">Reorder Level</label>
                <input type="text" id="reorder_level" name="reorder_level"
                       value="{{ old('reorder_level') }}">
                @error('reorder_level')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <div class="field">
                <label for="supplier">Supplier</label>
                <input type="text" id="supplier" name="supplier"
                       value="{{ old('supplier') }}">
                @error('supplier')
                    <span class="error-text">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="btn">Save Item</button>
        </form>
    </div>

@endsection