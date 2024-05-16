<?php

namespace Database\Seeders;

use App\Models\Attribute;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $attributes = [
            [
                'name' => 'Color',
                'values' => ['Black', 'Blue', 'Red'],
            ],
            [
                'name' => 'RAM',
                'values' => ['8GB', '16GB'],
            ],
            [
                'name' => 'Storage',
                'values' => ['64GB', '128GB', '256GB'],
            ],
        ];

        foreach ($attributes as $attribute) {
            DB::transaction(function() use ($attribute) {
                $createdAttribute = Attribute::create(['name' => $attribute['name']]);
                foreach ($attribute['values'] as $value) {
                    $createdAttribute->attributeOptions()->create(['value' => $value]);
                }
            });
        }
    }
}
