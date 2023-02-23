<?php

use Illuminate\Support\Str;
use Symfony\Component\Finder\SplFileInfo;

if (!function_exists('AllClass')) {
    function AllClass($directory, $namespace, $callback = null, $filter = null)
    {
        $files = AllFile($directory);
        if (!$files || !is_array($files)) return [];

        $classList = collect($files)->map(function (SplFileInfo $file) use ($namespace) {
            return (string) Str::of($namespace)
                ->append('\\', $file->getRelativePathname())
                ->replace(['/', '.php'], ['\\', '']);
        });
        if ($callback) {
            if ($filter) {
                $classList = $classList->filter($filter);
            }
            $classList->each($callback);
        } else {
            return $classList;
        }
    }
}

if (!function_exists('livewire_component')) {
    function livewire_component($name, $params=[])
    {
        return  platform_encode(['type' => 'livewire', 'name' => $name, 'params' => $params]);
    }
}
//platform_decode