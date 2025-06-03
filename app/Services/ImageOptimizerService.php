<?php

namespace App\Services;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class ImageOptimizerService
{
    /**
     * Optimizar imagen para credenciales
     */
    public function optimizeForCredential($imagePath, $targetSize = 100)
    {
        try {
            // Cargar imagen
            $image = Image::make(storage_path('app/public/' . $imagePath))->orientate();

            // Redimensionar manteniendo proporción
            $image->fit($targetSize, $targetSize, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            // Aplicar filtros para mejor calidad
            $image->sharpen(10);
            $image->contrast(5);

            // Guardar optimizada
            $optimizedPath = $this->getOptimizedPath($imagePath);
            $image->save(storage_path('app/public/' . $optimizedPath), 85);

            return $optimizedPath;

        } catch (\Exception $e) {
            \Log::error('Error optimizando imagen: ' . $e->getMessage());
            return $imagePath; // Retornar original si falla
        }
    }

    /**
     * Optimizar JPEG pesado
     */
    public function optimizeJpeg($imagePath, $maxFileSize = 50000) // 50KB
    {
        $image = Image::make(storage_path('app/public/' . $imagePath))->orientate();
        $quality = 90;

        do {
            $tempPath = storage_path('app/temp_' . basename($imagePath));
            $image->save($tempPath, $quality);
            $fileSize = filesize($tempPath);
            $quality -= 5;

        } while ($fileSize > $maxFileSize && $quality > 30);

        // Mover archivo optimizado
        $optimizedPath = $this->getOptimizedPath($imagePath);
        rename($tempPath, storage_path('app/public/' . $optimizedPath));

        return $optimizedPath;
    }

    /**
     * Crear thumbnail específico para credenciales
     */
    public function createCredentialThumbnail($imagePath)
    {
        $image = Image::make(storage_path('app/public/' . $imagePath))->orientate();

        // Configuración específica para credenciales
        $image->fit(200, 200, function ($constraint) {
            $constraint->aspectRatio();
        });

        // Mejorar nitidez para impresión
        $image->sharpen(15);
        $image->brightness(5);

        // Guardar con alta calidad pero optimizado
        $thumbnailPath = str_replace('.', '_thumb.', $imagePath);
        $image->save(storage_path('app/public/' . $thumbnailPath), 88);

        return $thumbnailPath;
    }

    /**
     * Procesar imagen al momento del upload
     */
    public function processUploadedImage($uploadedFile, $directory = 'players')
    {
        // Generar nombre único
        $filename = time() . '_' . uniqid() . '.jpg';
        $path = $directory . '/' . $filename;

        // Procesar imagen
        $image = Image::make($uploadedFile)->orientate();

        // Redimensionar si es muy grande
        if ($image->width() > 800 || $image->height() > 800) {
            $image->resize(800, 800, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
        }

        // Guardar original optimizado
        $image->save(storage_path('app/public/' . $path), 85);

        // Crear versión para credencial
        $credentialPath = $this->optimizeJpeg($path);

        return [
            'original' => $path,
            'credential' => $credentialPath
        ];
    }

    private function getOptimizedPath($originalPath)
    {
        $pathInfo = pathinfo($originalPath);
        return $pathInfo['dirname'] . '/' . $pathInfo['filename'] . '_opt.' . $pathInfo['extension'];
    }
}
