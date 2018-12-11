<?php

namespace PrestijeLegend\Providers;

use IO\Helper\TemplateContainer;
use IO\Helper\ResourceContainer;
use Plenty\Plugin\Events\Dispatcher;
use Plenty\Plugin\ServiceProvider;
use Plenty\Plugin\Templates\Twig;

use PrestijeLegend\Extensions\FreeFieldsExtension;


/**
 * Class PrestijeLegendServiceProvider
 * @package PrestijeLegend\Providers
 */
class PrestijeLegendServiceProvider extends ServiceProvider
{
    const PRIORITY = 0;

    public function register()
    {

    }

    public function boot(Twig $twig, Dispatcher $dispatcher)
    {
        $twig->addExtension(FreeFieldsExtension::class);

        $eventDispatcher->listen('IO.Resources.Import', function (ResourceContainer $container) {
            $container->addStyleTemplate('PrestijeLegend::Stylesheet');
        }, self::PRIORITY);

        $dispatcher->listen('IO.tpl.item', function (TemplateContainer $container)
        {
            $container->setTemplate('PrestijeLegend::Item.SingleItemWrapper');
            return false;
        }, self::PRIORITY);
    }
}

