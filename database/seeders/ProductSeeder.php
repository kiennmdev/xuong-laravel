<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductSize;
use App\Models\ProductColor;
use App\Models\ProductGallery;
use App\Models\ProductVariant;
use App\Models\Tag;
use \Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        ProductVariant::query()->truncate();
        ProductGallery::query()->truncate();
        DB::table('product_tag')->truncate();
        Product::query()->truncate();
        ProductSize::query()->truncate();
        ProductColor::query()->truncate();
        Tag::query()->truncate();

        Tag::factory(15)->create();

        //s, m , l, xl, xxl
        foreach (['S', 'M', "L", "XL", "XXL"] as $item) {
            ProductSize::query()->create([
                'name' => $item
            ]);
        }

        foreach (['#0000FF', '#FF00FF', "#33CCFF", "FF0033", "00EE00"] as $item) {
            ProductColor::query()->create([
                'name' => $item
            ]);
        }

        for ($i = 0; $i < 1000; $i++) {
            $name = fake()->text(80);
            Product::query()->create([
                'catalogue_id' => rand(1, 6),
                'name' => $name,
                'slug' => Str::slug($name) . '-' . Str::random(8),
                'sku' => Str::random(7) . $i,
                'img_thumbnail' => 'https://canifa.com/img/500/750/resize/6/o/6ot24s002-sb001-thumb.webp',
                'price_regular' => 600000,
                'price_sale' => 300000,
            ]);
        }

        for ($i = 1; $i < 1001; $i++) {
            ProductGallery::query()->insert(
                [
                    [
                        'product_id' => $i,
                        'image' => 'https://canifa.com/img/500/750/resize/6/o/6ot24s002-sb001-thumb.webp',
                    ],
                    [
                        'product_id' => $i,
                        'image' => 'https://canifa.com/img/500/750/resize/6/o/6ot24s002-sb001-thumb.webp',
                    ],
                ]
            );
            // ProductGallery::query()->create([
            //     'product_id' => $i,
            //     'image' => 'https://canifa.com/img/500/750/resize/6/o/6ot24s002-sb001-thumb.webp',
            // ]);
        }

        for ($i = 1; $i < 1001; $i++) {
            DB::table('product_tag')->insert([
                [
                    'product_id' => $i,
                    'tag_id' => rand(1, 8)
                ],
                [
                    'product_id' => $i,
                    'tag_id' => rand(9, 15)
                ],
            ]);
        }

        for ($productID = 1; $productID < 1001; $productID++) {

            $data = [];

            for ($sizeID = 1; $sizeID < 6; $sizeID++) {

                for ($colorID = 1; $colorID < 6; $colorID++) {
                    $data[] = [
                        'product_id' => $productID,
                        'product_size_id' => $sizeID,
                        'product_color_id' => $colorID,
                        'quantity' => 100,
                        'image' => 'https://canifa.com/img/500/750/resize/6/o/6ot24s002-sb001-thumb.webp',
                    ];
                }

            }
            DB::table('product_variants')->insert($data);

        }

       
    }
}
