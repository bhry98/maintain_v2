<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Traits\EmpTrait;
use App\Traits\RoleTrait;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use EmpTrait, RoleTrait;
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('roles.Roles') as $k => $value) {
            foreach ($value as $kk => $vv) {
                $roles[] = "$k-$kk";
            }
        };
        $roleN = ["ar" => "صلاحية المالك", "en" => "oner roles"];
        $role = $this->AddNewRole($roleN, "Owner", $roles, "1", null);
        // $emp = $this->AddNewEmployee("عبدالرحمن مسؤول", "35265", "bhrabdelrahman8@gmail.com", "bhryemp", "010970", "1", null, null, $role->id, "1", "1");
        // $emp = $this->AddNewEmployee("مدير الكهربا", "35265", "bhrabdelrahman8@gmail.com", "bhryemp", "010970", "1", null, null, $role->id, "1", "1");
    }
}
