<?php

declare(strict_types=1);

namespace Tests\Traits;

trait ImageExpectations
{
    protected const GET_IMAGE_SIZE_WIDTH_INDEX = 0;
    protected const GET_IMAGE_SIZE_HEIGHT_INDEX = 1;
    protected const GET_IMAGE_SIZE_MIME_INDEX = 'mime';

    protected function checkImageExpectations(string $imageData, int $expectedWidth, int $expectedHeight): void
    {
        $imageInfos = getimagesizefromstring($imageData);
        $this->assertNotNull($imageInfos);
        $this->assertIsArray($imageInfos);
        $this->assertEquals(
            $expectedWidth,
            $imageInfos[self::GET_IMAGE_SIZE_WIDTH_INDEX],
            "expected width was {$expectedWidth}, obtained {$imageInfos[self::GET_IMAGE_SIZE_WIDTH_INDEX]}"
        );
        $this->assertEquals(
            $expectedHeight,
            $imageInfos[self::GET_IMAGE_SIZE_HEIGHT_INDEX],
            "expected height was {$expectedHeight}, obtained {$imageInfos[self::GET_IMAGE_SIZE_HEIGHT_INDEX]}"
        );
        $this->assertEquals('image/jpeg', $imageInfos[self::GET_IMAGE_SIZE_MIME_INDEX]);
    }
}
