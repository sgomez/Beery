<?php

declare(strict_types=1);

namespace Tests\Behat\Context\Setup;

use App\Application\Command\RateBeer;
use App\Domain\Beer\Model\Beer;
use App\Domain\Beer\Model\Connoisseur as BeerConnoisseur;
use App\Domain\Beer\Model\Rate;
use App\Domain\Connoisseur\Model\Connoisseur;
use Behat\Behat\Context\Context;
use Prooph\ServiceBus\CommandBus;

final class RateContext implements Context
{
    /** @var CommandBus */
    private $commandBus;

    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @Given the :connoisseur connoisseur rated the :beer beer :rate
     * @Given /^(I) rated the ("[^"]+" beer) (\d+)$/
     */
    public function theBeerWithAbvHasBeenAdded(Connoisseur $connoisseur, Beer $beer, float $rate): void
    {
        $email = $connoisseur->email();

        $this->commandBus->dispatch(RateBeer::create(
            new BeerConnoisseur($email->value()),
            $beer->id(),
            new Rate($rate)
        ));
    }
}
