<?php

namespace App\Controller\Admin;

use App\Entity\Bien;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
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
            TextField::new('referenceBien')->hideOnForm(),
            TextField::new('nom'),
            TextareaField::new('description'),
            //SlugField::new('slug')->setTargetFieldName('nom'),
            //ImageField::new('imageFile')->SetFormType(VichImageType::class)->setBasePath('/uploads/biens'),
            IntegerField::new('compteActif'),
            IntegerField::new('compteAmortissement'),
            IntegerField::new('compteDotation'),
            TextField::new('invNature'),
            TextField::new('libelleInvNat'),



            //AssociationField::new('service'),
            //IntegerField::new('nombreUniteLot')

        ];
    }
    public function configureActions(Actions $actions): Actions
    {
        return $actions
            // ...
            ->remove(Crud::PAGE_INDEX, Action::NEW)
            //->remove(Crud::PAGE_DETAIL, Action::EDIT)
        ;
    }
}
