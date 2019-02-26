<?php

namespace App\Repositories;

use App\Components\Image;
use App\Entities\Tag;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository
{
    private $entityName = 'App\Entities\User';

    /** @var EntityManager $em */
    private $em;

    public function __construct(EntityManager $em, $meta)
    {
        parent::__construct($em, $meta);
        $this->em = $em;
    }

    /**
     * @param $request
     * @param $id
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function update($request, $id)
    {
        $user = $this->em->find($this->entityName, $id);
        $user->setName($request['name']);
        $user->setEmail($request['email']);

        $image = new Image();
        $image->update($request['avatar'], $user->getAvatar());

        $user->setAvatar($image->getName());

        $this->em->persist($user);
        $this->em->flush();
    }
}
