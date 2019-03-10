<?php

namespace App\Console\Commands\User;

use App\Entities\User;
use App\Repositories\UserRepository;
use Illuminate\Console\Command;

/**
 * Class MakeAdminCommand
 * @package App\Console\Commands\User
 *
 * @property UserRepository $userRepository
 */
class MakeAdminCommand extends Command
{
    protected $signature = 'user:admin {email}';

    protected $description = 'make user admin by email';

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();

        $this->userRepository = $userRepository;
    }


    public function handle()
    {
        $email = $this->argument('email');

        $user = $this->userRepository->findOneBy(['email' => $email]);

        if (!$user) {
            $this->error('Undefined user with email ' . $email);
            return false;
        }

        try {
            $user->setIsAdmin(User::ADMIN);
            \EntityManager::persist($user);
            \EntityManager::flush();
        } catch (\DomainException $e) {
            $this->error($e->getMessage());
        }

        $this->info("Success make new admin - {$user->getName()} ({$email})");
        return true;
    }
}
