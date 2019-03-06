<?php

namespace App\Repositories;

use App\Entities\Category;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Dropbox\Exception;

/**
 * Class CategoryRepository
 * @package App\Repositories
 *
 * @property EntityManager $em
 */
class CategoryRepository extends EntityRepository
{
    /** @var EntityManager $em */
    private $em;

    public function __construct(EntityManager $em, $meta)
    {
        parent::__construct($em, $meta);
        $this->em = $em;
    }

    /**
     * Add category
     *
     * @param array $request
     * @throws \Doctrine\ORM\ORMException
     */
    public function add(array $request)
    {
        $category = new Category();
        $category->setTitle($request['title']);
        $category->setSlug($request['title']);

        $this->em->persist($category);
    }

    /**
     * Update category
     *
     * @param array $request
     * @param int $id
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function update(array $request, int $id)
    {
        $category = $this->em->find(Category::class, $id);
        $category->setTitle($request['title']);
        $category->setSlug($request['title']);

        $this->em->persist($category);
    }

    /**
     * Delete category
     *
     * @param int $id
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function delete(int $id)
    {
        $category = $this->em->find(Category::class, $id);
        $this->em->remove($category);
    }

    /**
     * Select id and title categories
     *
     * @return mixed
     */
    public function selectIdAndTitle()
    {
        $query = 'SELECT c.id, c.title FROM App\Entities\Category c';
        return $this->em->createQuery($query)
            ->getResult();
    }
}
