<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\CategoryItem;
use Illuminate\Support\Str;

class StockManagement extends Controller
{
    public function index() {
        $userId = auth()->user()->id;
        $items = Item::where('user_id', $userId)->with('category')->get();
        
        return view('stock_management.index', compact('items'));
    }

    public function indexCreateOrEdit($id = null) {
    $categories = CategoryItem::all();
    $item = null;
    if ($id) {
        $item = Item::findOrFail($id);
    }
    return view('stock_management.update_create_item', 
    [
        'categories' => $categories,
        'item' => $item,
        ]
    );
}


    public function createOrupdate(Request $request, $id = null) {
        $userId = auth()->user()->id;

        $validated = $request->validate([
            'item_name' => 'required|string|max:255',
            'stok' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'path_item' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_item_id' => 'nullable|exists:category_items,id',
        ]);

        if (empty($request->category_item_id) && !empty($request->new_category) ) {
            $category = CategoryItem::create(['category_item_name' => $request->new_category]);
            $validated['category_item_id'] = $category->id;
        }


        if ($request->hasFile('path_item')) {
            $folder = 'user_' . Str::slug(auth()->user()->name) . '_' . auth()->id();
            $file = $request->file('path_item');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $imagePath = $file->storeAs($folder, $filename, 'public');
            $validated['path_item'] = $imagePath;
        }

        $validated['user_id'] = $userId;

        Item::updateOrCreate(['id' => $id], $validated);

        return redirect()->route('stock_management')->with('success', $id ? 'Item updated successfully' : 'Item created successfully');
    }
}
