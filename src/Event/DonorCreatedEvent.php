<?php

namespace App\Event;

use App\Entity\Donor;
use Symfony\Contracts\EventDispatcher\Event;

class DonorCreatedEvent extends Event
{
    private Donor $donor;

    /**
     * @param Donor $donor
     */
    public function __construct(Donor $donor)
    {
        $this->donor = $donor;
    }

    /**
     * @return Donor
     */
    public function getDonor(): Donor
    {
        return $this->donor;
    }

}