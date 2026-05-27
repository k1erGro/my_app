<?php

namespace App\Livewire;

use App\Models\Product;
use App\Models\Property;
use App\Models\SubCategory;
use Livewire\Component;
use Livewire\WithPagination;

class CatalogComponent extends Component
{
    use WithPagination;

    public SubCategory $subCategory;

    public $priceFrom;
    public $priceTo;
    public array $selectedProperties = [];

    public string $sort = 'rating_desc';

    public function updating($name)
    {
        if (in_array($name, ['priceFrom', 'priceTo', 'selectedProperties', 'sort'])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        $productIds = $this->subCategory->products()->pluck('id');

        $filters = Property::whereHas('propertyValues', function ($query) use ($productIds) {
            $query->whereIn('product_id', $productIds);
        })
            ->with(['propertyValues' => function ($query) use ($productIds) {
                $query->whereIn('product_id', $productIds)
                    ->select('property_id', 'value')
                    ->distinct();
            }])
            ->get();

        $productsQuery = Product::where('sub_category_id', $this->subCategory->id)
            ->withAvg('reviews', 'rating');

        $productsQuery->filterProducts($this->selectedProperties, $this->priceFrom, $this->priceTo);

        if ($this->sort === 'rating_desc') {
            $productsQuery->orderByDesc('reviews_avg_rating');
        } elseif ($this->sort === 'rating_asc') {
            $productsQuery->orderBy('reviews_avg_rating');
        }

        $products = $productsQuery->paginate(12);

        return view('livewire.catalog-component', [
            'products' => $products,
            'filters' => $filters
        ]);
    }}
