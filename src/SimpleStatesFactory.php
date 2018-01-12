<?php

namespace SimpleStates;

use SimpleStates\States\NewState;
use SimpleStates\States\LimitedState;
use SimpleStates\States\ActiveState;
use SimpleStates\States\OutdatedState;
use SimpleStates\States\RemovedState;

class SimpleStatesFactory
{
    /**
     * Returns a new State corresponding to the given stateCode
     *
     * @param ObjectStateInterface $objState    An instance of a class that implements this interface
     * @param int $stateCode    A state code
     *
     * @return SimpleStatesInterface
     */
    public function create(ObjectStateInterface $objState, int $stateCode): SimpleStatesInterface
    {
        switch ($stateCode) {
            case 1:
                return new NewState($objState);
                break;
            case 2:
                return new LimitedState($objState);
                break;
            case 3:
                return new ActiveState($objState);
                break;
            case 4:
                return new OutdatedState($objState);
                break;
            case 5:
                return new RemovedState($objState);
                break;
            default:
                throw new \Exception();
                break;
        }
    }
}
