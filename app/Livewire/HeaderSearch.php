<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;

class HeaderSearch extends Component
{
    public string $search = '';
    public array $results = [];

    public function updatedSearch()
    {
        if (strlen($this->search) < 2) {
            $this->results = [];
            return;
        }

        $this->results = Product::search($this->search)
            ->with(['categories', 'media'])
            ->take(6)
            ->get()
            ->toArray();
    }

    public function searchPage()
    {
        if (strlen($this->search) >= 2) {
            return redirect()->route('search.page', ['query' => $this->search]);
        }
    }

    public function render()
    {
        return view('livewire.header-search');
    }
}
