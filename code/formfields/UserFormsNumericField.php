<?php


class UserFormsNumericField extends NumericField
{

    private $min;

    private $max;

    /**
     * @return mixed
     */
    public function getMin()
    {
        return $this->min;
    }

    /**
     * @param mixed $min
     */
    public function setMin($min)
    {
        if (!is_numeric($min)) {
            throw new Exception('$min must be a number.');
        }

        $this->min = $min;
    }

    /**
     * @return mixed
     */
    public function getMax()
    {
        return $this->max;
    }

    /**
     * @param mixed $max
     */
    public function setMax($max)
    {
        if (!is_numeric($max)) {
            throw new Exception('$min must be a number.');
        }
        $this->max = $max;
    }

    public function validate($validator)
    {
        $isValid = parent::validate($validator);
        if (!$isValid) {
            return false;
        }

        if ((!empty($this->min) && $this->value < $this->min) || (!empty($this->max) && $this->value > $this->max)) {
            $validator->validationError(
                $this->name,
                _t(
                    'UserFormsNumericField.ErrorMsg',
                    "This must be between {min} and {max}",
                    ['min' => $this->min, 'max' => $this->max]
                ),
                "validation",
                false
            );

            return false;
        }

        return true;
    }
}
