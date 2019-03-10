<?php

namespace App\Console\Commands\User;

use App\Repositories\SubscribeRepository;
use Illuminate\Console\Command;

/**
 * Class VerifyCommand
 * @package App\Console\Commands\User
 *
 * @property SubscribeRepository $subscribeRepository
 */
class VerifyCommand extends Command
{
    protected $signature = 'user:verify {email}';

    protected $description = 'Verify user by email';

    private $subscribeRepository;

    public function __construct(SubscribeRepository $subscribeRepository)
    {
        parent::__construct();

        $this->subscribeRepository = $subscribeRepository;
    }


    public function handle()
    {
        $email = $this->argument('email');

        $user = $this->subscribeRepository->findOneBy(['email' => $email]);

        if (!$user) {
            $this->error('Undefined user with email ' . $email);
            return false;
        }

        try {
            $user->verify();
            \EntityManager::persist($user);
            \EntityManager::flush();
        } catch (\DomainException $e) {
            $this->error($e->getMessage());
        }

        $this->info('Success verify email ' . $email);
        return true;
    }
}
