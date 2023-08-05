<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Quote;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('quotes')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        /**
         * Parents categories.
         */
        $data = [
            ['text' => 'Vis comme si tu devais mourir demain, apprends comme si tu devais vivre toujours.', 'source' => 'Gandhi'],
            ['text' => "Le succès n'est pas final, l'échec n'est pas fatal. C'est le courage de continuer qui compte.", 'source' => 'Winston Churchill'],
            ['text' => "Tout est possible à qui rêve, ose, travaille et n'abandonne jamais.", 'source' => 'Xavier Dolan'],
            ['text' => "La seule limite à notre épanouissement de demain sera nos doutes d'aujourd'hui.", 'source' => 'Franklin Delano Roosevelt'],
            ['text' => 'Ceux qui ne font rien ne se trompent jamais.', 'source' => 'Théodore de Banville'],
            ['text' => "Je ne perds jamais. Soit je gagne, soit j'apprends.", 'source' => 'Nelson Mandela'],
            ['text' => 'Vous ne pouvez pas être ce gamin qui reste figé en haut du toboggan en réfléchissant. Vous devez glisser.', 'source' => 'Tina Fey'],
            ['text' => "J'ai appris il y a longtemps qu'il y a quelque chose de pire que de rater l'objectif : ne pas passer à l'action.", 'source' => 'Mia Hamm'],
            ['text' => "Un jour, tu te réveilleras et tu n'auras plus le temps de faire ce que tu voulais faire. Fais-le donc maintenant.", 'source' => 'Paulo Coelho'],
            ['text' => "En suivant le chemin qui s'appelle plus tard, nous arrivons sur la place qui s'appelle jamais.", 'source' => 'Sénèque'],
            ['text' => "Plus tard, il sera trop tard. Notre vie, c'est maintenant.", 'source' => 'Jacques Prévert'],
            ['text' => "Dans 20 ans, tu seras plus déçu par les choses que tu n'as pas faites que par celles que tu auras faites. Alors, sors des sentiers battus. Mets les voiles. Explore. Rêve. Découvre.", 'source' => 'Mark Twain'],
            ['text' => "Prends le temps de réfléchir, mais lorsque c'est le moment de passer à l'action, cesse de penser et vas-y.", 'source' => 'Andrew Jackson'],
            ['text' => 'Croyez en vos rêves et ils se réaliseront peut-être. Croyez en vous et ils se réaliseront sûrement.', 'source' => 'Martin Luther King'],
            ['text' => "Le succès, c'est vous aimer vous-même, c'est aimer ce que vous faites et c'est aimer comment vous le faites.", 'source' => 'Maya Angelou'],
            ['text' => "Tu ne sais jamais à quel point tu es fort, jusqu'au jour où être fort reste ta seule option.", 'source' => 'Bob Marley'],
            ['text' => "Il y a au fond de vous de multiples petites étincelles de potentialités ; elles ne demandent qu'un souffle pour s'enflammer en de magnifiques réussites.", 'source' => 'Wilferd Arlan Peterson'],
            ['text' => 'Soyez vous-même, tous les autres sont déjà pris.', 'source' => 'Oscar Wilde'],
            ['text' => "Le but de la vie, ce n'est pas l'espoir de devenir parfait, c'est la volonté d'être toujours meilleur.", 'source' => 'Ralph Waldo Emerson'],
            ['text' => 'Bouge toi !'],
            ['text' => "Don't quit !", 'language' => Quote::LANGUAGE_EN],
        ];

        $index = 1;
        $data = array_map(
            function ($item) use (&$index) {
                return array_merge($item, [
                    'id' => $index++,
                    'category_id' => 6,
                    'source' => $item['source'] ?? '',
                    'language' => $item['language'] ?? Quote::LANGUAGE_FR,
                ]);
            },
            $data
        );
        Quote::insert($data);
    }
}
