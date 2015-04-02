<?php

class CCValidator extends Illuminate\Validation\Validator {

    public function validateCreditcard($attribute, $value, $parameters)
    {
        // Strip any non-digits (useful for credit card numbers with spaces and hyphens)
        $value=preg_replace('/\D/', '', $value);
        // Set the string length and parity_check
        $length=strlen($value);
        $parity_check=$length % 2;
        $total=0;
        for ($i=0; $i<$length; $i++) {
            $dig=$value[$i];
            if ($i % 2 == $parity_check) {
                $dig*=2;
                if ($dig > 9) {
                    $dig-=9;
                }
            }
            $total+=$dig;
        }
      return ($total % 10 == 0) ? TRUE : FALSE;
    }

}