<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;
use Google\Service\Drive;

class GoogleDriveServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
        try {
            $client = new \Google\Client();
            $client->setClientId(config('filesystems.disks.google.clientId'));
            $client->setClientSecret(config('filesystems.disks.google.clientSecret'));
            $client->refreshToken(config('filesystems.disks.google.refreshToken'));
    
            $service = new Drive($client);
    
            // Almacenar el cliente de Google Drive en el contenedor de servicios de Laravel
            $this->app->instance('googleDriveService', $service);
    
            Storage::extend('google', function($app, $config) use ($service) {
                $options = [];
    
                if (!empty($config['teamDriveId'] ?? null)) {
                    $options['teamDriveId'] = $config['teamDriveId'];
                }
    
                $adapter = new \Masbug\Flysystem\GoogleDriveAdapter($service, $config['folderId']);
                $driver = new \League\Flysystem\Filesystem($adapter);
    
                return new \Illuminate\Filesystem\FilesystemAdapter($driver, $adapter);
            });
            /*
            Storage::extend('google', function($app, $config) {
                $options = [];

                if (!empty($config['teamDriveId'] ?? null)) {
                    $options['teamDriveId'] = $config['teamDriveId'];
                }

                $client = new \Google\Client();
                $client->setClientId($config['clientId']);
                $client->setClientSecret($config['clientSecret']);
                $client->refreshToken($config['refreshToken']);
                
                $service = new Drive($client);
                //$adapter = new \Masbug\Flysystem\GoogleDriveAdapter($service, $config['folderId'] ?? '/', $options);
                $adapter = new \Masbug\Flysystem\GoogleDriveAdapter($service, $config['folder']);
                //$adapter = new \Masbug\Flysystem\GoogleDriveAdapter($service, ['folderId' => $config['folder']]);
                $driver = new \League\Flysystem\Filesystem($adapter);

                // Almacenar el cliente de Google Drive en el contenedor de servicios de Laravel

                $app->instance('googleDriveService', $service);

                return new \Illuminate\Filesystem\FilesystemAdapter($driver, $adapter);
            });
            */
        } catch(\Exception $e) {
            // your exception handling logic
        }
    }
}
