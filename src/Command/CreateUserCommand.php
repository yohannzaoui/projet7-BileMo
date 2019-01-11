<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 18/11/2018
 * Time: 12:31
 */

namespace App\Command;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class CreateUserCommand
 * @package App\Command
 */
class CreateUserCommand extends Command
{

    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @var User
     */
    private $user;

    /**
     * @var bool
     */
    private $name;

    /**
     * @var bool
     */
    private $email;


    /**
     * CreateUserCommand constructor.
     * @param UserRepository $repository
     * @param bool $name
     * @param bool $email
     * @throws \Exception
     */
    public function __construct(
        UserRepository $repository,
        $name = true,
        $email = true
    ) {
        parent::__construct();
        $this->repository = $repository;
        $this->user = new User();
        $this->name = $name;
        $this->email = $email;
    }


    /**
     *
     */
    protected function configure()
    {
        $this
            ->setName('app:create-user')
            ->setDescription('Create user account')
            ->setHelp("Cette commande vous assiste pour la création d'un compte utilisateur")
            ->addArgument('name', InputArgument::REQUIRED, 'Name of the user')
            ->addArgument('email', InputArgument::REQUIRED, 'Email user')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('You are about to create an user.');
        $output->writeln('Name: ' .$input->getArgument('name'));
        $output->writeln('Email: ' .$input->getArgument('email'));

        $this->user->setName($input->getArgument('name'));
        $this->user->setEmail($input->getArgument('email'));

        $this->repository->save($this->user);

        $output->writeln('user successfully created');
    }
}