<?php

class SampleObject implements \SimpleStates\ObjectStateInterface
{
    public $price;
    public $last_action_date;
    public $state;
    public $approved;

    public function getLastActionDate(): \Carbon\Carbon
    {
        return $this->last_action_date;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function getApproved(): bool
    {
        return !!$this->approved;
    }

}
