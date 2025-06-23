# Laravel Make Repository

A lightweight Laravel package that provides Artisan commands to generate Repository classes following a clean and extendable pattern. Supports optional model binding and integrated model creation.

---

## 📦 Installation

Require the package via Composer:

```bash
composer require rakib-587/laravel-make-repository
```

If you're using Laravel <10 and auto-discovery doesn't work, manually register the service provider in `config/app.php`:

```php
'providers' => [
    Rakib\MakeRepository\MakeRepositoryServiceProvider::class,
],
```

---

## ⚙️ Usage

### ➤ Create a Repository for an Existing Model

```bash
php artisan make:repository User
```

This will generate:

- `app/Repositories/UserRepository.php`
- Uses `App\Models\User` as the associated model (automatically inferred)

---

### ➤ Create a Repository with an Explicit Model

```bash
php artisan make:repository Customer --model=User
```

This allows you to manually specify the model class to be used inside the repository.

---

### ➤ Create a Model with a Repository in One Command

```bash
php artisan make:model Product --repo
```

This command:
- Creates `app/Models/Product.php`
- Creates `app/Repositories/ProductRepository.php`
- Links the repository to the model automatically

---

## 🧩 Customizing the Stub

The repository class is generated using a stub file that defines its structure and placeholders.

By default, the command looks for a local stub file in your Laravel project:

```
stubs/repository.stub
```

If the file **does not exist**, it will gracefully fall back to using the default stub provided by the package.

---

### ✏️ How to Customize

To customize the repository structure, first publish the stub file into your project:

```bash
php artisan vendor:publish --tag=make-repository-stubs
```

This will copy the stub to:

```
stubs/repository.stub
```

You can now edit the stub to change the generated structure.

Available placeholders:

- `{{ ClassName }}` — The name of the generated repository class (e.g., `UserRepository`)
- `{{ ModelName }}` — The associated model class (e.g., `User`)

Once the stub exists in your project, it will automatically be used for all future repository generations.

---

## 📁 Output Structure Example

When you run:

```bash
php artisan make:repository Order
```

You'll get:

```php
// app/Repositories/OrderRepository.php

namespace App\Repositories;

use App\Models\Order;
use Rakib\MakeRepository\Repository;

class OrderRepository extends Repository
{
    public static function model()
    {
        return Order::class;
    }
}
```

---

## 📄 License

This package is open-sourced software licensed under the [MIT license](LICENSE).

---

## 🙌 Author

**Md Rakibul Islam**  
GitHub: [@rakib-587](https://github.com/rakib-587)
