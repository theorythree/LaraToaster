# NavPrompt

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Total Downloads][ico-downloads]][link-downloads]

## Description
> An easy-to-use notification utility for your Laravel projects.

## How it Works
> LaraToaster uses the Laravel Session class to create a Flash message from your controllers. When a message is detected, it will inject a Buefy Toast object and alert the user of your message.

## How to Install
> This package requires that you have [Vue][link-vue], [Bulma][link-bulma] and [Buefy][link-buefy] installed in your Laravel project.

### Step 1: Via Composer

``` bash
$ composer require theorythree/laratoaster
```

### Step 2: Define the service provider and alias in your Laravel project

This package takes advantage of the new _auto-discovery_ feature found in Laravel 5.5+. If you're using that version of Laravel, then you may skip this step and move on to Step 3.

Add NavPrompt Service Provider to `config/app.php`.
``` php
'providers' => [

  /*
   * Application Service Providers...
   */

  TheoryThree\LaraToaster\LaraToasterServiceProvider::class,
];
```

Define the LaraToaster Alias in `config/app.php`.
```php
'aliases' => [

  /*
   * Aliases
   */
  'Toaster' => TheoryThree\LaraToaster\LaraToasterFacade::class,
];
```

### Step 3. Publish the plugin config file and the Vue Component file

Publish the configuration file to override the package defaults and install the LaraToaster.vue component.

`$ php artisan vendor:publish --tag=laratoaster`

>This command will generate a config file `config/laratoaster.php` and it will install the LaraToaster Vue component `resources/assets/js/components/LaraToaster.vue`.

### Step 4. Register Vue Component

Register the LaraToaster Vue Component in `resources/js/app.js`.
```javascript
Vue.component('laratoaster', require('./components/LaraToaster.vue'));

```

### Usage
LaraToaster can be used in your project whenever you need to notify the user of an event. Most commonly, in your CRUD controllers. LaraToaster uses the `Session::flash` method to set a Flash message.

1. Install package
2. Include `Vue.component('laratoaster', require('./components/LaraToaster.vue'));` in `resources/assets/js/app.js`
3. Include `{!! Toaster::toast() !!}` in your Blade template

---

### make()

`String make( String $type, String $message )`

#### Description
> This method can be used in your Blade template in cases when you wish to show an alert message every time the view is loaded. This method does not rely on a Session so it will trigger the alert instantly upon page load.

_Important_
>The method returns a Vue component named `<laratoastert>`, so you must make sure that you use `{!! !!}` instead of `{{ }}` to bracket the method in your Blade template or the returned string will be escaped.

> Also, you must put the

#### Parameters

###### $type
String: The type of message to be displayed. Accepts any class name supported by Buefy (do not include `is-` in your type name). (Options: `success`, `warning`, `danger`, `black`,` white`, `dark`, `light`, `info`)

###### $message
String: The alert message to be displayed.

#### Example

``` js
// resources/js/app.js
// make sure the Vue component is registered
Vue.component('laratoaster', require('./components/LaraToaster.vue'));

// make sure the Vue is set to the HTML element contained in your Blade template
// In this example, we're assuming a div with an id of #app.
const app = new Vue({
    el: '#app'
});

```

``` html
<!-- in your Blade Template -->
<div id="app">
  {!! Toaster::make("success","Instant toast, made right in the template!") !!}
</div>  

```
MORE METHODS HERE

---

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing
All contributors welcome. If you would like to contribute to this package please feel to submit a pull request, submit an issue, or request a feature.

See our [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for more details.

## Credits

- [Dan Merfeld][link-author] - Author and Maintainer.

## Contact
Want to get in touch to discuss this package, or another one you'd like us to build? Feel free to reach out to the maintainer of this package by emailing me at [dan@theorythree.com][link-mailme], follow or @ me on Twitter [@dmerfeld][link-tweetme]. I'd really like to hear from you. Honest.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/theorythree/LaraToast.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/theorythree/LaraToast/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/theorythree/LaraToast.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/theorythree/LaraToast.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/theorythree/LaraToast.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/theorythree/LaraToast
[link-travis]: https://travis-ci.org/theorythree/LaraToast
[link-scrutinizer]: https://scrutinizer-ci.com/g/theorythree/LaraToast/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/theorythree/LaraToast
[link-downloads]: https://packagist.org/packages/theorythree/LaraToast
[link-author]: https://github.com/dmerfeld
[link-contributors]: ../../contributors
[link-mailme]: mailto:dan@theorythree.com
[link-tweetme]: https://twitter.com/dmerfeld
[link-bulma]: https://bulma.io
[link-buefy]: https://buefy.github.io
[link-vue]: https://vuejs.org
