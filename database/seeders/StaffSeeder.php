<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Staff;

class StaffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $staff= [
            [
              'name' => 'Somar Kesen',
              'tittle' => 'Backend | work coordinator',
              'email' => 'freelancer@somar-kesen.com',
              'linkedin' => 'https://www.linkedin.com/in/somarkn99/',
              'website' => 'www.somar-kesen.com',
            ],
            [
                'name' => 'Kinan Khoja',
                'tittle' => 'Forntend',
                'email' => 'Khoja.kinan@gmail.com',
                'linkedin' => 'https://www.linkedin.com/in/kinan-khoja-3158881a8/',
                'website' => '',
              ],
              [
                'name' => 'Maya Amen Basha',
                'tittle' => 'UI/UX',
                'email' => 'maya1391a@gmail.com',
                'linkedin' => 'https://www.linkedin.com/in/maya-amin-basha-b60b27229/',
                'website' => '',
              ],
              [
                'name' => 'Michel Ibrahim',
                'tittle' => 'Mobile',
                'email' => 'mishealibrahim1994@gmail.com',
                'linkedin' => 'https://www.linkedin.com/in/michel-ibrahim-4a2b841b0/',
                'website' => '',
              ]
            ];

        Staff::insert($staff);
    }
}
