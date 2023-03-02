<?php

namespace App\Controller\Admin;

use App\Entity\Topsellers;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TopsellersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Topsellers::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            AssociationField::new('products','Product'),
        ];
    }

}
