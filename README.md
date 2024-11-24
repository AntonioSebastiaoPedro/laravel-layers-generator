# Laravel Layers Generator

**Laravel Layers Generator** is a custom Artisan command that simplifies the creation of modular structures in Laravel projects, with some prebuilt methods. This command allows you to automatically generate essential files for an entity, including:

- **Model**
- **Controller**
- **Repository**
- **DTOs** (Create and Edit)
- **Requests** (Store and Update)
- **Resource**

## Features

- **Automated Code Generation**: Quickly set up layers for your entities with a single command.
- **Stub-Based Customization**: Define your own code templates for each layer.
- **Collision-Free**: Skips generating files if they already exist, ensuring you don't accidentally overwrite important files.
- **Clean and Modular Structure**: Designed to align with clean architecture principles.

---

## Installation

1. **Clone or Download the Package**  
   Clone this repository or download the files, then place the `GenerateEntity` command in your Laravel application's `app/Console/Commands` directory.

2. **Register the Command**  
   Open the `app/Console/Kernel.php` file and add the command to the `$commands` array:
   ```php
   protected $commands = [
       \App\Console\Commands\GenerateEntity::class,
   ];
   ```

## Usage

Run the Artisan command, specifying the name of the entity you want to generate:

```bash
php artisan generate:layers EntityName
```

For example, to generate files for a `User` entity:
```bash
php artisan generate:layers User
```

### What Happens
This command will generate:
- `app/Models/User.php`
- `app/Http/Controllers/UserController.php`
- `app/Repositories/UserRepository.php`
- `app/DTOs/User/UserCreateDTO.php`
- `app/DTOs/User/UserEditDTO.php`
- `app/Http/Requests/User/StoreUserRequest.php`
- `app/Http/Requests/User/UpdateUserRequest.php`
- `app/Http/Resources/UserResource.php`

If any file already exists, it will not be overwritten.

---

## Customizing Stubs

You can customize the generated code by editing the `.stub` files in the `stubs` directory. These files act as templates, and placeholders like `{{name}}` will be replaced with the entity name when the files are generated.

Example of a `model.stub` file:
```php
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class {{class}} extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = '{{class}}';
    protected $primaryKey = 'id';

    protected $fillable = [
        'data',
    ];
}

```

---

## Contributing

Feel free to open issues or submit pull requests for improvements and additional features. Contributions are welcome!