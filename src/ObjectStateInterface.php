<?php

namespace SimpleStates;

use \Carbon\Carbon;

interface ObjectStateInterface
{
    /**
     * Returns the last action date field
     *
     * @return Carbon
     */
    public function getLastActionDate(): Carbon;

    /**
     * Returns the price field
     *
     * @return int
     */
    public function getPrice(): int;

    /**
     * Returns the approved field
     *
     * @return bool
     */
    public function getApproved(): bool;
}
