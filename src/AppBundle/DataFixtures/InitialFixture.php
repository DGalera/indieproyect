<?php

namespace AppBundle\DataFixtures;

use Faker;
use AppBundle\Entity\Category;
use AppBundle\Entity\UserMgr\Developer;
use AppBundle\Entity\Resource;
use AppBundle\Entity\Review;
use AppBundle\Entity\UserMgr\Reviewer;
use AppBundle\Entity\Videogame;
use Doctrine\Bundle\FixturesBundle\ORMFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class InitialFixture implements ORMFixtureInterface {

    public function load(ObjectManager $manager) {
        $jobFaker = Faker\Factory::create();

        //Categorys

        $Action = new Category();
        $Action->setDescription($jobFaker->sentence);
        $Action->setName("Action");

        $manager->persist($Action);

        $Adventure = new Category();
        $Adventure->setDescription($jobFaker->sentence);
        $Adventure->setName("Adventure");

        $manager->persist($Adventure);

        $Simulator = new Category();
        $Simulator->setDescription($jobFaker->sentence);
        $Simulator->setName("Simulator");

        $manager->persist($Simulator);

        $Strategy = new Category();
        $Strategy->setDescription($jobFaker->sentence);
        $Strategy->setName("Strategy");

        $manager->persist($Strategy);


        // Developer
        $jdca29 = new Developer();
        $jdca29->setUsername("jdca29");
        $jdca29->setEmail("jdca29@cuatrovientos.org");
        $jdca29->setPassword("1234");
        $jdca29->setCompany($jobFaker->company);
        $jdca29->setName($jobFaker->firstName);
        $jdca29->setSurnames($jobFaker->lastName);

        $manager->persist($jdca29);

        $sargentometraca = new Developer();
        $sargentometraca->setUsername("sargentometraca");
        $sargentometraca->setEmail("sargentometraca@cuatrovientos.org");
        $sargentometraca->setPassword("1234");
        $sargentometraca->setCompany($jobFaker->company);
        $sargentometraca->setName($jobFaker->firstName);
        $sargentometraca->setSurnames($jobFaker->lastName);

        $manager->persist($sargentometraca);

        $lekr7 = new Developer();
        $lekr7->setUsername("lekr7");
        $lekr7->setEmail("lekimaster@cuatrovientos.org");
        $lekr7->setPassword("1234");
        $lekr7->setCompany($jobFaker->company);
        $lekr7->setName($jobFaker->firstName);
        $lekr7->setSurnames($jobFaker->lastName);

        $manager->persist($lekr7);

        //Videogames

        $gtav = new Videogame();
        $gtav->setCategory($Action);
        $gtav->setDescription("Cuando un joven estafador, un ladrón de bancos retirado y un temible psicópata desquiciado se enredan con algunos de los personajes del submundo criminal, el gobierno de los Estados Unidos y la industria del entretenimiento, deben llevar a cabo una serie de peligrosos atracos para sobrevivir en una ciudad implacable en la que no se puede confiar en nadie, especialmente en ellos mismos.");
        $gtav->setDeveloper($jdca29);
        $gtav->setLogo("https://img.gta5-mods.com/q95/images/modded-cooler-gta-5-loading-screen-logo/3df0c9-2fe3a8abf83fdb39b09765ec00485e0c.png");
        $gtav->setTitle("Grand Theft Auto V");
        $gtav->setWeburl("https://www.rockstargames.com/V/restricted-content/agegate/form?redirect=https%3A%2F%2Fwww.rockstargames.com%2FV%2Fes&options=&locale=es_es");

        $manager->persist($gtav);

        $ageofempires = new Videogame();
        $ageofempires->setCategory($Strategy);
        $ageofempires->setDescription("Age of Empires (también conocido como Age of Empires I) es un videojuego de estrategia en tiempo real para computadoras personales, el primero de la serie homónima, lanzado el 26 de octubre de 1997 y escenificado en una línea del tiempo de 3000 años, desde la temprana Edad de Piedra hasta la Edad de Hierro.");
        $ageofempires->setDeveloper($sargentometraca);
        $ageofempires->setLogo("https://gamedustria.com/wp-content/uploads/2019/08/Age-of-Empires-Logo.jpg");
        $ageofempires->setTitle("Age of Empires");
        $ageofempires->setWeburl("https://www.ageofempires.com/");

        $manager->persist($ageofempires);

        $ark = new Videogame();
        $ark->setCategory($Adventure);
        $ark->setDescription("ARK: Survival Evolved es un juego de acción-aventura y supervivencia que utiliza una vista de primera persona, con la posibilidad de utilizar una de tercera persona en algunos casos. Para sobrevivir, los jugadores deben establecer una base, con una Hoguera y armas; actividades adicionales, como la domesticación y alimentación de los dinosaurios, requieren más recursos. El primer mapa del juego, conocido como 'The Island' (Ark en inglés) es de aproximadamente 48 kilómetros cuadrados; aproximadamente 36 kilómetros cuadrados de masa terrestre, con 12 kilómetros cuadrados de océano.");
        $ark->setDeveloper($lekr7);
        $ark->setLogo("https://gamehag.com/img/rewards/logo/ark-survival-evolved.png");
        $ark->setTitle("Ark Survival");
        $ark->setWeburl("https://survivetheark.com/");

        $manager->persist($ark);

        $spore = new Videogame();
        $spore->setCategory($Simulator);
        $spore->setDescription("Spore es una simulación que abarca del nivel celular al nivel galáctico. Consiste en varias fases más o menos largas, denominadas estadios, cada una con su propio estilo de juego, y una vez que la barra de ADN que está ubicada en la parte inferior se llena, el jugador obtiene la posibilidad de evolucionar y pasar al siguiente estadio, o, de lo contrario, quedarse jugando en el actual. Los estadios existentes son: de célula, de criatura, tribal, de civilización y del espacio. En su discurso de GDC, Wright comparó el estilo del juego de cada fase a un juego existente.");
        $spore->setDeveloper($lekr7);
        $spore->setLogo("https://upload.wikimedia.org/wikipedia/fi/b/ba/Spore_logo_38434873683.jpg");
        $spore->setTitle("Spore");
        $spore->setWeburl("http://spore.com");

        $manager->persist($spore);

        //Reviewers

        $jabatazo = new Reviewer();
        $jabatazo->setEmail("jabatazo@cuatrovientos.org");
        $jabatazo->setName($jobFaker->firstName);
        $jabatazo->setSurnames($jobFaker->lastName);
        $jabatazo->setUsername("jabatazo");
        $jabatazo->setPassword("1234");
        $jabatazo->setWeb("http://jabatazo.com");

        $manager->persist($jabatazo);

        $migadrain = new Reviewer();
        $migadrain->setEmail("migadrain@cuatrovientos.org");
        $migadrain->setName($jobFaker->firstName);
        $migadrain->setSurnames($jobFaker->lastName);
        $migadrain->setUsername("migadrain");
        $migadrain->setPassword("1234");
        $migadrain->setWeb("http://migadrain.com");

        $manager->persist($migadrain);

        //reviews

        $review1 = new Review();
        $review1->setPunctuation(10);
        $review1->setAnalysis($jobFaker->sentence);
        $review1->setReviewer($jabatazo);
        $review1->setVideogame($gtav);

        $manager->persist($review1);

        $review2 = new Review();
        $review2->setPunctuation(8);
        $review2->setAnalysis($jobFaker->sentence);
        $review2->setReviewer($migadrain);
        $review2->setVideogame($gtav);

        $manager->persist($review2);

        $review3 = new Review();
        $review3->setPunctuation(6);
        $review3->setAnalysis($jobFaker->sentence);
        $review3->setReviewer($jabatazo);
        $review3->setVideogame($ark);

        $manager->persist($review3);

        $review4 = new Review();
        $review4->setPunctuation(9);
        $review4->setAnalysis($jobFaker->sentence);
        $review4->setReviewer($migadrain);
        $review4->setVideogame($ark);

        $manager->persist($review4);

        $review5 = new Review();
        $review5->setPunctuation(8);
        $review5->setAnalysis($jobFaker->sentence);
        $review5->setReviewer($jabatazo);
        $review5->setVideogame($spore);

        $manager->persist($review5);

        $review6 = new Review();
        $review6->setPunctuation(5);
        $review6->setAnalysis($jobFaker->sentence);
        $review6->setReviewer($migadrain);
        $review6->setVideogame($spore);

        $manager->persist($review6);

        $review7 = new Review();
        $review7->setPunctuation(7);
        $review7->setAnalysis($jobFaker->sentence);
        $review7->setReviewer($jabatazo);
        $review7->setVideogame($ageofempires);

        $manager->persist($review7);

        $review8 = new Review();
        $review8->setPunctuation(3);
        $review8->setAnalysis($jobFaker->sentence);
        $review8->setReviewer($migadrain);
        $review8->setVideogame($ageofempires);

        $manager->persist($review8);

        $resource1 = new Resource();
        $resource1->setUrl("https://www.rockstargames.com/rockstar_games/games/img/screens/241-3.jpg");
        $resource1->setVideogame($gtav);
        $resource1->setType("image");

        $manager->persist($resource1);
        
        $resource2 = new Resource();
        $resource2->setUrl("https://i.ytimg.com/vi/TOxuNbXrO28/maxresdefault.jpg");
        $resource2->setVideogame($gtav);
        $resource2->setType("image");

        $manager->persist($resource2);
        
        $resource3 = new Resource();
        $resource3->setUrl("https://xombitgames.com/files/2015/03/GTA-V.jpg");
        $resource3->setVideogame($gtav);
        $resource3->setType("image");

        $manager->persist($resource3);
        
        $resource4 = new Resource();
        $resource4->setUrl("https://www.youtube.com/embed/QkkoHAzjnUs");
        $resource4->setVideogame($gtav);
        $resource4->setType("video");

        $manager->persist($resource4);
        
        $resource5 = new Resource();
        $resource5->setUrl("https://www.youtube.com/embed/3DBrG2YjqQA");
        $resource5->setVideogame($gtav);
        $resource5->setType("video");

        $manager->persist($resource5);
        
        $resource11 = new Resource();
        $resource11->setUrl("https://steamcdn-a.akamaihd.net/steam/apps/17390/0000006447.1920x1080.jpg?t=1490108896");
        $resource11->setVideogame($spore);
        $resource11->setType("image");

        $manager->persist($resource11);
        
        $resource21 = new Resource();
        $resource21->setUrl("https://st-listas.20minutos.es/images/2015-01/391713/4613797_640px.jpg?1420291736");
        $resource21->setVideogame($spore);
        $resource21->setType("image");

        $manager->persist($resource21);
        
        $resource31 = new Resource();
        $resource31->setUrl("https://vignette.wikia.nocookie.net/spore/images/9/9a/Spore_planet.jpg/revision/latest?cb=20100716051411");
        $resource31->setVideogame($spore);
        $resource31->setType("image");

        $manager->persist($resource31);
        
        $resource41 = new Resource();
        $resource41->setUrl("https://www.youtube.com/embed/zi2GvqboQfY?list=TLPQMjYwMjIwMjCMMRLraOimiw");
        $resource41->setVideogame($spore);
        $resource41->setType("video");

        $manager->persist($resource41);
        
        $resource51 = new Resource();
        $resource51->setUrl("https://www.youtube.com/embed/d_u2rXnVnxc");
        $resource51->setVideogame($spore);
        $resource51->setType("video");

        $manager->persist($resource51);
        
        $resource12 = new Resource();
        $resource12->setUrl("https://store-images.s-microsoft.com/image/apps.44561.67854144654891351.62e8ac86-d08d-4b3e-a943-500d5e0b2692.7c8422ad-1ebc-47b3-950c-a8fa0e652860?mode=scale&q=90&h=1080&w=1920");
        $resource12->setVideogame($ark);
        $resource12->setType("image");

        $manager->persist($resource12);
        
        $resource22 = new Resource();
        $resource22->setUrl("https://cdn.vox-cdn.com/thumbor/YPeX4ARUkYV0uppoIawTrO5N_N8=/0x0:1920x1080/1200x800/filters:focal(807x387:1113x693)/cdn.vox-cdn.com/uploads/chorus_image/image/62641262/vlcsnap_01564.0.png");
        $resource22->setVideogame($ark);
        $resource22->setType("image");

        $manager->persist($resource22);
        
        $resource32 = new Resource();
        $resource32->setUrl("https://image.winudf.com/v2/image1/Y29tLnN0dWRpb3dpbGRjYXJkLndhcmRydW1zdHVkaW9zLmFya19zY3JlZW5fMF8xNTUzNTI1NjAwXzA0MQ/screen-0.jpg?fakeurl=1&type=.jpg");
        $resource32->setVideogame($ark);
        $resource32->setType("image");

        $manager->persist($resource32);
        
        $resource42 = new Resource();
        $resource42->setUrl("https://www.youtube.com/embed/FW9vsrPWujI");
        $resource42->setVideogame($ark);
        $resource42->setType("video");

        $manager->persist($resource42);
        
        $resource52 = new Resource();
        $resource52->setUrl("https://www.youtube.com/embed/587ZD-y4LQE");
        $resource52->setVideogame($ark);
        $resource52->setType("video");

        $manager->persist($resource52);
        
        $resource13 = new Resource();
        $resource13->setUrl("https://steamcdn-a.akamaihd.net/steam/apps/813780/ss_f270aa4e146459dc8b75a69bfecf23d13b0e8df6.1920x1080.jpg?t=1581370390");
        $resource13->setVideogame($ageofempires);
        $resource13->setType("image");

        $manager->persist($resource13);
        
        $resource23 = new Resource();
        $resource23->setUrl("https://store-images.s-microsoft.com/image/apps.47758.13672427983916579.274b1ffd-9cde-4bef-9a3e-6f37073d5ed0.aed47fff-d756-4ed0-878d-ca2187620409?w=672&h=378&q=80&mode=letterbox&background=%23FFE4E4E4&format=jpg");
        $resource23->setVideogame($ageofempires);
        $resource23->setType("image");

        $manager->persist($resource23);
        
        $resource33 = new Resource();
        $resource33->setUrl("https://e.rpp-noticias.io/normal/2019/08/19/192819_829981.png");
        $resource33->setVideogame($ageofempires);
        $resource33->setType("image");

        $manager->persist($resource33);
        
        $resource43 = new Resource();
        $resource43->setUrl("https://www.youtube.com/embed/V7LZLx_5pu0");
        $resource43->setVideogame($ageofempires);
        $resource43->setType("video");

        $manager->persist($resource43);
       
        $resource53 = new Resource();
        $resource53->setUrl("https://www.youtube.com/embed/Q3rDhoWcVgQ");
        $resource53->setVideogame($ageofempires);
        $resource53->setType("video");

        $manager->persist($resource53);





        $manager->flush();
    }

}
