<?php

namespace App\Repositories;

use App\Components\Image;
use App\Entities\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Class UserRepository
 * @package App\Repositories
 *
 * @property EntityManager $em
 */
class UserRepository extends EntityRepository
{
    /** @var EntityManager $em */
    private $em;

    public function __construct(EntityManager $em, $meta)
    {
        parent::__construct($em, $meta);
        $this->em = $em;
    }

    /**
     *  Update user data
     *
     * @param $request
     * @param int $id
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function update($request, int $id)
    {
        $user = $this->em->find(User::class, $id);
        $user->setName($request['name']);
        $user->setEmail($request['email']);

        $image = new Image($request['avatar']);
        $image->update($user->getAvatar());
        $user->setAvatar($image->getName());

        $this->em->persist($user);
    }

    /**
     * Delete user
     *
     * @param int $id
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function delete(int $id)
    {
        $user = $this->em->find(User::class, $id);
        $this->em->remove($user);
    }
}
