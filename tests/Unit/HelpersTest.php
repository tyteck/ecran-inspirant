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

    /** @test */
    public function chunk_text_should_return_empty_array(): void
    {
        $chunks = chunkText('', '');

        $this->assertIsArray($chunks);
        $this->assertCount(0, $chunks);
    }

    /** @test */
    public function chunk_text_by_sentences(): void
    {
        $chunks = chunkText($this->lorem, '.');

        $this->assertIsArray($chunks);
        $this->assertCount(3, $chunks);

        $expectedChunks = [
            'Lorem ipsum dolor sit amet, consectetur adipiscing elit',
            'Morbi bibendum non sapien vitae tempus',
            'Nulla pellentesque ornare sagittis',
        ];
        $this->assertEqualsCanonicalizing($expectedChunks, $chunks);
    }

    /** @test */
    public function chunk_text_by_tab(): void
    {
        $chunks = chunkText("Lorem\tIpsum\tDolor", "\t");

        $this->assertIsArray($chunks);
        $this->assertCount(3, $chunks);

        $expectedChunks = [
            'Lorem', 'Ipsum', 'Dolor',
        ];
        $this->assertEqualsCanonicalizing($expectedChunks, $chunks);
    }

    /** @test */
    public function chunk_text_by_words(): void
    {
        $chunks = chunkText('Lorem ipsum dolor sit amet, consectetur adipiscing elit', ' ');

        $this->assertIsArray($chunks);
        $this->assertCount(8, $chunks);

        $expectedChunks = [
            'Lorem', 'ipsum', 'dolor', 'sit', 'amet,', 'consectetur', 'adipiscing', 'elit',
        ];
        $this->assertEqualsCanonicalizing($expectedChunks, $chunks);
    }

    /** @test */
    public function chunk_by_words_and_assemble(): void
    {
        $chunks = chunkText(
            text: 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.',
            separator: ' ',
            assemble: 5
        );

        $this->assertIsArray($chunks);
        $this->assertCount(2, $chunks);

        $expectedChunks = [
            'Lorem ipsum dolor sit amet,', 'consectetur adipiscing elit.',
        ];
        $this->assertEqualsCanonicalizing($expectedChunks, $chunks);
    }

    /**
     * @test
     *
     * @dataProvider provideTextToChunk
     *
     * @param mixed $text
     * @param mixed $expectedChunks
     */
    public function chunk_smart(string $text, array $expectedChunks): void
    {
        $chunks = chunkSmart(text: $text);
        $this->assertIsArray($chunks);
        $this->assertCount(count($expectedChunks), $chunks);

        $this->assertEqualsCanonicalizing($expectedChunks, $chunks);
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
}
