<?php

namespace Irfan\Phplearning;

use DI\ContainerBuilder;
use Irfan\Phplearning\controller\RegistrationController;
use Irfan\Phplearning\routing\RouterManager;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class App
{
    public function init(): void
    {
        try {
            $builder = new ContainerBuilder();
            $builder->addDefinitions(__DIR__ . '/config/di-config.php');
            $container = $builder->build();
            $controller = $container->get(RouterManager::class);
            $controller->init();
        } catch (LoaderError $e) {

        } catch (RuntimeError $e) {

        } catch (SyntaxError $e) {

        } catch (\Exception $e) {
        }
    }

}