<?php

namespace App\Processors;

use gulch\Minify\Contract\ProcessorInterface;

use function preg_match_all, strlen, str_replace, preg_replace, str_contains;

class QuotesRemover implements ProcessorInterface
{
    public function process(string $buffer): string
    {
        if (strlen($buffer) === 0) {
            return '';
        }

        $matched_tags = [];

        /* preg_match_all('|<[^\/].+?((\w+)="(\S+)").+?>|', $buffer, $matches); */
        preg_match_all('|<[\w]+[^>]*>|', $buffer, $matched_tags);

        $search_array = [];
        $replace_array = [];
        $counter = 0;

        foreach ($matched_tags[0] as $matched_tag) {

            if (false === str_contains($matched_tag, '"')) {
                continue;
            }

            $new_tag = preg_replace(
                '|(\w+)="(\S+)"|i',
                '$1=$2',
                $matched_tag
            );

            $search_array[$counter] = $matched_tag;
            $replace_array[$counter] = $new_tag;

            ++$counter;
        }

        $buffer = str_replace($search_array, $replace_array, $buffer);

        return $buffer;
    }
}
