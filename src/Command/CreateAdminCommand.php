<?php
/**
 * Created by PhpStorm.
 * User: Yohann Zaoui
 * Date: 18/11/2018
 * Time: 12:31
 */

namespace App\Command;

use App\Entity\Client;
use App\Repository\ClientRepository;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

/**
 * Class CreateClientCommand
 * @package App\Command
 */
class CreateAdminCommand extends Command
{

    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    /**
     * @var ClientRepository
     */
    private $repository;

    /**
     * @var Admin
     */
    private $admin;

    /**
     * @var bool
     */
    private $username;

    /**
     * @var bool
     */
    private $password;

    /**
     * @var bool
     */
    private $email;


    /**
     * CreateAdminCommand constructor.
     * @param EncoderFactoryInterface $encoderFactory
     * @param ClientRepository $repository
     * @param bool $username
     * @param bool $password
     * @param bool $email
     * @throws \Exception
     */
    public function __construct(
        EncoderFactoryInterface $encoderFactory,
        ClientRepository $repository,
        $username = true,
        $password = true,
        $email = true
    ) {
        parent::__construct();
        $this->encoderFactory = $encoderFactory;
        $this->repository = $repository;
        $this->admin = new Client();
        $this->username = $username;
        $this->password = $password;
        $this->email = $email;
    }


    /**
     *
     */
    protected function configure()
    {
        $this
            ->setName('app:create-admin')
            ->setDescription('Create admin account')
            ->setHelp("Cette commande vous assiste pour la création d'un compte client")
            ->addArgument('username', InputArgument::REQUIRED, 'Username of the admin')
            ->addArgument('password', InputArgument::REQUIRED, 'password admin')
            ->addArgument('email', InputArgument::REQUIRED, 'Email admin')
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
        $output->writeln('You are about to create an admin.');
        $output->writeln('Username: ' .$input->getArgument('username'));
        $output->writeln('Password: ' .$input->getArgument('password'));
        $output->writeln('Email: ' .$input->getArgument('email'));
        $output->writeln('Role: ROLE_ADMIN');

        $passwordEncode = $this->encoderFactory->getEncoder(Client::class)
            ->encodePassword($input->getArgument('password'), null);

        $this->admin->setUsername($input->getArgument('username'));
        $this->admin->setPassword($passwordEncode);
        $this->admin->setEmail($input->getArgument('email'));
        $this->admin->setRoles(['ROLE_ADMIN']);

        $this->repository->save($this->admin);

        $output->writeln('Admin successfully created');
    }
}