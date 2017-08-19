<?php

class MedicamentTableSeeder extends Seeder
{
	public function run()
	{
		DB::table('medicaments')->insert(array(
			
			array('id_famille' => "1", 'code' => "#MDC001", 'nom' => "Efferalgan Vitamine C", 'q_stock' => 200, 'q_minimum' => 40, 'ht' => 1.6, 'tt' => 10, 'description' => "Ce médicament est un antalgique (calme la douleur) et un antipyrétique (fait baisser la fièvre).
				Ce médicament contient du paracétamol."),
		    array('id_famille' => "1", 'code' => "#MDC002", 'nom' => "Fervex Adultes", 'q_stock' => 100, 'q_minimum' => 20, 'ht' => 3.49, 'tt' => 15, 'description' => "Ce médicament est indiqué dans le traitement des rhumes, rhinites, rhinopharyngites et des états grippaux de l'adulte"),
		    array('id_famille' => "1", 'code' => "#MDC003", 'nom' => "Daflon 500 mg x60", 'q_stock' => 70, 'q_minimum' => 10, 'ht' => 10.79, 'tt' => 7, 'description' => "Médicament préconisé dans le traitement des troubles de la circulation veineuse (jambes lourdes, douleurs, impatiences, hémorroïdes)"),

		    array('id_famille' => "2", 'code' => "#MDC004", 'nom' => "Sédatif PC x40", 'q_stock' => 100, 'q_minimum' => 20, 'ht' => 3.99, 'tt' => 10, 'description' => "Médicament homéopathique traditionnellement utilisé dans les états anxieux et émotifs, les troubles mineurs du sommeil."),
		    array('id_famille' => "2", 'code' => "#MDC005", 'nom' => "Oscillococcinum x30", 'q_stock' => 100, 'q_minimum' => 20, 'ht' => 20.99, 'tt' => 15, 'description' => "Oscillococcinum est un médicament homéopathique indiqué dans le traitement des états grippaux (frissons, courbatures, fièvres)."),
		    array('id_famille' => "2", 'code' => "#MDC006", 'nom' => "Paragrippe", 'q_stock' => 85, 'q_minimum' => 10, 'ht' => 4.49, 'tt' => 7, 'description' => "Médicament préconisé dans le traitement des troubles de la circulation veineuse (jambes lourdes, douleurs, impatiences, hémorroïdes)"),

		    array('id_famille' => "3", 'code' => "#MDC007", 'nom' => "Oligosol Lithium x28", 'q_stock' => 50, 'q_minimum' => 5, 'ht' => 4.89, 'tt' => 10, 'description' => "Modificateur du terrain en particulier au cours de troubles légers du sommeil, irritabilité. Adulte et enfant de plus de 6 ans."),
		    array('id_famille' => "3", 'code' => "#MDC008", 'nom' => "Actisoufre flacon", 'q_stock' => 50, 'q_minimum' => 5, 'ht' => 4.99, 'tt' => 17, 'description' => "Médicament préconisé dans les états inflammatoires chroniques des voies respiratoires supérieures tels que rhinites et rhinopharyngites chroniques."),
		    array('id_famille' => "3", 'code' => "#MDC009", 'nom' => "Dissolvurol 0,25% gouttes", 'q_stock' => 50, 'q_minimum' => 5, 'ht' => 2.79, 'tt' => 20, 'description' => "Ce médicament est utilisé chez l'adulte comme modificateur de terrain en particulier au cours d'affections rhumatismales inflammatoires."),

		    array('id_famille' => "4", 'code' => "#MDC010", 'nom' => "Euphytose x120", 'q_stock' => 25, 'q_minimum' => 1, 'ht' => 5.99, 'tt' => 12, 'description' => "Traditionnellement utilisé pour réduire les troubles mineurs de l'anxiété et du sommeil chez l'adulte et les enfants.")
		));
		
	}
}