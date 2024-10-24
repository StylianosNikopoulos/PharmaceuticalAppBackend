<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        // Generate a random manufacturing date
        $manufacturingDate = $this->faker->dateTimeBetween('-2 years', 'now'); 
        $productNames = [
            'Lyrica',
            'Lipitor',
            'Eliquis',
            'Prevnar',
            'Xeljanz',
            'Ibrance',
            'Chantix',
            'Zithromax',
            'Celebrex',
            'Norvasc',
            'Enbrel',
            'Diflucan'
        ];
        $productCategories = ['tablet', 'capsule', 'injection'];
        $productStatuses = ['under development', 'in clinical trials', 'completed'];

        // List of available ingredients
        $availableIngredients =  [
            'Lactose',
            'Magnesium Stearate',
            'Microcrystalline Cellulose',
            'Talc',
            'Silicon Dioxide',
            'Starch',
            'Calcium Carbonate',
            'Sodium Starch Glycolate',
            'Gelatin',
            'Polyethylene Glycol',
            'Hypromellose',
            'Titanium Dioxide',
            'Sucrose',
            'Povidone',
            'Propylene Glycol',
            'Sodium Lauryl Sulfate',
            'Citric Acid',
            'Croscarmellose Sodium',
            'Stearic Acid',
            'Mannitol'
        ];

        // Select a random number of ingredients (between 2 and 5 ingredients, for example)
        $randomIngredients = collect($availableIngredients)
            ->random(rand(2, 5))  // Choose a random number of ingredients
            ->toArray();

        // Convert the array of selected ingredients into a comma-separated string
        $productIngredients = implode(', ', $randomIngredients);


        return [
            //
            'name' => $this->faker->unique()->randomElement($productNames),
            'category' => $this->faker->randomElement($productCategories),
            //Will update for better batch numbers
            'batch_number' => (string)$this->faker->randomNumber(9, true),
            'active_ingredients'=> $productIngredients,
            'status' => $this->faker->randomElement($productStatuses),
            'manufacturing_date' => $manufacturingDate,
            'expiration_date' => $this->faker->dateTimeBetween($manufacturingDate, '+3 years'),
        ];
    }
}
