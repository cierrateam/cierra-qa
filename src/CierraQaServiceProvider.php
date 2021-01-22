<?php declare(strict_types=1);

namespace Cierrateam\CierraQa;

use Cierrateam\CierraQa\Console\InstallCierraQaPackageCommand;
use Illuminate\Support\ServiceProvider;

class CierraQaServiceProvider extends ServiceProvider
{
    public function register()
    {
        parent::register();
    }

    public function boot()
    {
        // Register the command if we are using the application via the CLI
        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCierraQaPackageCommand::class,
            ]);
        }

        $this->publishes([
            // qa files
            __DIR__.'/.qa' => base_path('.qa'),

            // dev files
            __DIR__.'/.dev' => base_path('.dev'),

            // copy github workflow file
            __DIR__.'/.github/workflows/code-quality.yml' => base_path('.github/workflows/code-quality.yml'),

            // copy Makefile
            __DIR__.'/.makefile/Makefile' => base_path('Makefile'),
        ], 'cierra-qa');
    }

}