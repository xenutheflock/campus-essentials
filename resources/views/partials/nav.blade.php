<nav class="site">
    <a href="{{ route('products.index') }}"
       class="{{ request()->routeIs('products.index') ? 'active' : '' }}">
        Inventory List
    </a>

    <a href="{{ route('products.create') }}"
       class="{{ request()->routeIs('products.create') ? 'active' : '' }}">
        Add New Item
    </a>
</nav>