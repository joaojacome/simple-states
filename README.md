# What is this?

An example of how to validate state changes.

# Assumptions

* I'm assuming a default state path as New -> Active -> Outdated -> Removed.
* A class should implement a `ObjectStateInterface` to be compatible with this library
* The SimpleStates library will validate states changes from `New` to `Active` depending on the price.
	* If the price is less than 50, then a `New` state can upgrade directly into `Active`.
	* If greater than 50, it can be upgraded only to `Limited`, which would require a manual intervention.
* Changes from `Outdated` to `Active` are possible if less than 10 days passed since last action
	* If more than 10 days passed since last action, the state will be upgraded to `Removed`

# Usage

* Instantiate a state using the factory

```php
<?php
$factory = new SimpleStates\SimpleStatesFactory();
$sampleObject = new SampleObject(); //mock
$sampleObject->state = $factory->create($sampleObject, 1);
```

* Check if a state can be upgraded
```php
<?php
if ($sampleObject->state->canUpgrade()) {
	//good!
}
```

* Upgrade a state
```php
<?php
$sampleObject->state = $sampleObject->state->upgrade();
```