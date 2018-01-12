<?php

namespace SimpleStates\States;

use SimpleStates\SimpleStates;
use SimpleStates\SimpleStatesInterface;
use SimpleStates\Exceptions\CannotUpgradeException;

class ActiveState extends SimpleStates
{
    /**
     * {@inheritDoc}
     *
     * @return bool
     */
    public function canUpgrade(): bool
    {
        //can be upgraded if at least 60 days passed since last change
        return $this->objState->getLastActionDate()
            ->addDays(60) <= \Carbon\Carbon::now();
    }

    /**
     * {@inheritDoc}
     *
     * @return SimpleStatesInterface
     */
    public function upgrade(): SimpleStatesInterface
    {
        if ($this->canUpgrade()) {
            return new OutdatedState($this->objState);
        } else {
            throw new CannotUpgradeException();
        }
    }
}
