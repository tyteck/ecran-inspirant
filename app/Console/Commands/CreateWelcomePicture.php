<?php

declare(strict_types=1);

namespace App\Console\Commands;

use App\Models\Quote;
use App\Services\FontPathSelector;
use App\Services\InspirationFont;
use App\Services\InspirationPicture;
use Illuminate\Console\Command;

class CreateWelcomePicture extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:welcome';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create welcome picture that will be displayed on index page.';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        // get random font
        $fontPath = (new FontPathSelector())->getOneFont();

        // get quote
        $text = Quote::getOne();

        $wantedDimensions = [
            'mobile' => ['width' => 300, 'height' => 300],
            'default' => ['width' => 600, 'height' => 800],
        ];
        foreach ($wantedDimensions as $name => $dimensions) {
            // create inspiration picture
            $picture = InspirationPicture::create($dimensions['width'], $dimensions['height'], fake()->hexColor());

            // add text
            InspirationFont::create(picture: $picture, fontPath: $fontPath, text: $text)
                ->alignMiddleCenter()
                ->applyToImage()
            ;

            $picturePath = public_path("images/welcome-{$name}.jpg");
            $picture->save($picturePath);
        }

        return Command::SUCCESS;
    }
}
