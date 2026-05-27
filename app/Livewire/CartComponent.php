<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CartComponent extends Component
{
// Массив для хранения ID выбранных элементов корзины
    public array $selectedItems = [];

    // Чекбокс "Выбрать все"
    public bool $selectAll = true;

    public function mount()
    {
        // При загрузке страницы отмечаем все товары галочками
        $this->selectAllItems();
    }

    // Слушатель изменения чекбокса "Выбрать все"
    public function updatedSelectAll($value)
    {
        if ($value) {
            $this->selectAllItems();
        } else {
            $this->selectedItems = [];
        }
    }

    // Слушатель изменения отдельных чекбоксов товаров
    public function updatedSelectedItems()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        $allIds = $cart ? $cart->cartItems()->pluck('id')->map(fn($id) => (string)$id)->toArray() : [];

        // Если количество выбранных совпадает со всеми — ставим галочку "Выбрать все"
        $this->selectAll = count($this->selectedItems) === count($allIds);
    }

    private function selectAllItems()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        if ($cart) {
            // Livewire приводит значения wire:model массивов к строкам, поэтому кастим к string
            $this->selectedItems = $cart->cartItems()->pluck('id')->map(fn($id) => (string)$id)->toArray();
        }
    }

    public function increment($itemId)
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        if ($cart) {
            $item = $cart->cartItems()->find($itemId);
            if ($item) {
                $item->increment('quantity');
            }
        }
    }

    public function decrement($itemId)
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        if ($cart) {
            $item = $cart->cartItems()->find($itemId);
            if ($item && $item->quantity > 1) {
                $item->decrement('quantity');
            }
        }
    }

    public function delete($itemId)
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        if ($cart) {
            $cart->cartItems()->where('id', $itemId)->delete();
            // Удаляем ID из массива выбранных, если он там был
            $this->selectedItems = array_diff($this->selectedItems, [(string)$itemId]);
        }
    }

    public function render()
    {
        $cart = Cart::where('user_id', Auth::id())->first();
        $items = collect();
        $totalPrice = 0;
        $totalQuantity = 0;

        if ($cart) {
            // Чистим битые связи, как в твоем оригинальном CartShowController
            $cart = $cart->fresh(['cartItems.product']);
            foreach ($cart->cartItems as $item) {
                if (!$item->product) {
                    $item->delete();
                }
            }

            $items = $cart->cartItems()->with('product')->get();

            // Считаем итоговые данные ТОЛЬКО для выбранных чекбоксами товаров
            foreach ($items as $item) {
                if (in_array((string)$item->getKey(), $this->selectedItems)) {
                    $totalPrice += $item->getProduct()->getPrice() * $item->getQuantity();
                    $totalQuantity += $item->getQuantity();
                }
            }
        }

        return view('livewire.cart-component', [
            'items' => $items,
            'totalPrice' => $totalPrice,
            'totalQuantity' => $totalQuantity,
        ]);
    }
}
