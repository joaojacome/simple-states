<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use SimpleStates\ObjectStateInterface;
use SimpleStates\SimpleStatesFactory;
use SimpleStates\States\ActiveState;
use SimpleStates\States\LimitedState;
use SimpleStates\States\NewState;
use SimpleStates\States\OutdatedState;
use SimpleStates\States\RemovedState;
use SimpleStates\Exceptions\CannotUpgradeException;

require_once "SampleObject.php";

/**
 * @covers SimpleStates
 */
final class SimpleStatesTest extends TestCase
{
    public function testNewToLimited()
    {
        $factory = new SimpleStates\SimpleStatesFactory();
        $adv = new SampleObject();
        $adv->price = 51;
        $adv->state = $factory->create($adv, 1);
        $adv->state = $adv->state->upgrade();
        $this->assertInstanceOf(LimitedState::class, $adv->state);
    }

    public function testNewToActive()
    {
        $factory = new SimpleStates\SimpleStatesFactory();
        $adv = new SampleObject();
        $adv->price = 50;
        $adv->state = $factory->create($adv, 1);
        $adv->state = $adv->state->upgrade();
        $this->assertInstanceOf(ActiveState::class, $adv->state);
    }

    public function testLimitedToActiveException()
    {
        $this->expectException(CannotUpgradeException::class);
        $factory = new SimpleStates\SimpleStatesFactory();
        $adv = new SampleObject();
        $adv->price = 51;
        $adv->state = $factory->create($adv, 1);
        $adv->state = $adv->state->upgrade();
        $adv->state = $adv->state->upgrade();
    }
    
    public function testLimitedToActive()
    {
        $factory = new SimpleStates\SimpleStatesFactory();
        $adv = new SampleObject();
        $adv->price = 51;
        $adv->state = $factory->create($adv, 1);
        $adv->state = $adv->state->upgrade();
        $this->assertInstanceOf(LimitedState::class, $adv->state);
        $adv->approved = true;
        $adv->state = $adv->state->upgrade();
        $this->assertInstanceOf(ActiveState::class, $adv->state);
    }

    public function testActiveToOutdatedException()
    {
        $this->expectException(CannotUpgradeException::class);
        $factory = new SimpleStates\SimpleStatesFactory();
        $adv = new SampleObject();
        $adv->price = 51;
        $adv->last_action_date = \Carbon\Carbon::now()->subHours(1);
        $adv->state = $factory->create($adv, 3);
        $adv->state = $adv->state->upgrade();
    }

    public function testActiveToOutdatedException2()
    {
        $this->expectException(CannotUpgradeException::class);
        $factory = new SimpleStates\SimpleStatesFactory();
        $adv = new SampleObject();
        $adv->last_action_date = \Carbon\Carbon::now()->subDays(59);
        $adv->state = $factory->create($adv, 3);
        $adv->state = $adv->state->upgrade();
    }

    public function testActiveToOutdatedSuccess()
    {
        $factory = new SimpleStates\SimpleStatesFactory();
        $adv = new SampleObject();
        $adv->last_action_date = \Carbon\Carbon::now()->subDays(61);
        $adv->state = $factory->create($adv, 3);
        $adv->state = $adv->state->upgrade();
        $this->assertInstanceOf(OutdatedState::class, $adv->state);
    }

    public function testOutdatedToActive()
    {
        $factory = new SimpleStates\SimpleStatesFactory();
        $adv = new SampleObject();
        $adv->last_action_date = \Carbon\Carbon::now()->subDays(5);
        $adv->state = $factory->create($adv, 4);
        $adv->state = $adv->state->upgrade();
        $this->assertInstanceOf(ActiveState::class, $adv->state);
    }
    
    public function testOutdatedToRemoved()
    {
        $factory = new SimpleStates\SimpleStatesFactory();
        $adv = new SampleObject();
        $adv->last_action_date = \Carbon\Carbon::now()->subDays(11);
        $adv->state = $factory->create($adv, 4);
        $adv->state = $adv->state->upgrade();
        $this->assertInstanceOf(RemovedState::class, $adv->state);
    }
    
    public function testRemovedUpgrade()
    {
        $this->expectException(CannotUpgradeException::class);
        $factory = new SimpleStates\SimpleStatesFactory();
        $adv = new SampleObject();
        $adv->state = $factory->create($adv, 5);
        $adv->state = $adv->state->upgrade();
    }

}
