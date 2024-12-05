<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\AdminController;
use App\Http\Middleware\CheckIfApproved;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleUserController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\MarcasController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\TallaController;
use App\Http\Controllers\Tipo_ropaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\AsigTallaController;
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
Route::match(['get', 'post'], '/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');


// Rutas de autenticación
Auth::routes();

// Rutas de recursos para productos
Route::resource('products', ProductController::class);

// Rutas de recursos para marcas// tablas fuertes
Route::resource('/home/empresas', EmpresaController::class);
Route::resource('/home/marcas', MarcasController::class);
Route::resource('/home/categorias', CategoriaController::class);
Route::resource('/home/tallas', TallaController::class);
Route::resource('/home/tipo_ropas', Tipo_ropaController::class);
Route::resource('/admin/entradas', EntradaController::class);
Route::resource('/admin/asig_talla', AsigTallaController::class);
Route::resource('/admin/entradas', EntradaController::class);
Route::resource('/admin/productos', ProductoController::class);
Route::resource('/admin/venta', VentaController::class);
Route::resource('/admin/admin/venta', VentaController::class);
Route::resource('ventas', VentaController::class);

Route::resource('admin/proveedores', ProveedorController::class);
Route::get('/proveedores', [ProveedorController::class, 'proveedorUsers'])->name('proveedores.index');
Route::get('/proveedores/create', [ProveedorController::class, 'create'])->name('proveedores.create');
Route::get('/proveedores/{id_proveedor}', [ProveedorController::class, 'show'])->name('proveedores.show');
Route::resource('proveedores', ProveedorController::class);
Route::resource('admin/proveedores', ProveedorController::class);

// Rutas administrativas bajo el prefijo 'admin'
Route::prefix('admin')->group(function () {
    Route::resource('products', ProductController::class);
});

// Rutas API para productos (si es necesario)

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
Route::get('/usuarios/clientes', [RoleUserController::class, 'clienteUsers'])->name('usuarios.cliente');
Route::get('/usuarios/empleado', [RoleUserController::class, 'empleadoUsers'])->name('usuarios.empleado');
Route::patch('/empleados/{userId}/update-puesto', [EmpleadoController::class, 'updatePuesto'])->name('empleado.update.puesto');
Route::post('/admin/update-role', [AdminController::class, 'updateRole'])->name('admin.updateRole');

Route::get('/admin/clientes', [ClienteController::class, 'index'])->name('admin.clientes');
Route::resource('clientes', ClienteController::class);

// Ruta para listar empleados
Route::get('/admin/empleados', [EmpleadoController::class, 'index'])->name('admin.empleados');
// Rutas para el CRUD de empleados
Route::resource('empleados', EmpleadoController::class);

Route::get('/admin/tickets', [TicketController::class, 'index'])->name('admin.tickets');
Route::resource('tickets', TicketController::class);
Route::resource('categorias', CategoriaController::class);
Route::prefix('admin')->name('admin.')->group(function() {
    Route::resource('ventas', VentaController::class);
});




