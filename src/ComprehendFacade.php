<?php

namespace MichaelJWright\Comprehend;

use Illuminate\Support\Facades\Facade;

class ComprehendFacade extends Facade
{
    protected static function getFacadeAccessor() {
        return 'aws-comprehend';
    }
}
