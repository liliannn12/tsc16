<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategoryFixtures extends Fixture
{

    public function __construct(private SluggerInterface $slugger){}

    public function load(ObjectManager $manager): void
    {
        $category = $this->createCategory(name:'CORDISTES', manager:$manager);
        $category=$this->createCategory(name:'SOUDURE', manager:$manager);
        $category=$this->createCategory(name:'TUYAUTERIE', manager:$manager);
        $category=$this->createCategory(name:'METALLERIE', manager:$manager);
        $category=$this->createCategory(name:'CHAUDRONNERIE', manager:$manager);
        $category=$this->createCategory(name:'FORMATION', manager:$manager);
        $category=$this->createCategory(name:'TOURNAGES', manager:$manager);
 
        $manager->flush();
    }

    public function createCategory(string $name, ObjectManager $manager){
        $category = new Category();
        $category->setName($name);
        $category->setSlug($this->slugger->slug($category->getName())->lower());
        $manager->persist($category);

        return $category;
    }
}
