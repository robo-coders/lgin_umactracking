<?php
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Carbon\Carbon;

class PrefixRule implements Rule
{

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Auth()->user()->prefix === substr($value, 0, 2);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This must be uppercase';
    }
}
?>
