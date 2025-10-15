<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class Scaffolding extends Command
{
    protected $signature = 'make:scaffold {name}';
    protected $description = 'Cria Model, Repository, Service e Controller para uma entidade';

    public function handle()
    {
        $name = Str::studly($this->argument('name'));
        $lower = Str::snake($name);
        $path = app_path("src/{$name}");

        if (!File::exists($path)) {
            File::makeDirectory($path, 0755, true);
        }

        // Model
        File::put("{$path}/{$name}.php", $this->getModelTemplate($name, $lower));

        // Repository
        File::put("{$path}/{$name}Repository.php", $this->getRepositoryTemplate($name));

        // Service
        File::put("{$path}/{$name}Service.php", $this->getServiceTemplate($name));

        // Controller
        File::put("{$path}/{$name}Controller.php", $this->getControllerTemplate($name));

        $this->info("Scaffolding para {$name} criado com sucesso!");
    }

    protected function getModelTemplate($name, $table)
    {
        return <<<PHP
<?php

namespace App\\src\\{$name};

use Illuminate\\Database\\Eloquent\\Model;

class {$name} extends Model
{
    protected \$table = '{$table}s';
    protected \$guarded = [];
}
PHP;
    }

    protected function getRepositoryTemplate($name)
    {
        return <<<PHP
<?php

namespace App\\src\\{$name};

use App\\src\\Commons\\Repositories\\AbstractRepository;

class {$name}Repository extends AbstractRepository
{
    protected \$model;

    public function __construct({$name} \$model)
    {
        \$this->model = \$model;
    }
}
PHP;
    }

    protected function getServiceTemplate($name)
    {
        return <<<PHP
<?php

namespace App\\src\\{$name};

use App\\src\\Commons\\Services\\AbstractService;

class {$name}Service extends AbstractService
{
    public function __construct({$name}Repository \$repository)
    {
        parent::__construct(\$repository);
    }
}
PHP;
    }

    protected function getControllerTemplate($name)
    {
        return <<<PHP
<?php

namespace App\\src\\{$name};

use App\\src\\Commons\\Controllers\\AbstractController;

class {$name}Controller extends AbstractController
{
    public function __construct({$name}Service \$service)
    {
        parent::__construct(\$service, {$name}Validator::class);
    }
}
PHP;
    }
}
