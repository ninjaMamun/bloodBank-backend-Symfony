<?php

namespace App\Message;

use App\Entity\Donor;

class SendWelcomeEmailMessage
{
    private $donorId;

    /**
     * @param $donorId
     */
    public function __construct($donorId)
    {
        $this->donorId = $donorId;
    }

    /**
     * @return mixed
     */
    public function getDonorId():int
    {
        return $this->donorId;
    }









}