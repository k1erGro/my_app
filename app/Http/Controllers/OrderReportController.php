<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderReportController extends Controller
{
    public function index()
    {
        $reports = OrderReport::where('user_id', Auth::id())->with('order')->latest()->get();
        return view('shop.order-report.index', compact('reports'));
    }

    public function create(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Это не ваш заказ');
        }

        $existingReport = OrderReport::where('user_id', Auth::id())
            ->where('order_id', $order->getKey())
            ->first();

        if ($existingReport) {
            return redirect()->route('order-report.edit', $existingReport->getKey())
                ->with('info', 'Вы уже создавали вопрос по этому заказу. Здесь вы можете его изменить.');
        }

        $user = Auth::user();
        return view('shop.order-report.create', compact('order', 'user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|exists:orders,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $exists = OrderReport::where('user_id', Auth::id())
            ->where('order_id', $request->order_id)
            ->exists();

        if ($exists) {
            return redirect()->back()->with('error', 'Вы уже создали вопрос по этому заказу.');
        }

        OrderReport::create([
            'order_id' => $request->order_id,
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('orders.show', $request->order_id)
            ->with('success', 'Ваш вопрос успешно отправлен администрации!');
    }

    public function edit(OrderReport $report)
    {
        if ($report->user_id !== Auth::id()) {
            abort(403);
        }

        if ($report->admin_answer) {
            return redirect()->route('order-report.index')
                ->with('error', 'Нельзя изменить вопрос, на который уже получен ответ.');
        }

        return view('shop.order-report.edit', compact('report'));
    }

    public function update(Request $request, OrderReport $report)
    {
        if ($report->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $report->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('order-report.index')
            ->with('success', 'Вопрос успешно обновлен!');
    }

    public function adminIndex()
    {
        $reports = OrderReport::with(['user', 'order'])->latest()->get();
        return view('admin.order-reports.index', compact('reports'));
    }

    public function adminAnswer(Request $request, OrderReport $report)
    {
        $request->validate([
            'admin_answer' => 'required|string',
        ]);

        $report->update([
            'admin_answer' => $request->admin_answer
        ]);

        return redirect()->back()->with('success', 'Ответ успешно отправлен пользователю!');
    }
}
