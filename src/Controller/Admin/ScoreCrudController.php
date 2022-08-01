<?php

namespace App\Controller\Admin;

use App\Entity\Score;
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

        yield ChoiceField::new('matchDay', 'Spieltag')
            ->setChoices($matchDays);
        yield NumberField::new('score', 'Punkte');
        yield AssociationField::new('user', 'Spieler');
    }
}
