<?php

namespace ZoutApps\LaravelBackpackAuth\Generators;


use SplFileInfo;
use ZoutApps\LaravelBackpackAuth\Traits\CanNormalizeString;

class RouteFileGenerator extends Generator
{
    use CanNormalizeString;

    private function stubPath(bool $lucid)
    {
        if ($lucid) {
            return __DIR__.'/../stubs/Lucid/routes/routes.stub';
        } else {
            return __DIR__.'/../stubs/routes/routes.stub';
        }
    }

    private function getPath(string $name, bool $lucid, string $service)
    {
        if ($lucid) {
            return '/src/Services/'.studly_case($service).'/Http/'.$name.'-routes.php';
        } else {
            return '/routes/'.$name.'.php';
        }
    }

    public function generateRoutesFile(string $name, bool $force, bool $lucid = false, string $service = null)
    {
        $name = $this->normalize($name);
        $path = $this->getPath($name, $lucid, $service);
        $stub = $this->stubPath($lucid);
        $this->generateFile($name, $path, new SplFileInfo($stub), $force);
    }
}