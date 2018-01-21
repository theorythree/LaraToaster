<?php
namespace TheoryThree\LaraToaster;
/**
 *
 * @license MIT
 * @package LaraToaster
 */

use Illuminate\Support\Facades\Facade;

class LaraToasterFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laratoaster';
    }
}
