<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Province;
use App\Models\Commune;
use App\Models\Domaine;
use App\Models\Chantier;
use App\Models\Programme;
use App\Models\Projet;
use App\Models\SousProjetLocalise;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->count(10)->create();

        $roles = ['gestionnaire', 'admin'];
        foreach($roles as $role){
            Role::create(['name' => $role]);
        }


        ////////////// TEST CASE ONLY
        $user1 = User::find(1);
        $user1->assignRole('gestionnaire');
        $user2 = User::find(2);
        $user2->assignRole('admin');
        /////////////////////////////

        $domaines = [
            ['code_du_domaine' => 101, 'description_fr' => "Domaine de l'Éducation", 'description_ar' => 'مجال التعليم'],
            ['code_du_domaine' => 102, 'description_fr' => "Domaine de la Santé", 'description_ar' => 'مجال الصحة'],
            ['code_du_domaine' => 103, 'description_fr' => "Domaine de l'Agriculture", 'description_ar' => 'مجال الزراعة'],
            ['code_du_domaine' => 104, 'description_fr' => "Domaine de l'Industrie", 'description_ar' => 'مجال الصناعة'],
            ['code_du_domaine' => 105, 'description_fr' => "Domaine des Technologies", 'description_ar' => 'مجال التكنولوجيا'],
            ['code_du_domaine' => 106, 'description_fr' => "Domaine des Finances", 'description_ar' => 'مجال المالية'],
            ['code_du_domaine' => 107, 'description_fr' => "Domaine de l'Énergie", 'description_ar' => 'مجال الطاقة'],
            ['code_du_domaine' => 108, 'description_fr' => "Domaine du Tourisme", 'description_ar' => 'مجال السياحة'],
            ['code_du_domaine' => 109, 'description_fr' => "Domaine de l'Environnement", 'description_ar' => 'مجال البيئة'],
            ['code_du_domaine' => 110, 'description_fr' => "Domaine de la Culture", 'description_ar' => 'مجال الثقافة'],
        ];

        foreach ($domaines as $domaine) {
            Domaine::create($domaine);
        }

        $provinces = [
            ['code_province' => 'P101', 'description_province_fr' => 'Tanger-Assilah',         'description_province_ar' => 'طنجة-أصيلة'],
            ['code_province' => 'P102', 'description_province_fr' => 'Tétouan',                'description_province_ar' => 'تطوان'],
            ['code_province' => 'P103', 'description_province_fr' => 'Larache',                'description_province_ar' => 'العرائش'],
            ['code_province' => 'P104', 'description_province_fr' => 'Chefchaouen',            'description_province_ar' => 'شفشاون'],
            ['code_province' => 'P105', 'description_province_fr' => 'Al Hoceïma',             'description_province_ar' => 'الحسيمة'],
            ['code_province' => 'P106', 'description_province_fr' => 'Fès',                    'description_province_ar' => 'فاس'],
            ['code_province' => 'P107', 'description_province_fr' => 'Meknès',                 'description_province_ar' => 'مكناس'],
            ['code_province' => 'P108', 'description_province_fr' => 'Taza',                   'description_province_ar' => 'تازة'],
            ['code_province' => 'P109', 'description_province_fr' => 'Ifrane',                 'description_province_ar' => 'إفران'],
            ['code_province' => 'P110', 'description_province_fr' => 'Oujda-Angad',            'description_province_ar' => 'وجدة-أنكاد'],
            ['code_province' => 'P111', 'description_province_fr' => 'Nador',                  'description_province_ar' => 'الناظور'],
            ['code_province' => 'P112', 'description_province_fr' => 'Agadir Ida-Outanane',    'description_province_ar' => 'أكادير إدا وتنان'],
            ['code_province' => 'P113', 'description_province_fr' => 'Taroudant',              'description_province_ar' => 'تارودانت'],
            ['code_province' => 'P114', 'description_province_fr' => 'Guelmim',                'description_province_ar' => 'كلميم'],
            ['code_province' => 'P115', 'description_province_fr' => 'Laâyoune',               'description_province_ar' => 'العيون'],
            ['code_province' => 'P116', 'description_province_fr' => 'Dakhla',                 'description_province_ar' => 'الداخلة'],
        ];

        foreach ($provinces as $province) {
            Province::create($province);
        }


        $communes = [
            ['code_commune' => 'C101', 'nom_fr' => 'Asilah',     'nom_ar' => 'أصيلة'],
            ['code_commune' => 'C102', 'nom_fr' => 'Martil',     'nom_ar' => 'مرتيل'],
            ['code_commune' => 'C103', 'nom_fr' => 'Fnideq',     'nom_ar' => 'الفنيدق'],
            ['code_commune' => 'C104', 'nom_fr' => 'Al Hoceima', 'nom_ar' => 'الحسيمة'],
            ['code_commune' => 'C105', 'nom_fr' => 'Imzouren',   'nom_ar' => 'إمزورن'],
            ['code_commune' => 'C106', 'nom_fr' => 'El Jadida',  'nom_ar' => 'الجديدة'],
            ['code_commune' => 'C107', 'nom_fr' => 'Inezgane',   'nom_ar' => 'إنزكان'],
            ['code_commune' => 'C108', 'nom_fr' => 'Tiznit',     'nom_ar' => 'تيزنيت'],
            ['code_commune' => 'C109', 'nom_fr' => 'Tinghir',    'nom_ar' => 'تنغير'],
            ['code_commune' => 'C110', 'nom_fr' => 'Sefrou',     'nom_ar' => 'صفرو'],
            ['code_commune' => 'C111', 'nom_fr' => 'Azrou',      'nom_ar' => 'أزرو'],
            ['code_commune' => 'C112', 'nom_fr' => 'Midelt',     'nom_ar' => 'ميدلت'],
        ];
        foreach ($communes as $commune) {
            Commune::create($commune);
        }

        $chantiers = [
            ['code' => 'CH001', 'desc' => 'Construction de 10 écoles rurales',          'domaine_fr' => "Domaine de l'Éducation"],
            ['code' => 'CH002', 'desc' => 'Réhabilitation de centres de santé',         'domaine_fr' => "Domaine de la Santé"],
            ['code' => 'CH003', 'desc' => 'Aménagement des périmètres irrigués',        'domaine_fr' => "Domaine de l'Agriculture"],
            ['code' => 'CH004', 'desc' => 'Création de zones industrielles locales',    'domaine_fr' => "Domaine de l'Industrie"],
            ['code' => 'CH005', 'desc' => 'Digitalisation des services publics',        'domaine_fr' => "Domaine des Technologies"],
            ['code' => 'CH006', 'desc' => 'Construction de centres fiscaux',            'domaine_fr' => "Domaine des Finances"],
            ['code' => 'CH007', 'desc' => 'Développement d’unités solaires',            'domaine_fr' => "Domaine de l'Énergie"],
            ['code' => 'CH008', 'desc' => 'Création de circuits touristiques',          'domaine_fr' => "Domaine du Tourisme"],
            ['code' => 'CH009', 'desc' => 'Reboisement et protection des forêts',       'domaine_fr' => "Domaine de l'Environnement"],
            ['code' => 'CH010', 'desc' => 'Restauration de sites historiques',          'domaine_fr' => "Domaine de la Culture"],
        ];

        foreach ($chantiers as $chantier) {
            $domaine = Domaine::where('description_fr', $chantier['domaine_fr'])->first();

            if ($domaine) {
                Chantier::create([
                    'code_du_chantier' => $chantier['code'],
                    'description_du_chantier' => $chantier['desc'],
                    'id_domaine' => $domaine->id_domaine,
                ]);
            }
        }

        $programmes = [
            ['code' => 'PR001', 'desc' => 'Programme d\'équipement scolaire 2025',                  'chantier_desc' => 'Construction de 10 écoles rurales'],
            ['code' => 'PR002', 'desc' => 'Programme santé régionale Nord',                          'chantier_desc' => 'Réhabilitation de centres de santé'],
            ['code' => 'PR003', 'desc' => 'Programme d’irrigation durable',                          'chantier_desc' => 'Aménagement des périmètres irrigués'],
            ['code' => 'PR004', 'desc' => 'Programme de zones industrielles de proximité',           'chantier_desc' => 'Création de zones industrielles locales'],
            ['code' => 'PR005', 'desc' => 'Programme e-Gov 2025',                                    'chantier_desc' => 'Digitalisation des services publics'],
            ['code' => 'PR006', 'desc' => 'Programme de modernisation fiscale locale',               'chantier_desc' => 'Construction de centres fiscaux'],
            ['code' => 'PR007', 'desc' => 'Programme d’énergie solaire rurale',                      'chantier_desc' => 'Développement d’unités solaires'],
            ['code' => 'PR008', 'desc' => 'Programme de valorisation du patrimoine naturel',         'chantier_desc' => 'Création de circuits touristiques'],
            ['code' => 'PR009', 'desc' => 'Programme national de reboisement 2025-2030',             'chantier_desc' => 'Reboisement et protection des forêts'],
            ['code' => 'PR010', 'desc' => 'Programme de restauration culturelle et artistique',      'chantier_desc' => 'Restauration de sites historiques'],
        ];

        foreach ($programmes as $programme) {
            $chantier = Chantier::where('description_du_chantier', $programme['chantier_desc'])->first();

            if ($chantier) {
                Programme::create([
                    'code_du_programme' => $programme['code'],
                    'description_du_programme' => $programme['desc'],
                    'id_chantier' => $chantier->id_chantier,
                ]);
            }
        }

        $projets = [
            [
                'code_du_projet' => 'PRJ001',
                'nom_du_projet' => 'Construction d\'une école primaire à Fès',
                'cout_cro' => 500000.00,
                'cout_total_du_projet' => 600000.00,
                'annee_debut' => '2023',
                'annee_fin_prevue' => '2024',
                'etat_d_avancement_physique' => '50%',
                'etat_d_avancement_financier' => '45%',
                'commentaires' => 'Projet en cours de réalisation.',
                'id_province' => 1,
                'id_commune' => 10,
                'id_programme' => 5,
            ],
            [
                'code_du_projet' => 'PRJ-001',
                'nom_du_projet' => 'Réhabilitation des écoles rurales à Ifrane',
                'cout_cro' => 1200000,
                'cout_total_du_projet' => 1500000,
                'annee_debut' => '2024',
                'annee_fin_prevue' => '2025',
                'etat_d_avancement_physique' => '65%',
                'etat_d_avancement_financier' => '60%',
                'commentaires' => 'Travaux en cours dans 3 établissements.',
                'id_province' => 1,
                'id_commune' => 1,
                'id_programme' => 1,
            ],
            [
                'code_du_projet' => 'PRJ-002',
                'nom_du_projet' => 'Extension du réseau d’eau potable à Tiznit',
                'cout_cro' => 800000,
                'cout_total_du_projet' => 950000,
                'annee_debut' => '2023',
                'annee_fin_prevue' => '2024',
                'etat_d_avancement_physique' => '85%',
                'etat_d_avancement_financier' => '80%',
                'commentaires' => 'Presque terminé.',
                'id_province' => 2,
                'id_commune' => 2,
                'id_programme' => 2,
            ],
            [
                'code_du_projet' => 'PRJ-003',
                'nom_du_projet' => 'Pavage de routes rurales à Midelt',
                'cout_cro' => 1000000,
                'cout_total_du_projet' => 1200000,
                'annee_debut' => '2023',
                'annee_fin_prevue' => '2024',
                'etat_d_avancement_physique' => '70%',
                'etat_d_avancement_financier' => '68%',
                'commentaires' => 'Avancement conforme au planning.',
                'id_province' => 3,
                'id_commune' => 3,
                'id_programme' => 3,
            ],
            [
                'code_du_projet' => 'PRJ-004',
                'nom_du_projet' => 'Création d’une maison de jeunes à Taroudant',
                'cout_cro' => 600000,
                'cout_total_du_projet' => 750000,
                'annee_debut' => '2024',
                'annee_fin_prevue' => '2024',
                'etat_d_avancement_physique' => '40%',
                'etat_d_avancement_financier' => '30%',
                'commentaires' => 'Phase de gros œuvre.',
                'id_province' => 4,
                'id_commune' => 4,
                'id_programme' => 4,
            ],
            [
                'code_du_projet' => 'PRJ-005',
                'nom_du_projet' => 'Construction d’un centre de santé à Tinghir',
                'cout_cro' => 1400000,
                'cout_total_du_projet' => 1600000,
                'annee_debut' => '2023',
                'annee_fin_prevue' => '2024',
                'etat_d_avancement_physique' => '90%',
                'etat_d_avancement_financier' => '85%',
                'commentaires' => 'Finitions en cours.',
                'id_province' => 5,
                'id_commune' => 5,
                'id_programme' => 5,
            ],
            [
                'code_du_projet' => 'PRJ-006',
                'nom_du_projet' => 'Aménagement du souk hebdomadaire de Sefrou',
                'cout_cro' => 500000,
                'cout_total_du_projet' => 620000,
                'annee_debut' => '2024',
                'annee_fin_prevue' => '2024',
                'etat_d_avancement_physique' => '55%',
                'etat_d_avancement_financier' => '52%',
                'commentaires' => 'Travaux de voirie réalisés.',
                'id_province' => 6,
                'id_commune' => 6,
                'id_programme' => 6,
            ],
            [
                'code_du_projet' => 'PRJ-007',
                'nom_du_projet' => 'Rénovation des centres culturels à Azrou',
                'cout_cro' => 700000,
                'cout_total_du_projet' => 750000,
                'annee_debut' => '2023',
                'annee_fin_prevue' => '2024',
                'etat_d_avancement_physique' => '75%',
                'etat_d_avancement_financier' => '70%',
                'commentaires' => 'Deux centres rénovés sur trois.',
                'id_province' => 7,
                'id_commune' => 7,
                'id_programme' => 7,
            ],
            [
                'code_du_projet' => 'PRJ-008',
                'nom_du_projet' => 'Construction d’un dispensaire à El Hajeb',
                'cout_cro' => 1100000,
                'cout_total_du_projet' => 1300000,
                'annee_debut' => '2024',
                'annee_fin_prevue' => '2025',
                'etat_d_avancement_physique' => '25%',
                'etat_d_avancement_financier' => '15%',
                'commentaires' => 'Début du terrassement.',
                'id_province' => 8,
                'id_commune' => 8,
                'id_programme' => 8,
            ],
            [
                'code_du_projet' => 'PRJ-009',
                'nom_du_projet' => 'Électrification rurale dans le Rif',
                'cout_cro' => 1800000,
                'cout_total_du_projet' => 2000000,
                'annee_debut' => '2023',
                'annee_fin_prevue' => '2025',
                'etat_d_avancement_physique' => '80%',
                'etat_d_avancement_financier' => '78%',
                'commentaires' => 'Postes installés.',
                'id_province' => 9,
                'id_commune' => 9,
                'id_programme' => 9,
            ],
            [
                'code_du_projet' => 'PRJ-010',
                'nom_du_projet' => 'Modernisation du marché central de Khénifra',
                'cout_cro' => 900000,
                'cout_total_du_projet' => 1000000,
                'annee_debut' => '2024',
                'annee_fin_prevue' => '2025',
                'etat_d_avancement_physique' => '35%',
                'etat_d_avancement_financier' => '25%',
                'commentaires' => 'Appel d’offre lancé.',
                'id_province' => 10,
                'id_commune' => 10,
                'id_programme' => 10,
            ]
        ];

        foreach ($projets as $projet) {
            Projet::create($projet);
        }

        $sous_projets = [
            [
                'code_du_sous_projet' => 'SPJ-001',
                'nom_du_sous_projet' => 'Réhabilitation de l’école Ain Leuh',
                'secteur_concerne' => 'Éducation',
                'site' => 'Ain Leuh',
                'centre' => 'Centre 1',
                'surface' => '800 m²',
                'statut' => 'En cours',
                'lineaire' => null,
                'douars_desservis' => 'Ain Leuh, Zaouiat Ifrane',
                'source_de_financement' => 'INDH',
                'nature_de_l_intervention' => 'Réhabilitation complète',
                'beneficiaire' => '120 élèves',
                'estimation_initiale' => 500000,
                'avancement_physique' => '60%',
                'avancement_financier' => '58%',
                'commentaires' => 'Classe 1 terminée',
                'localite' => 'Ain Leuh',
                'id_projet' => 1,
                'id_province' => 1,
                'id_commune' => 1,
            ],
            [
                'code_du_sous_projet' => 'SPJ-002',
                'nom_du_sous_projet' => 'Installation de pompes à eau',
                'secteur_concerne' => 'Eau',
                'site' => 'Douar Ait Oumghar',
                'centre' => 'Centre A',
                'surface' => null,
                'statut' => 'Terminé',
                'lineaire' => '1.5 km',
                'douars_desservis' => 'Ait Oumghar, Targa',
                'source_de_financement' => 'ONEE',
                'nature_de_l_intervention' => 'Extension du réseau',
                'beneficiaire' => '200 foyers',
                'estimation_initiale' => 400000,
                'avancement_physique' => '100%',
                'avancement_financier' => '100%',
                'commentaires' => 'Projet réceptionné',
                'localite' => 'Tiznit',
                'id_projet' => 2,
                'id_province' => 2,
                'id_commune' => 2,
            ],
            [
                'code_du_sous_projet' => 'SPJ-003',
                'nom_du_sous_projet' => 'Bitumage de la route rurale R5321',
                'secteur_concerne' => 'Infrastructure',
                'site' => 'El Ksiba',
                'centre' => 'Centre routier',
                'surface' => null,
                'statut' => 'En cours',
                'lineaire' => '3 km',
                'douars_desservis' => 'Tiddas, El Ksiba',
                'source_de_financement' => 'Conseil provincial',
                'nature_de_l_intervention' => 'Travaux routiers',
                'beneficiaire' => '450 habitants',
                'estimation_initiale' => 800000,
                'avancement_physique' => '70%',
                'avancement_financier' => '65%',
                'commentaires' => 'Dernière couche d’asphalte en cours',
                'localite' => 'Midelt',
                'id_projet' => 3,
                'id_province' => 3,
                'id_commune' => 3,
            ],
            [
                'code_du_sous_projet' => 'SPJ-004',
                'nom_du_sous_projet' => 'Maison des jeunes Taliouine',
                'secteur_concerne' => 'Jeunesse',
                'site' => 'Taliouine',
                'centre' => 'Centre jeunesse',
                'surface' => '500 m²',
                'statut' => 'En cours',
                'lineaire' => null,
                'douars_desservis' => 'Taliouine',
                'source_de_financement' => 'Ministère de la Jeunesse',
                'nature_de_l_intervention' => 'Construction',
                'beneficiaire' => 'Jeunes de 12 à 25 ans',
                'estimation_initiale' => 600000,
                'avancement_physique' => '35%',
                'avancement_financier' => '30%',
                'commentaires' => 'Murs montés',
                'localite' => 'Taroudant',
                'id_projet' => 4,
                'id_province' => 4,
                'id_commune' => 4,
            ],
            [
                'code_du_sous_projet' => 'SPJ-005',
                'nom_du_sous_projet' => 'Centre de santé Alnif',
                'secteur_concerne' => 'Santé',
                'site' => 'Alnif',
                'centre' => 'Dispensaire Alnif',
                'surface' => '600 m²',
                'statut' => 'Presque terminé',
                'lineaire' => null,
                'douars_desservis' => 'Alnif, Tazzarine',
                'source_de_financement' => 'Ministère de la Santé',
                'nature_de_l_intervention' => 'Nouvelle construction',
                'beneficiaire' => 'Zone Sud Tinghir',
                'estimation_initiale' => 1400000,
                'avancement_physique' => '90%',
                'avancement_financier' => '85%',
                'commentaires' => 'Peinture en cours',
                'localite' => 'Tinghir',
                'id_projet' => 5,
                'id_province' => 5,
                'id_commune' => 5,
            ],
            [
                'code_du_sous_projet' => 'SPJ-006',
                'nom_du_sous_projet' => 'Réaménagement du marché hebdomadaire',
                'secteur_concerne' => 'Commerce',
                'site' => 'Sefrou centre',
                'centre' => 'Souk Lhad',
                'surface' => '1200 m²',
                'statut' => 'En cours',
                'lineaire' => null,
                'douars_desservis' => 'Sefrou, Azrou',
                'source_de_financement' => 'Collectivité locale',
                'nature_de_l_intervention' => 'Réaménagement',
                'beneficiaire' => 'Commerçants et habitants',
                'estimation_initiale' => 500000,
                'avancement_physique' => '60%',
                'avancement_financier' => '55%',
                'commentaires' => 'Installation des étals',
                'localite' => 'Sefrou',
                'id_projet' => 6,
                'id_province' => 6,
                'id_commune' => 6,
            ],
            [
                'code_du_sous_projet' => 'SPJ-007',
                'nom_du_sous_projet' => 'Réhabilitation de la bibliothèque municipale',
                'secteur_concerne' => 'Culture',
                'site' => 'Azrou',
                'centre' => 'Bibliothèque urbaine',
                'surface' => '300 m²',
                'statut' => 'En cours',
                'lineaire' => null,
                'douars_desservis' => 'Azrou',
                'source_de_financement' => 'Fondation Hassan II',
                'nature_de_l_intervention' => 'Réhabilitation',
                'beneficiaire' => 'Élèves et étudiants',
                'estimation_initiale' => 400000,
                'avancement_physique' => '65%',
                'avancement_financier' => '60%',
                'commentaires' => 'Toiture rénovée',
                'localite' => 'Azrou',
                'id_projet' => 7,
                'id_province' => 7,
                'id_commune' => 7,
            ],
            [
                'code_du_sous_projet' => 'SPJ-008',
                'nom_du_sous_projet' => 'Dispensaire rural Aït Naamane',
                'secteur_concerne' => 'Santé',
                'site' => 'Aït Naamane',
                'centre' => 'Centre de soins',
                'surface' => '400 m²',
                'statut' => 'En démarrage',
                'lineaire' => null,
                'douars_desservis' => 'Aït Naamane, Oued Ifrane',
                'source_de_financement' => 'INDH',
                'nature_de_l_intervention' => 'Construction neuve',
                'beneficiaire' => '250 familles',
                'estimation_initiale' => 1100000,
                'avancement_physique' => '15%',
                'avancement_financier' => '10%',
                'commentaires' => 'Terrassement en cours',
                'localite' => 'El Hajeb',
                'id_projet' => 8,
                'id_province' => 8,
                'id_commune' => 8,
            ],
            [
                'code_du_sous_projet' => 'SPJ-009',
                'nom_du_sous_projet' => 'Installation de 20 poteaux électriques',
                'secteur_concerne' => 'Énergie',
                'site' => 'Douar Beni Bouayach',
                'centre' => 'Centre électrique',
                'surface' => null,
                'statut' => 'En finalisation',
                'lineaire' => '2.5 km',
                'douars_desservis' => 'Beni Bouayach, Imzouren',
                'source_de_financement' => 'ONEE',
                'nature_de_l_intervention' => 'Électrification rurale',
                'beneficiaire' => '300 ménages',
                'estimation_initiale' => 1800000,
                'avancement_physique' => '90%',
                'avancement_financier' => '85%',
                'commentaires' => 'Raccordement en cours',
                'localite' => 'Rif',
                'id_projet' => 9,
                'id_province' => 9,
                'id_commune' => 9,
            ],
            [
                'code_du_sous_projet' => 'SPJ-010',
                'nom_du_sous_projet' => 'Aménagement du marché couvert',
                'secteur_concerne' => 'Commerce',
                'site' => 'Khénifra centre',
                'centre' => 'Marché central',
                'surface' => '1000 m²',
                'statut' => 'En appel d’offres',
                'lineaire' => null,
                'douars_desservis' => 'Khénifra, Ouaoumana',
                'source_de_financement' => 'Commune urbaine',
                'nature_de_l_intervention' => 'Modernisation',
                'beneficiaire' => 'Tous les commerçants du centre-ville',
                'estimation_initiale' => 900000,
                'avancement_physique' => '5%',
                'avancement_financier' => '0%',
                'commentaires' => 'Dossier en cours d’étude',
                'localite' => 'Khénifra',
                'id_projet' => 10,
                'id_province' => 10,
                'id_commune' => 10,
            ]
        ];

        foreach($sous_projets as $sp){
            SousProjetLocalise::create($sp);
        }
    }
}
