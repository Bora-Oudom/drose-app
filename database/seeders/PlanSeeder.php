<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans=[
            [
                'name' =>'Basic Plan',
                'slug' =>'basic-plan',
                'stripe_plan' =>'price_1NGZtqKorNiCxdkXTN6eP0m1',
                'price' =>4.99,
                'description' =>'Basic Plan'
            ],
            [
                'name' =>'Standard Plan',
                'slug' =>'standard-plan',
                'stripe_plan' =>'price_1NGdxWKorNiCxdkXDr3xkQ3D',
                'price' =>7.99,
                'description' =>'Standard Plan'
            ],
            [
                'name' =>'Premium Plan',
                'slug' =>'premium-plan',
                'stripe_plan' =>'price_1NGdxWKorNiCxdkXYpqRG89w',
                'price' =>9.99,
                'description' =>'Premium Plan'
            ],
        ]; 
        foreach($plans as $plan){
            Plan::create($plan);
        }  
    }
}
