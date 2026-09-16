<nav class="tabs">
    <a href="{{ route('products.index') }}"
       class="tab {{ request()->routeIs('products.index') ? 'is-current' : '' }}">
        Inventory List
    </a>

    <a href="{{ route('products.create') }}"
       class="tab {{ request()->routeIs('products.create') ? 'is-current' : '' }}">
        Add New Item
    </a>
</nav>