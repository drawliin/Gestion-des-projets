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

        $roles = ['gestionnaire', 'admin', 'directeur', 'financier'];
        foreach($roles as $role){
            Role::create(['name' => $role]);
        }


        ////////////// TEST CASE ONLY
        $user2 = User::find(1);
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
            ['code_province' => 'P110', 'description_province_fr' => 'Oujda-Angad', 'description_province_ar' => 'وجدة-أنكاد'],
            ['code_province' => 'P111', 'description_province_fr' => 'Nador', 'description_province_ar' => 'الناظور'],
            ['code_province' => 'P112', 'description_province_fr' => 'Berkane', 'description_province_ar' => 'بركان'],
            ['code_province' => 'P113', 'description_province_fr' => 'Driouch',  'description_province_ar' => 'الدريوش'],
            ['code_province' => 'P114', 'description_province_fr' => 'Figuig', 'description_province_ar' => 'الفيق'],
            ['code_province' => 'P115', 'description_province_fr' => 'Taourirt', 'description_province_ar' => 'تاوريرت'],
            ['code_province' => 'P116', 'description_province_fr' => 'Jerada', 'description_province_ar' => 'جرادة'],
            ['code_province' => 'P117', 'description_province_fr' => 'Guercif', 'description_province_ar' => 'جرسيف'],
        ];

        foreach ($provinces as $province) {
            Province::create($province);
        }


        $communes = [
            // Oujda (id_province = 1)
            ['code_commune' => 'C11001', 'nom_fr' => 'Bni Drar',           'nom_ar' => 'بني درار', 'id_province' => 1],
            ['code_commune' => 'C11002', 'nom_fr' => 'Oujda',              'nom_ar' => 'وجدة', 'id_province' => 1],
            ['code_commune' => 'C11003', 'nom_fr' => 'Angad',              'nom_ar' => 'أنكاد', 'id_province' => 1],
            ['code_commune' => 'C11004', 'nom_fr' => 'Naima',              'nom_ar' => 'النعيمة', 'id_province' => 1],
            ['code_commune' => 'C11005', 'nom_fr' => 'Ain Sfa',            'nom_ar' => 'عين الصفا', 'id_province' => 1],
            ['code_commune' => 'C11006', 'nom_fr' => 'Bni Khaled',         'nom_ar' => 'بني خالد', 'id_province' => 1],
            ['code_commune' => 'C11007', 'nom_fr' => 'Isly',               'nom_ar' => 'إيسلي', 'id_province' => 1],
            ['code_commune' => 'C11008', 'nom_fr' => 'Mestferki',          'nom_ar' => 'مسطرفكي', 'id_province' => 1],
            ['code_commune' => 'C11009', 'nom_fr' => 'Bsara',              'nom_ar' => 'بصرة', 'id_province' => 1],
            ['code_commune' => 'C11010', 'nom_fr' => 'Sidi Boulenouar',    'nom_ar' => 'سيدي بولنوار', 'id_province' => 1],
            ['code_commune' => 'C11011', 'nom_fr' => 'Sidi Moussa Lemhaya','nom_ar' => 'سيدي موسى لمهاية', 'id_province' => 1],

            // Berkane (id_province = 2)
            ['code_commune' => 'C12001', 'nom_fr' => 'Saïdia',             'nom_ar' => 'السعيدية', 'id_province' => 2],
            ['code_commune' => 'C12002', 'nom_fr' => 'Berkane',            'nom_ar' => 'بركان', 'id_province' => 2],
            ['code_commune' => 'C12003', 'nom_fr' => 'Ahfir',              'nom_ar' => 'أحفير', 'id_province' => 2],
            ['code_commune' => 'C12004', 'nom_fr' => 'Aghbal',             'nom_ar' => 'أغبال', 'id_province' => 2],
            ['code_commune' => 'C12005', 'nom_fr' => 'Erreggada',          'nom_ar' => 'الرڭادة', 'id_province' => 2],
            ['code_commune' => 'C12006', 'nom_fr' => 'Jrawa',              'nom_ar' => 'جرڭوة', 'id_province' => 2],
            ['code_commune' => 'C12007', 'nom_fr' => 'Madagh',             'nom_ar' => 'مضاغ', 'id_province' => 2],
            ['code_commune' => 'C12008', 'nom_fr' => 'Tafoughalt',         'nom_ar' => 'تافوغالت', 'id_province' => 2],
            ['code_commune' => 'C12009', 'nom_fr' => 'Rislane',            'nom_ar' => 'رسلان', 'id_province' => 2],
            ['code_commune' => 'C12010', 'nom_fr' => 'Chouihia',           'nom_ar' => 'الشويحية', 'id_province' => 2],
            ['code_commune' => 'C12011', 'nom_fr' => 'Boughriba',          'nom_ar' => 'بوغريبة', 'id_province' => 2],
            ['code_commune' => 'C12012', 'nom_fr' => 'Laâtamna',           'nom_ar' => 'لعاتمة', 'id_province' => 2],
            ['code_commune' => 'C12013', 'nom_fr' => 'Aklim',              'nom_ar' => 'أكليم', 'id_province' => 2],
            ['code_commune' => 'C12014', 'nom_fr' => 'Fezouane',           'nom_ar' => 'فزوان', 'id_province' => 2],
            ['code_commune' => 'C12015', 'nom_fr' => 'Zegzel',             'nom_ar' => 'زكزل', 'id_province' => 2],
            ['code_commune' => 'C12016', 'nom_fr' => 'Sidi Slimane Echcharaa','nom_ar' => 'سيدي سليمان الشراعة', 'id_province' => 2],
            ['code_commune' => 'C12017', 'nom_fr' => 'Sidi Bouhria',       'nom_ar' => 'سيدي بوحريا', 'id_province' => 2],

            // Taourirt (id_province = 3)
            ['code_commune' => 'C13001', 'nom_fr' => 'Debdou',             'nom_ar' => 'دبدو', 'id_province' => 3],
            ['code_commune' => 'C13002', 'nom_fr' => 'El Aioun Sidi Mellouk','nom_ar' => 'العيون سيدي ملوك', 'id_province' => 3],
            ['code_commune' => 'C13003', 'nom_fr' => 'Taourirt',           'nom_ar' => 'تاوريرت', 'id_province' => 3],
            ['code_commune' => 'C13004', 'nom_fr' => 'El Atef',            'nom_ar' => 'العاتق', 'id_province' => 3],
            ['code_commune' => 'C13005', 'nom_fr' => "Oulad M'hammed",    'nom_ar' => 'أولاد امحمد', 'id_province' => 3],
            ['code_commune' => 'C13006', 'nom_fr' => 'Sidi Ali Belkassem', 'nom_ar' => 'سيدي علي بلقاسم', 'id_province' => 3],
            ['code_commune' => 'C13007', 'nom_fr' => 'Sidi Lahsen',        'nom_ar' => 'سيدي لحسن', 'id_province' => 3],
            ['code_commune' => 'C13008', 'nom_fr' => 'Ain Lehjer',         'nom_ar' => 'عين الحجر', 'id_province' => 3],
            ['code_commune' => 'C13009', 'nom_fr' => 'Mechraa Hammadi',    'nom_ar' => 'مشرع حمادي', 'id_province' => 3],
            ['code_commune' => 'C13010', 'nom_fr' => 'Mestegmer',          'nom_ar' => 'مسطڭمر', 'id_province' => 3],
            ['code_commune' => 'C13011', 'nom_fr' => 'Tancherfi',          'nom_ar' => 'تانشرفي', 'id_province' => 3],
            ['code_commune' => 'C13012', 'nom_fr' => 'Ahl Oued Za',        'nom_ar' => 'أهل وادي زا', 'id_province' => 3],
            ['code_commune' => 'C13013', 'nom_fr' => 'Gteter',             'nom_ar' => 'كتاترة', 'id_province' => 3],
            ['code_commune' => 'C13014', 'nom_fr' => 'Melg El Ouidane',    'nom_ar' => 'ملڭ الويدان', 'id_province' => 3],

            // Figuig (id_province = 4)
            ['code_commune' => 'C14001', 'nom_fr' => 'Bouarfa',            'nom_ar' => 'بوعرفة', 'id_province' => 4],
            ['code_commune' => 'C14002', 'nom_fr' => 'Figuig',             'nom_ar' => 'فجيج', 'id_province' => 4],
            ['code_commune' => 'C14003', 'nom_fr' => "Aïn Chaïr",        'nom_ar' => 'عين الشعير', 'id_province' => 4],
            ['code_commune' => 'C14004', 'nom_fr' => "Aïn Chouater",     'nom_ar' => 'عين الشواطر', 'id_province' => 4],
            ['code_commune' => 'C14005', 'nom_fr' => "Bni Tadjite",      'nom_ar' => 'بني تجيت', 'id_province' => 4],
            ['code_commune' => 'C14006', 'nom_fr' => 'Bouanane',           'nom_ar' => 'بوعنان', 'id_province' => 4],
            ['code_commune' => 'C14007', 'nom_fr' => 'Bouchaouene',        'nom_ar' => 'بوشاون', 'id_province' => 4],
            ['code_commune' => 'C14008', 'nom_fr' => 'Boumerieme',         'nom_ar' => 'بومريم', 'id_province' => 4],
            ['code_commune' => 'C14009', 'nom_fr' => 'Talsint',            'nom_ar' => 'تالسينت', 'id_province' => 4],
            ['code_commune' => 'C14010', 'nom_fr' => 'Tendrara',           'nom_ar' => 'تندرارة', 'id_province' => 4],
            ['code_commune' => 'C14011', 'nom_fr' => 'Bni Guil',           'nom_ar' => 'بني كيل', 'id_province' => 4],
            ['code_commune' => 'C14012', 'nom_fr' => 'Abbou Lakhal',       'nom_ar' => 'عبو لكحل', 'id_province' => 4],
            ['code_commune' => 'C14013', 'nom_fr' => 'Maatarka',           'nom_ar' => 'معتركة', 'id_province' => 4],

            // Jerada (id_province = 5)
            ['code_commune' => 'C15001', 'nom_fr' => 'Jerada',             'nom_ar' => 'جرادة', 'id_province' => 5],
            ['code_commune' => 'C15002', 'nom_fr' => "Aïn Bni Mathar",   'nom_ar' => 'عين بني مطهر', 'id_province' => 5],
            ['code_commune' => 'C15003', 'nom_fr' => 'Touissit',           'nom_ar' => 'تويسيت', 'id_province' => 5],
            ['code_commune' => 'C15004', 'nom_fr' => 'Gafait',             'nom_ar' => 'ڨفايت', 'id_province' => 5],
            ['code_commune' => 'C15005', 'nom_fr' => 'Guenfouda',          'nom_ar' => 'ڨنفودة', 'id_province' => 5],
            ['code_commune' => 'C15006', 'nom_fr' => 'Laaouinate',          'nom_ar' => 'لعوينات', 'id_province' => 5],
            ['code_commune' => 'C15007', 'nom_fr' => 'Lebkhata',           'nom_ar' => 'لبخاتة', 'id_province' => 5],
            ['code_commune' => 'C15008', 'nom_fr' => 'Ras Asfour',          'nom_ar' => 'رأس العسفور', 'id_province' => 5],
            ['code_commune' => 'C15009', 'nom_fr' => 'Sidi Boubker',        'nom_ar' => 'سيدي بوبكر', 'id_province' => 5],
            ['code_commune' => 'C15010', 'nom_fr' => 'Tiouli',             'nom_ar' => 'تيولي', 'id_province' => 5],
            ['code_commune' => 'C15011', 'nom_fr' => 'Bni Mathar',          'nom_ar' => 'بني مطهر', 'id_province' => 5],
            ['code_commune' => 'C15012', 'nom_fr' => 'Mrija',              'nom_ar' => 'مريجة', 'id_province' => 5],
            ['code_commune' => 'C15013', 'nom_fr' => 'Oulad Ghziyel',       'nom_ar' => 'أولاد غزيل', 'id_province' => 5],
            ['code_commune' => 'C15014', 'nom_fr' => 'Oulad Sidi Abdelhakem','nom_ar' => 'أولاد سيدي عبد الحاكم', 'id_province' => 5],

            // Guercif (id_province = 6)
            ['code_commune' => 'C16001', 'nom_fr' => 'Guercif',            'nom_ar' => 'ڨرسيف', 'id_province' => 6],
            ['code_commune' => 'C16002', 'nom_fr' => 'Assebbab',           'nom_ar' => 'السبعاب', 'id_province' => 6],
            ['code_commune' => 'C16003', 'nom_fr' => 'Barkine',            'nom_ar' => 'باركين', 'id_province' => 6],
            ['code_commune' => 'C16004', 'nom_fr' => 'Houara Oulad Raho',  'nom_ar' => 'هوارة أولاد رحو', 'id_province' => 6],
            ['code_commune' => 'C16005', 'nom_fr' => 'Lamrija',            'nom_ar' => 'لمريجة', 'id_province' => 6],
            ['code_commune' => 'C16006', 'nom_fr' => 'Mazguitam',          'nom_ar' => 'مزڭيطام', 'id_province' => 6],
            ['code_commune' => 'C16007', 'nom_fr' => 'Oulad Bourima',      'nom_ar' => 'أولاد بوريمة', 'id_province' => 6],
            ['code_commune' => 'C16008', 'nom_fr' => 'Ras Laksar',         'nom_ar' => 'رأس لڭصار', 'id_province' => 6],
            ['code_commune' => 'C16009', 'nom_fr' => 'Saka',               'nom_ar' => 'ساكة', 'id_province' => 6],
            ['code_commune' => 'C16010', 'nom_fr' => 'Taddart',            'nom_ar' => 'تادارت', 'id_province' => 6],

            // Nador (id_province = 7)
            ['code_commune' => 'C17001', 'nom_fr' => 'Nador',              'nom_ar' => 'الناظور', 'id_province' => 7],
            ['code_commune' => 'C17002', 'nom_fr' => 'Beni Ensar',         'nom_ar' => 'بني أنصار', 'id_province' => 7],
            ['code_commune' => 'C17003', 'nom_fr' => 'Al Aaroui',          'nom_ar' => 'العروي', 'id_province' => 7],
            ['code_commune' => 'C17004', 'nom_fr' => 'Zaïo',               'nom_ar' => 'زايو', 'id_province' => 7],
            ['code_commune' => 'C17005', 'nom_fr' => 'Selouane',           'nom_ar' => 'سلوان', 'id_province' => 7],
            ['code_commune' => 'C17006', 'nom_fr' => 'Zeghanghane',        'nom_ar' => 'زڭانغان', 'id_province' => 7],
            ['code_commune' => 'C17007', 'nom_fr' => 'Ras El Ma',          'nom_ar' => 'رأس الماء', 'id_province' => 7],
            ['code_commune' => 'C17008', 'nom_fr' => 'Bni Bouifrour',      'nom_ar' => 'بني بويڭرور', 'id_province' => 7],
            ['code_commune' => 'C17009', 'nom_fr' => 'Ihaddadene',         'nom_ar' => 'إحدادن', 'id_province' => 7],
            ['code_commune' => 'C17010', 'nom_fr' => 'Iksane',             'nom_ar' => 'إيكسان', 'id_province' => 7],
            ['code_commune' => 'C17011', 'nom_fr' => 'Bouarg',             'nom_ar' => 'بوعرك', 'id_province' => 7],
            ['code_commune' => 'C17012', 'nom_fr' => 'Bni Chiker',         'nom_ar' => 'بني شيكر', 'id_province' => 7],
            ['code_commune' => 'C17013', 'nom_fr' => 'Iaazzanene',         'nom_ar' => 'يعزازن', 'id_province' => 7],
            ['code_commune' => 'C17014', 'nom_fr' => 'Bni Sidel Jbel',     'nom_ar' => 'بني سيدال الجبل', 'id_province' => 7],
            ['code_commune' => 'C17015', 'nom_fr' => 'Bni Sidel Louta',    'nom_ar' => 'بني سيدال لوطا', 'id_province' => 7],
            ['code_commune' => 'C17016', 'nom_fr' => 'Hassi Berkane',      'nom_ar' => 'حاسي بركان', 'id_province' => 7],
            ['code_commune' => 'C17017', 'nom_fr' => 'Afsou',              'nom_ar' => 'أفسو', 'id_province' => 7],
            ['code_commune' => 'C17018', 'nom_fr' => 'Tiztoutine',          'nom_ar' => 'تيزطوطين', 'id_province' => 7],
            ['code_commune' => 'C17019', 'nom_fr' => "Bni Oukil Oulad M'Hand",'nom_ar' => 'بني وكيل أولاد امحند', 'id_province' => 7],
            ['code_commune' => 'C17020', 'nom_fr' => 'Arekmane',           'nom_ar' => 'أركمان', 'id_province' => 7],
            ['code_commune' => 'C17021', 'nom_fr' => 'Al Barkanyene',      'nom_ar' => 'البركانيين', 'id_province' => 7],
            ['code_commune' => 'C17022', 'nom_fr' => 'Oulad Settout',      'nom_ar' => 'أولاد ستوت', 'id_province' => 7],
            ['code_commune' => 'C17023', 'nom_fr' => 'Oulad Daoud Zkhanine','nom_ar' => 'أولاد داود زخانين', 'id_province' => 7],

            // Driouch (id_province = 8)
            ['code_commune' => 'C18001', 'nom_fr' => 'Driouch',            'nom_ar' => 'الدريوش', 'id_province' => 8],
            ['code_commune' => 'C18002', 'nom_fr' => 'Midar',              'nom_ar' => 'ميدار', 'id_province' => 8],
            ['code_commune' => 'C18003', 'nom_fr' => 'Ben Taieb',          'nom_ar' => 'بن الطيب', 'id_province' => 8],
            ['code_commune' => 'C18004', 'nom_fr' => 'Temsamane',          'nom_ar' => 'تيمزمان', 'id_province' => 8],
            ['code_commune' => 'C18005', 'nom_fr' => 'Trougout',           'nom_ar' => 'تروڭوت', 'id_province' => 8],
            ['code_commune' => 'C18006', 'nom_fr' => 'Ijermaouas',         'nom_ar' => 'إجرماون', 'id_province' => 8],
            ['code_commune' => 'C18007', 'nom_fr' => 'Ain Zohra',          'nom_ar' => 'عين زوهرة', 'id_province' => 8],
            ['code_commune' => 'C18008', 'nom_fr' => 'Ait Mait',           'nom_ar' => 'آيت مايت', 'id_province' => 8],
            ['code_commune' => 'C18009', 'nom_fr' => 'Ouled Aissa',        'nom_ar' => 'أولاد عيسى', 'id_province' => 8],
            ['code_commune' => 'C18010', 'nom_fr' => 'Dar El Kebdani',     'nom_ar' => 'دار الكبداني', 'id_province' => 8],
            ['code_commune' => 'C18011', 'nom_fr' => 'Oulad Boubker',      'nom_ar' => 'أولاد بوبكر', 'id_province' => 8],
            ['code_commune' => 'C18012', 'nom_fr' => 'Tazaghine',          'nom_ar' => 'تزغين', 'id_province' => 8],
            ['code_commune' => 'C18013', 'nom_fr' => 'Azlaf',              'nom_ar' => 'أزلاف', 'id_province' => 8],
            ['code_commune' => 'C18014', 'nom_fr' => 'Bni Marghnine',      'nom_ar' => 'بني مرغنين', 'id_province' => 8],
            ['code_commune' => 'C18015', 'nom_fr' => 'Boudinar',           'nom_ar' => 'بودينار', 'id_province' => 8],
            ['code_commune' => 'C18016', 'nom_fr' => 'Iferni',             'nom_ar' => 'إفرني', 'id_province' => 8],
            ['code_commune' => 'C18017', 'nom_fr' => "M'Hajer",           'nom_ar' => 'المهاجر', 'id_province' => 8],
            ['code_commune' => 'C18018', 'nom_fr' => 'Ouardana',           'nom_ar' => 'واردانة', 'id_province' => 8],
            ['code_commune' => 'C18019', 'nom_fr' => 'Oulad Amghar',       'nom_ar' => 'أولاد أمغار', 'id_province' => 8],
            ['code_commune' => 'C18020', 'nom_fr' => 'Tafersit',           'nom_ar' => 'تافرست', 'id_province' => 8],
            ['code_commune' => 'C18021', 'nom_fr' => 'Talilit',            'nom_ar' => 'تاليلت', 'id_province' => 8],
            ['code_commune' => 'C18022', 'nom_fr' => 'Tsaft',              'nom_ar' => 'تسافت', 'id_province' => 8],
            ['code_commune' => 'C18023', 'nom_fr' => 'Mtalssa',            'nom_ar' => 'متالسة', 'id_province' => 8],
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
            ]
        ];

        foreach($sous_projets as $sp){
            SousProjetLocalise::create($sp);
        }
    }
}
