<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class GenerateEntity extends Command
{
    protected $signature = 'generate:entity {name}';
    protected $description = 'Generate Model, Controller, Repository, DTOs, and Resource for a given entity';

    public function handle()
    {
        $name = ucfirst($this->argument('name'));
        $this->info("Gerando arquivos para a entidade: $name");

        $this->generateModel($name);
        $this->generateController($name);
        $this->generateRepository($name);
        $this->generateDTOs($name, 'Create');
        $this->generateDTOs($name, 'Edit');
        $this->generateRequests($name, 'Store');
        $this->generateRequests($name, 'Update');
        $this->generateResource($name);
    }

    private function generateModel($name)
    {
        $path = app_path('Models');
        $fileName = $path . "/{$name}.php";

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        if (File::exists($fileName)) {
            $this->info("O Model $name já existe.");
            return;
        }

        $modelStub = File::get(base_path('stubs/model.stub')); // Supondo que você tenha um stub
        $modelContent = str_replace('{{class}}', $name, $modelStub);
        File::put($fileName, $modelContent);
        $this->info("Model $name criado com sucesso!");
    }

    private function generateController($name)
    {
        $path = app_path('Http/Controllers');
        $fileName = $path . "/{$name}Controller.php";

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        if (File::exists($fileName)) {
            $this->info("O Controller {$name}Controller já existe.");
            return;
        }

        $controllerStub = File::get(base_path('stubs/controller.stub')); // Stub do controller
        $controllerContent = str_replace('{{class}}', $name, $controllerStub);
        File::put($fileName, $controllerContent);
        $this->info("Controller {$name}Controller criado com sucesso!");
    }

    private function generateRepository($name)
    {
        $path = app_path('Repositories');
        $fileName = $path . "/{$name}Repository.php";

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        if (File::exists($fileName)) {
            $this->info("O Repository {$name}Repository já existe.");
            return;
        }

        $repositoryStub = File::get(base_path('stubs/repository.stub')); // Stub do repository
        $repositoryContent = str_replace('{{class}}', $name, $repositoryStub);
        File::put($fileName, $repositoryContent);
        $this->info("Repository {$name}Repository criado com sucesso!");
    }

    private function generateDTOs($name, $type)
    {
        $path = app_path("DTOs/{$name}");
        $fileName = $path . "/{$type}{$name}DTO.php";

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        if (File::exists($fileName)) {
            $this->info("O {$type}{$name}DTO já existe.");
            return;
        }

        $dtoStub = File::get(base_path('stubs/dto.stub')); // Stub do DTO
        $dtoContent = str_replace(['{{class}}', '{{type}}'], [$name, $type], $dtoStub);
        File::put($fileName, $dtoContent);
        $this->info("{$type}{$name}DTO criado com sucesso!");
    }

    private function generateRequests($name, $type)
    {
        $path = app_path("Http/Requests/{$name}");
        $fileName = $path . "/{$type}{$name}Request.php";

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        if (File::exists($fileName)) {
            $this->info("O {$type}{$name}Request já existe.");
            return;
        }

        $requestStub = File::get(base_path('stubs/request.stub'));
        $requestContent = str_replace(['{{class}}', '{{type}}'], [$name, $type], $requestStub);
        File::put($fileName, $requestContent);
        $this->info("{$type}{$name}Request criado com sucesso!");
    }

    private function generateResource($name)
    {
        $path = app_path("Http/Resources");
        $fileName = $path . "/{$name}Resource.php";

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        if (File::exists($fileName)) {
            $this->info("O Resource {$name}Resource já existe.");
            return;
        }

        $resourceStub = File::get(base_path('stubs/resource.stub')); // Stub do resource
        $resourceContent = str_replace('{{class}}', $name, $resourceStub);
        File::put($fileName, $resourceContent);
        $this->info("Resource {$name}Resource criado com sucesso!");
    }
}
