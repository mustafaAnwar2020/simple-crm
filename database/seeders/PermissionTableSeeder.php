<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{
$permissions = [
'role-list',
'role-create',
'role-edit',
'role-delete',
'user-list',
'user-create',
'user-edit',
'user-delete',
'project-list',
'project-create',
'project-edit',
'project-delete',
'task-list',
'task-create',
'task-edit',
'task-delete',
'client-list',
'client-create',
'client-edit',
'client-delete'

];
foreach ($permissions as $permission) {
Permission::create(['name' => $permission]);
}
}
}
