# Laravel Filters
Filter models for Laravel.

#### PHP >= 5.6.4, Laravel >= 5.3

## Installation

Filters for Laravel is installed via [Composer](https://getcomposer.org/).
For most uses, you will need to require `maksa988/laravel-filters` and an individual gateway:

```bash
composer require maksa988/laravel-filters
```

## Usage

First you need to create a filter, you can do this using the artisan command `php artisan make:filter PostFilter`.

After that the `App\Filters` directory will be created and the `PostFilter` filter will be created there.

```php
<?php

namespace App\Filters;

use Maksa988\LaravelFilters\Filters;

class PostFilter extends Filters
{
    /**
     * Available filters
     *
     * @var array
     */
    protected $filters = [
        'title',
    ];

    /**
     * @param string $value
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function title($value)
    {
        return $this->builder->where('title', $value);
    }
}
```

In the filter class, create methods whose names you must specify in the `$filters` array. The method will receive the value that will be accepted from the request.

Elequent builder is available in the class to compile a query that will be called when filtering data.

```php
/**
 * Display a listing of the resource.
 *
 * @param Post $post
 * @param PostFilter $filter
 * @return \Illuminate\View\View
 */
public function index(Post $post, PostFilter $filter)
{
    $list = $post->filter($filter)->paginate(20);

    return $this->view(compact('list'));
}
```

You can use the filter in the model by simply calling the scope `filter`, passing the class with the filter there.

In order for scope to be available in the model, you need to connect trait `Maksa988\LaravelFilters\Traits\HasFilters`:

```php
class Post extends Model
{
    use HasFilters;
}
```

To filter data by the title filter in the address, just pass a field with that name, for example, this can be done using GET:

`http://example.com/posts?title=Post%20title`

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security

If you discover any security related issues, please send me an email at maksa988ua@gmail.com instead of using the issue tracker.

## Credits

- [Maksa988](https://github.com/maksa988)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.