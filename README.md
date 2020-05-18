# Url highlight bundle
[![Build status](https://github.com/vstelmakh/url-highlight-symfony-bundle/workflows/build/badge.svg?branch=master)](https://github.com/vstelmakh/url-highlight-symfony-bundle/actions)
[![Packagist version](https://img.shields.io/packagist/v/vstelmakh/url-highlight-symfony-bundle?color=orange)](https://packagist.org/packages/vstelmakh/url-highlight-symfony-bundle)
[![PHP version](https://img.shields.io/packagist/php-v/vstelmakh/url-highlight-symfony-bundle)](https://www.php.net/)
[![License](https://img.shields.io/github/license/vstelmakh/url-highlight-symfony-bundle?color=yellowgreen)](LICENSE)

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
Bundle register url highlight service which available via autowire or directly from container:  
```php
<?php

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use VStelmakh\UrlHighlight\UrlHighlight;

class ExampleController extends AbstractController
{
    public function autowire(UrlHighlight $urlHighlight)
    {
        // do your stuff
    }

    public function fromContainer()
    {
        /** @var UrlHighlight $urlHighlight */
        $urlHighlight = $this->container->get('vstelmakh.url_highlight');
    }
}
```

Additionally `urls_to_html` filter available in templates:  
```twig
{{ 'Basic example http://example.com'|urls_to_html }}

{# output: Basic example <a href="http://example.com">http://example.com</a> #}
```

More details see usage in [Twig url highlight](https://github.com/vstelmakh/url-highlight-twig-extension#usage) repository.

## Configuration
Works out of the box with default configuration:  
```yaml
url_highlight:
  validator: ~
  highlighter: ~
  encoder: ~
```
If you need to change configuration add desired options to your `parameters.yaml` or create separate config: `config/packages/url_highlight.yaml`.  
More information about configuration options could be found in [Url highlight](https://github.com/vstelmakh/url-highlight#configuration) library.  

### Example to define validator to not match urls without scheme
- Define validator service. Use bundled with Url highlight library or create your own implementation
of `VStelmakh\UrlHighlight\Validator\ValidatorInterface`:
```yaml
# config/services.yaml
services:
    ...
    VStelmakh\UrlHighlight\Validator\Validator:
        arguments: [false]
```

- Provide service id in `url_highlight.yaml` config
```yaml
# config/packages/url_highlight.yaml
url_highlight:
    validator: VStelmakh\UrlHighlight\Validator\Validator
```

## Credits
[Volodymyr Stelmakh](https://github.com/vstelmakh)  
Licensed under the MIT License. See [LICENSE](LICENSE) for more information.  