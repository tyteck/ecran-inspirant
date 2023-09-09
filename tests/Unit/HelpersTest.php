<?php

declare(strict_types=1);

namespace Tests\Unit;

use Tests\TestCase;

/**
 * @internal
 */
class HelpersTest extends TestCase
{
    protected string $lorem = 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi bibendum non sapien vitae tempus. Nulla pellentesque ornare sagittis.';

    /**
     * @test
     *
     * @dataProvider provideTextToChunk
     *
     * @param mixed $text
     * @param mixed $expectedChunks
     */
    public function chunk_smart_should_be_good(string $text, array $expectedChunks): void
    {
        $chunks = chunkSmart(text: $text);
        $this->assertIsArray($chunks);
        $this->assertCount(count($expectedChunks), $chunks);

        $this->assertEqualsCanonicalizing($expectedChunks, $chunks);
    }

    /**
     * @test
     *
     * @dataProvider provideTextToChunkAsString
     *
     * @param mixed $text
     */
    public function chunk_smart_as_string_should_be_good(string $text, string $expectedResult): void
    {
        $result = chunkSmart(text: $text, asString: true);
        $this->assertIsString($result);

        $this->assertEquals($expectedResult, $result);
    }

    /*
    |--------------------------------------------------------------------------
    | helpers & providers
    |--------------------------------------------------------------------------
    */
    public static function provideTextToChunk(): array
    {
        return [
            [
                '', [],
            ],
            [
                'Lorem ipsum dolor sit amet.',
                ['Lorem ipsum dolor sit amet.'],
            ],
            [
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi bibendum non sapien vitae tempus. Nulla pellentesque ornare sagittis.',
                [
                    'Lorem ipsum dolor sit amet,',
                    'consectetur adipiscing elit.',
                    'Morbi bibendum non sapien vitae tempus.',
                    'Nulla pellentesque ornare sagittis.',
                ],
            ],
            [
                "C'est pas parce qu'on a rien à dire qu'il faut fermer sa gueule.",
                ["C'est pas parce qu'on a rien à dire qu'il faut fermer sa gueule."],
            ],
            [
                "La vie, c'est comme une boîte de chocolats, on ne sait jamais sur quoi on va tomber! Forrest Gump (1994).",
                [
                    'La vie,',
                    "c'est comme une boîte de chocolats,",
                    'on ne sait jamais sur quoi on va tomber!',
                    'Forrest Gump (1994).',
                ],
            ],
            [
                "On n'a qu'à manger des artichauts. Les artichauts, c'est un vrai plat de pauvres. C'est le seul plat que quand t'as fini de manger, t'en as plus dans ton assiette que quand tu as commencé !",
                [
                    "On n'a qu'à manger des artichauts.",
                    'Les artichauts,',
                    "c'est un vrai plat de pauvres.",
                    "C'est le seul plat que quand t'as fini de manger,",
                    "t'en as plus dans ton assiette que quand tu as commencé !",
                ],
            ],
        ];
    }

    public static function provideTextToChunkAsString(): array
    {
        return [
            [
                '', '',
            ],
            [
                'Lorem ipsum dolor sit amet.',
                'Lorem ipsum dolor sit amet.',
            ],
            [
                'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi bibendum non sapien vitae tempus. Nulla pellentesque ornare sagittis.',
                'Lorem ipsum dolor sit amet,' . PHP_EOL .
                'consectetur adipiscing elit.' . PHP_EOL .
                'Morbi bibendum non sapien vitae tempus.' . PHP_EOL .
                'Nulla pellentesque ornare sagittis.',
            ],
            [
                "C'est pas parce qu'on a rien à dire qu'il faut fermer sa gueule.",
                "C'est pas parce qu'on a rien à dire qu'il faut fermer sa gueule.",
            ],
            [
                "La vie, c'est comme une boîte de chocolats, on ne sait jamais sur quoi on va tomber! Forrest Gump (1994).",
                'La vie,' . PHP_EOL .
                "c'est comme une boîte de chocolats," . PHP_EOL .
                'on ne sait jamais sur quoi on va tomber!' . PHP_EOL .
                'Forrest Gump (1994).',
            ],
            [
                "On n'a qu'à manger des artichauts. Les artichauts, c'est un vrai plat de pauvres. C'est le seul plat que quand t'as fini de manger, t'en as plus dans ton assiette que quand tu as commencé !",
                "On n'a qu'à manger des artichauts." . PHP_EOL .
                'Les artichauts,' . PHP_EOL .
                "c'est un vrai plat de pauvres." . PHP_EOL .
                "C'est le seul plat que quand t'as fini de manger," . PHP_EOL .
                "t'en as plus dans ton assiette que quand tu as commencé !",
            ],
        ];
    }
}
