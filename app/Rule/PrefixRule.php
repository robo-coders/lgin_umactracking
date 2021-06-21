<?php
namespace App\Rule;

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
        $return = false;
        $prefix_arr = [];
        $prefixes = Auth()->user()->prefix;
        foreach($prefixes as $pre){
            array_push($prefix_arr, $pre->prefix); 
        }
        $chunk =    strtolower(substr($value, 0, 2));
        if(in_array($chunk, $prefix_arr)){
            $return = true;
        }else{
            $chunk =    strtolower(substr($value, 0, 3));
            if(in_array($chunk, $prefix_arr)){
                $return = true;
            }
        }
        
        return $return;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Invalid Prefix';
    }
}
?>
