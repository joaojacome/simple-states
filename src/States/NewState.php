<?php

namespace SimpleStates\States;

use SimpleStates\SimpleStates;
use SimpleStates\SimpleStatesInterface;
use SimpleStates\Exceptions\CannotUpgradeException;

class NewState extends SimpleStates
{
    /**
     * {@inheritDoc}
     *
     * @return bool
     */
    public function canUpgrade(): bool
    {
        //can be upgraded only if the price is 50 or less
        return $this->objState->getPrice() <= 50;
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
            return new LimitedState($this->objState);
        }
    }
}
