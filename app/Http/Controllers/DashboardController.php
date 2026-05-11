<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $query = Item::with('category');

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->has('category_id') && $request->category_id != '') {
            $query->where('category_id', $request->category_id);
        }

        $items = $query->paginate(10);
        $total_items = Item::count();
        $low_stock_items = Item::whereColumn('stock', '<', 'min_stock')->where('stock', '>', 0)->count();
        $out_of_stock_items = Item::where('stock', '<=', 0)->count();
        $total_categories = Category::count(); // Tambahkan hitungan kategori

        $categories = Category::all();

        return view('dashboard.index', compact(
            'items', 
            'total_items', 
            'low_stock_items', 
            'out_of_stock_items', 
            'total_categories', // Kirim ke view
            'categories'
        ));
    }
}
