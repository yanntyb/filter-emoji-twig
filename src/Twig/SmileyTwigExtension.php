<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class SmileyTwigExtension extends AbstractExtension
{
    private array $emoji = [
        ":)" => "😀",
        ";)" => "😉",
        "<3" => "♥️"
    ];

    public function getFilters(): array
    {
        return [
            new TwigFilter("smiley", [$this, "smileyToEmoji"])
        ];
    }

    public function smileyToEmoji(string $text): string
    {
        $replaced = $text;
        foreach($this->emoji as $key => $value){
            $replaced = $this->changeTextToEmoji($text, $key, $value);
        }
        return $replaced;
    }

    private function changeTextToEmoji(string $haystack, string $needle, string $emoji): string
    {
        if(str_contains($haystack, $needle)){
            return str_replace($needle,$emoji, $haystack);
        }
        return $haystack;
    }
}