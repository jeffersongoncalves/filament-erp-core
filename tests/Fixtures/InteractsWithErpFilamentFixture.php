<?php

namespace JeffersonGoncalves\FilamentErp\Core\Tests\Fixtures;

use JeffersonGoncalves\FilamentErp\Core\Testing\InteractsWithErpFilament;
use Orchestra\Testbench\TestCase;

/**
 * Gives PHPStan a concrete consumer for the InteractsWithErpFilament trait so
 * the trait body is analysed in the context of an Orchestra Testbench TestCase
 * (PHPStan skips traits that are used zero times).
 */
abstract class InteractsWithErpFilamentFixture extends TestCase
{
    use InteractsWithErpFilament;
}
