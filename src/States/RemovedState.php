<?php

namespace SimpleStates\States;

use SimpleStates\SimpleStates;
use SimpleStates\SimpleStatesInterface;
use SimpleStates\Exceptions\CannotUpgradeException;

class RemovedState extends SimpleStates
{
    /**
     * {@inheritDoc}
     *
     * @return bool
     */
    public function canUpgrade(): bool
    {
        //cannot be upgraded
        return false;
    }

    /**
     * {@inheritDoc}
     *
     * @return SimpleStatesInterface
     */
    public function upgrade(): SimpleStatesInterface
    {
        throw new CannotUpgradeException("Cannot be upgraded anymore.");
    }
}
