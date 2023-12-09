<?php

namespace App\Rules;

use App\Models\Proposal;
use Illuminate\Contracts\Validation\Rule;

class UniqueTitle implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        // Get the existing titles from the database
        $existingTitles = \App\Models\Proposal::pluck('project_title')->toArray();

        // Check if any title is too similar to the new value
        foreach ($existingTitles as $existingTitle) {
            // You can adjust the threshold based on your needs
            if ($this->countDifferentCharacters($existingTitle, $value) <= 50) {
                return false;
            }
        }

        return true;
    }

    public function message()
    {
        return 'The title is not unique or has more than one different character.';
    }

    private function countDifferentCharacters($str1, $str2)
    {
        $diffCount = 0;
        $len = min(strlen($str1), strlen($str2));

        for ($i = 0; $i < $len; $i++) {
            if ($str1[$i] !== $str2[$i]) {
                $diffCount++;
            }

            // You can adjust the threshold based on your needs
            if ($diffCount > 1) {
                return $diffCount;
            }
        }

        return $diffCount;
    }
}
