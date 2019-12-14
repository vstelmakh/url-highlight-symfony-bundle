# Twig url highlight bundle
Symfony bundle for twig url highlight extension  

## Installation
Install the latest version with:  
```bash
$ composer require vstelmakh/twig-url-highlight-bundle
```

## Setup
If your application is using [Symfony Flex](https://symfony.com/doc/current/setup/flex.html) - you are ready to go, skip next steps.

Enable the bundle by adding it to the list of registered bundles
in the `config/bundles.php` file of your project:

```php
// config/bundles.php

return [
    // ...
    VStelmakh\TwigUrlHighlightBundle\TwigUrlHighlightBundle::class => ['all' => true],
];
```

## Usage
Use `urls_to_html` filter in your templates:  
```twig
{{ 'Basic example http://example.com'|urls_to_html }}

{# output: Basic example <a href="http://example.com">http://example.com</a> #}
```

More details see usage in [Twig url highlight](https://github.com/vstelmakh/twig-url-highlight#usage) repository.

## Credits
[Volodymyr Stelmakh](https://github.com/vstelmakh)  
Licensed under the MIT License. See [LICENSE](LICENSE) for more information.  