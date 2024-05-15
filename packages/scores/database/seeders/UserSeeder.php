<?php

namespace Leo\Scores\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Leo\Users\Models\User;
use Leo\Users\Role;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            "John Smith", "Jane Doe", "Michael Johnson", "Emily Davis", "James Brown",
            "Patricia Wilson", "Robert Jones", "Linda Garcia", "David Miller", "Barbara Martinez",
            "William Anderson", "Elizabeth Taylor", "Joseph Thomas", "Jennifer Hernandez",
            "Charles Moore", "Maria Martin", "Christopher Jackson", "Susan Lee", "Daniel Perez",
            "Margaret White", "Matthew Harris", "Dorothy Clark", "Anthony Lewis", "Sarah Robinson",
            "Mark Walker", "Jessica Young", "Donald Allen", "Karen King", "Paul Wright", "Nancy Scott",
            "Steven Green", "Betty Adams", "George Baker", "Sandra Gonzalez", "Kenneth Nelson",
            "Ashley Carter", "Andrew Mitchell", "Kimberly Perez", "Joshua Roberts", "Deborah Turner",
            "Edward Phillips", "Laura Campbell", "Brian Parker", "Amy Evans", "Kevin Edwards",
            "Melissa Collins", "Jason Stewart", "Rebecca Sanchez", "Gary Morris", "Stephanie Rogers",
            "Timothy Reed", "Sharon Cook", "Ronald Morgan", "Kathleen Bell", "Jeffrey Murphy",
            "Anna Bailey", "Ryan Rivera", "Brenda Cooper", "Jacob Richardson", "Pamela Cox",
            "Stephen Howard", "Nicole Ward", "Larry Brooks", "Kathryn Diaz", "Frank Price",
            "Diane Simmons", "Scott Bennett", "Rachel Butler", "Eric Foster", "Catherine Gonzales",
            "Justin Henderson", "Christine Russell", "Raymond Griffin", "Heather Flores",
            "Gregory Cruz", "Teresa Fisher", "Benjamin Kim", "Judith Long", "Samuel Peterson",
            "Shirley Powell", "Patrick Perry", "Alice Bryant", "Alexander Ramirez", "Megan James",
            "Jack Watson", "Ruth Hughes", "Dennis Alexander", "Jean Sanders", "Jerry Myers",
            "Cheryl Ross", "Tyler Kelly", "Andrea Diaz", "Aaron Ward", "Mariah Ruiz",
            "Douglas Hughes", "Evelyn Foster", "Adam Simmons", "Beverly Bryant"
        ];
        $idRole = Role::where('name','players')->value('id');
        foreach ($names as $name) {
            User::create([
                'name' => $name,
                'email' => strtolower(str_replace(' ', '.', $name)) . '@example.com',
                'password' => Hash::make('password'),
                'idRole'=>$idRole,
                'phone' => '03' . mt_rand(10000000, 99999999), // Generating random phone numbers starting with 03
            ]);
        }

    }
}
