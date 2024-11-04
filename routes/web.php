<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\Tipo_ropaController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\PuestoController;
use App\Http\Controllers\TallaController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\CheckIfApproved;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleUserController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Ruta principal que carga la vista welcome
Route::get('/', function () {
    return view('welcome');
});

// Ruta para el HomeController que muestra el dashboard
Route::get('/home', [HomeController::class, 'index'])->name('home');

// Rutas de autenticación (si tu proyecto requiere iniciar sesión y registrarse)
use Illuminate\Support\Facades\Auth;
Auth::routes();

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Rutas de autenticación
Auth::routes();

// Rutas de recursos para productos
Route::resource('products', ProductController::class);

// Rutas de recursos para marcas
Route::resource('/home/marcas', MarcasController::class);
Route::resource('/home/categorias', CategoriaController::class);
Route::resource('/home/tipo_ropas', Tipo_ropaController::class);
Route::resource('/home/empresas', EmpresaController::class);
Route::resource('/home/puestos', PuestoController::class);
Route::resource('/home/tallas', TallaController::class);
Route::resource('/home/ventas', TallaController::class);
Route::resource('/home/productos', ProductoController::class);



Route::resource('admin/proveedores', ProveedorController::class);
Route::resource('empleados', EmpleadoController::class);
Route::get('/proveedores', [ProveedorController::class, 'proveedorUsers'])->name('proveedores.index');
Route::get('/proveedores/create', [ProveedorController::class, 'create'])->name('proveedores.create');
Route::get('/proveedores/{id_proveedor}', [ProveedorController::class, 'show'])->name('proveedores.show');
Route::resource('proveedores', ProveedorController::class);
Route::resource('admin/proveedores', ProveedorController::class);
Route::resource('/admin/ventas', VentaController::class);

Route::resource('productos', ProductoController::class);
Route::resource('/admin/productos', ProductoController::class);
Route::delete('/productos/{id}', [ProductoController::class, 'destroy'])->name('productos.destroy');

Route::resource('entradas', \App\Http\Controllers\EntradaController::class);
Route::resource('/admin/entradas', \App\Http\Controllers\EntradaController::class);
Route::delete('admin/entradas/{entrada}', [\App\Http\Controllers\EntradaController::class, 'destroy'])->name('entradas.destroy');
Route::delete('admin/entradas/{entrada}', [EntradaController::class, 'destroy'])->name('entradas.destroy');



// Rutas administrativas bajo el prefijo 'admin'
Route::prefix('admin')->group(function () {
    Route::resource('products', ProductController::class);
});

// Rutas API para productos (si es necesario)
Route::apiResource('/home/products', ProductController::class);

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::post('/approve-user/{id}', [AdminController::class, 'approveUser'])->name('approve.user');
});
Route::post('/admin/approve-user/{userId}', [AdminController::class, 'approveUser'])->name('admin.approve.user');

Route::get('/pending-users', [AdminController::class, 'showPendingUsers'])->name('pending.users');

// Ruta para mostrar usuarios no aprobados
Route::get('/admin/pending-users', [AdminController::class, 'showPendingUsers'])->name('admin.pending.users');

Route::get('/usuarios-no-aprobados', [AdminController::class, 'usuariosNoAprobados'])->name('usuarios.no.aprobados');


Route::middleware(['auth', CheckIfApproved::class])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    // otras rutas protegidas
});

// Ruta para usuarios en espera de aprobación
Route::get('/pendiente-aprobacion', function () {
    return view('pendiente_aprobacion');
})->name('pendiente.aprobacion');
///vista de los usuarios
Route::get('/usuarios/admin', [RoleUserController::class, 'adminUsers'])->name('usuarios.admin');
Route::patch('/admin/users/{userId}/role', [AdminController::class, 'updateRole'])->name('admin.update.role');
Route::get('/usuarios/proveedor', [RoleUserController::class, 'proveedorUsers'])->name('usuarios.proveedor');
Route::patch('/admin/users/{user}/empresa', [AdminController::class, 'updateEmpresa'])->name('admin.update.empresa');
Route::get('/usuarios/cliente', [RoleUserController::class, 'clienteUsers'])->name('usuarios.cliente');
Route::get('/usuarios/empleado', [RoleUserController::class, 'empleadoUsers'])->name('usuarios.empleado');
Route::patch('/empleados/{userId}/update-puesto', [EmpleadoController::class, 'updatePuesto'])->name('empleado.update.puesto');
Route::post('/admin/update-role', [AdminController::class, 'updateRole'])->name('admin.updateRole');



