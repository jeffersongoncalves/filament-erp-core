<?php

namespace JeffersonGoncalves\FilamentErp\Core\Tests\Fixtures;

use JeffersonGoncalves\FilamentErp\Core\Concerns\SubmittableRecordActions;

/**
 * Gives PHPStan a concrete consumer for the SubmittableRecordActions trait so
 * the trait body is analysed (PHPStan skips traits that are used zero times).
 */
class SubmittableRecordActionsFixture
{
    use SubmittableRecordActions;
}
