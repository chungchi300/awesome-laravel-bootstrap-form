<?php

/**
 * Created by PhpStorm.
 * User: jeffchung
 * Date: 2/18/17
 * Time: 9:33 PM
 */
namespace Jeffchung\Awesome\Facades;
use Illuminate\Support\Facades\Facade;

/**
 * Facade for Form
 *
 * @package Bootstrapper\Facades

 */
class Form extends Facade
{
    const FORM_HORIZONTAL = 'form-horizontal';
    const FORM_INLINE = 'form-inline';
    const FORM_SUCCESS = 'has-success';
    const FORM_WARNING = 'has-warning';
    const FORM_ERROR = 'has-error';
    const INPUT_LARGE = 'input-lg';

    /**
     * {@inheritdoc}
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'jeffchungawesome::form';
    }
}
