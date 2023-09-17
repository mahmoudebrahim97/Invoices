<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Invoice>
 */
class InvoicesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'invoice_number' =>$this->faker->numberBetween(1,1000),
            'invoice_Date' => $this->faker->date(),
            'Due_date' => $this->faker->date(),
            'product' => $this->faker->text(10),
            'section_id' => $this->faker->text(10),
            'Discount' => $this->faker->numberBetween(1,10000),
            'Rate_VAT' => '5%',
            'Value_VAT' => $this->faker->numberBetween(1,100000),
            'Amount_collection' => 21121,
            'Amount_Commission' => 454454,
            'Total' => $this->faker->numberBetween(1,100000),
            'Status' => 'غير مدفوعة',
            'Value_Status' => 2,
            'note' => '',
        ];
    }
}
