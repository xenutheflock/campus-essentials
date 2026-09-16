<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    private array $categories = [
        'Paper Products',
        'Writing Tools',
        'Art Materials',
        'Bags and Cases',
        'Other',
    ];

    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('q')) {
            $search = $request->input('q');

            $query->where(function ($builder) use ($search) {
                $builder->where('item_name', 'like', '%' . $search . '%')
                        ->orWhere('supplier', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        $products = $query->latest()->get();

        $all = Product::all();

        $stats = [
            'items' => $all->count(),
            'units' => $all->sum('stock_quantity'),
            'value' => $all->sum(fn ($product) => $product->price * $product->stock_quantity),
            'low'   => $all->filter(fn ($product) => $product->stock_quantity <= $product->reorder_level)->count(),
        ];

        return view('products.index', [
            'products'   => $products,
            'stats'      => $stats,
            'categories' => $this->categories,
        ]);
    }

    public function create()
    {
        return view('products.create', [
            'categories' => $this->categories,
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'item_name'      => 'required|string|max:100',
            'category'       => ['required', Rule::in($this->categories)],
            'price'          => 'required|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'supplier'       => 'required|string|max:100',
            'reorder_level'  => 'required|integer|min:0',
        ]);

        Product::create($validated);

        return redirect()
            ->route('products.index')
            ->with('success', $validated['item_name'] . ' was added to the inventory.');
    }
}