<?php

namespace Respect\Validation\Rules;

class NoneOf extends AbstractComposite
{

    public function assert($input)
    {
        $exceptions = $this->validateRules($input);
        $numRules = count($this->getRules());
        $numExceptions = count($exceptions);
        if ($numRules !== $numExceptions)
            throw $this->reportError($input)->setRelated($exceptions);
        return true;
    }

    public function validate($input)
    {
        $validators = $this->getRules();
        return count($validators) === count(array_filter(
                $validators,
                function($v) use($input) {
                    return!$v->validate($input);
                }
            ));
    }

}
