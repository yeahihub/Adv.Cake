<?php

declare(strict_types=1);

namespace App\ReverseStringFunction;

class StringReverser
{
    public function reverseWordsPreservingCase(string $text): string
    {
    // Выполняет поиск символов в строке по шаблону и помещает его в массив $matches
    preg_match_all("/[^\s'-]+|['-]+|\s+/u", $text, $matches);

    $result = '';

    foreach ($matches[0] as $match) {
        // Если массив содержит буквы возвращает их в обратном порядке
        if (preg_match('/\p{L}/u', $match)) {
            $result .= $this->reverseWord($match);
        } else {
            $result .= $match;
        }
    }

    return $result;
    }

    public function reverseWord(string $word): string
    {
    // Извлекает все буквы из $word и помещает их в массив $letters
    preg_match_all('/\p{L}/u', $word, $letters);
    $letters = $letters[0];
    $reversedLetters = array_reverse($letters);

    // Сохраняет шаблон регистра
    $casePattern = [];
    foreach ($letters as $ch) {
        $casePattern[] = (mb_strtoupper($ch, 'UTF-8') === $ch);
    }

    // Применяет шаблон регистра к буквам в обратном порядке   
    $resultLetters = [];
    foreach ($reversedLetters as $i => $ch) {
        $resultLetters[] = $casePattern[$i]
            ? mb_strtoupper($ch, 'UTF-8')
            : mb_strtolower($ch, 'UTF-8');
    }

    // Вставляет буквы обратно, сохраняя пунктуацию
    $result = '';
    $j = 0;
    $len = mb_strlen($word, 'UTF-8');

    for ($i = 0; $i < $len; $i++) {
        $ch = mb_substr($word, $i, 1, 'UTF-8');
        if (preg_match('/\p{L}/u', $ch)) {
            $result .= $resultLetters[$j++];
        } else {
            $result .= $ch;
        }
    }

    return $result;
    }
}