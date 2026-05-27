<?php

namespace App\Http\Controllers\Admin\Users;

use App\Enums\RoleEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UpdateUserController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UpdateRequest $request, User $user)
    {
        // 1. Проверяем права текущего авторизованного админа (твоя стандартная политика)
        $this->authorize('update', $user);

        $chosenRole = $request->validated()['role'];

        // 2. Защита от "самоубийства" прав: не даем текущему админу снять с себя управляющую роль
        if (auth()->id() === $user->getKey() && $chosenRole === 'User') {
            return redirect()->back()->withErrors([
                'role' => 'Вы не можете перевести в статус обычного пользователя самого себя!'
            ]);
        }

        // 3. Синхронизируем роль в Spatie Permission
        if ($chosenRole === 'User') {
            // Если выбран дефолтный пользователь, просто очищаем все спец-роли из Spatie
            $user->syncRoles([]);
        } else {
            // Если выбрана конкретная роль (Director, Manager, TechnicalSpecialist), привязываем её
            $user->syncRoles([$chosenRole]);
        }

        // 4. Редирект обратно на список пользователей в админке с красивым уведомлением
        return redirect()->route('admin.index')->with('message', 'Роль пользователя успешно обновлена!');
    }
}
