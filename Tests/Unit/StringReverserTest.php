<?php

declare(strict_types=1);

namespace Tests\Unit;

use PHPUnit\Framework\TestCase; 
use App\ReverseStringFunction\StringReverser;

class StringReverserTest extends TestCase
{
    public function testItReversesWordsPreservingCase(): void
    {
        $reverser = new StringReverser();

        $this->assertEquals(
            'Siht si na elpmaxe!',
            $reverser->reverseWordsPreservingCase('This is an example!')
        );

        $this->assertEquals(
            '¡Aloh, Odnum!',
            $reverser->reverseWordsPreservingCase('¡Hola, Mundo!')
        );
        
        $this->assertEquals(
            "Тевирп! А ыт ьшеанз юиротси Ыннаж д'Кра.",
            $reverser->reverseWordsPreservingCase("Привет! А ты знаешь историю Жанны д'Арк.")
        );

        $this->assertEquals(
            '12345 !@#$%',
            $reverser->reverseWordsPreservingCase('12345 !@#$%')
        );
    }
}