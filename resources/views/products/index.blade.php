@extends('layouts.app')

@section('title', 'Inventory List')

@section('content')

    @if (session('success'))
        <div class="flash">
            <span class="label">Saved</span>
            <span>{{ session('success') }}</span>
        </div>
    @endif

    <section class="stats">
        <div class="stat">
            <span class="label">Items tracked</span>
            <p class="stat-value">{{ $stats['items'] }}</p>
        </div>
        <div class="stat">
            <span class="label">Units in stock</span>
            <p class="stat-value">{{ number_format($stats['units']) }}</p>
        </div>
        <div class="stat">
            <span class="label">Stock value</span>
            <p class="stat-value">&#8369;{{ number_format($stats['value'], 2) }}</p>
        </div>
        <div class="stat">
            <span class="label">Needs reorder</span>
            <p class="stat-value {{ $stats['low'] > 0 ? 'is-alert' : '' }}">{{ $stats['low'] }}</p>
        </div>
    </section>

    <section class="toolbar">
        <h2>Current Inventory</h2>

        <form method="GET" action="{{ route('products.index') }}" class="toolbar-controls">
            <input type="text" name="q" class="control"
                   value="{{ request('q') }}"
                   placeholder="Search item or supplier">

            <select name="category" class="control">
                <option value="">All categories</option>
                @foreach ($categories as $option)
                    <option value="{{ $option }}" @selected(request('category') === $option)>
                        {{ $option }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="btn btn--ghost btn--small">Search</button>
        </form>
    </section>

    @if ($products->isNotEmpty())

        <div class="ledger-wrap">
            <table class="ledger">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Category</th>
                        <th class="num">Price</th>
                        <th class="num">In stock</th>
                        <th class="num">Reorder at</th>
                        <th>Supplier</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td class="item">{{ $product->item_name }}</td>
                            <td class="muted">{{ $product->category }}</td>
                            <td class="num">&#8369;{{ number_format($product->price, 2) }}</td>
                            <td class="num strong">{{ $product->stock_quantity }}</td>
                            <td class="num muted">{{ $product->reorder_level }}</td>
                            <td class="muted">{{ $product->supplier }}</td>
                            <td>
                                @if ($product->stock_quantity <= $product->reorder_level)
                                    <span class="badge badge--alert">Reorder now</span>
                                @else
                                    <span class="badge badge--ok">In stock</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    @else

        <div class="empty">
            <div>
                @if (request()->filled('q') || request()->filled('category'))
                    <p class="empty-title">Nothing matches.</p>
                    <p class="empty-text">Clear the filters, or record a new supply item.</p>
                @else
                    <p class="empty-title">No items yet.</p>
                    <p class="empty-text">Record your first supply item to start tracking stock.</p>
                @endif
            </div>
            <a href="{{ route('products.create') }}" class="btn">Add New Item</a>
        </div>

    @endif

@endsection