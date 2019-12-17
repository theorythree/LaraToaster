# LaraToaster

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

Add LaraToaster Service Provider to `config/app.php`.
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

### Step 4. Install Buefy + Bulma

If you haven't already, install Buefy. Doing so will also install Bulma.
`$ yarn add buefy`


### Step 5. Register Vue Component

Register the LaraToaster Vue Component in `resources/assets/js/app.js`.
```javascript

// import BUEFY
import Buefy from 'buefy'
// Use Buefy
Vue.use(Buefy)

// Register LaraToast Vue Component
Vue.component('laratoaster', require('./components/LaraToaster.vue').default);

// Make sure to have a New Vue instance setup
const app = new Vue({
    el: '#app'
});

```

### Step 6. Run your compiler
Don't forget to run your compiler script to update your js files.
`$ yarn run dev` or `$ yarn run watch`


### Usage
LaraToaster can be used in your project whenever you need to notify the user of an event. Most commonly, in your CRUD controllers. LaraToaster uses the `Session::flash` method to set a Flash message.

1. Install package
2. Include `Vue.component('laratoaster', require('./components/LaraToaster.vue'));` in `resources/assets/js/app.js`
3. Include `{!! Toaster::toast() !!}` in your Blade template
4. Set the Toaster message in your controller (see example below)

---

### make()

`String make( String $type, String $message )`

#### Description
> This method can be used in your Blade template in cases when you wish to show an alert message every time the view is loaded. This method does not rely on a Session so it will trigger the alert instantly upon page load.

_Important_
>The method returns a Vue component named `<laratoastert>`, so you must make sure that you use `{!! !!}` instead of `{{ }}` to bracket the method in your Blade template or the returned string will be escaped.

> Also, you must put the tag within an instantiated Vue element. In the examples we're using a div with an id of #app.

#### Parameters

###### $type
String: The type of message to be displayed. Accepts any class name supported by Buefy (do not include `is-` in your type name). (Options: `success`, `warning`, `danger`, `black`,` white`, `dark`, `light`, `info`)

###### $message
String: The alert message to be displayed.

#### Example 1: Instant Toast

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

---

### toast()

`String toast()`

#### Description
> LaraToaster can also be used to rely on Session and this is more likely the setup you'll want to have in your projects. There are two parts to the setup. (1) the `toast()` method call in your Blade templates (which serves as a placeholder for where the `<laratoaster>` element will be injected into your template) and (2) the use of one of the many method calls in your controllers.

> Below, we're using the `success()` method because we're optimists.

_Important_
>The method returns a Vue component named `<laratoastert>`, so you must make sure that you use `{!! !!}` instead of `{{ }}` to bracket the method in your Blade template or the returned string will be escaped.

> Also, you must put the tag within an instantiated Vue element. In the examples we're using a div with an id of #app.

#### Example 2 - Standard Toaster Setup

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
  {!! Toaster::toast() !!}
</div>  

```

```php
<?php

// controller example

namespace App\Http\Controllers;

use Toaster; // (1) include Toaster
use Session;
use Illuminate\Http\Request;

class ItemController extends Controller
{

  // ...

  public function store(Request $request)
  {

    // your store() method code

    // (2) Call Toaster
    Toaster::success("Your item was saved.");
    return redirect()->route('items.show',$item->id);

  }

}


```
---

### success(), warning(), danger()

`String [success, warning, danger]( String $message )`

#### Description
> These methods can be used in your controller files to set the type of alert message you wish to trigger. In all cases the a Session Flash message will be set with the message you provide.

_Important_
> Do not forget to include `{!! Toaster::toast() !!}` in your Blade template within an instantiated Vue element.

#### Parameters

###### $message
String: The alert message to be displayed.

#### Example 3: Setting Your Toaster Messages

``` html
<!-- in your Blade Template -->
<div id="app">
  {!! Toaster::toast() !!}
</div>  

```

```php
<?php

/*
 Somewhere in your code probably a
 store(), update(), or destroy() method.
*/

Toaster::success("Success feels good!");
Toaster::warning("I got bad feeling about this.");
Toaster::danger("I imagined that working out differently.");

/*
 You can also use any of the other named functions
 that correspond with the Bulma status class names.
*/

Toaster::white("I don't see the world in black and white.");
Toaster::black("Who turned out the lights?");
Toaster::light("I probably should be used on a dark background.");
Toaster::dark("I probably should be used on a light background.");
Toaster::info("I'm cool either way.");

```

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

[ico-version]: https://img.shields.io/packagist/v/theorythree/LaraToaster.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/theorythree/LaraToast/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/theorythree/LaraToaster.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/theorythree/LaraToaster.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/theorythree/LaraToaster.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/theorythree/LaraToaster
[link-travis]: https://travis-ci.org/theorythree/LaraToaster
[link-scrutinizer]: https://scrutinizer-ci.com/g/theorythree/LaraToaster/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/theorythree/LaraToaster
[link-downloads]: https://packagist.org/packages/theorythree/LaraToaster
[link-author]: https://github.com/dmerfeld
[link-contributors]: ../../contributors
[link-mailme]: mailto:dan@theorythree.com
[link-tweetme]: https://twitter.com/dmerfeld
[link-bulma]: https://bulma.io
[link-buefy]: https://buefy.github.io
[link-vue]: https://vuejs.org
