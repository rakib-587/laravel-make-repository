# Laravel Make Repository

A lightweight Laravel package that provides Artisan commands to generate Repository classes following a clean and extendable pattern. Supports optional model binding and integrated model creation.

---

## 📦 Installation

Require the package via Composer:

```bash
composer require rakib-587/laravel-make-repository --dev
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
php artisan make:repository UserRepository
```

This will generate:

- `app/Repositories/UserRepository.php`
- Uses `App\Models\User` as the associated model (automatically inferred)

---

### ➤ Create a Repository with an Explicit Model

```bash
php artisan make:repository InvoiceRepository --model=Invoice
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

## 🧩 Customizing Stub

The repository is generated using a stub located at:

```
stubs/repository.stub
```

To customize the repository structure:
1. Publish the stub file (optional in future versions).
2. Edit the stub content and placeholders (`{{ modelName }}`, `{{ ClassName }}`).

---

## 📁 Output Structure Example

When you run:

```bash
php artisan make:repository OrderRepository --model=Order
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

**Rakibul Islam**  
GitHub: [@rakib-587](https://github.com/rakib-587)
