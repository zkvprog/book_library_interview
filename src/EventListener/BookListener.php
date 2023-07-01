<?php

namespace App\EventListener;

use App\Entity\Book;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class BookListener
{
    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();

        if (!$entity instanceof Book) {
            return;
        }

        $entityManager = $args->getObjectManager();

        foreach ($entity->getAuthor() as $author) {
            $author->setBookCount($author->getBookCount() + 1);
            $entityManager->persist($author);
        }

        $entityManager->flush();
    }
}