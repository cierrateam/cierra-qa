<?php declare(strict_types=1);

namespace Cierrateam\CierraQa\Console;

use Illuminate\Console\Command;

class InstallCierraQaPackageCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'cierra-qa:install';

    /**
     * @var string
     */
    protected $description = 'Install the Cierra QA Package';

    public function handle()
    {
        $this->info('Installing Cierra QA Package');

        $this->call('vendor:publish', [
            '--tag' => 'cierra-qa'
        ]);

        $this->info('Installed Cierra QA Package');
    }
}