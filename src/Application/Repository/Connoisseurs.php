<?php

declare(strict_types=1);

namespace App\Application\Repository;

use App\Domain\Model\Connoisseur;

interface Connoisseurs
{
    public function add(Connoisseur $connoisseur): void;
}