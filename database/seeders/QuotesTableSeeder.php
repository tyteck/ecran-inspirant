<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Enums\Languages;
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
            ['Vis comme si tu devais mourir demain, apprends comme si tu devais vivre toujours.', 'Gandhi'],
            ["La vie est un mystère qu'il faut vivre, et non un problème à résoudre.", 'Gandhi'],
            ["La non-violence est l'arme des forts.", 'Gandhi'],
            ["Soyez vous-même le changement que\tvous voudriez voir dans le monde.", 'Gandhi'],
            ["Le succès n'est pas final, l'échec n'est pas fatal. C'est le courage de continuer qui compte.", 'Winston Churchill'],
            ["Tout est possible à qui rêve, ose, travaille et n'abandonne jamais.", 'Xavier Dolan'],
            ["La seule limite à notre épanouissement de demain, sera nos doutes d'aujourd'hui.", 'Franklin Delano Roosevelt'],
            ['Ceux qui ne font rien ne se trompent jamais.', 'Théodore de Banville'],
            ["Je ne perds jamais. Soit je gagne, soit j'apprends.", 'Nelson Mandela'],
            ["Vous ne pouvez pas être ce gamin, celui qui reste figé en haut\tdu toboggan en réfléchissant. Vous devez glisser.", 'Tina Fey'],
            ["J'ai appris, il y a longtemps, qu'il y a quelque chose de pire que de rater l'objectif : ne pas passer à l'action.", 'Mia Hamm'],
            ["Un jour, tu te réveilleras, et tu n'auras plus le temps de faire\tce que tu voulais faire. Fais-le donc maintenant.", 'Paulo Coelho'],
            ["Quand on ne peut revenir en arrière, on ne doit se préoccuper que de\tla meilleure façon d'aller de l'avant.", 'Paulo Coelho'],
            ["En suivant le chemin qui s'appelle plus tard, nous arrivons sur la place qui s'appelle jamais.", 'Sénèque'],
            ["Plus tard, il sera trop tard. Notre vie, c'est maintenant.", 'Jacques Prévert'],
            ["Dans 20 ans, tu seras plus déçu par les choses\tque tu n'as pas faites, que par celles que tu auras faites. Alors, sors des sentiers battus. Mets les voiles. Explore. Rêve. Découvre.", 'Mark Twain'],
            ["Prends le temps de réfléchir, mais lorsque c'est le moment de passer à l'action, cesse de penser et vas-y.", 'Andrew Jackson'],
            ["Croyez en vos rêves et\tils se réaliseront peut-être. Croyez en vous et ils se réaliseront sûrement.", 'Martin Luther King'],
            ["Le succès, c'est vous aimer vous-même, c'est aimer ce que vous faites, et c'est aimer comment vous le faites.", 'Maya Angelou'],
            ["Tu ne sais jamais à quel point tu es fort, jusqu'au jour où être fort reste ta seule option.", 'Bob Marley'],
            ["Il y a au fond de vous\tde multiples petites étincelles de potentialités ; elles ne demandent qu'un souffle pour\ts'enflammer en de magnifiques réussites.", 'Wilferd Arlan Peterson'],
            ['Soyez vous-même, tous les autres sont déjà pris.', 'Oscar Wilde'],
            ['La beauté est dans les yeux de celui qui regarde.', 'Oscar Wilde'],
            ["N'aimez jamais quelqu'un qui vous traite comme si vous étiez ordinaire.", 'Oscar Wilde'],
            ["L'expérience est le nom que chacun donne à ses erreurs.", 'Oscar Wilde'],
            ["Le but de la vie, ce n'est pas l'espoir de devenir parfait, c'est la volonté d'être toujours meilleur.", 'Ralph Waldo Emerson'],
            ["Le courage n'est pas l'absence de peur, mais la capacité de vaincre ce qui fait peur.", 'Nelson Mandela'],
            ["Le succès n'est pas final. L'echec n'est pas fatal. C'est le courage de continuer qui compte.", 'Winston Churchill'],
            ['Vis comme si tu devais mourir demain. Apprends comme si tu devais vivre toujours.', 'Gandhi'],
            ["La vie, c'est comme une bicyclette, il faut avancer pour ne pas perdre l'équilibre.", 'Albert Einstein'],
            ['Un problème sans solution est un problème mal posé.', 'Albert Einstein'],
            ['Si vous voulez vivre une vie heureuse, attachez-la à un but, non pas à des personnes ou des choses.', 'Albert Einstein'],
            ["Le monde ne sera pas détruit\tpar ceux qui font le mal, mais par ceux qui les regardent\tsans rien faire.", 'Albert Einstein'],
            ["Exige beaucoup de toi-même\tet attends peu des autres. Ainsi beaucoup d'ennuis te seront épargnés.", 'Confucius'],
            ["Un sourire coûte moins cher que l'électricité, mais donne autant de lumière.", 'Abbé Pierre'],
            ["J'parle pas aux cons, ça les instruit.", 'Michel Audiard'],
            ["Le premier savoir est le savoir de mon ignorance : c'est le début de l'intelligence.", 'Socrate'],
            ['Quand on veut on peut, quand on peut on doit.', 'Napoléon Bonaparte'],
            ["Celui qui accepte le mal\tsans lutter contre lui coopère avec lui.", 'Martin Luther King'],
            ["Un gagnant est un rêveur qui n'abandonne jamais.", 'Nelson Mandela'],
            ["Agissez comme s'il était impossible d'échouer.", 'Winston Churchill'],
            ["La vraie richesse d'un homme, en ce monde, se mesure au bien qu'il a fait autour de lui.", 'Mahomet'],
            ["Ils ne savaient pas que c'était impossible, alors ils l'ont fait.", 'Mark Twain'],
            ["Il n'existe que deux choses infinies, l'univers et la bêtise humaine. Mais pour l'univers, je n'ai pas de certitude absolue.", 'Albert Einstein'],
            ['Ne vis pas pour que ta présence se remarque, mais pour que ton absence se ressente.', 'Bob Marley'],
            ['Je pense, donc je suis.', 'René Descartes'],
            ['Mieux vaux fait que parfait.', 'Sheryl Sandberg'],
            ["Le mieux est l'ennemi du bien.", 'Voltaire'],
            ["Fais de ta vie un rêve, et d'un rêve, une réalité.", 'Antoine de Saint-Exupéry'],
            ['La vie est un défi à relever, un bonheur à mériter, une aventure à tenter.', 'Mère Teresa'],
            ["Les jaloux détruisent\tce qu'ils sont incapables de créer.", 'Paul Guth'],
            ["L'ignorant affirme, le savant doute, le sage réfléchit.", 'Aristote'],
            ['Sourire mobilise 15 muscles, mais faire la gueule en sollicite 40. Reposez-vous : souriez !', 'Christophe André'],
            ['Mesdames, un conseil. Si vous cherchez un homme beau, riche et intelligent... prenez-en trois !', 'Coluche'],
            ["Le succès de chaque femme\tdevrait être une source inspiration pour une autre. Nous devons nous élever les unes les autres. Soyez très courageuses : soyez fortes, avec beaucoup de bonté, et surtout soyez humbles.", 'Serena Williams'],
            ['Je me trompe, donc je suis.', 'Xavier Tartakover'],
            ['Il n’y a jamais d’échec, il n’y a que des expériences.', 'Michaels Claeys'],
            ["Apprendre de ses erreurs c'est avancer à grands pas.", 'Sharins'],
            ['Même les erreurs peuvent vous faire avancer.', 'Marc Jacobs'],
            ['On a le droit de faire des erreurs, mais le devoir de les corriger.', 'Pierre de Ronsard'],
            ['Ceux qui ne font rien ne se trompent jamais.', 'Théodore de Banville'],
            ["L'échec est le fondement de la réussite.", 'Lao-Tseu'],
            ["Je peux accepter l'échec, tout le monde rate quelque chose. Mais je ne peux pas accepter de ne pas essayer.", 'Michael Jordan'],
            ["Il n'y a qu'une façon d'échouer : c'est abandonner avant d'avoir réussi.", 'Georges Clémenceau'],
            ['Les faiblesses des hommes font la force des femmes.', 'Voltaire'],
            ['Au pays des Femmes, la tendresse est reine.', 'Taha-Hassine FERHAT'],
            ["Une femme sage ne veut être l'ennemie de personne ; une femme sage refuse d'être la victime de qui que ce soit.", 'Maya Angelou'],
            ["Ce n'est point aux femmes de se couvrir, mais aux hommes de se tenir.", 'Szczepan Yamenski'],
            ['Les femmes sont la mesure de la faiblesse des hommes.'],
            ["Il n'est pire aveugle\tque celui qui ne veut pas voir. Il n'est pire sourd\tque celui qui ne veut pas entendre.", 'Proverbe français'],
            ["Ne fait pas à autrui\tce que tu ne veux pas qu'on te fasse.", 'Proverbe français'],
            ["Tu vois la paille\tdans l'oeil de ton voisin, mais pas la poutre dans le tien.", 'Proverbe français'],
            ["À l'impossible nul n'est tenu.", 'Proverbe français'],
        ];

        $index = 1;
        $data = array_map(
            function ($item) use (&$index) {
                return [
                    'id' => $index++,
                    'text' => $item[0],
                    'source' => $item[1] ?? 'anonyme',
                    'language' => $item['language'] ?? Languages::FR,
                ];
            },
            $data
        );

        Quote::insert($data);
    }
}
