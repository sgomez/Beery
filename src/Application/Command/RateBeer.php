<?php

declare(strict_types=1);

namespace App\Application\Command;

use App\Domain\Beer\Model\Connoisseur;
use App\Domain\Beer\Model\Id;
use App\Domain\Beer\Model\Rate;
use Prooph\Common\Messaging\Command;
use Prooph\Common\Messaging\PayloadTrait;

final class RateBeer extends Command
{
    use PayloadTrait;

    private function __construct(array $payload)
    {
        $this->init();
        $this->setPayload($payload);
    }

    public static function create(Connoisseur $connoisseurEmail, Id $beerId, Rate $rate): self
    {
        return new self([
            'connoisseur_email' => $connoisseurEmail->value(),
            'beer_id' => $beerId->value(),
            'rate' => $rate->value(),
        ]);
    }

    public function connoisseurEmail(): Connoisseur
    {
        return new Connoisseur($this->payload()['connoisseur_email']);
    }

    public function beerId(): Id
    {
        return new Id($this->payload()['beer_id']);
    }

    public function rate(): Rate
    {
        return new Rate($this->payload()['rate']);
    }
}
