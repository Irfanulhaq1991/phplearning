<?php


use Doctrine\ORM\EntityManagerInterface;
use Irfan\Phplearning\controller\LoginController;
use Irfan\Phplearning\controller\RegistrationController;
use Irfan\Phplearning\model\User;
use Irfan\Phplearning\model\UserRepo;
use Irfan\Phplearning\routing\FlightRouter;
use Irfan\Phplearning\routing\RouterContract;
use Irfan\Phplearning\routing\RouterManager;
use Psr\Container\ContainerInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use function DI\autowire;
use function DI\create;
use function DI\get;


return [
    FilesystemLoader::class => create()->constructor(__DIR__ . '/../view/temp/'),
    Environment::class => create()->constructor(get(FilesystemLoader::class)),
    RegistrationController::class => autowire(),
    LoginController::class => autowire(),
    RouterContract::class => autowire(FlightRouter::class),
    RouterManager::class => autowire(),
    EntityManagerInterface::class => function () {
        return require __DIR__ . '/db-config.php';
    },
    UserRepo::class => function (ContainerInterface $c) {
        $em = $c->get(EntityManagerInterface::class);
        return $em->getRepository(User::class);
    },
];