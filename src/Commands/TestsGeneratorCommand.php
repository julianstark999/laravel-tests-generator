<?php

namespace JulianStark999\LaravelTestsGenerator\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

class TestsGeneratorCommand extends Command
{
    public $signature = 'tests-generator {--dir=*}';

    public $description = 'Check and create missing tests';

    public function handle(): void
    {
        $this->info('Check directories');

        $directories = $this->getDirectories();

        $this->info('Processing');

        $directories->each(function (string $dir): void {
            $this->info($dir);

            $this->processDirectory(app_path($dir));
        });

        $this->info('Finished');
    }

    private function getDirectories(): Collection
    {
        $directories = collect();
        $configuredDirectories = config('tests-generator.directories');

        $optionDirs = $this->option('dir');

        if (! count($optionDirs)) {
            foreach ($configuredDirectories as $item) {
                $directories->push($item);
            }

            return $directories;
        }

        collect($optionDirs)->each(function (string $key) use ($configuredDirectories, $directories): void {
            if (! Arr::has($configuredDirectories, $key)) {
                return;
            }

            $directories->push($configuredDirectories[$key]);
        });

        return $directories;
    }

    private function processDirectory(string $path): void
    {
        // check if directory exists
        if (! File::exists($path)) {
            return;
        }

        $relativePath = $this->getRelativeNamespace($path);
        $files = File::allFiles($path);

        collect($files)->each(function ($file) use ($relativePath): void {
            $fileName = $file->getRelativePathname();
            $className = str_replace('.php', '', $fileName);

            if ($this->checkIfTestExists(sprintf('%s\%s', $relativePath, $className))) {
                return;
            }

            $testName = sprintf(
                '%s\%sTest',
                $relativePath,
                $className
            );

            $this->callSilently('make:test', [
                'name' => $testName,
            ]);

            $this->info('    '.$testName);
        });
    }

    private function getRelativeNamespace(string $path): string
    {
        return str_replace(app_path(), '', $path);
    }

    private function checkIfTestExists(string $relativePath): bool
    {
        return File::exists(sprintf(
            '%s\Feature%sTest.php',
            base_path('tests'),
            $relativePath
        ));
    }
}
