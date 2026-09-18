@extends('layouts.app')

@section('title', 'Add New Item')

@section('content')

    <div class="entry">
        <div>
            <h2>Add New Item</h2>
            <p class="entry-intro">
                Every field is required. The reorder level sets the threshold
                at which this item is flagged on the inventory list.
            </p>

            @if ($errors->any())
                <div class="notice">
                    <strong>Nothing was saved.</strong>
                    Please correct the {{ $errors->count() }}
                    highlighted field(s) below.
                </div>
            @endif

            <form action="{{ route('products.store') }}" method="POST">
                @csrf

                <div class="form-grid">

                    <div class="field field--wide @error('item_name') has-error @enderror">
                        <label for="item_name">Item name</label>
                        <input type="text" id="item_name" name="item_name"
                               value="{{ old('item_name') }}"
                               placeholder="e.g. Yellow Pad Paper">
                        @error('item_name')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field @error('category') has-error @enderror">
                        <label for="category">Category</label>
                        <select id="category" name="category">
                            <option value="">Select a category</option>
                            @foreach ($categories as $option)
                                <option value="{{ $option }}"
                                    @selected(old('category') === $option)>
                                    {{ $option }}
                                </option>
                            @endforeach
                        </select>
                        @error('category')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field @error('supplier') has-error @enderror">
                        <label for="supplier">Supplier</label>
                        <input type="text" id="supplier" name="supplier"
                               value="{{ old('supplier') }}"
                               placeholder="e.g. Dela Cruz Trading">
                        @error('supplier')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field @error('price') has-error @enderror">
                        <label for="price">Price (&#8369;)</label>
                        <input type="text" id="price" name="price" inputmode="decimal"
                               value="{{ old('price') }}" placeholder="0.00">
                        @error('price')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field @error('stock_quantity') has-error @enderror">
                        <label for="stock_quantity">Stock quantity</label>
                        <input type="text" id="stock_quantity" name="stock_quantity"
                               inputmode="numeric" value="{{ old('stock_quantity') }}"
                               placeholder="0">
                        @error('stock_quantity')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="field @error('reorder_level') has-error @enderror">
                        <label for="reorder_level">Reorder level</label>
                        <input type="text" id="reorder_level" name="reorder_level"
                               inputmode="numeric" value="{{ old('reorder_level') }}"
                               placeholder="0">
                        @error('reorder_level')
                            <span class="field-error">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <div class="form-actions">
                    <button type="submit" class="btn">Save Item</button>
                    <a href="{{ route('products.index') }}" class="btn btn--ghost">Cancel</a>
                </div>
            </form>
        </div>

        <aside class="preview">
            <span class="label">Preview</span>
            <div class="preview-name" id="pv-name">Untitled item</div>
            <div class="preview-category" id="pv-category">No category yet</div>

            <div class="preview-grid">
                <div class="preview-cell">
                    <span class="label">Price</span>
                    <p id="pv-price">&mdash;</p>
                </div>
                <div class="preview-cell">
                    <span class="label">Supplier</span>
                    <p id="pv-supplier">&mdash;</p>
                </div>
                <div class="preview-cell">
                    <span class="label">In stock</span>
                    <p id="pv-stock">&mdash;</p>
                </div>
                <div class="preview-cell">
                    <span class="label">Reorder at</span>
                    <p id="pv-reorder">&mdash;</p>
                </div>
            </div>

            <p class="preview-note" id="pv-note">
                Items are flagged when stock falls to or below the reorder level.
            </p>
        </aside>
    </div>

@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

    var fields = {
        item_name:      document.getElementById('item_name'),
        category:       document.getElementById('category'),
        price:          document.getElementById('price'),
        stock_quantity: document.getElementById('stock_quantity'),
        reorder_level:  document.getElementById('reorder_level'),
        supplier:       document.getElementById('supplier')
    };

    var out = {
        name:     document.getElementById('pv-name'),
        category: document.getElementById('pv-category'),
        price:    document.getElementById('pv-price'),
        stock:    document.getElementById('pv-stock'),
        reorder:  document.getElementById('pv-reorder'),
        supplier: document.getElementById('pv-supplier'),
        note:     document.getElementById('pv-note')
    };

    function peso(value) {
        var n = Number(value);
        if (value === '' || isNaN(n)) return '\u2014';
        return '\u20B1' + n.toLocaleString('en-PH', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    function update() {
        out.name.textContent     = fields.item_name.value.trim() || 'Untitled item';
        out.category.textContent = fields.category.value || 'No category yet';
        out.price.textContent    = peso(fields.price.value);
        out.stock.textContent    = fields.stock_quantity.value || '\u2014';
        out.reorder.textContent  = fields.reorder_level.value || '\u2014';
        out.supplier.textContent = fields.supplier.value.trim() || '\u2014';

        var stock   = fields.stock_quantity.value;
        var reorder = fields.reorder_level.value;

        if (stock !== '' && reorder !== '' && Number(stock) <= Number(reorder)) {
            out.note.textContent = 'At these numbers the item will be flagged '
                + 'Reorder now as soon as it is saved.';
        } else {
            out.note.textContent = 'Items are flagged when stock falls to or '
                + 'below the reorder level.';
        }
    }

    Object.keys(fields).forEach(function (key) {
        fields[key].addEventListener('input', update);
        fields[key].addEventListener('change', update);
    });

    update();
});
</script>
@endpush