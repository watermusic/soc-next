<?php

namespace App\Controller\Admin;

use App\Entity\Player;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AvatarField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class PlayerCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Player::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPaginatorPageSize(600)
            ->setSearchFields(['name', 'position.name', 'team.name', 'user.name'])
            ;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('position')
            ->add('team')
            ->add('user')
            ;
    }

    public function configureFields(string $pageName): iterable
    {
        yield ImageField::new('thumbUrl')
            ->setBasePath('images/player/trans')
            ->hideOnForm();
        yield TextField::new('name');
        yield MoneyField::new('signingFee')->setCurrency('EUR')->setStoredAsCents();
        yield MoneyField::new('marketValue')->setCurrency('EUR')->setStoredAsCents();
        yield NumberField::new('averageGrade', 'Note');
        yield NumberField::new('averageScore', 'Punkte');
        yield AssociationField::new('position');
        yield AssociationField::new('user');
        yield AssociationField::new('team');
    }

}
