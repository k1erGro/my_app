<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Product;
use App\Models\Category;
use App\Models\Property;
use App\Models\Address;
use Illuminate\Support\Str;

class ProductForm extends Component
{
    use WithFileUploads;

    public ?Product $product = null;
    public bool $isEdit = false;

    public $name;
    public $slug;
    public $description;
    public $price;
    public $category_id;
    public $sub_category_id;
    public $image;

    public array $specs = [];
    public array $stocks = [];
    public $subCategories = [];

    public function mount(Product $product = null)
    {
        if ($product && $product->exists) {
            $this->product = $product;
            $this->isEdit = true;

            $this->name = $product->name;
            $this->slug = $product->slug;
            $this->description = $product->description;
            $this->price = $product->price;
            $this->category_id = $product->category_id;
            $this->sub_category_id = $product->sub_category_id;

            if ($this->category_id) {
                $this->subCategories = \App\Models\Category::find($this->category_id)->subCategories ?? [];
            }

            $this->specs = $product->propertyValues->map(function ($pv) {
                return [
                    'property_id' => $pv->property_id,
                    'value' => $pv->value
                ];
            })->toArray();

            // ИСПРАВЛЕНО: Читаем из pivot-поля 'product_quantity'
            $this->stocks = $product->addresses->map(function ($address) {
                return [
                    'address_id' => $address->id,
                    'product_quantity' => $address->pivot->product_quantity ?? 0
                ];
            })->toArray();
        }

        if (empty($this->specs)) {
            $this->addSpec();
        }
        if (empty($this->stocks)) {
            $this->addStock();
        }
    }

    public function updatedCategoryId($value)
    {
        // Сбрасываем выбранную подкатегорию
        $this->sub_category_id = null;

        if ($value) {
            // Здесь мы ищем подкатегории, привязанные к выбранной категории.
            // Я предполагаю, что у тебя в модели Category есть связь subCategories().
            // Если связь называется иначе (например, children), замени имя.
            $category = \App\Models\Category::find($value);
            $this->subCategories = $category ? $category->subCategories : [];
        } else {
            $this->subCategories = [];
        }
    }

    public function updatedName($value)
    {
        if (!$this->isEdit) {
            $this->slug = Str::slug($value);
        }
    }

    public function addSpec()
    {
        $this->specs[] = ['property_id' => '', 'value' => ''];
    }

    public function removeSpec($index)
    {
        unset($this->specs[$index]);
        $this->specs = array_values($this->specs);
    }

    // --- Логика работы с динамическими СКЛАДАМИ ---
    public function addStock()
    {
        $this->stocks[] = ['address_id' => '', 'product_quantity' => 1];
    }

    public function removeStock($index)
    {
        unset($this->stocks[$index]);
        $this->stocks = array_values($this->stocks);
    }

    // --- Сохранение формы ---
    public function save()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'nullable|exists:sub_categories,id',
            'specs.*.property_id' => 'required|exists:properties,id',
            'specs.*.value' => 'required|string|max:255',
            'stocks.*.address_id' => 'required|exists:addresses,id',
            'stocks.*.product_quantity' => 'required|integer|min:0',
        ];

        $this->validate($rules);

        // 1. Создаем или обновляем сам товар
        $productData = [
            'name' => $this->name,
            'slug' => $this->slug ?? Str::slug($this->name),
            'description' => $this->description,
            'price' => $this->price,
            'category_id' => $this->category_id,
            'sub_category_id' => $this->sub_category_id,
        ];

        if ($this->isEdit) {
            $this->product->update($productData);
            $product = $this->product;
        } else {
            $product = Product::create($productData);
        }

        // 2. Синхронизируем Характеристики (удаляем старые, пишем новые)
        $product->propertyValues()->delete();
        foreach ($this->specs as $spec) {
            $product->propertyValues()->create([
                'property_id' => $spec['property_id'],
                'value' => $spec['value']
            ]);
        }

        // 3. Синхронизируем Склады (через связь Many-to-Many sync с pivot данными)
        $syncStocks = [];
        foreach ($this->stocks as $stock) {
            $syncStocks[$stock['address_id']] = ['product_quantity' => $stock['product_quantity']];
        }
        $product->addresses()->sync($syncStocks);

        if ($this->image) {
            $product->clearMediaCollection('product_images');
            $product->addMedia($this->image->getRealPath())->toMediaCollection('product_images');
        }

        session()->flash('message', $this->isEdit ? 'Товар успешно обновлен!' : 'Товар успешно создан!');
        return redirect()->route('admin.product.index');
    }

    public function render()
    {
        return view('livewire.admin.product-form', [
            'categories' => Category::all(),
            'properties' => Property::all(),
            'warehouses' => Address::all(), // Твои склады
        ]);
    }
}
