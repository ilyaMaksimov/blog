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
    use PaginatesFromParams;

    /** @var EntityManager $em */
    private $em;

    public function __construct(EntityManager $em, $meta)
    {
        parent::__construct($em, $meta);
        $this->em = $em;
    }

    /**
     * Add post
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

        $image = new Image($request['image']);
        $image->saveToDirectory();
        $image->compressionToStandardSize();
        $post->setImage($image->getName());

        $tags = $this->em->getRepository(Tag::class)->findBy(['id' => $request['tags']]);
        $post->setTags($tags);

        $category = $this->em->find(Category::class, $request['category']);
        $post->setCategory($category);

        $this->em->persist($post);
    }

    /**
     * Update post
     *
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

        $image = new Image($request['image']);
        $image->update($post->getImage());
        $image->compressionToStandardSize();
        $post->setImage($image->getName());

        $category = $this->em->find(Category::class, $request['category']);
        $post->setCategory($category);

        $tags = $this->em->getRepository(Tag::class)->findBy(['id' => $request['tags']]);
        $post->getTags()->clear();
        $post->setTags($tags);

        $this->em->persist($post);
    }

    /**
     * Delete post
     *
     * @param int $id
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Doctrine\ORM\TransactionRequiredException
     */
    public function delete(int $id)
    {
        $post = $this->em->find(Post::class, $id);
        Image::remove($post->getImage());
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

    public function recentPosts()
    {
        $query = "SELECT p FROM App\Entities\Post p  ORDER BY p.date DESC";
        return $query = $this->em->createQuery($query)
            ->setMaxResults(2)
            ->getResult();
    }

    /**
     * Get public posts with pagination
     *
     * @param int $limit number of posts per page
     * @param int $page
     * @return LengthAwarePaginator
     */
    public function getPublicPostWithPagination(int $limit = 8, int $page = 1): LengthAwarePaginator
    {
        $query = 'SELECT p FROM App\Entities\Post p WHERE p.is_public = :public';
        $query = $this->em->createQuery($query)
            ->setParameter(':public', Post::STATUS_PUBLIC);

        return $this->paginate($query, $limit, $page);
    }

    /**
     * Find by slug tag with pagination
     *
     * @param string $slug
     * @param int $limit
     * @param int $page
     * @return LengthAwarePaginator
     */
    public function findBySlugTagWithPagination(string $slug, int $limit = 8, int $page = 1): LengthAwarePaginator
    {
        $query = 'SELECT p FROM App\Entities\Post p  JOIN p.tags c WHERE c.slug = :slug';
        $query = $this->em->createQuery($query)
            ->setParameter(':slug', $slug);

        return $this->paginate($query, $limit, $page);
    }

    /**
     * Find by slug category with pagination
     *
     * @param string $slug
     * @param int $limit
     * @param int $page
     * @return LengthAwarePaginator
     */
    public function findBySlugCategoryWithPagination(string $slug, int $limit = 8, int $page = 1): LengthAwarePaginator
    {
        $query = "SELECT p FROM App\Entities\Post p  JOIN p.category c WHERE c.slug = :slug";
        $query = $this->em->createQuery($query)
            ->setParameter(':slug', $slug);

        return $this->paginate($query, $limit, $page);
    }
}
