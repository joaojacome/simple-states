<?php

namespace SimpleStates;

interface SimpleStatesInterface
{
    /**
     * Constructor
     *
     * @param ObjectStateInterface $objState An instance of a class that implements this interface
     */
    public function __construct(ObjectStateInterface $objState);

    /**
     * Updates current state
     *
     * @return SimpleStatesInterface
     */
    public function upgrade(): SimpleStatesInterface;

    /**
     * Checks if current state can be upgraded, based on a set of defined rules
     *
     * @return bool
     */
    public function canUpgrade(): bool;
}
