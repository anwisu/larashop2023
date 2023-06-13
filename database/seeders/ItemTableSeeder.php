<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $item = new Item([
            'image_path' => 'https://www.yumiko.pl/wp-content/uploads/2020/08/exo-the-war.jpg',
            'title' => 'EXO - The War',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt',
            'cost_price' => 10,
            'sell_price' => 15
        ]);
        $item->save();

        $item = new Item([
            'image_path' => 'https://www.yumiko.pl/wp-content/uploads/2022/04/SEVENTEEN-FACE-THE-SUN.png',
            'title' => 'SEVENTEEN - Face The Sun',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt',
            'cost_price' => 10,
            'sell_price' => 15
        ]);
        $item->save();

        $item = new Item([
            'image_path' => 'https://www.yumiko.pl/wp-content/uploads/2021/06/BTS-Butter.png',
            'title' => 'BTS - Butter',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ',
            'cost_price' => 10,
            'sell_price' => 15
        ]);
        $item->save();

        $item = new Item([
            'image_path' => 'https://www.yumiko.pl/wp-content/uploads/2022/09/LE-SSERAFIM-ANTIFRAGILE.jpg',
            'title' => 'LE SSERAFIM - ANTIFRAGILE',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt',
            'cost_price' => 10,
            'sell_price' => 15
        ]);
        $item->save();

        $item = new Item([
            'image_path' => 'https://www.yumiko.pl/wp-content/uploads/2023/02/926525-1-scaled.jpg',
            'title' => 'TWICE - READY TO BE ',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt',
            'cost_price' => 10,
            'sell_price' => 15
        ]);
        $item->save();

        $item = new Item([
            'image_path' => 'https://www.yumiko.pl/wp-content/uploads/2022/06/ITZY-CHECKMATE-STANDARD-EDITION-1.png',
            'title' => 'ITZY - CHECKMATE',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt',
            'cost_price' => 10,
            'sell_price' => 15
        ]);
        $item->save();
    }

}


