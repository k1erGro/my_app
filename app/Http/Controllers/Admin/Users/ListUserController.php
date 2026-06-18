<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ListUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $query = User::query();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('l_name', 'like', "%{$search}%")
                    ->orWhere('f_name', 'like', "%{$search}%")
                    ->orWhere('m_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%")
                    ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $sortField = $request->get('sort', 'id');
        $sortDirection = $request->get('direction', 'desc');

        $allowedSorts = ['id', 'l_name', 'email', 'phone', 'created_at'];
        if (!in_array($sortField, $allowedSorts)) {
            $sortField = 'id';
        }

        $query->orderBy($sortField, $sortDirection);

        $users = $query->paginate(8);
        $users->appends($request->only(['search', 'sort', 'direction']));

        return view('admin.user.index', compact('users'));
    }
}
