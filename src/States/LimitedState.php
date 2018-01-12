<?php

namespace SimpleStates\States;

use SimpleStates\SimpleStates;
use SimpleStates\SimpleStatesInterface;
use SimpleStates\Exceptions\CannotUpgradeException;

class LimitedState extends SimpleStates
{
    /**
     * {@inheritDoc}
     *
     * @return bool
     */
    public function canUpgrade(): bool
    {
        //can be upgraded only if the approved field is set to true
        return !!$this->objState->getApproved();
    }

    /**
     * {@inheritDoc}
     *
     * @return SimpleStatesInterface
     */
    public function upgrade(): SimpleStatesInterface
    {
        if ($this->canUpgrade()) {
            return new ActiveState($this->objState);
        } else {
            throw new CannotUpgradeException();
        }
    }
}
