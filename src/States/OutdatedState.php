<?php

namespace SimpleStates\States;

use SimpleStates\SimpleStates;
use SimpleStates\SimpleStatesInterface;
use SimpleStates\Exceptions\CannotUpgradeException;

class OutdatedState extends SimpleStates
{
    /**
     * {@inheritDoc}
     *
     * @return bool
     */
    public function canUpgrade(): bool
    {
        //can be upgraded if at least 10 days passed since last action
        return $this->objState->getLastActionDate()
            ->addDays(10) <= \Carbon\Carbon::now();
    }

    /**
     * {@inheritDoc}
     *
     * @return SimpleStatesInterface
     */
    public function upgrade(): SimpleStatesInterface
    {
        if ($this->canUpgrade()) {
            return new RemovedState($this->objState);
        } else {
            return new ActiveState($this->objState);
        }
    }
}
