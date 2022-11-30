<?php

declare(strict_types=1);

namespace App\Tests\Controller;

class ForumControllerTest extends AbstractControllerTest
{
    public function testDisplayForums(): void
    {
        $this->responseIsSuccessful('/forums/');
        self::assertSelectorTextContains('.card-header', 'Statistiques');
    }
}
