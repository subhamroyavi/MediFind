<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Contact;
use App\Models\Service;
use App\Models\Facility;
use App\Models\Hospital;
use App\Models\Location;
use App\Models\Ambulance;
use App\Models\OpeningDay;
use Faker\Factory as Faker;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        //hospital
        // for ($i = 0; $i < 20; $i++) {
        //     DB::beginTransaction();

        //     try {
        //         $hospital = Hospital::create([
        //             'hospital_name' => $faker->company . ' Hospital',
        //             'organization_type' => $faker->randomElement(['Government', 'Private', 'NGO']),
        //             'description' => $faker->paragraph,
        //             'status' => $faker->boolean,
        //             'image' => null, // No image in seeder
        //         ]);

        //         // Create contacts
        //         for ($j = 0; $j < 2; $j++) {
        //             Contact::create([
        //                 'hospital_id' => $hospital->hospital_id,
        //                 'contact_type' => $faker->randomElement(['phone', 'email', 'fax']),
        //                 'value' => $faker->phoneNumber,
        //                 'is_primary' => $j === 0,
        //                 'website_link' => $faker->url,
        //             ]);
        //         }

        //         // Create services
        //         for ($j = 0; $j < 3; $j++) {
        //             Service::create([
        //                 'hospital_id' => $hospital->hospital_id,
        //                 'service_name' => $faker->randomElement(['X-Ray', 'Surgery', 'ICU', 'Maternity', 'OPD']),
        //             ]);
        //         }

        //         // Create facilities
        //         for ($j = 0; $j < 3; $j++) {
        //             Facility::create([
        //                 'hospital_id' => $hospital->hospital_id,
        //                 'description' => $faker->sentence,
        //             ]);
        //         }

        //         // Create opening days
        //         foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'] as $day) {
        //             OpeningDay::create([
        //                 'hospital_id' => $hospital->hospital_id,
        //                 'opening_day' => $day,
        //                 'opening_time' => '09:00',
        //                 'closing_time' => '17:00',
        //                 'status' => true,
        //             ]);
        //         }

        //         // Create location
        //         Location::create([
        //             'entity_type' => 'hospital',
        //             'entity_id' => $hospital->hospital_id,
        //             'address_line1' => $faker->streetAddress,
        //             'address_line2' => $faker->secondaryAddress,
        //             'city' => $faker->city,
        //             'district' => $faker->city,
        //             'state' => $faker->state,
        //             'pincode' => $faker->postcode,
        //             'country' => $faker->country,
        //             'google_maps_link' => $faker->url,
        //         ]);

        //         DB::commit();
        //     } catch (\Exception $e) {
        //         DB::rollBack();
        //         dump('Seeder error: ' . $e->getMessage());
        //     }
        // }

        //ambulance
        // Create 10 dummy ambulances
       for ($i = 1; $i <= 10; $i++) {
            $ambulanceData = [
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'email' => $faker->unique()->safeEmail,
                'phone' => $faker->numerify('##########'), // 10-digit number only

                'license_number' => 'LIC' . $faker->unique()->numerify('######'),
                'vehicle_number' => 'KA' . $faker->unique()->numerify('##@@####'),
                'vehicle_model' => $faker->word . ' ' . $faker->randomElement(['HiAce', 'Innova', 'Eeco']),
                'organization_type' => $faker->randomElement(['Private', 'Government']),
                'service_type' => $faker->randomElement(['BLS', 'ALS', 'ICU', 'other']),
                'insurance_number' => 'INS' . $faker->unique()->numerify('######'),
                'status' => $faker->boolean,
                'image' => 'ambulances/sample_image.jpg', // static image file
            ];

            $ambulance = Ambulance::create($ambulanceData);

            $locationData = [
                'address_line1' => $faker->streetAddress,
                'address_line2' => $faker->optional()->secondaryAddress,
                'city' => $faker->city,
                'district' => $faker->citySuffix,
                'state' => $faker->state,
                'pincode' => $faker->postcode,
                'country' => $faker->country,
                'google_maps_link' => 'https://maps.google.com/?q=' . $faker->latitude . ',' . $faker->longitude,
                'entity_type' => 'ambulance',
                'entity_id' => $ambulance->ambulance_id,
            ];

            Location::create($locationData);
        }
    }
}
