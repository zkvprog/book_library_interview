<?php

namespace App\Admin;

use App\Entity\Author;
use App\Entity\Book;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ModelAutocompleteType;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

final class BookAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('name', TextType::class);
        $form->add('description', TextareaType::class);
        /*$form->add('author', ModelAutocompleteType::class, [
            'property' => 'name',
            'template' => 'App/Form/Type/sonata_type_model_autocomplete.html.twig',
            'multiple' => true,
        ]);*/
        $form->add('author', EntityType::class, [
            'class' => Author::class,
            'choice_label' => 'name',
            'multiple' => true,
        ]);
        $form->add('image', TextType::class, ['required' => false,]);
        $form->add('year', NumberType::class);
    }

    protected function configureDatagridFilters(DatagridMapper $filter): void
    {
        $filter->add('name');
        $filter->add('author');
        $filter->add('description');
        $filter->add('year');
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('name');
        $list->addIdentifier('description');
        $list->addIdentifier('author');
        $list->addIdentifier('year');
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('name');
    }

    public function toString($object): string
    {
        return $object instanceof Book
            ? $object->getName()
            : 'New book';
    }
}