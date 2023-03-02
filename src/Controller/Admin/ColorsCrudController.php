<?php

namespace App\Controller\Admin;

use App\Entity\Colors;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;

class ColorsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Colors::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [

            TextField::new('colorname'),
            yield ColorField::new('colorname')->showValue(),
            yield ColorField::new('colorname')->showSample(false),

        ];
    }

}
