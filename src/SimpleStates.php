<?php

namespace SimpleStates;

abstract class SimpleStates implements SimpleStatesInterface
{
    /**
     * @var ObjectStateInterface
     */
    protected $objState;

    /**
     * Constructor
     *
     * @param ObjectStateInterface $objState
     */
    public function __construct(ObjectStateInterface $objState)
    {
        $this->objState = $objState;
    }
}
