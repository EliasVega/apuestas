<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = Role::create(['name' => 'superAdmin']);
        $admin = Role::create(['name' => 'admin']);
        $operatings = Role::create(['name' => 'operatings']);
        $purchases = Role::create(['name' => 'purchases']);
        $sales = Role::create(['name' => 'sales']);

        Permission::create(['name' => 'superAdmin', 'description' => 'derechos solo superadministrador', 'status' => 'locked'])->syncRoles([$superAdmin]);

        Permission::create(['name' => 'cashInflow.index', 'description' => 'Listado Entrada de efectivo', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'cashInflow.store', 'description' => 'Crear Entradas de efectivo', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);

        Permission::create(['name' => 'cashOutflow.index', 'description' => 'Listado Salida de efectivo', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'cashOutflow.store', 'description' => 'crear Salida de efectivo', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);

        Permission::create(['name' => 'cashRegister.index', 'description' => 'Listado Cajas', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'cashRegister.create', 'description' => 'Crear Caja', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'cashRegister.show', 'description' => 'Ver Caja', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'cashRegister.edit', 'description' => 'Cerrar caja', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings]);

        Permission::create(['name' => 'company.index', 'description' => 'Listado Compañias', 'status' => 'active'])->syncRoles([$superAdmin, $admin]);
        Permission::create(['name' => 'company.create', 'description' => 'Crear Compañia', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'company.show', 'description' => 'Ver Compañia', 'status' => 'active'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'company.edit', 'description' => 'Editar Compañia', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'company.destroy', 'description' => 'Eliminar Compañia', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'company.companyStatus', 'description' => 'Estado Compañia', 'status' => 'locked'])->syncRoles([$superAdmin]);

        Permission::create(['name' => 'dashboard.index', 'description' => 'Dashboard', 'status' => 'active'])->syncRoles([$superAdmin, $admin]);

        Permission::create(['name' => 'department.index', 'description' => 'Listado Departamentos', 'status' => 'active'])->assignRole($superAdmin, $admin, $operatings, $purchases, $sales);
        Permission::create(['name' => 'department.create', 'description' => 'Crear Departamento', 'status' => 'locked'])->assignRole($superAdmin);
        Permission::create(['name' => 'department.show', 'description' => 'Ver Departamento', 'status' => 'locked'])->assignRole($superAdmin);
        Permission::create(['name' => 'department.edit', 'description' => 'Editar Departamento', 'status' => 'locked'])->assignRole($superAdmin);
        Permission::create(['name' => 'department.destroy', 'description' => 'Eliminar Departamento', 'status' => 'locked'])->assignRole($superAdmin);

        Permission::create(['name' => 'indicator.index', 'description' => 'Indicador', 'status' => 'active'])->syncRoles([$superAdmin, $admin, $operatings, $purchases, $sales]);
        Permission::create(['name' => 'indicator.edit', 'description' => 'Editar Indicador', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'indicator.dianStatus', 'description' => 'Activa documentos electronicos', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'indicator.posStatus', 'description' => 'Activar Post', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'indicator.logoStatus', 'description' => 'Activar Logo', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'indicator.payrollStatus', 'description' => 'Activar Nomina', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'indicator.accountingStatus', 'description' => 'Activar contabilidad', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'indicator.inventoryStatus', 'description' => 'Manejo inventario', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'indicator.productPrice', 'description' => 'Manejo Precio Producto', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'indicator.materialStatus', 'description' => 'activar Materias primas', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'indicator.restaurantStatus', 'description' => 'activar Restaurantes', 'status' => 'locked'])->syncRoles([$superAdmin]);

        Permission::create(['name' => 'lottery.index', 'description' => 'Listado Loterias', 'status' => 'active'])->assignRole($superAdmin, $admin, $operatings, $purchases, $sales);
        Permission::create(['name' => 'lottery.create', 'description' => 'Crear Loteria', 'status' => 'locked'])->assignRole($superAdmin);
        Permission::create(['name' => 'lottery.show', 'description' => 'Ver Loteria', 'status' => 'locked'])->assignRole($superAdmin);
        Permission::create(['name' => 'lottery.edit', 'description' => 'Editar Loteria', 'status' => 'locked'])->assignRole($superAdmin);
        Permission::create(['name' => 'lottery.destroy', 'description' => 'Eliminar Loteria', 'status' => 'locked'])->assignRole($superAdmin);

        Permission::create(['name' => 'municipality.index', 'description' => 'Listado municipios', 'status' => 'active'])->assignRole($superAdmin, $admin, $operatings, $purchases, $sales);
        Permission::create(['name' => 'municipality.create', 'description' => 'Crear municipio', 'status' => 'locked'])->assignRole($superAdmin);
        Permission::create(['name' => 'municipality.show', 'description' => 'Ver municipio', 'status' => 'locked'])->assignRole($superAdmin);
        Permission::create(['name' => 'municipality.edit', 'description' => 'Editar municipio', 'status' => 'locked'])->assignRole($superAdmin);
        Permission::create(['name' => 'municipality.destroy', 'description' => 'Eliminar municipio', 'status' => 'locked'])->assignRole($superAdmin);

        Permission::create(['name' => 'permission.index', 'description' => 'Listado permisos', 'status' => 'active'])->syncRoles([$superAdmin, $admin]);
        Permission::create(['name' => 'permission.create', 'description' => 'Crear permisos', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'permission.show', 'description' => 'Ver permisos', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'permission.edit', 'description' => 'Editar permisos', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'permission.destroy', 'description' => 'Eliminar permisos', 'status' => 'locked'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'permission.permissionStatus', 'description' => 'Permiso estado', 'status' => 'locked'])->syncRoles([$superAdmin]);

        Permission::create(['name' => 'play.index', 'description' => 'Listado Juegos', 'status' => 'active'])->assignRole($superAdmin, $admin, $operatings, $purchases, $sales);
        Permission::create(['name' => 'play.create', 'description' => 'Crear Juego', 'status' => 'locked'])->assignRole($superAdmin);
        Permission::create(['name' => 'play.show', 'description' => 'Ver Juego', 'status' => 'locked'])->assignRole($superAdmin);
        Permission::create(['name' => 'play.edit', 'description' => 'Editar Juego', 'status' => 'locked'])->assignRole($superAdmin);
        Permission::create(['name' => 'play.destroy', 'description' => 'Eliminar Juego', 'status' => 'locked'])->assignRole($superAdmin);

        Permission::create(['name' => 'prohibitedNumber.index', 'description' => 'Listado Betados', 'status' => 'active'])->assignRole($superAdmin, $admin, $operatings, $purchases, $sales);
        Permission::create(['name' => 'prohibitedNumber.create', 'description' => 'Crear Numero Betado', 'status' => 'locked'])->assignRole($superAdmin);
        Permission::create(['name' => 'prohibitedNumber.show', 'description' => 'Ver numero vetado', 'status' => 'locked'])->assignRole($superAdmin);
        Permission::create(['name' => 'prohibitedNumber.edit', 'description' => 'Editar numero vetado', 'status' => 'locked'])->assignRole($superAdmin);
        Permission::create(['name' => 'prohibitedNumber.destroy', 'description' => 'Eliminar numero vetado', 'status' => 'locked'])->assignRole($superAdmin);

        Permission::create(['name' => 'rol.index', 'description' => 'Listado roles', 'status' => 'active'])->syncRoles([$superAdmin, $admin]);
        Permission::create(['name' => 'rol.create', 'description' => 'Crear rol', 'status' => 'active'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'rol.show', 'description' => 'Ver rol', 'status' => 'active'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'rol.edit', 'description' => 'Editar rol', 'status' => 'active'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'rol.destroy', 'description' => 'Eliminar rol', 'status' => 'locked'])->syncRoles([$superAdmin]);

        Permission::create(['name' => 'user.index', 'description' => 'Listado usuarios', 'status' => 'active'])->syncRoles([$superAdmin, $admin]);
        Permission::create(['name' => 'user.create', 'description' => 'Crear usuario', 'status' => 'active'])->syncRoles([$superAdmin, $admin]);
        Permission::create(['name' => 'user.show', 'description' => 'Ver usuario', 'status' => 'active'])->syncRoles([$superAdmin, $admin]);
        Permission::create(['name' => 'user.edit', 'description' => 'Editar usuario', 'status' => 'active'])->syncRoles([$superAdmin, $admin]);
        Permission::create(['name' => 'user.destroy', 'description' => 'Eliminar usuario', 'status' => 'active'])->syncRoles([$superAdmin]);
        Permission::create(['name' => 'user.status', 'description' => 'Estado usuario', 'status' => 'active'])->syncRoles([$superAdmin, $admin]);
        Permission::create(['name' => 'user.locked', 'description' => 'Desactivar usuario', 'status' => 'active'])->syncRoles([$superAdmin, $admin]);
    }
}
