<?php

namespace App\Repositories;

use App\Components\Image;
use App\Entities\Tag;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class UserRepository extends EntityRepository
{
    const ENTITY_NAME = 'App\Entities\User';

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
        $user = $this->em->find(self::ENTITY_NAME, $id);
        $user->setName($request['name']);
        $user->setEmail($request['email']);

        $image = new Image();
        $image->update($request['avatar'], $user->getAvatar());

        $user->setAvatar($image->getName());

        $this->em->persist($user);
        $this->em->flush();
    }

    /**
     * @param $id
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function delete($id)
    {
        $user = $this->em->find(self::ENTITY_NAME, $id);
        $this->em->remove($user);
    }
}
