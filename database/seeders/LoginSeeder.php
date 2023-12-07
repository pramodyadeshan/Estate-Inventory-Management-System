<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->delete();
        DB::table('system_settings')->delete();
        DB::table('user_roles')->delete();
        DB::table('categories')->delete();
        DB::table('products')->delete();
        DB::table('media_files')->delete();
        DB::table('incomes')->delete();
        DB::table('expenditures')->delete();
        DB::table('states')->delete();
        DB::table('divisions')->delete();
        DB::table('stocks')->delete();
        DB::table('chat_bots')->delete();
        DB::table('chats')->delete();

        DB::table('users')->insert([
            //Super Admin
            'id' => 1,
            'name' => 'Super Admin',
            'username' => 'super',
            'password' => Hash::make('12345678'),
            'status' => 1,
            'role_id' => 1,
            'image' => '1701108377.png',
            'state_id' => '["1"]',
            'current_state' => 1,
            'unread_message' => 0,
            'msg_sender_id' => 2,
            'remember_token' => '',
        ]);

        DB::table('users')->insert([
            //Admin
            'id' => 2,
            'name' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('12345678'),
            'status' => 1,
            'role_id' => 2,
            'image' => '1701108377.png',
            'state_id' => '["1"]',
            'current_state' => 1,
            'unread_message' => 0,
            'msg_sender_id' => 1,
            'remember_token' => '',
        ]);

        DB::table('users')->insert([
            //Employee
            'id' => 3,
            'name' => 'Employee',
            'username' => 'emp',
            'password' => Hash::make('12345678'),
            'status' => 1,
            'role_id' => 3,
            'image' => '1701108377.png',
            'state_id' => '["1"]',
            'current_state' => 1,
            'unread_message' => 0,
            'msg_sender_id' => 1,
            'remember_token' => '',
        ]);

        DB::table('user_roles')->insert([
            //Super Admin
            'id' => 1,
            'role_name' => 'Super Admin',
            'group_level' => 0,
            'status' => 1,
        ]);

        DB::table('user_roles')->insert([
            //Admin
            'id' => 2,
            'role_name' => 'Admin',
            'group_level' => 1,
            'status' => 1,
        ]);

        DB::table('user_roles')->insert([
            //Employee
            'id' => 3,
            'role_name' => 'Employee',
            'group_level' => 2,
            'status' => 1,
        ]);

        DB::table('categories')->insert([
            //Category
            'id' => 1,
            'cate_name' => 'Tea',
        ]);

        DB::table('media_files')->insert([
            //Media File
            'id' => 1,
            'file_name' => '1701108595.png',
            'file_type' => 'image/png',
            'user_id' => '0',
        ]);

        DB::table('products')->insert([
            //Products
            'id' => 1,
            'name' => 'Ceylon Tea',
            'qty' => '20',
            'buy_price' => 100.00,
            'sell_price' => 120.00,
            'manu_date' => '2023-09-30',
            'exp_date' => '2024-01-01',
            'isActive' => 1,
            'cate_id' => '1',
            'img_id' => '1',
            'user_id' => '1',
            'division_id' => '1',
        ]);

        DB::table('system_settings')->insert([
            //System Settings
            'id' => 1,
            'title' => 'Inventory System',
            'logo' => '1701108595.png',
            'footer_title' => '© 2023 Your Company Name. All rights reserved.',
        ]);

        DB::table('incomes')->insert([
            //Income
            'id' => 1,
            'date' => '2024-01-01',
            'note' => 'Sell a laptop',
            'price' => 32500.00,
            'user_id' => '1'
        ]);

        DB::table('expenditures')->insert([
            //Expenditure
            'id' => 1,
            'date' => '2024-01-02',
            'note' => 'Internet Bill',
            'price' => 8500.00,
            'user_id' => '1'
        ]);

        DB::table('states')->insert([
            //States
            'id' => 1,
            'state_name' => 'Test State',
        ]);

        DB::table('divisions')->insert([
            //States
            'id' => 1,
            'division_name' => 'Test Division',
            'state_id' => '1',
        ]);

        DB::table('stocks')->insert([
            //Stocks
            'id' => 1,
            'date' => '2023-12-01',
            'price' => 100.00,
            'qty' => 2,
            'total' => 200.00,
            'division_id' => 1,
            'product_id' => 1,
            'user_id' => 1,
        ]);

        DB::table('chat_bots')->insert([
            //States
            'id' => 1,
            'keyword' => 'Hi',
            'response' => 'Welcome to Chat Bot',
        ]);

        DB::table('chats')->insert([
            //States
            'id' => 1,
            'date_time' => '2023-12-06 04:15 AM',
            'message' => 'Welcome to System',
            'sender_id' => 1,
            'receiver_id' => 2,
            'deliver_status' => 0,
        ]);

    }
}
