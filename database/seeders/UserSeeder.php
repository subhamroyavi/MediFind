<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Service;
use App\Models\Location;
use App\Models\Ambulance;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $organizationTypes = ['government', 'private', 'ngo'];
        $serviceTypes = ['basic', 'advanced', 'critical'];
        $cities = ['Mumbai', 'Delhi', 'Bangalore', 'Hyderabad', 'Chennai'];
        $states = ['Maharashtra', 'Delhi', 'Karnataka', 'Telangana', 'Tamil Nadu'];
        $vehicleModels = ['Tata Winger', 'Force Traveller', 'Mahindra Supro', 'Toyota HiAce'];

        for ($i = 1; $i <= 20; $i++) {
            // Create ambulance data with validation rules in mind
            $ambulanceData = [
                'first_name' => 'Driver',
                'last_name' => '#' . $i,
                'email' => 'ambulance' . $i . '@example.com',
                'phone' => '9' . mt_rand(100000000, 999999999),
                'license_number' => 'LIC' . mt_rand(10000, 99999),
                'vehicle_number' => 'MH-' . $faker->unique()->numerify('##-####'),
                'vehicle_model' => $vehicleModels[array_rand($vehicleModels)],
                'organization_type' => $organizationTypes[array_rand($organizationTypes)],
                'service_type' => $serviceTypes[array_rand($serviceTypes)],
                'insurance_number' => 'INS' . mt_rand(10000, 99999),
                'status' => mt_rand(0, 1),
                // Image is nullable, so we can skip it or add random images if needed
            ];

            // Create location data
            $locationData = [
                'address_line1' => mt_rand(1, 999) . ' ' . $faker->streetName,
                'address_line2' => 'Area ' . chr(mt_rand(65, 90)),
                'city' => $cities[array_rand($cities)],
                'district' => 'District ' . mt_rand(1, 20),
                'state' => $states[array_rand($states)],
                'pincode' => $faker->postcode,
                'country' => 'India',
                'google_maps_link' => 'https://maps.google.com/?q=' . $faker->latitude . ',' . $faker->longitude,
            ];

            try {
                // Create the ambulance
                $ambulance = Ambulance::create($ambulanceData);

                // Create the associated location
                Location::create(array_merge(
                    $locationData,
                    [
                        'entity_type' => 'ambulance',
                        'entity_id' => $ambulance->ambulance_id,
                    ]
                ));
            } catch (\Exception $e) {
                // Log or handle the error
                logger()->error('Error creating ambulance: ' . $e->getMessage());
                continue; // Skip to next iteration if there's an error
            }
        }
    }
}
