<?php

namespace App\Repositories;

use App\Entities\Category;
use App\Entities\Post;
use App\Entities\Tag;
use App\Components\Image;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Dropbox\Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use LaravelDoctrine\ORM\Pagination\PaginatesFromParams;

/**
 * Class PostRepository
 * @package App\Repositories
 *
 * @property EntityManager $em
 */
class PostRepository extends EntityRepository
{
    /** @var EntityManager $em */
    private $em;

    public function __construct(EntityManager $em, $meta)
    {
        parent::__construct($em, $meta);
        $this->em = $em;
    }

    /**
     * @param $request
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function add($request)
    {
        $post = new Post();
        $post->setTitle($request['title']);
        $post->setSlug($request['title']);
        $post->setDescription($request['description']);
        $post->setContent($request['content']);
        $post->setIsPublic($request['is_public']);
        $post->setIsFeatured($request['is_featured']);
        $post->setDate($request['date']);

        $image = new Image();
        $image->saveToDirectory($request['image']);
        $image->fit();

        $post->setImage($image->getName());

        $tags = $this->em->getRepository(Tag::class)->findBy(['id' => $request['tags']]);
        $post->setTags($tags);

        $category = $this->em->find(Category::class, $request['category']);
        $post->setCategory($category);

        $this->em->persist($post);
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
        /** @var Post $post */
        $post = $this->em->find(Post::class, $id);
        $post->setTitle($request['title']);
        $post->setSlug($request['title']);
        $post->setDescription($request['description']);
        $post->setContent($request['content']);
        $post->setIsFeatured($request['is_featured']);
        $post->setIsPublic($request['is_public']);
        $post->setDate($request['date']);

        $image = new Image();
        $image->update($request['image'], $post->getImage());
        $image->fit();
        $post->setImage($image->getName());

        $category = $this->em->find(Category::class, $request['category']);
        $post->setCategory($category);

        // Это очень плохое решение?
        $tags = $this->em->getRepository(Tag::class)->findBy(['id' => $request['tags']]);
        $post->getTags()->clear();
        $post->setTags($tags);

        $this->em->persist($post);
    }

    /**
     * @param int $id
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function delete(int $id)
    {
        $post = $this->em->find(Post::class, $id);

        $image = new Image();
        $image->remove($post->getImage());
        $this->em->remove($post);
    }

    /**
     * Get related posts
     * @param Post $post
     * @return mixed
     */
    public function related(Post $post)
    {
        $query = $this->em->createQueryBuilder()
            ->select('p')
            ->from(Post::class, 'p')
            ->where('p.category = :category')
            ->andWhere('p.id != :id')
            ->setParameter('category', $post->getCategory())
            ->setParameter('id', $post->getId())
            ->getQuery();
        return $query->execute();
    }

    public function findBySlugTagAndPaginate(string $slug, int $limit = 8, int $page = 1): LengthAwarePaginator
    {
        $query = 'SELECT p FROM App\Entities\Post p  JOIN p.tags c WHERE c.slug = :slug';
        $query = $this->em->createQuery($query)
            ->setParameter(':slug', $slug);

        return $this->paginate($query, $limit, $page);
    }

    public function findBySlugCategoryAndPaginate(string $slug, int $limit = 8, int $page = 1): LengthAwarePaginator
    {
        $query = "SELECT p FROM App\Entities\Post p  JOIN p.category c WHERE c.slug = :slug";
        $query = $this->em->createQuery($query)
            ->setParameter(':slug', $slug);

        return $this->paginate($query, $limit, $page);
    }

    public function recentPosts()
    {
        $query = "SELECT p FROM App\Entities\Post p  ORDER BY p.date DESC";
        return $query = $this->em->createQuery($query)
            ->setMaxResults(2)
            ->getResult();
    }

    public function getAll()
    {
        $query = "SELECT p FROM App\Entities\Post p  ORDER BY p.date DESC";
        return $query = $this->em->createQuery($query)
            ->getResult();
    }

    use PaginatesFromParams;

    /**
     * @param int $limit
     * @param int $page
     * @return LengthAwarePaginator
     */
    public function all(int $limit = 8, int $page = 1): LengthAwarePaginator
    {
        // paginateAll is already public, you may use it directly as well.
        return $this->paginateAll($limit, $page);
    }


    public function findAll1($slug, $results = 10, $pageName = 'page')
    {
        $query = $this->createQueryBuilder('p')
            // ->leftJoin('p.category', 'c.slug', 'ON')
            ->join('p.category', 'c', 'ON')
            ->where('c.slug = :slug')
            //->orderBy('s.name', 'asc')
            ->setParameter('slug', $slug)
            /*   ->select('t', 'f', 'c')
               ->
               ->leftJoin('t.category', 'c', 'ON')
               ->orderBy('t.createdAt', 'asc')*/
            ->getQuery();

        return $this->paginate($query, $results, $pageName);
    }

    public function findAll2($results = 10, $pageName = 'page')
    {
        return $query = $this->createQueryBuilder('t')
            /*   ->select('t', 'f', 'c')
               ->leftJoin('t.first', 'f', 'ON')
               ->leftJoin('t.category', 'c', 'ON')
               ->orderBy('t.createdAt', 'asc')*/
            ->getQuery();

        //$this->paginate($query, $results, $pageName);
    }


    /**
     * @return mixed
     * TODO delete method
     */
    public function getAllComment()
    {
        $query = "SELECT p FROM App\Entities\Post p  LEFT JOIN App\Entities\Comment c ON p.id = c.post_id";
        return $query = $this->em->createQuery($query)
            ->getResult();
    }

    public function query()
    {
        //$query = 'SELECT u FROM App\Entities\Post u';
        //$query = 'SELECT p FROM App\Entities\Post p  JOIN App\Entities\Category c WHERE c.id = 14';
        //$query = 'SELECT p FROM App\Entities\Post p  JOIN p.category c WHERE c.id = 1';
        //$query = "SELECT p FROM App\Entities\Post p  JOIN p.category c WHERE c.slug = 'kategoriya-1'";
        $query = "SELECT p FROM App\Entities\Post p  JOIN p.tags c WHERE c.slug = :slug";
        return $query = $this->em->createQuery($query)
            ->setParameter(':slug', 321)
            ->getResult();
    }


}
