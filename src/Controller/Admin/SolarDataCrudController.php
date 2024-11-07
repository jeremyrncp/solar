<?php

namespace App\Controller\Admin;

use App\Entity\SolarData;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SolarDataCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return SolarData::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('customer'),
            DateTimeField::new('createdAt'),
            NumberField::new('production'),
            NumberField::new('productionDay'),
            NumberField::new('productionTotal'),
            NumberField::new('co2'),
            NumberField::new('threes')
        ];
    }
}
