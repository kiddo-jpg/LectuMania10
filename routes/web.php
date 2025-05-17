<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuariosController;
use App\Http\Controllers\LibrosController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\PayPalController;
use App\Http\Controllers\GeolocationController;

// ----------------------
// RUTAS PÚBLICAS
// ----------------------

// Página principal
Route::get('/', function () {
    return view('usuarios.index');
});

// Registro de usuario
Route::get('/ingresar', [UsuariosController::class, 'index'])->name('usuarios.index');
Route::post('/ingresar', [UsuariosController::class, 'store'])->name('usuarios.store');

// Login tradicional
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

// Login social (Google, GitHub)
Route::get('/login/{provider}', [SocialiteController::class, 'redirectToProvider'])->name('socialite.redirect');
Route::get('/login/{provider}/callback', [SocialiteController::class, 'handleProviderCallback'])->name('socialite.callback');

// Geolocalización 
Route::get('/geolocation', [GeolocationController::class, 'getCoordinates'])->name('geolocation');

// ----------------------
// RUTAS PROTEGIDAS (AUTENTICADOS)
// ----------------------
Route::middleware(['auth'])->group(function () {

    // Libros
    Route::get('/libros', [LibrosController::class, 'index'])->name('libros.index');
    Route::get('/libros/create', [LibrosController::class, 'create'])->name('libros.create');
    Route::post('/libros', [LibrosController::class, 'store'])->name('libros.store');
    Route::get('/libros/{id}/edit', [LibrosController::class, 'edit'])->name('libros.edit');
    Route::put('/libros/{id}', [LibrosController::class, 'update'])->name('libros.update');
    Route::delete('/libros/{id}', [LibrosController::class, 'destroy'])->name('libros.destroy');

    // Pedidos 
    Route::get('/pedidos', [\App\Http\Controllers\PedidoController::class, 'index'])->name('pedidos.index');
    Route::get('/pedidos/{id}', [\App\Http\Controllers\PedidoController::class, 'show'])->name('pedidos.show');
    Route::delete('/pedidos/{id}', [\App\Http\Controllers\PedidoController::class, 'destroy'])->name('pedidos.destroy');

    // Carrito
    Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
    Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
    Route::delete('/carrito/eliminar/{id}', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
    Route::post('/carrito/agregar-todo', [CarritoController::class, 'agregarTodo'])->name('carrito.agregarTodo');
    Route::post('/carrito/finalizar', [CarritoController::class, 'finalizarCompra'])->name('carrito.finalizar');

    // Usuarios (CRUD)
    Route::get('/usuarios/tablausuarios', [UsuariosController::class, 'tabla'])->name('usuarios.tablausuarios');
    Route::get('/usuarios/create', [UsuariosController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios', [UsuariosController::class, 'store'])->name('usuarios.store');
    Route::get('/usuarios/{id}/edit', [UsuariosController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{id}', [UsuariosController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{id}', [UsuariosController::class, 'destroy'])->name('usuarios.destroy');

    // Perfil de usuario
    Route::get('/perfil', [AuthController::class, 'perfil'])->name('perfil');
    Route::post('/perfil', [AuthController::class, 'updatePerfil'])->name('perfil.update');
    Route::delete('/perfil', [AuthController::class, 'eliminarCuenta'])->name('perfil.eliminar');

    // PayPal
    Route::get('paypal', [PayPalController::class, 'index'])->name('paypal');
    Route::get('paypal/payment', [PayPalController::class, 'payment'])->name('paypal.payment');
    Route::get('paypal/payment/success', [PayPalController::class, 'paymentSuccess'])->name('paypal.payment.success');
    Route::get('/paypal/cancel', [PayPalController::class, 'paymentCancel'])->name('paypal.payment.cancel');

    // Logout
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});