<?php

namespace JulianStark999\LaravelTestsGenerator\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\File;

class LaravelTestsGeneratorCommand extends Command
{
    public $signature = 'laravel-tests-generator {--dir=*}';

    public $description = 'My command';

    public function handle(): void
    {
        $directories = $this->getDirectories();

        $directories->each(function ($dir) {
            $this->processDirectory($dir);
        });
    }

    private function getDirectories(): Collection
    {
        $directories = collect();
        $configuredDirectories = config('tests-generator.directories');

        $optionDirs = $this->option('dir');

        if (! count($optionDirs)) {
            foreach ($configuredDirectories as $item) {
                $directories->push(app_path($item));
            }

            return $directories;
        }

        collect($optionDirs)->each(function ($key) use ($configuredDirectories, $directories) {
            if (! Arr::has($configuredDirectories, $key)) {
                return;
            }

            $directories->push(app_path($configuredDirectories[$key]));
        });

        return $directories;
    }

    private function processDirectory(string $path)
    {
        if (! File::exists($path)) {
            return;
        }

        $this->info($path);

        $relativePath = $this->getRelativeNamespace($path);
        $files = File::allFiles($path);

        collect($files)->each(function ($file) use ($relativePath) {
            $fileName = $file->getRelativePathname();
            $className = str_replace('.php', '', $fileName);

            if ($this->checkIfTestExists(sprintf('%s\%s', $relativePath, $className))) {
                return;
            }

            $this->callSilently('make:test', [
                'name' => sprintf(
                    '%s\%sTest',
                    $relativePath,
                    $className
                ),
            ]);
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
