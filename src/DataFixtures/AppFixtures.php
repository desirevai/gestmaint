<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\Agents;
use App\Entity\Directions;
use App\Entity\Fiche;
use App\Entity\Interventions;
use App\Entity\Ordinateurs;
use App\Entity\Pannes;
use App\Entity\Peripheriques;
use App\Entity\Services;
use App\Entity\Solutions;
use App\Entity\Techniciens;
use App\Entity\TypeFiche;
use App\Entity\TypeOrdinateur;
use App\Entity\User;

class AppFixtures extends Fixture
{
    private $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager)
    {
        $directions = [];
        $services = [];
        $peripherique = [];
        $agent = [];
        $ordinateur = [];
        $intervention = [];
        $typeOrdinateur = [];
        $fiche = [];
        $typeFiche = [];
        $technicien = [];
        $panne = [];
        $solution = [];

        $marque = ["HP", "DELL", "MAC", "TOSHOBA", "ACER", "ASUS"];
        $typeOrdi = ["DESKTOP", "LAPTOP", "ALL-IN-ONE"];
        $peri = [
            "Imprimante LasertJet MFP200",
            "Imprimante LasertJet MFP400",
            "Imprimante LasertJet MFP135",
            "Ecran 20 Pouces",
            "Ecran 22 Pouces",
            "Ecran 19 Pouces",
            "Imprimante LasertJet MFP1102",
            "Imprimante OfficeJet 2500"
        ];
        $fich = [
            "Fiche de sortie",
            "Fiche d'entrée"
        ];
        $nameTech = [
            "DIARRA",
            "DOUMBIA",
            "VAI",
            "CHERIF"
        ];
        $pans = [
            "RAM Defectueuse",
            "Boite d'alimentation defectueuse",
            "Disque dur defectueux",
            "Redemarrage cyclique",
            "BSOD"
        ];
        $proces = [
            "Dual Core",
            "Core 2 Duo",
            "Core I3",
            "Core I5",
            "Core I7"
        ];
        $typeR = [
            "DDR2",
            "DDR3",
            "DDR4"
        ];


        for ($i = 0; $i < 3; $i++) {
            $typeOrdinateur[$i] = (new TypeOrdinateur())
                ->setLibelle($typeOrdi[rand(0, count($typeOrdi) - 1)]);
            $manager->persist($typeOrdinateur[$i]);
        }
        for ($i = 0; $i < 3; $i++) {
            $typeFiche[$i] = (new TypeFiche())
                ->setLibelle($fich[rand(0, count($fich) - 1)]);
            $manager->persist($typeFiche[$i]);
        }
        for ($i = 0; $i < 5; $i++) {
            $technicien[$i] = (new Techniciens())
                ->setNom($nameTech[rand(0, count($nameTech) - 1)])
                ->setPrenoms("Prenom Technicien")
                ->setContact("0102030405")
                ->setEmail("email00$i@mail.com");
            $manager->persist($technicien[$i]);
        }
        for ($i = 0; $i < 7; $i++) {
            $panne[$i] = (new Pannes())
                ->setLibelle($pans[rand(0, count($pans) - 1)])
                ->setDescription("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.");
            $manager->persist($panne[$i]);
            for ($j = 0; $j < 3; $j++) {
                $solution[$j] = (new Solutions())
                    ->setLibelle("Solution 00$j")
                    ->addPanne($panne[$i])
                    ->setDescription("Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.");;
                $manager->persist($solution[$j]);
            }
        }

        for ($i = 0; $i < 5; $i++) {
            $directions[$i] = (new Directions())
                ->setLibelle("Direction 00$i")
                ->setSigle("DIR00$i");
            $manager->persist($directions[$i]);

            for ($j = 0; $j < rand(2, 5); $j++) {
                $services[$j] = (new Services())
                    ->setLibelle("Service $j-Dir $i")
                    ->setDirection($directions[$i]);
                $manager->persist($services[$j]);

                for ($k = 0; $k < 3; $k++) {
                    $agent[$k] = (new Agents())
                        ->setNom("Nom")
                        ->setPrenoms("Prenom Agent $k")
                        ->setContacts("0102030405")
                        ->setEmailPerso("email@perso.com")
                        ->setEmailPro("email@pro.com")
                        ->setService($services[rand(0, count($services) - 1)]);
                    $manager->persist($agent[$k]);

                    for ($s = 0; $s < 6; $s++) {
                        $peripherique[$s] = (new Peripheriques())
                            ->setLibelle($peri[rand(0, count($peri) - 1)])
                            ->setAgent($agent[rand(0, count($agent) - 1)]);
                        $manager->persist($peripherique[$s]);
                    }
                    for ($v = 0; $v < rand(1, 2); $v++) {
                        $ordinateur[$v] = (new Ordinateurs())
                            ->setModele($marque[rand(0, count($marque) - 1)])
                            ->setProcesseur($proces[rand(0, count($proces) - 1)])
                            ->setFrequence(3.5)
                            ->setRam(4.0)
                            ->setTypeRam([$typeR[rand(0, count($typeR) - 1)]])
                            ->setDisque(500)
                            ->setType($typeOrdinateur[rand(0, count($typeOrdinateur) - 1)])
                            ->setAgent($agent[$k]);
                        $manager->persist($ordinateur[$v]);

                        for ($w = 0; $w < rand(1, 6); $w++) {
                            $intervention[$w] = (new Interventions())
                                ->setDiagnostique("Le Lorem Ipsum est simplement du faux texte employé dans la composition et la mise en page avant impression. Le Lorem Ipsum est le faux texte standard de l'imprimerie depuis les années 1500, quand un imprimeur anonyme assembla ensemble des morceaux de texte pour réaliser un livre spécimen de polices de texte. Il n'a pas fait que survivre cinq siècles, mais s'est aussi adapté à la bureautique informatique, sans que son contenu n'en soit modifié. Il a été popularisé dans les années 1960 grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, et, plus récemment, par son inclusion dans des applications de mise en page de texte, comme Aldus PageMaker.")
                                ->setObservation("L'extrait standard de Lorem Ipsum utilisé depuis le XVIè siècle est reproduit ci-dessous pour les curieux. Les sections 1.10.32 et 1.10.33 du de Cicéron sont aussi reproduites dans leur version originale, accompagnée de la traduction anglaise de H. Rackham (1914).")
                                ->setOrdinateur($ordinateur[$v])
                                ->addTechnicien($technicien[rand(0, 4)])
                                ->addPanne($panne[rand(0, 4)])
                                ->setCreatedAt(new \Datetime());
                            $manager->persist($intervention[$w]);
                        }

                        for ($z = 0; $z < rand(1, 5); $z++) {
                            $fiche[$z] = (new Fiche())
                                ->setLibelle($fich[rand(0, count($fich) - 1)])
                                ->setType($typeFiche[rand(0, count($typeFiche) - 1)])
                                ->setOrdinateurs($ordinateur[$v])
                                ->setCreatedAt(new \Datetime());
                            $manager->persist($fiche[$z]);
                        }
                    }
                }
            }
        }

        $user = (new user())
            ->setEmail("user@sygma.inc")
            ->setUsername("sygma")
            ->setRoles(["ROLE_USER", "ROLE_ADMIN"]);
        $user->setPassword($this->passwordHasher->hashPassword(
            $user,
            'sygma'
        ));
        $manager->persist($user);

        $manager->flush();
    }
}
