<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Roses',
                'description' => 'Beautiful roses in various colors and arrangements.',
                'sort_order' => 1,
            ],
            [
                'name' => 'Bouquets',
                'description' => 'Hand-crafted bouquets for all occasions.',
                'sort_order' => 2,
            ],
            [
                'name' => 'Arrangements',
                'description' => 'Stunning floral arrangements for your home or office.',
                'sort_order' => 3,
            ],
            [
                'name' => 'Seasonal',
                'description' => 'Seasonal flowers and special holiday arrangements.',
                'sort_order' => 4,
            ],
            [
                'name' => 'Plants',
                'description' => 'Indoor and outdoor plants that last.',
                'sort_order' => 5,
            ],
            [
                'name' => 'Gifts',
                'description' => 'Flowers with chocolates, teddy bears, and other gifts.',
                'sort_order' => 6,
            ],
            [
                'name' => 'Wedding',
                'description' => 'Special arrangements for your big day.',
                'sort_order' => 7,
            ],
            [
                'name' => 'Sympathy',
                'description' => 'Thoughtful arrangements to express your condolences.',
                'sort_order' => 8,
            ],
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category['name'],
                'slug' => Str::slug($category['name']),
                'description' => $category['description'],
                'is_active' => true,
                'sort_order' => $category['sort_order'],
            ]);
        }

        // Create some subcategories
        $roseCategory = Category::where('slug', 'roses')->first();
        if ($roseCategory) {
            $roseSubcategories = [
                [
                    'name' => 'Red Roses',
                    'description' => 'Classic red roses symbolizing love and passion.',
                    'sort_order' => 1,
                ],
                [
                    'name' => 'White Roses',
                    'description' => 'Elegant white roses for weddings and pure expressions.',
                    'sort_order' => 2,
                ],
                [
                    'name' => 'Pink Roses',
                    'description' => 'Gentle pink roses expressing gratitude and admiration.',
                    'sort_order' => 3,
                ],
                [
                    'name' => 'Yellow Roses',
                    'description' => 'Bright yellow roses symbolizing friendship and joy.',
                    'sort_order' => 4,
                ],
            ];

            foreach ($roseSubcategories as $subcategory) {
                Category::create([
                    'name' => $subcategory['name'],
                    'slug' => Str::slug($subcategory['name']),
                    'description' => $subcategory['description'],
                    'is_active' => true,
                    'parent_id' => $roseCategory->id,
                    'sort_order' => $subcategory['sort_order'],
                ]);
            }
        }

        $bouquetCategory = Category::where('slug', 'bouquets')->first();
        if ($bouquetCategory) {
            $bouquetSubcategories = [
                [
                    'name' => 'Birthday Bouquets',
                    'description' => 'Celebratory bouquets for birthdays.',
                    'sort_order' => 1,
                ],
                [
                    'name' => 'Anniversary Bouquets',
                    'description' => 'Romantic bouquets to celebrate your special day.',
                    'sort_order' => 2,
                ],
                [
                    'name' => 'Congratulations Bouquets',
                    'description' => 'Bouquets to celebrate achievements and milestones.',
                    'sort_order' => 3,
                ],
            ];

            foreach ($bouquetSubcategories as $subcategory) {
                Category::create([
                    'name' => $subcategory['name'],
                    'slug' => Str::slug($subcategory['name']),
                    'description' => $subcategory['description'],
                    'is_active' => true,
                    'parent_id' => $bouquetCategory->id,
                    'sort_order' => $subcategory['sort_order'],
                ]);
            }
        }
    }
}