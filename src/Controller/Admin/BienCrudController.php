<?php

namespace App\Controller\Admin;

use App\Entity\Bien;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class BienCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Bien::class;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('nom'),
            SlugField::new('slug')->setTargetFieldName('nom'),
            ImageField::new('image')
                ->setBasePath('uploads/')
                ->setFormTypeOptions(['mapped'=>false, 'required'=>false])
                ->setUploadDir('public/uploads')
                ->setUploadedFileNamePattern('[randomhas].[extension]')
                ->setRequired(false),
            TextField::new('referenceBien'),
            TextareaField::new('description'),
            AssociationField::new('service'),
            IntegerField::new('nombreUniteLot')

        ];
    }
}
