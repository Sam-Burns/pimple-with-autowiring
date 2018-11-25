<?php
namespace SamBurns\PimpleWithAutowiring;

use Pimple\Container as PimpleContainer;
use Pimple\Psr11\Container as PimplePsr11Container;
use Psr\Container\ContainerInterface;
use Symfony\Component\DependencyInjection\Container as SymfonyContainer;
use UltraLite\CompositeContainer\CompositeContainer;

class ContainerFactory
{
    private $pimple;

    public function __construct(PimpleContainer $pimple)
    {
        $this->pimple = $pimple;
    }

    public function create(): ContainerInterface
    {
        $compositeContainer = new CompositeContainer();
        $compositeContainer->addContainer(new PimplePsr11Container($this->pimple));

        $symfonyContainer = new SymfonyContainer();
        $compositeContainer->addContainer($symfonyContainer);

        return $compositeContainer;
    }
}
