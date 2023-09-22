<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Article;
use App\Entity\Category;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArticleFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', options:['label' => 'Titre'])
            ->add('content', TextareaType::class, [
                'attr' => ['id' => 'contenuArticle']
            ])
            ->add('user', EntityType::class, ['class' => User::class,'choice_label'=>'lastname','label'=> 'Auteur'])
            ->add('category', EntityType::class,
            ['class' => Category::class, 
            'choice_label' => 'name', 
            'label' => 'Catégories']);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
