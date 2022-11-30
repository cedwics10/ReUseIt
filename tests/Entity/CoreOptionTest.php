<?php

declare(strict_types=1);

namespace App\Tests\Entity;

use App\Entity\CoreOption;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class CoreOptionTest extends KernelTestCase
{
    use TestUtilsTrait;

    protected AbstractDatabaseTool $databaseTool;

    protected function setUp(): void
    {
        parent::setUp();
        $this->databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
    }

    public function getEntity(): CoreOption
    {
        return (new CoreOption())
            ->setName('CoreOption name')
            ->setValue('CoreOption value')
        ;
    }

    public function testInvalidBlankNameEntity(): void
    {
        $invalidCoreOption = $this->getEntity()->setName('');
        $this->assertHasErrors($invalidCoreOption, 1);
    }

    public function testInvalidUsedName(): void
    {
        $this->databaseTool->loadAliceFixture([dirname(__DIR__) . '/Fixtures/core_options.yaml']);
        $this->assertHasErrors($this->getEntity()->setName('max_online_users'), 1);
    }
}
