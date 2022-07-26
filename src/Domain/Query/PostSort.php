<?php

namespace App\Domain\Query;

use App\Common\CQRS\Query;
use App\Domain\EnumType\Order;
use Symfony\Component\Validator\Constraints as Assert;

class PostSort implements Query
{
    public function __construct(
        #[Assert\NotBlank]
        public readonly string $by,

        #[Assert\Choice(choices: [Order::Asc, Order::Desc])]
        public readonly Order $order = Order::Desc,
    ){}
}
