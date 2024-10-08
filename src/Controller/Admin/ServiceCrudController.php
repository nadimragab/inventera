<?php

namespace App\Controller\Admin;

use App\Entity\Service;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ServiceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Service::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nomService'),
            SlugField::new('slug')->setTargetFieldName('nomService'),
            /*ImageField::new('image')
                ->setBasePath('uploads/')
                ->setFormTypeOptions(['mapped'=>false, 'required'=>false])
                ->setUploadDir('public/uploads')
                ->setUploadedFileNamePattern('[randomhas].[extension]')
                ->setRequired(false),
            */
            TextField::new('image'),
            TextField::new('referenceService'),
            TextareaField::new('description'),
            AssociationField::new('structure')

        ];
    }
    

}
