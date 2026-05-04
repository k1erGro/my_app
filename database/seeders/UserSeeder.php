<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            ['l_name' => 'Никитин', 'f_name' => 'Кирилл', 'm_name' => 'Анатольевич', 'email' => 'kirillnik522@gmail.com', 'password' => 'qwe123', 'birthday' => '2006-07-28', 'phone' => '+7 (123) 123-45-67', 'address' => 'ул. Пархоменко 105'],
            ['l_name' => 'Балакин', 'f_name' => 'Сергей', 'm_name' => 'Михайлович', 'email' => 'silige3dmodel@gmail.com', 'password' => 'qwe123', 'birthday' => '2006-09-03', 'phone' => '+7 (456) 123-45-67', 'address' => 'ул. Ленина 28'],
            ['l_name' => 'Алленов', 'f_name' => 'Антон', 'm_name' => 'Алексеевич', 'email' => 'anton123@gmail.com', 'password' => 'qwe123', 'birthday' => '2006-09-03', 'phone' => '+7 (789) 123-45-67', 'address' => 'пр. Мира 53'],
            ['l_name' => 'Калинин', 'f_name' => 'Максим', 'm_name' => 'Владимирович', 'email' => 'kalina123@gmail.com', 'password' => 'qwe123', 'birthday' => '2006-08-08', 'phone' => '+7 (123) 456-78-90', 'address' => 'ул. Ленина 76'],
            ['l_name' => 'Орлов', 'f_name' => 'Константин', 'm_name' => 'Юрьевич', 'email' => 'register_aqua@gmail.com', 'password' => 'qwe123', 'birthday' => '2006-10-16', 'phone' => '+7 (123) 190-45-67', 'address' => 'ул. Красноармейская 12'],
            ['l_name' => 'Новожилов', 'f_name' => 'Никита', 'm_name' => 'Алексеевич', 'email' => 'mrnaiko@gmail.com', 'password' => 'qwe123', 'birthday' => '2006-03-09', 'phone' => '+7 (123) 167-45-67', 'address' => 'ул. Красная 54'],
            ['l_name' => 'Черкасов', 'f_name' => 'Евгений', 'm_name' => 'Вениаминович', 'email' => 'neton1333@gmail.com', 'password' => 'qwe123', 'birthday' => '2006-08-10', 'phone' => '+7 (123) 76-45-67', 'address' => 'ул. Дружинина 54'],
            ['l_name' => 'Цветков', 'f_name' => 'Артем', 'm_name' => 'Васильевич', 'email' => 'bampir24@gmail.com', 'password' => 'qwe123', 'birthday' => '2006-12-01', 'phone' => '+7 (678) 123-45-67', 'address' => 'ул. Циолковского 67'],
            ['l_name' => 'Шелепов', 'f_name' => 'Данил', 'm_name' => 'Александрович', 'email' => 'k1nanogo@gmail.com', 'password' => 'qwe123', 'birthday' => '2006-07-30', 'phone' => '+7 (866) 132-49-67', 'address' => 'ул. Пархоменко 13'],
        ];

        foreach ($users as $user) {
            User::create([
                'l_name' => $user['l_name'],
                'f_name' => $user['f_name'],
                'm_name' => $user['m_name'],
                'email' => $user['email'],
                'password' => $user['password'],
                'birthday' => $user['birthday'],
                'phone' => $user['phone'],
                'address' => $user['address']
            ]);
        }
    }
}
