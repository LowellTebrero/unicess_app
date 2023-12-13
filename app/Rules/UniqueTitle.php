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

        // Check if any title has a matching sequence of 4 or 5 words with the new value
        foreach ($existingTitles as $existingTitle) {
            if ($this->hasMatchingSequence($existingTitle, $value, 4) || $this->hasMatchingSequence($existingTitle, $value, 5)) {
                return false;
            }
        }

        return true;
    }

    public function message()
    {
        return 'The title contains a matching sequence of 4 or 5 words with an existing project title.';
    }

    private function hasMatchingSequence($str1, $str2, $wordCount)
    {
        $words1 = explode(' ', $str1);
        $words2 = explode(' ', $str2);

        $len1 = count($words1);
        $len2 = count($words2);

        // Check if the length is less than the specified word count
        if ($len1 < $wordCount || $len2 < $wordCount) {
            return false;
        }

        for ($i = 0; $i <= $len1 - $wordCount; $i++) {
            $sequence = implode(' ', array_slice($words1, $i, $wordCount));
            if (strpos($str2, $sequence) !== false) {
                return true;
            }
        }

        return false;
    }

}
