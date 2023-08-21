<?php

namespace App\Controller\Admin;

use App\Entity\Score;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class ScoreCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Score::class;
    }

    public function configureFields(string $pageName): iterable
    {
        $matchDays = [];
        foreach (range(1, 34) as $day) {
            $matchDays[$day . ". Spieltag"] = $day;
        }

        yield AssociationField::new('user', 'Spieler');
        yield ChoiceField::new('matchDay', 'Spieltag')
            ->setChoices($matchDays);
        yield NumberField::new('score', 'Punkte');
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('matchDay')
            ->add('user')
            ;
    }
}
