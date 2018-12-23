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
class CreateClientCommand extends Command
{

    /**
     * @var EncoderFactoryInterface
     */
    private $encoderFactory;

    /**
     * @var ClientRepository
     */
    private $clientRepository;

    /**
     * @var Client
     */
    private $client;

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
     * @param ClientRepository $userRepository
     * @param bool $username
     * @param bool $password
     * @param bool $email
     * @throws \Exception
     */
    public function __construct(
        EncoderFactoryInterface $encoderFactory,
        ClientRepository $userRepository,
        $username = true,
        $password = true,
        $email = true
    ) {
        parent::__construct();
        $this->encoderFactory = $encoderFactory;
        $this->clientRepository = $userRepository;
        $this->client = new Client();
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
            ->setName('app:create-client')
            ->setDescription('Create client account')
            ->setHelp("Cette commande vous assiste pour la création d'un compte client")
            ->addArgument('username', InputArgument::REQUIRED, 'Username of the client')
            ->addArgument('password', InputArgument::REQUIRED, 'password client')
            ->addArgument('email', InputArgument::REQUIRED, 'Email client')
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
        $output->writeln('You are about to create an client.');
        $output->writeln('Username: ' .$input->getArgument('username'));
        $output->writeln('Password: ' .$input->getArgument('password'));
        $output->writeln('Email: ' .$input->getArgument('email'));
        $output->writeln('Role: ROLE_USER');

        $passwordEncode = $this->encoderFactory->getEncoder(Client::class)
            ->encodePassword($input->getArgument('password'), null);

        $this->client->setUsername($input->getArgument('username'));
        $this->client->setPassword($passwordEncode);
        $this->client->setEmail($input->getArgument('email'));
        $this->client->setRoles(['ROLE_USER']);

        $this->clientRepository->save($this->client);

        $output->writeln('Client successfully created');
    }
}