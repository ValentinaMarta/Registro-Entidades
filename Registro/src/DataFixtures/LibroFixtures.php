<?php

namespace App\DataFixtures;
use App\Entity\Libro;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LibroFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i=0; $i<30; $i++){
            $libro=new Libro();
            $libro->setNombre('Libro prueba ');
            $libro->setAutora('Autora prueba ');
            $libro->setEditorial('Editorial prueba ');
            $libro->setPrecio( 1.0);
            $manager->persist($libro);
        }

        $manager->flush();
    }
}
