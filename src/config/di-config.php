<?php


use DI\ContainerBuilder;
use DI\DependencyException;
use DI\NotFoundException;
use Doctrine\ORM\EntityManagerInterface;
use Irfan\Phplearning\App;
use Irfan\Phplearning\controller\LoginController;
use Irfan\Phplearning\controller\RegistrationController;
use Irfan\Phplearning\controller\UserGroupsController;
use Irfan\Phplearning\model\User;
use Irfan\Phplearning\model\UserRepo;
use Irfan\Phplearning\routing\FlightRouter;
use Irfan\Phplearning\routing\RouterContract;
use Irfan\Phplearning\routing\RouterManager;
use Irfan\Phplearning\utilities\SecurityUtility;
use Irfan\Phplearning\utilities\SessionManager;
use Irfan\Phplearning\utilities\SessionManagerContract;
use Irfan\Phplearning\view\LoginPresenter;
use Irfan\Phplearning\view\RegistrationPresenter;
use Irfan\Phplearning\view\UserGroupsPresenter;
use Psr\Container\ContainerInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use function DI\autowire;
use function DI\create;
use function DI\get;


$diGrape = [
    //database
    EntityManagerInterface::class => function () {
        return require __DIR__ . '/db-config.php';
    },
    UserRepo::class => function (ContainerInterface $c) {
        $em = $c->get(EntityManagerInterface::class);
        return $em->getRepository(User::class);
    },
    //app
    App::class => autowire(),
    // session manager
    SessionManagerContract::class => autowire(SessionManager::class),
    //twig
    FilesystemLoader::class => create()->constructor(__DIR__ . '/../view/temp/'),
    Environment::class => create()->constructor(get(FilesystemLoader::class)),
    // controller
    LoginController::class => autowire(),
    RegistrationController::class => autowire(),
    UserGroupsController::class=>autowire(),
    // presenter
    LoginPresenter::class => autowire(),
    RegistrationPresenter::class => autowire(),
    UserGroupsPresenter::class => autowire(),
    //router
    RouterContract::class => autowire(FlightRouter::class),
    // Utilities
    SecurityUtility::class => autowire(),
];


try {
    $builder = new ContainerBuilder();
    $builder->addDefinitions($diGrape);
    $container = $builder->build();
    return $container->get(App::class);
} catch (Exception $e) {
    return null;
}