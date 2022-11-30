<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\Forum;
use App\Entity\Message;
use App\Entity\Thread;
use App\Entity\User;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ThreadFixtures extends BaseFixtures implements DependentFixtureInterface
{
    /** @var Thread[] */
    private array $threads = [];

    public function loadData(ObjectManager $manager): void
    {
        $this->createMany(Thread::class, FixturesSettings::THREADS_COUNT, function (Thread $thread): void {
            /** @var Forum $forum */
            $forum = $this->getRandomReference(Forum::class);

            /** @var User $author */
            $author = $this->getRandomReference(User::class);

            $thread->setTitle($this->faker->words(random_int(4, 8), true))
                ->setAuthor($author)
                ->setCreatedAt($this->faker->dateTimeBetween('-1 years'))
                ->setForum($forum)
            ;

            $this->faker->boolean(40) ? $thread->setLock(true) : $thread->setLock(false);
            $this->faker->boolean(10) ? $thread->setPin(true) : $thread->setPin(false);

            $this->threads[] = $thread;
        });

        foreach ($this->threads as $thread) {
            $firstMessage = new Message();
            $firstMessage->setAuthor($thread->getAuthor())
                ->setCreatedAt($thread->getCreatedAt())
                ->setContent($this->faker->sentences(random_int(1, 15), true))
                ->setThread($thread)
            ;

            if ($this->faker->boolean) {
                $firstMessage->setUpdatedAt($this->faker->dateTimeBetween($firstMessage->getCreatedAt()));
            } else {
                $firstMessage->setUpdatedAt($firstMessage->getCreatedAt());
            }

            $manager->persist($firstMessage);

            $thread->setLastMessage($firstMessage);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            ForumFixtures::class,
            UserFixtures::class,
        ];
    }
}
