<?php

namespace App\Providers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        // Asegurarte de que los archivos en el directorio storage sean accesibles públicamente
        if (!Storage::disk('public')->exists('imagenes')) {
            Storage::disk('public')->makeDirectory('imagenes');
        }

        // Intentar crear un enlace simbólico de forma segura
        $publicStoragePath = public_path('storage');
        $storagePath = storage_path('app/public');

        if (!file_exists($publicStoragePath)) {
            try {
                // Crear un enlace simbólico
                symlink($storagePath, $publicStoragePath);
            } catch (\Exception $e) {
                // Si no se puede crear el enlace, intentar copiar los archivos como alternativa
                if (!File::exists($publicStoragePath)) {
                    File::copyDirectory($storagePath, $publicStoragePath);
                }
            }
        }
    }
}
