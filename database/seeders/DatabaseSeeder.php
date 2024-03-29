<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use PhpParser\Node\Stmt\Foreach_;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    private $permissions =[
        'role-list',
        'role-create',
        'role-edit',
        'role-delete'

    ];
    public function run(): void
    {
       foreach($this->permissions as $permission){
        Permission::create(['name'=>$permission]);
       }
       $user = User::create([
        'name'=>'Diacon Cristian',
        'email'=>'diacon.cristian@elev.cihcahul.md',
        'password'=> Hash::make('Cristi2004')
       ]);

       $role =Role::create(['name' => 'Admin']);

       $permissions =Permission::pluck('id','id')->all();

       $role->syncPermissions($permissions);

       $user->assignRole([$role->id]);
    }
}