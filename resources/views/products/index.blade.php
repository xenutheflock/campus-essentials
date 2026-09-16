@extends('layouts.app')

@section('title', 'Inventory List')

@section('content')

    <div class="card">
        <h2>Current Inventory</h2>

        @if (session('success'))
            <div class="alert-success">{{ session('success') }}</div>
        @endif

        @if ($products->isEmpty())

            <p>No items yet. Use <strong>Add New Item</strong> to record your
               first supply.</p>

        @else

            <table>
                <thead>
                    <tr>
                        <th>Item Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>In Stock</th>
                        <th>Reorder At</th>
                        <th>Supplier</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->item_name }}</td>
                            <td>{{ $product->category }}</td>
                            <td>₱{{ number_format($product->price, 2) }}</td>
                            <td>{{ $product->stock_quantity }}</td>
                            <td>{{ $product->reorder_level }}</td>
                            <td>{{ $product->supplier }}</td>
                            <td>
                                @if ($product->stock_quantity <= $product->reorder_level)
                                    <span class="badge-low">Reorder now</span>
                                @else
                                    <span class="badge-ok">In stock</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        @endif
    </div>

@endsection