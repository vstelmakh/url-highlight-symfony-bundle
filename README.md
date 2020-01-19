# Twig url highlight bundle
![Build status](https://github.com/vstelmakh/url-highlight-symfony-bundle/workflows/build/badge.svg?branch=master)
![PHP version](https://img.shields.io/packagist/php-v/vstelmakh/url-highlight-symfony-bundle)
![License](https://img.shields.io/github/license/vstelmakh/url-highlight-symfony-bundle)

Symfony bundle for [Url highlight](https://github.com/vstelmakh/url-highlight) library  

## Installation
Install the latest version with:  
```bash
$ composer require vstelmakh/url-highlight-symfony-bundle
```

## Setup
If your application is using [Symfony Flex](https://symfony.com/doc/current/setup/flex.html) - you are ready to go, skip next steps.

Enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    VStelmakh\UrlHighlightSymfonyBundle\UrlHighlightBundle::class => ['all' => true],
];
```

## Usage
Use `urls_to_html` filter in your templates:  
```twig
{{ 'Basic example http://example.com'|urls_to_html }}

{# output: Basic example <a href="http://example.com">http://example.com</a> #}
```

More details see usage in [Twig url highlight](https://github.com/vstelmakh/url-highlight-twig-extension#usage) repository.

## Credits
[Volodymyr Stelmakh](https://github.com/vstelmakh)  
Licensed under the MIT License. See [LICENSE](LICENSE) for more information.  