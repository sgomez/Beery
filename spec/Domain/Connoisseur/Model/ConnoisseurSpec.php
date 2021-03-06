<?php

declare(strict_types=1);

namespace spec\App\Domain\Connoisseur\Model;

use App\Domain\Connoisseur\Event\ConnoisseurRegistered;
use App\Domain\Connoisseur\Model\Email;
use App\Domain\Connoisseur\Model\Id;
use App\Domain\Connoisseur\Model\Name;
use App\Domain\Connoisseur\Model\Password;
use PhpSpec\ObjectBehavior;
use Tests\Service\Prooph\Spec\AggregateAsserter;

final class ConnoisseurSpec extends ObjectBehavior
{
    function let(): void
    {
        $this->beConstructedThrough('register', [
            new Id('e8a68535-3e17-468f-acc3-8a3e0fa04a59'),
            new Name('Krzystof Krawczyk'),
            new Email('krawczyk@biale.pl'),
            new Password('$2a$04$N2x1MTIgy8fth66TdWZ1NeHIjJIrK7Ns09I9xk1PDRn8IqkQSckua'),
        ]);

        (new AggregateAsserter())->assertAggregateHasProducedEvent(
            $this->getWrappedObject(),
            ConnoisseurRegistered::withData(
                new Id('e8a68535-3e17-468f-acc3-8a3e0fa04a59'),
                new Name('Krzystof Krawczyk'),
                new Email('krawczyk@biale.pl'),
                new Password('$2a$04$N2x1MTIgy8fth66TdWZ1NeHIjJIrK7Ns09I9xk1PDRn8IqkQSckua')
            )
        );
    }

    function it_has_id(): void
    {
        $this->id()->shouldBeLike(new Id('e8a68535-3e17-468f-acc3-8a3e0fa04a59'));
    }

    function it_has_email(): void
    {
        $this->email()->shouldBeLike(new Email('krawczyk@biale.pl'));
    }
}
