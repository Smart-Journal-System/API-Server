<?php

use Illuminate\Database\Seeder;

use App\User;
use App\Organization;
use App\OrganizationUser;

use Illuminate\Support\Facades\Hash;

class OrganizationUserSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employees = [
            'Curtis', 'Nikki', 'Mu', 'Tahamid', 'Harbind'
        ];

        $organization = Organization::create([
            'name' => 'Smart Journal System'
        ]);

        $this->command->info('Smart Journal System organization has been created');

        foreach ($employees as $employee) {
            $user = User::create([
                'email' => $employee . '@smartjournalsystem.com',
                'username' => $employee,
                'password' => Hash::make($employee),
            ]);

            $this->command->info($employee . ' user has been created');

            OrganizationUser::create([
                'user_id' => $user->id,
                'organization_id' => $organization->id
            ]);

            $this->command->info($employee . ' has been added to the ' . $organization->name . ' organization');
        }
    }
}
