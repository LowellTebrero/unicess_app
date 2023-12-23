<?php

namespace Database\Factories;

use App\Models\CustomizeAdminInventory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CustomizeAdminInventory>
 */
class CustomizeAdminInventoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = CustomizeAdminInventory::class;

    public function definition()
    {
        return [

            'number' =>1
        ];
    }
}
