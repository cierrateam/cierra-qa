<?php declare(strict_types=1);

namespace Cierrateam\CierraQa\Tests\Unit;

use Artisan;
use Cierrateam\CierraQa\Tests\TestCase;
use Illuminate\Support\Facades\File;

class InstallCierraQaPackageCommandTest extends TestCase
{
    /** @test */
    function the_install_command_copies_files()
    {
        // make sure we're starting from a clean state
        if (is_dir(base_path('.qa'))) {
            removeDirectoryStructure(base_path('.qa'));
        }

        if (is_dir(base_path('.github'))) {
            removeDirectoryStructure(base_path('.qa'));
        }

        if (File::exists(base_path('Makefile'))) {
            unlink(base_path('Makefile'));
        }

        $this->assertFalse(File::exists(base_path('.qa/phpcs/rules.xml')));
        $this->assertFalse(File::exists(base_path('.qa/phpstan/phpstan.neon')));
        $this->assertFalse(File::exists(base_path('Makefile')));

        Artisan::call('cierra-qa:install');

        $this->assertTrue(File::exists(base_path('.qa/phpcs/rules.xml')));
        $this->assertTrue(File::exists(base_path('.qa/phpstan/phpstan.neon')));
        $this->assertTrue(File::exists(base_path('Makefile')));
    }
}
