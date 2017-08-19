<?php

class FamilleTableSeeder extends Seeder
{
	public function run()
	{
		DB::table('familles')->insert(array(array('code' => "#FM0001", 'nom' => "Allopathie", 'description' => "L'allopathie désigne un ensemble de traitements médicaux qui utilisent des substances dont les propriétés permettent de contrecarrer les symptômes de la maladie. Par exemple les antibiotiques, l'insuline ou encore les anti-inflammatoires sont des traitements allopathiques."), array('code' => "#FM0002", 'nom' => "Homéopathie", 'description' => "Les médicaments homéopathiques sont préparés à partir de substances végétales, animales, minérales ou chimiques, fortement diluées."), array('code' => "#FM0003", 'nom' => "Oligothérapie", 'description' => "L’Oligothérapie est une méthode thérapeutique qui consiste à l’administration d’oligo-éléments nécessaires en très faibles quantités au métabolisme du corps humain. L'objectif est de corriger un dysfonctionnement métabolique par le rétablissement de l'équilibre physiologique du patient."), array('code' => "#FM0004", 'nom' => "Phytothérapie", 'description' => "La phytothérapie est une méthode qui utilise l'action des plantes médicinales et qui consiste à traiter certaines pathologies à l'aide de plantes. La phytothérapie utilise les plantes ou certaines de leurs parties comme les racines, les tiges ou les feuilles.")));
	}
}

