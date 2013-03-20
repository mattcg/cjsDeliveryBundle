# cjsDeliveryBundle #

Symfony2 Bundle that provides CommonJS module compilation in the form of an Assetic filter.

Based on [cjsDelivery](https://github.com/mattcg/cjsDelivery).

## Usage ##

### Step 1 ###

Add `mattcg/cjsdelivery-bundle` as a dependency in your project's `composer.json` file if you're using Composer to manage dependencies.

```JavaScript
// composer.json
{
    "require": {
        "php": ">=5.4.0",
        "mattcg/cjsdelivery-bundle": "0.1.*"
    }
}
```

### Step 2 ###

Show Symfony how to use the cjsDelivery Assetic filter service.

```YAML
# app/config/config.yml
# Assetic Configuration
assetic:
    debug:          %kernel.debug%
    use_controller: false
    bundles:        [ cjsDeliveryDemoBundle ]
    filters:
        cssrewrite: ~
        cjs_delivery:
            resource: "%kernel.root_dir%/../vendor/mattcg/cjsdelivery-bundle/Resources/config/services.xml"
```

### Step 3 ###

This step is optional. Configure the filter in your Symfony parameters YAML file, as in the following example which uses all the available configuration options.

```YAML
# app/config/parameters.yml
parameters:
  matt_cg.cjs_delivery_filter.minify_identifiers: false
  matt_cg.cjs_delivery_filter.includes:
    - "%kernel.root_dir%/../components"
    - "/Users/someuser/.npm/node_modules"
  matt_cg.cjs_delivery_filter.parse_pragmas: true
  matt_cg.cjs_delivery_filter.pragmas:
  	- "DEBUG"
  matt_cg.cjs_delivery_filter.pragma_format: "/\/\/ ifdef (?<pragma>[A-Z_]+)\n(.*?)\n\/\/ endif \1/"
```

The options correspond to features in [cjsDelivery](https://github.com/mattcg/cjsDelivery). Specifying `pragma_format` is unnecessary if you're using the default format (the one shown in the example).

### Step 4 ###

Use the filter when outputting script tags in your templates. The following example shows how to do it in a Twig template.

```
{% javascripts filter="cjs_delivery" output="/js/compiled.js"
	'@cjsDeliveryDemoBundle/Resources/js/hello/main.js'
%}
	<script src="{{ asset_url }}"></script>
{% endjavascripts %}
```

## Credits and license ##

Copyright © 2013 [Matthew Caruana Galizia](http://twitter.com/mcaruanagalizia), licensed under a [Creative Commons Attribution 3.0 Unported (CC BY 3.0)](http://creativecommons.org/licenses/by/3.0/legalcode) license.
