<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Item;

class StockManagement extends Component
{
    public $search = '';

    public function render()
    {
        $userId = auth()->user()->id;
        $items = Item::where('user_id', $userId)
            ->where(function($query) {
                $query->where('item_name', 'like', '%' . $this->search . '%');
            })
            ->with('category')->orderBy('stok', 'asc')  ->orderBy('item_name', 'asc')  
            ->get();

        return view('livewire.stock-management', [
            'items' => $items
        ]);
    }
}