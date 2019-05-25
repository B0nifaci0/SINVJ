<?php

use Illuminate\Database\Seeder;
use App\State;
use App\Municipality;
//use Database;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StateTableSeeder::class);

        $this->command->info('State table seeded!');

        $this->call(MunicipalityTableSeeder::class);

        $this->command->info('Municipality table seeded!');
    }
}


class StateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		factory(State::class)->create([
			'id' => '01',
			'name' =>  'Aguascalientes',
			'abbrev' =>  'Ags.',
			'country' =>  'MX'
		]);
		factory(State::class)->create([
			'id' => '02',
			'name' =>  'Baja California',
			'abbrev' =>  'BC',
			'country' =>  'MX'
		]);
		factory(State::class)->create([
			'id' => '03',
			'name' =>  'Baja California Sur',
			'abbrev' =>  'BCS',
			'country' =>  'MX'
		]);
		factory(State::class)->create([
			'id' => '04',
			'name' =>  'Campeche',
			'abbrev' =>  'Camp.',
			'country' =>  'MX'
		]);
		factory(State::class)->create([
			'id' => '05',
			'name' =>  'Coahuila de Zaragoza',
			'abbrev' =>  'Coah.',
			'country' =>  'MX'
		]);
		factory(State::class)->create([
			'id' => '06',
			'name' =>  'Colima',
			'abbrev' =>  'Col.',
			'country' =>  'MX'
		]);
		factory(State::class)->create([
			'id' => '07',
			'name' =>  'Chiapas',
			'abbrev' =>  'Chis.',
			'country' =>  'MX'
		]);
		factory(State::class)->create([
			'id' => '08',
			'name' =>  'Chihuahua',
			'abbrev' =>  'Chih.',
			'country' =>  'MX'
		]);
		factory(State::class)->create([
			'id' => '09',
			'name' =>  'Distrito Federal',
			'abbrev' =>  'DF',
			'country' =>  'MX'
		]);
		factory(State::class)->create([
			'id' => '10',
			'name' =>  'Durango',
			'abbrev' =>  'Dgo.',
			'country' =>  'MX'
		]);
		factory(State::class)->create([
			'id' => '11',
			'name' =>  'Guanajuato',
			'abbrev' =>  'Gto.',
			'country' =>  'MX'
		]);
		factory(State::class)->create([
			'id' => '12',
			'name' =>  'Guerrero',
			'abbrev' =>  'Gro.',
			'country' =>  'MX'
		]);
		factory(State::class)->create([
			'id' => '13',
			'name' =>  'Hidalgo',
			'abbrev' =>  'Hgo.',
			'country' =>  'MX'
		]);
		factory(State::class)->create([
			'id' => '14',
			'name' =>  'Jalisco',
			'abbrev' =>  'Jal.',
			'country' =>  'MX'
		]);
		factory(State::class)->create([
			'id' => '15',
			'name' =>  'México',
			'abbrev' =>  'Mex.',
			'country' =>  'MX'
		]);
		factory(State::class)->create([
			'id' => '16',
			'name' =>  'Michoacán de Ocampo',
			'abbrev' =>  'Mich.',
			'country' =>  'MX'
		]);
		factory(State::class)->create([
			'id' => '17',
			'name' =>  'Morelos',
			'abbrev' =>  'Mor.',
			'country' =>  'MX'
		]);
		factory(State::class)->create([
			'id' => '18',
			'name' =>  'Nayarit',
			'abbrev' =>  'Nay.',
			'country' =>  'MX'
		]);
		factory(State::class)->create([
			'id' => '19',
			'name' =>  'Nuevo León',
			'abbrev' =>  'NL',
			'country' =>  'MX'
		]);
		factory(State::class)->create([
			'id' => '20',
			'name' =>  'Oaxaca',
			'abbrev' =>  'Oax.',
			'country' =>  'MX'
		]);
		factory(State::class)->create([
			'id' => '21',
			'name' =>  'Puebla',
			'abbrev' =>  'Pue.',
			'country' =>  'MX'
		]);
		factory(State::class)->create([
			'id' => '22',
			'name' =>  'Querétaro',
			'abbrev' =>  'Qro.',
			'country' =>  'MX'
		]);
		factory(State::class)->create([
			'id' => '23',
			'name' =>  'Quintana Roo',
			'abbrev' =>  'Q. Roo',
			'country' =>  'MX'
		]);
		factory(State::class)->create([
			'id' => '24',
			'name' =>  'San Luis Potosí',
			'abbrev' =>  'SLP',
			'country' =>  'MX'
		]);
		factory(State::class)->create([
			'id' => '25',
			'name' =>  'Sinaloa',
			'abbrev' =>  'Sin.',
			'country' =>  'MX'
		]);
		factory(State::class)->create([
			'id' => '26',
			'name' =>  'Sonora',
			'abbrev' =>  'Son.',
			'country' =>  'MX'
		]);
		factory(State::class)->create([
			'id' => '27',
			'name' =>  'Tabasco',
			'abbrev' =>  'Tab.',
			'country' =>  'MX'
		]);
		factory(State::class)->create([
			'id' => '28',
			'name' =>  'Tamaulipas',
			'abbrev' =>  'Tamps.',
			'country' =>  'MX'
		]);
		factory(State::class)->create([
			'id' => '29',
			'name' =>  'Tlaxcala',
			'abbrev' =>  'Tlax.',
			'country' =>  'MX'
		]);
		factory(State::class)->create([
			'id' => '30',
			'name' =>  'Veracruz de Ignacio de la Llave',
			'abbrev' =>  'Ver.',
			'country' =>  'MX'
		]);
		factory(State::class)->create([
			'id' => '31',
			'name' =>  'Yucatán',
			'abbrev' =>  'Yuc.',
			'country' =>  'MX'
		]);
		factory(State::class)->create([
			'id' => '32',
			'name' =>  'Zacatecas',
			'abbrev' =>  'Zac.',
			'country' =>  'MX'
		]);
    }
}


class MunicipalityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Municipality::class)->create([
            'name' =>  'Aguascalientes',
            'state_id' => '01',
            'number' =>  '001',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Asientos',
            'state_id' => '01',
            'number' =>  '002',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Calvillo',
            'state_id' => '01',
            'number' =>  '003',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cosío',
            'state_id' => '01',
            'number' =>  '004',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jesús María',
            'state_id' => '01',
            'number' =>  '005',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Pabellón de Arteaga',
            'state_id' => '01',
            'number' =>  '006',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Rincón de Romos',
            'state_id' => '01',
            'number' =>  '007',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San José de Gracia',
            'state_id' => '01',
            'number' =>  '008',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tepezalá',
            'state_id' => '01',
            'number' =>  '009',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'El Llano',
            'state_id' => '01',
            'number' =>  '010',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Francisco de los Romo',
            'state_id' => '01',
            'number' =>  '011',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ensenada',
            'state_id' => '02',
            'number' =>  '001',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mexicali',
            'state_id' => '02',
            'number' =>  '002',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tecate',
            'state_id' => '02',
            'number' =>  '003',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tijuana',
            'state_id' => '02',
            'number' =>  '004',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Playas de Rosarito',
            'state_id' => '02',
            'number' =>  '005',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Comondú',
            'state_id' => '03',
            'number' =>  '001',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mulegé',
            'state_id' => '03',
            'number' =>  '002',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'La Paz',
            'state_id' => '03',
            'number' =>  '003',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Los Cabos',
            'state_id' => '03',
            'number' =>  '008',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Loreto',
            'state_id' => '03',
            'number' =>  '009',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Calkiní',
            'state_id' => '04',
            'number' =>  '001',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Campeche',
            'state_id' => '04',
            'number' =>  '002',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Carmen',
            'state_id' => '04',
            'number' =>  '003',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Champotón',
            'state_id' => '04',
            'number' =>  '004',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Hecelchakán',
            'state_id' => '04',
            'number' =>  '005',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Hopelchén',
            'state_id' => '04',
            'number' =>  '006',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Palizada',
            'state_id' => '04',
            'number' =>  '007',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tenabo',
            'state_id' => '04',
            'number' =>  '008',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Escárcega',
            'state_id' => '04',
            'number' =>  '009',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Calakmul',
            'state_id' => '04',
            'number' =>  '010',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Candelaria',
            'state_id' => '04',
            'number' =>  '011',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Abasolo',
            'state_id' => '05',
            'number' =>  '001',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Acuña',
            'state_id' => '05',
            'number' =>  '002',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Allende',
            'state_id' => '05',
            'number' =>  '003',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Arteaga',
            'state_id' => '05',
            'number' =>  '004',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Candela',
            'state_id' => '05',
            'number' =>  '005',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Castaños',
            'state_id' => '05',
            'number' =>  '006',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cuatro Ciénegas',
            'state_id' => '05',
            'number' =>  '007',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Escobedo',
            'state_id' => '05',
            'number' =>  '008',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Francisco I. Madero',
            'state_id' => '05',
            'number' =>  '009',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Frontera',
            'state_id' => '05',
            'number' =>  '010',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'General Cepeda',
            'state_id' => '05',
            'number' =>  '011',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Guerrero',
            'state_id' => '05',
            'number' =>  '012',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Hidalgo',
            'state_id' => '05',
            'number' =>  '013',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jiménez',
            'state_id' => '05',
            'number' =>  '014',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Juárez',
            'state_id' => '05',
            'number' =>  '015',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Lamadrid',
            'state_id' => '05',
            'number' =>  '016',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Matamoros',
            'state_id' => '05',
            'number' =>  '017',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Monclova',
            'state_id' => '05',
            'number' =>  '018',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Morelos',
            'state_id' => '05',
            'number' =>  '019',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Múzquiz',
            'state_id' => '05',
            'number' =>  '020',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Nadadores',
            'state_id' => '05',
            'number' =>  '021',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Nava',
            'state_id' => '05',
            'number' =>  '022',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ocampo',
            'state_id' => '05',
            'number' =>  '023',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Parras',
            'state_id' => '05',
            'number' =>  '024',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Piedras Negras',
            'state_id' => '05',
            'number' =>  '025',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Progreso',
            'state_id' => '05',
            'number' =>  '026',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ramos Arizpe',
            'state_id' => '05',
            'number' =>  '027',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Sabinas',
            'state_id' => '05',
            'number' =>  '028',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Sacramento',
            'state_id' => '05',
            'number' =>  '029',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Saltillo',
            'state_id' => '05',
            'number' =>  '030',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Buenaventura',
            'state_id' => '05',
            'number' =>  '031',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan de Sabinas',
            'state_id' => '05',
            'number' =>  '032',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro',
            'state_id' => '05',
            'number' =>  '033',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Sierra Mojada',
            'state_id' => '05',
            'number' =>  '034',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Torreón',
            'state_id' => '05',
            'number' =>  '035',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Viesca',
            'state_id' => '05',
            'number' =>  '036',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villa Unión',
            'state_id' => '05',
            'number' =>  '037',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zaragoza',
            'state_id' => '05',
            'number' =>  '038',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Armería',
            'state_id' => '06',
            'number' =>  '001',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Colima',
            'state_id' => '06',
            'number' =>  '002',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Comala',
            'state_id' => '06',
            'number' =>  '003',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Coquimatlán',
            'state_id' => '06',
            'number' =>  '004',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cuauhtémoc',
            'state_id' => '06',
            'number' =>  '005',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ixtlahuacán',
            'state_id' => '06',
            'number' =>  '006',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Manzanillo',
            'state_id' => '06',
            'number' =>  '007',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Minatitlán',
            'state_id' => '06',
            'number' =>  '008',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tecomán',
            'state_id' => '06',
            'number' =>  '009',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villa de Álvarez',
            'state_id' => '06',
            'number' =>  '010',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Acacoyagua',
            'state_id' => '07',
            'number' =>  '001',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Acala',
            'state_id' => '07',
            'number' =>  '002',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Acapetahua',
            'state_id' => '07',
            'number' =>  '003',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Altamirano',
            'state_id' => '07',
            'number' =>  '004',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Amatán',
            'state_id' => '07',
            'number' =>  '005',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Amatenango de la Frontera',
            'state_id' => '07',
            'number' =>  '006',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Amatenango del Valle',
            'state_id' => '07',
            'number' =>  '007',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Angel Albino Corzo',
            'state_id' => '07',
            'number' =>  '008',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Arriaga',
            'state_id' => '07',
            'number' =>  '009',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Bejucal de Ocampo',
            'state_id' => '07',
            'number' =>  '010',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Bella Vista',
            'state_id' => '07',
            'number' =>  '011',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Berriozábal',
            'state_id' => '07',
            'number' =>  '012',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Bochil',
            'state_id' => '07',
            'number' =>  '013',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'El Bosque',
            'state_id' => '07',
            'number' =>  '014',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cacahoatán',
            'state_id' => '07',
            'number' =>  '015',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Catazajá',
            'state_id' => '07',
            'number' =>  '016',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cintalapa',
            'state_id' => '07',
            'number' =>  '017',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Coapilla',
            'state_id' => '07',
            'number' =>  '018',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Comitán de Domínguez',
            'state_id' => '07',
            'number' =>  '019',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'La Concordia',
            'state_id' => '07',
            'number' =>  '020',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Copainalá',
            'state_id' => '07',
            'number' =>  '021',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chalchihuitán',
            'state_id' => '07',
            'number' =>  '022',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chamula',
            'state_id' => '07',
            'number' =>  '023',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chanal',
            'state_id' => '07',
            'number' =>  '024',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chapultenango',
            'state_id' => '07',
            'number' =>  '025',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chenalhó',
            'state_id' => '07',
            'number' =>  '026',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chiapa de Corzo',
            'state_id' => '07',
            'number' =>  '027',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chiapilla',
            'state_id' => '07',
            'number' =>  '028',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chicoasén',
            'state_id' => '07',
            'number' =>  '029',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chicomuselo',
            'state_id' => '07',
            'number' =>  '030',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chilón',
            'state_id' => '07',
            'number' =>  '031',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Escuintla',
            'state_id' => '07',
            'number' =>  '032',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Francisco León',
            'state_id' => '07',
            'number' =>  '033',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Frontera Comalapa',
            'state_id' => '07',
            'number' =>  '034',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Frontera Hidalgo',
            'state_id' => '07',
            'number' =>  '035',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'La Grandeza',
            'state_id' => '07',
            'number' =>  '036',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huehuetán',
            'state_id' => '07',
            'number' =>  '037',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huixtán',
            'state_id' => '07',
            'number' =>  '038',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huitiupán',
            'state_id' => '07',
            'number' =>  '039',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huixtla',
            'state_id' => '07',
            'number' =>  '040',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'La Independencia',
            'state_id' => '07',
            'number' =>  '041',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ixhuatán',
            'state_id' => '07',
            'number' =>  '042',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ixtacomitán',
            'state_id' => '07',
            'number' =>  '043',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ixtapa',
            'state_id' => '07',
            'number' =>  '044',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ixtapangajoya',
            'state_id' => '07',
            'number' =>  '045',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jiquipilas',
            'state_id' => '07',
            'number' =>  '046',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jitotol',
            'state_id' => '07',
            'number' =>  '047',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Juárez',
            'state_id' => '07',
            'number' =>  '048',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Larráinzar',
            'state_id' => '07',
            'number' =>  '049',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'La Libertad',
            'state_id' => '07',
            'number' =>  '050',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mapastepec',
            'state_id' => '07',
            'number' =>  '051',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Las Margaritas',
            'state_id' => '07',
            'number' =>  '052',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mazapa de Madero',
            'state_id' => '07',
            'number' =>  '053',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mazatán',
            'state_id' => '07',
            'number' =>  '054',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Metapa',
            'state_id' => '07',
            'number' =>  '055',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mitontic',
            'state_id' => '07',
            'number' =>  '056',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Motozintla',
            'state_id' => '07',
            'number' =>  '057',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Nicolás Ruíz',
            'state_id' => '07',
            'number' =>  '058',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ocosingo',
            'state_id' => '07',
            'number' =>  '059',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ocotepec',
            'state_id' => '07',
            'number' =>  '060',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ocozocoautla de Espinosa',
            'state_id' => '07',
            'number' =>  '061',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ostuacán',
            'state_id' => '07',
            'number' =>  '062',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Osumacinta',
            'state_id' => '07',
            'number' =>  '063',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Oxchuc',
            'state_id' => '07',
            'number' =>  '064',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Palenque',
            'state_id' => '07',
            'number' =>  '065',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Pantelhó',
            'state_id' => '07',
            'number' =>  '066',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Pantepec',
            'state_id' => '07',
            'number' =>  '067',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Pichucalco',
            'state_id' => '07',
            'number' =>  '068',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Pijijiapan',
            'state_id' => '07',
            'number' =>  '069',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'El Porvenir',
            'state_id' => '07',
            'number' =>  '070',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villa Comaltitlán',
            'state_id' => '07',
            'number' =>  '071',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Pueblo Nuevo Solistahuacán',
            'state_id' => '07',
            'number' =>  '072',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Rayón',
            'state_id' => '07',
            'number' =>  '073',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Reforma',
            'state_id' => '07',
            'number' =>  '074',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Las Rosas',
            'state_id' => '07',
            'number' =>  '075',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Sabanilla',
            'state_id' => '07',
            'number' =>  '076',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Salto de Agua',
            'state_id' => '07',
            'number' =>  '077',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Cristóbal de las Casas',
            'state_id' => '07',
            'number' =>  '078',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Fernando',
            'state_id' => '07',
            'number' =>  '079',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Siltepec',
            'state_id' => '07',
            'number' =>  '080',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Simojovel',
            'state_id' => '07',
            'number' =>  '081',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Sitalá',
            'state_id' => '07',
            'number' =>  '082',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Socoltenango',
            'state_id' => '07',
            'number' =>  '083',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Solosuchiapa',
            'state_id' => '07',
            'number' =>  '084',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Soyaló',
            'state_id' => '07',
            'number' =>  '085',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Suchiapa',
            'state_id' => '07',
            'number' =>  '086',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Suchiate',
            'state_id' => '07',
            'number' =>  '087',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Sunuapa',
            'state_id' => '07',
            'number' =>  '088',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tapachula',
            'state_id' => '07',
            'number' =>  '089',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tapalapa',
            'state_id' => '07',
            'number' =>  '090',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tapilula',
            'state_id' => '07',
            'number' =>  '091',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tecpatán',
            'state_id' => '07',
            'number' =>  '092',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tenejapa',
            'state_id' => '07',
            'number' =>  '093',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Teopisca',
            'state_id' => '07',
            'number' =>  '094',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tila',
            'state_id' => '07',
            'number' =>  '096',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tonalá',
            'state_id' => '07',
            'number' =>  '097',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Totolapa',
            'state_id' => '07',
            'number' =>  '098',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'La Trinitaria',
            'state_id' => '07',
            'number' =>  '099',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tumbalá',
            'state_id' => '07',
            'number' =>  '100',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tuxtla Gutiérrez',
            'state_id' => '07',
            'number' =>  '101',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tuxtla Chico',
            'state_id' => '07',
            'number' =>  '102',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tuzantán',
            'state_id' => '07',
            'number' =>  '103',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tzimol',
            'state_id' => '07',
            'number' =>  '104',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Unión Juárez',
            'state_id' => '07',
            'number' =>  '105',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Venustiano Carranza',
            'state_id' => '07',
            'number' =>  '106',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villa Corzo',
            'state_id' => '07',
            'number' =>  '107',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villaflores',
            'state_id' => '07',
            'number' =>  '108',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Yajalón',
            'state_id' => '07',
            'number' =>  '109',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Lucas',
            'state_id' => '07',
            'number' =>  '110',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zinacantán',
            'state_id' => '07',
            'number' =>  '111',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Cancuc',
            'state_id' => '07',
            'number' =>  '112',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Aldama',
            'state_id' => '07',
            'number' =>  '113',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Benemérito de las Américas',
            'state_id' => '07',
            'number' =>  '114',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Maravilla Tenejapa',
            'state_id' => '07',
            'number' =>  '115',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Marqués de Comillas',
            'state_id' => '07',
            'number' =>  '116',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Montecristo de Guerrero',
            'state_id' => '07',
            'number' =>  '117',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Andrés Duraznal',
            'state_id' => '07',
            'number' =>  '118',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago el Pinar',
            'state_id' => '07',
            'number' =>  '119',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ahumada',
            'state_id' => '08',
            'number' =>  '001',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Aldama',
            'state_id' => '08',
            'number' =>  '002',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Allende',
            'state_id' => '08',
            'number' =>  '003',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Aquiles Serdán',
            'state_id' => '08',
            'number' =>  '004',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ascensión',
            'state_id' => '08',
            'number' =>  '005',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Bachíniva',
            'state_id' => '08',
            'number' =>  '006',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Balleza',
            'state_id' => '08',
            'number' =>  '007',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Batopilas',
            'state_id' => '08',
            'number' =>  '008',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Bocoyna',
            'state_id' => '08',
            'number' =>  '009',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Buenaventura',
            'state_id' => '08',
            'number' =>  '010',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Camargo',
            'state_id' => '08',
            'number' =>  '011',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Carichí',
            'state_id' => '08',
            'number' =>  '012',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Casas Grandes',
            'state_id' => '08',
            'number' =>  '013',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Coronado',
            'state_id' => '08',
            'number' =>  '014',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Coyame del Sotol',
            'state_id' => '08',
            'number' =>  '015',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'La Cruz',
            'state_id' => '08',
            'number' =>  '016',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cuauhtémoc',
            'state_id' => '08',
            'number' =>  '017',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cusihuiriachi',
            'state_id' => '08',
            'number' =>  '018',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chihuahua',
            'state_id' => '08',
            'number' =>  '019',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chínipas',
            'state_id' => '08',
            'number' =>  '020',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Delicias',
            'state_id' => '08',
            'number' =>  '021',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Dr. Belisario Domínguez',
            'state_id' => '08',
            'number' =>  '022',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Galeana',
            'state_id' => '08',
            'number' =>  '023',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Isabel',
            'state_id' => '08',
            'number' =>  '024',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Gómez Farías',
            'state_id' => '08',
            'number' =>  '025',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Gran Morelos',
            'state_id' => '08',
            'number' =>  '026',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Guachochi',
            'state_id' => '08',
            'number' =>  '027',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Guadalupe',
            'state_id' => '08',
            'number' =>  '028',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Guadalupe y Calvo',
            'state_id' => '08',
            'number' =>  '029',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Guazapares',
            'state_id' => '08',
            'number' =>  '030',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Guerrero',
            'state_id' => '08',
            'number' =>  '031',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Hidalgo del Parral',
            'state_id' => '08',
            'number' =>  '032',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huejotitán',
            'state_id' => '08',
            'number' =>  '033',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ignacio Zaragoza',
            'state_id' => '08',
            'number' =>  '034',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Janos',
            'state_id' => '08',
            'number' =>  '035',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jiménez',
            'state_id' => '08',
            'number' =>  '036',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Juárez',
            'state_id' => '08',
            'number' =>  '037',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Julimes',
            'state_id' => '08',
            'number' =>  '038',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'López',
            'state_id' => '08',
            'number' =>  '039',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Madera',
            'state_id' => '08',
            'number' =>  '040',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Maguarichi',
            'state_id' => '08',
            'number' =>  '041',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Manuel Benavides',
            'state_id' => '08',
            'number' =>  '042',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Matachí',
            'state_id' => '08',
            'number' =>  '043',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Matamoros',
            'state_id' => '08',
            'number' =>  '044',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Meoqui',
            'state_id' => '08',
            'number' =>  '045',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Morelos',
            'state_id' => '08',
            'number' =>  '046',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Moris',
            'state_id' => '08',
            'number' =>  '047',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Namiquipa',
            'state_id' => '08',
            'number' =>  '048',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Nonoava',
            'state_id' => '08',
            'number' =>  '049',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Nuevo Casas Grandes',
            'state_id' => '08',
            'number' =>  '050',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ocampo',
            'state_id' => '08',
            'number' =>  '051',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ojinaga',
            'state_id' => '08',
            'number' =>  '052',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Praxedis G. Guerrero',
            'state_id' => '08',
            'number' =>  '053',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Riva Palacio',
            'state_id' => '08',
            'number' =>  '054',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Rosales',
            'state_id' => '08',
            'number' =>  '055',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Rosario',
            'state_id' => '08',
            'number' =>  '056',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Francisco de Borja',
            'state_id' => '08',
            'number' =>  '057',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Francisco de Conchos',
            'state_id' => '08',
            'number' =>  '058',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Francisco del Oro',
            'state_id' => '08',
            'number' =>  '059',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Bárbara',
            'state_id' => '08',
            'number' =>  '060',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Satevó',
            'state_id' => '08',
            'number' =>  '061',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Saucillo',
            'state_id' => '08',
            'number' =>  '062',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Temósachic',
            'state_id' => '08',
            'number' =>  '063',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'El Tule',
            'state_id' => '08',
            'number' =>  '064',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Urique',
            'state_id' => '08',
            'number' =>  '065',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Uruachi',
            'state_id' => '08',
            'number' =>  '066',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Valle de Zaragoza',
            'state_id' => '08',
            'number' =>  '067',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Azcapotzalco',
            'state_id' => '09',
            'number' =>  '002',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Coyoacán',
            'state_id' => '09',
            'number' =>  '003',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cuajimalpa de Morelos',
            'state_id' => '09',
            'number' =>  '004',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Gustavo A. Madero',
            'state_id' => '09',
            'number' =>  '005',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Iztacalco',
            'state_id' => '09',
            'number' =>  '006',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Iztapalapa',
            'state_id' => '09',
            'number' =>  '007',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'La Magdalena Contreras',
            'state_id' => '09',
            'number' =>  '008',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Milpa Alta',
            'state_id' => '09',
            'number' =>  '009',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Álvaro Obregón',
            'state_id' => '09',
            'number' =>  '010',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tláhuac',
            'state_id' => '09',
            'number' =>  '011',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlalpan',
            'state_id' => '09',
            'number' =>  '012',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Xochimilco',
            'state_id' => '09',
            'number' =>  '013',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Benito Juárez',
            'state_id' => '09',
            'number' =>  '014',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cuauhtémoc',
            'state_id' => '09',
            'number' =>  '015',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Miguel Hidalgo',
            'state_id' => '09',
            'number' =>  '016',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Venustiano Carranza',
            'state_id' => '09',
            'number' =>  '017',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Canatlán',
            'state_id' => '10',
            'number' =>  '001',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Canelas',
            'state_id' => '10',
            'number' =>  '002',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Coneto de Comonfort',
            'state_id' => '10',
            'number' =>  '003',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cuencamé',
            'state_id' => '10',
            'number' =>  '004',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Durango',
            'state_id' => '10',
            'number' =>  '005',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'General Simón Bolívar',
            'state_id' => '10',
            'number' =>  '006',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Gómez Palacio',
            'state_id' => '10',
            'number' =>  '007',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Guadalupe Victoria',
            'state_id' => '10',
            'number' =>  '008',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Guanaceví',
            'state_id' => '10',
            'number' =>  '009',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Hidalgo',
            'state_id' => '10',
            'number' =>  '010',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Indé',
            'state_id' => '10',
            'number' =>  '011',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Lerdo',
            'state_id' => '10',
            'number' =>  '012',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mapimí',
            'state_id' => '10',
            'number' =>  '013',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mezquital',
            'state_id' => '10',
            'number' =>  '014',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Nazas',
            'state_id' => '10',
            'number' =>  '015',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Nombre de Dios',
            'state_id' => '10',
            'number' =>  '016',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ocampo',
            'state_id' => '10',
            'number' =>  '017',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'El Oro',
            'state_id' => '10',
            'number' =>  '018',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Otáez',
            'state_id' => '10',
            'number' =>  '019',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Pánuco de Coronado',
            'state_id' => '10',
            'number' =>  '020',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Peñón Blanco',
            'state_id' => '10',
            'number' =>  '021',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Poanas',
            'state_id' => '10',
            'number' =>  '022',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Pueblo Nuevo',
            'state_id' => '10',
            'number' =>  '023',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Rodeo',
            'state_id' => '10',
            'number' =>  '024',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Bernardo',
            'state_id' => '10',
            'number' =>  '025',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Dimas',
            'state_id' => '10',
            'number' =>  '026',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan de Guadalupe',
            'state_id' => '10',
            'number' =>  '027',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan del Río',
            'state_id' => '10',
            'number' =>  '028',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Luis del Cordero',
            'state_id' => '10',
            'number' =>  '029',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro del Gallo',
            'state_id' => '10',
            'number' =>  '030',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Clara',
            'state_id' => '10',
            'number' =>  '031',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Papasquiaro',
            'state_id' => '10',
            'number' =>  '032',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Súchil',
            'state_id' => '10',
            'number' =>  '033',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tamazula',
            'state_id' => '10',
            'number' =>  '034',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tepehuanes',
            'state_id' => '10',
            'number' =>  '035',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlahualilo',
            'state_id' => '10',
            'number' =>  '036',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Topia',
            'state_id' => '10',
            'number' =>  '037',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Vicente Guerrero',
            'state_id' => '10',
            'number' =>  '038',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Nuevo Ideal',
            'state_id' => '10',
            'number' =>  '039',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Abasolo',
            'state_id' => '11',
            'number' =>  '001',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Acámbaro',
            'state_id' => '11',
            'number' =>  '002',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Miguel de Allende',
            'state_id' => '11',
            'number' =>  '003',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Apaseo el Alto',
            'state_id' => '11',
            'number' =>  '004',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Apaseo el Grande',
            'state_id' => '11',
            'number' =>  '005',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Atarjea',
            'state_id' => '11',
            'number' =>  '006',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Celaya',
            'state_id' => '11',
            'number' =>  '007',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Manuel Doblado',
            'state_id' => '11',
            'number' =>  '008',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Comonfort',
            'state_id' => '11',
            'number' =>  '009',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Coroneo',
            'state_id' => '11',
            'number' =>  '010',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cortazar',
            'state_id' => '11',
            'number' =>  '011',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cuerámaro',
            'state_id' => '11',
            'number' =>  '012',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Doctor Mora',
            'state_id' => '11',
            'number' =>  '013',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Dolores Hidalgo Cuna de la Independencia Nacional',
            'state_id' => '11',
            'number' =>  '014',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Guanajuato',
            'state_id' => '11',
            'number' =>  '015',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huanímaro',
            'state_id' => '11',
            'number' =>  '016',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Irapuato',
            'state_id' => '11',
            'number' =>  '017',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jaral del Progreso',
            'state_id' => '11',
            'number' =>  '018',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jerécuaro',
            'state_id' => '11',
            'number' =>  '019',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'León',
            'state_id' => '11',
            'number' =>  '020',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Moroleón',
            'state_id' => '11',
            'number' =>  '021',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ocampo',
            'state_id' => '11',
            'number' =>  '022',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Pénjamo',
            'state_id' => '11',
            'number' =>  '023',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Pueblo Nuevo',
            'state_id' => '11',
            'number' =>  '024',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Purísima del Rincón',
            'state_id' => '11',
            'number' =>  '025',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Romita',
            'state_id' => '11',
            'number' =>  '026',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Salamanca',
            'state_id' => '11',
            'number' =>  '027',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Salvatierra',
            'state_id' => '11',
            'number' =>  '028',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Diego de la Unión',
            'state_id' => '11',
            'number' =>  '029',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Felipe',
            'state_id' => '11',
            'number' =>  '030',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Francisco del Rincón',
            'state_id' => '11',
            'number' =>  '031',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San José Iturbide',
            'state_id' => '11',
            'number' =>  '032',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Luis de la Paz',
            'state_id' => '11',
            'number' =>  '033',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Catarina',
            'state_id' => '11',
            'number' =>  '034',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Cruz de Juventino Rosas',
            'state_id' => '11',
            'number' =>  '035',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Maravatío',
            'state_id' => '11',
            'number' =>  '036',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Silao de la Victoria',
            'state_id' => '11',
            'number' =>  '037',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tarandacuao',
            'state_id' => '11',
            'number' =>  '038',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tarimoro',
            'state_id' => '11',
            'number' =>  '039',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tierra Blanca',
            'state_id' => '11',
            'number' =>  '040',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Uriangato',
            'state_id' => '11',
            'number' =>  '041',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Valle de Santiago',
            'state_id' => '11',
            'number' =>  '042',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Victoria',
            'state_id' => '11',
            'number' =>  '043',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villagrán',
            'state_id' => '11',
            'number' =>  '044',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Xichú',
            'state_id' => '11',
            'number' =>  '045',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Yuriria',
            'state_id' => '11',
            'number' =>  '046',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Acapulco de Juárez',
            'state_id' => '12',
            'number' =>  '001',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ahuacuotzingo',
            'state_id' => '12',
            'number' =>  '002',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ajuchitlán del Progreso',
            'state_id' => '12',
            'number' =>  '003',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Alcozauca de Guerrero',
            'state_id' => '12',
            'number' =>  '004',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Alpoyeca',
            'state_id' => '12',
            'number' =>  '005',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Apaxtla',
            'state_id' => '12',
            'number' =>  '006',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Arcelia',
            'state_id' => '12',
            'number' =>  '007',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Atenango del Río',
            'state_id' => '12',
            'number' =>  '008',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Atlamajalcingo del Monte',
            'state_id' => '12',
            'number' =>  '009',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Atlixtac',
            'state_id' => '12',
            'number' =>  '010',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Atoyac de Álvarez',
            'state_id' => '12',
            'number' =>  '011',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ayutla de los Libres',
            'state_id' => '12',
            'number' =>  '012',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Azoyú',
            'state_id' => '12',
            'number' =>  '013',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Benito Juárez',
            'state_id' => '12',
            'number' =>  '014',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Buenavista de Cuéllar',
            'state_id' => '12',
            'number' =>  '015',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Coahuayutla de José María Izazaga',
            'state_id' => '12',
            'number' =>  '016',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cocula',
            'state_id' => '12',
            'number' =>  '017',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Copala',
            'state_id' => '12',
            'number' =>  '018',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Copalillo',
            'state_id' => '12',
            'number' =>  '019',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Copanatoyac',
            'state_id' => '12',
            'number' =>  '020',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Coyuca de Benítez',
            'state_id' => '12',
            'number' =>  '021',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Coyuca de Catalán',
            'state_id' => '12',
            'number' =>  '022',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cuajinicuilapa',
            'state_id' => '12',
            'number' =>  '023',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cualác',
            'state_id' => '12',
            'number' =>  '024',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cuautepec',
            'state_id' => '12',
            'number' =>  '025',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cuetzala del Progreso',
            'state_id' => '12',
            'number' =>  '026',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cutzamala de Pinzón',
            'state_id' => '12',
            'number' =>  '027',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chilapa de Álvarez',
            'state_id' => '12',
            'number' =>  '028',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chilpancingo de los Bravo',
            'state_id' => '12',
            'number' =>  '029',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Florencio Villarreal',
            'state_id' => '12',
            'number' =>  '030',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'General Canuto A. Neri',
            'state_id' => '12',
            'number' =>  '031',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'General Heliodoro Castillo',
            'state_id' => '12',
            'number' =>  '032',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huamuxtitlán',
            'state_id' => '12',
            'number' =>  '033',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huitzuco de los Figueroa',
            'state_id' => '12',
            'number' =>  '034',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Iguala de la Independencia',
            'state_id' => '12',
            'number' =>  '035',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Igualapa',
            'state_id' => '12',
            'number' =>  '036',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ixcateopan de Cuauhtémoc',
            'state_id' => '12',
            'number' =>  '037',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zihuatanejo de Azueta',
            'state_id' => '12',
            'number' =>  '038',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Juan R. Escudero',
            'state_id' => '12',
            'number' =>  '039',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Leonardo Bravo',
            'state_id' => '12',
            'number' =>  '040',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Malinaltepec',
            'state_id' => '12',
            'number' =>  '041',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mártir de Cuilapan',
            'state_id' => '12',
            'number' =>  '042',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Metlatónoc',
            'state_id' => '12',
            'number' =>  '043',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mochitlán',
            'state_id' => '12',
            'number' =>  '044',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Olinalá',
            'state_id' => '12',
            'number' =>  '045',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ometepec',
            'state_id' => '12',
            'number' =>  '046',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Pedro Ascencio Alquisiras',
            'state_id' => '12',
            'number' =>  '047',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Petatlán',
            'state_id' => '12',
            'number' =>  '048',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Pilcaya',
            'state_id' => '12',
            'number' =>  '049',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Pungarabato',
            'state_id' => '12',
            'number' =>  '050',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Quechultenango',
            'state_id' => '12',
            'number' =>  '051',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Luis Acatlán',
            'state_id' => '12',
            'number' =>  '052',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Marcos',
            'state_id' => '12',
            'number' =>  '053',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Miguel Totolapan',
            'state_id' => '12',
            'number' =>  '054',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Taxco de Alarcón',
            'state_id' => '12',
            'number' =>  '055',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tecoanapa',
            'state_id' => '12',
            'number' =>  '056',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Técpan de Galeana',
            'state_id' => '12',
            'number' =>  '057',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Teloloapan',
            'state_id' => '12',
            'number' =>  '058',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tepecoacuilco de Trujano',
            'state_id' => '12',
            'number' =>  '059',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tetipac',
            'state_id' => '12',
            'number' =>  '060',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tixtla de Guerrero',
            'state_id' => '12',
            'number' =>  '061',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlacoachistlahuaca',
            'state_id' => '12',
            'number' =>  '062',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlacoapa',
            'state_id' => '12',
            'number' =>  '063',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlalchapa',
            'state_id' => '12',
            'number' =>  '064',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlalixtaquilla de Maldonado',
            'state_id' => '12',
            'number' =>  '065',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlapa de Comonfort',
            'state_id' => '12',
            'number' =>  '066',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlapehuala',
            'state_id' => '12',
            'number' =>  '067',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'La Unión de Isidoro Montes de Oca',
            'state_id' => '12',
            'number' =>  '068',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Xalpatláhuac',
            'state_id' => '12',
            'number' =>  '069',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Xochihuehuetlán',
            'state_id' => '12',
            'number' =>  '070',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Xochistlahuaca',
            'state_id' => '12',
            'number' =>  '071',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zapotitlán Tablas',
            'state_id' => '12',
            'number' =>  '072',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zirándaro',
            'state_id' => '12',
            'number' =>  '073',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zitlala',
            'state_id' => '12',
            'number' =>  '074',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Eduardo Neri',
            'state_id' => '12',
            'number' =>  '075',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Acatepec',
            'state_id' => '12',
            'number' =>  '076',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Marquelia',
            'state_id' => '12',
            'number' =>  '077',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cochoapa el Grande',
            'state_id' => '12',
            'number' =>  '078',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'José Joaquín de Herrera',
            'state_id' => '12',
            'number' =>  '079',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Juchitán',
            'state_id' => '12',
            'number' =>  '080',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Iliatenco',
            'state_id' => '12',
            'number' =>  '081',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Acatlán',
            'state_id' => '13',
            'number' =>  '001',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Acaxochitlán',
            'state_id' => '13',
            'number' =>  '002',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Actopan',
            'state_id' => '13',
            'number' =>  '003',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Agua Blanca de Iturbide',
            'state_id' => '13',
            'number' =>  '004',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ajacuba',
            'state_id' => '13',
            'number' =>  '005',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Alfajayucan',
            'state_id' => '13',
            'number' =>  '006',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Almoloya',
            'state_id' => '13',
            'number' =>  '007',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Apan',
            'state_id' => '13',
            'number' =>  '008',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'El Arenal',
            'state_id' => '13',
            'number' =>  '009',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Atitalaquia',
            'state_id' => '13',
            'number' =>  '010',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Atlapexco',
            'state_id' => '13',
            'number' =>  '011',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Atotonilco el Grande',
            'state_id' => '13',
            'number' =>  '012',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Atotonilco de Tula',
            'state_id' => '13',
            'number' =>  '013',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Calnali',
            'state_id' => '13',
            'number' =>  '014',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cardonal',
            'state_id' => '13',
            'number' =>  '015',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cuautepec de Hinojosa',
            'state_id' => '13',
            'number' =>  '016',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chapantongo',
            'state_id' => '13',
            'number' =>  '017',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chapulhuacán',
            'state_id' => '13',
            'number' =>  '018',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chilcuautla',
            'state_id' => '13',
            'number' =>  '019',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Eloxochitlán',
            'state_id' => '13',
            'number' =>  '020',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Emiliano Zapata',
            'state_id' => '13',
            'number' =>  '021',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Epazoyucan',
            'state_id' => '13',
            'number' =>  '022',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Francisco I. Madero',
            'state_id' => '13',
            'number' =>  '023',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huasca de Ocampo',
            'state_id' => '13',
            'number' =>  '024',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huautla',
            'state_id' => '13',
            'number' =>  '025',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huazalingo',
            'state_id' => '13',
            'number' =>  '026',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huehuetla',
            'state_id' => '13',
            'number' =>  '027',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huejutla de Reyes',
            'state_id' => '13',
            'number' =>  '028',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huichapan',
            'state_id' => '13',
            'number' =>  '029',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ixmiquilpan',
            'state_id' => '13',
            'number' =>  '030',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jacala de Ledezma',
            'state_id' => '13',
            'number' =>  '031',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jaltocán',
            'state_id' => '13',
            'number' =>  '032',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Juárez Hidalgo',
            'state_id' => '13',
            'number' =>  '033',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Lolotla',
            'state_id' => '13',
            'number' =>  '034',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Metepec',
            'state_id' => '13',
            'number' =>  '035',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Agustín Metzquititlán',
            'state_id' => '13',
            'number' =>  '036',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Metztitlán',
            'state_id' => '13',
            'number' =>  '037',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mineral del Chico',
            'state_id' => '13',
            'number' =>  '038',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mineral del Monte',
            'state_id' => '13',
            'number' =>  '039',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'La Misión',
            'state_id' => '13',
            'number' =>  '040',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mixquiahuala de Juárez',
            'state_id' => '13',
            'number' =>  '041',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Molango de Escamilla',
            'state_id' => '13',
            'number' =>  '042',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Nicolás Flores',
            'state_id' => '13',
            'number' =>  '043',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Nopala de Villagrán',
            'state_id' => '13',
            'number' =>  '044',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Omitlán de Juárez',
            'state_id' => '13',
            'number' =>  '045',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Felipe Orizatlán',
            'state_id' => '13',
            'number' =>  '046',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Pacula',
            'state_id' => '13',
            'number' =>  '047',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Pachuca de Soto',
            'state_id' => '13',
            'number' =>  '048',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Pisaflores',
            'state_id' => '13',
            'number' =>  '049',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Progreso de Obregón',
            'state_id' => '13',
            'number' =>  '050',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mineral de la Reforma',
            'state_id' => '13',
            'number' =>  '051',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Agustín Tlaxiaca',
            'state_id' => '13',
            'number' =>  '052',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Bartolo Tutotepec',
            'state_id' => '13',
            'number' =>  '053',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Salvador',
            'state_id' => '13',
            'number' =>  '054',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago de Anaya',
            'state_id' => '13',
            'number' =>  '055',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Tulantepec de Lugo Guerrero',
            'state_id' => '13',
            'number' =>  '056',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Singuilucan',
            'state_id' => '13',
            'number' =>  '057',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tasquillo',
            'state_id' => '13',
            'number' =>  '058',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tecozautla',
            'state_id' => '13',
            'number' =>  '059',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tenango de Doria',
            'state_id' => '13',
            'number' =>  '060',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tepeapulco',
            'state_id' => '13',
            'number' =>  '061',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tepehuacán de Guerrero',
            'state_id' => '13',
            'number' =>  '062',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tepeji del Río de Ocampo',
            'state_id' => '13',
            'number' =>  '063',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tepetitlán',
            'state_id' => '13',
            'number' =>  '064',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tetepango',
            'state_id' => '13',
            'number' =>  '065',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villa de Tezontepec',
            'state_id' => '13',
            'number' =>  '066',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tezontepec de Aldama',
            'state_id' => '13',
            'number' =>  '067',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tianguistengo',
            'state_id' => '13',
            'number' =>  '068',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tizayuca',
            'state_id' => '13',
            'number' =>  '069',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlahuelilpan',
            'state_id' => '13',
            'number' =>  '070',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlahuiltepa',
            'state_id' => '13',
            'number' =>  '071',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlanalapa',
            'state_id' => '13',
            'number' =>  '072',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlanchinol',
            'state_id' => '13',
            'number' =>  '073',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlaxcoapan',
            'state_id' => '13',
            'number' =>  '074',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tolcayuca',
            'state_id' => '13',
            'number' =>  '075',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tula de Allende',
            'state_id' => '13',
            'number' =>  '076',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tulancingo de Bravo',
            'state_id' => '13',
            'number' =>  '077',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Xochiatipan',
            'state_id' => '13',
            'number' =>  '078',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Xochicoatlán',
            'state_id' => '13',
            'number' =>  '079',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Yahualica',
            'state_id' => '13',
            'number' =>  '080',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zacualtipán de Ángeles',
            'state_id' => '13',
            'number' =>  '081',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zapotlán de Juárez',
            'state_id' => '13',
            'number' =>  '082',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zempoala',
            'state_id' => '13',
            'number' =>  '083',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zimapán',
            'state_id' => '13',
            'number' =>  '084',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Acatic',
            'state_id' => '14',
            'number' =>  '001',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Acatlán de Juárez',
            'state_id' => '14',
            'number' =>  '002',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ahualulco de Mercado',
            'state_id' => '14',
            'number' =>  '003',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Amacueca',
            'state_id' => '14',
            'number' =>  '004',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Amatitán',
            'state_id' => '14',
            'number' =>  '005',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ameca',
            'state_id' => '14',
            'number' =>  '006',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juanito de Escobedo',
            'state_id' => '14',
            'number' =>  '007',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Arandas',
            'state_id' => '14',
            'number' =>  '008',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'El Arenal',
            'state_id' => '14',
            'number' =>  '009',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Atemajac de Brizuela',
            'state_id' => '14',
            'number' =>  '010',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Atengo',
            'state_id' => '14',
            'number' =>  '011',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Atenguillo',
            'state_id' => '14',
            'number' =>  '012',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Atotonilco el Alto',
            'state_id' => '14',
            'number' =>  '013',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Atoyac',
            'state_id' => '14',
            'number' =>  '014',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Autlán de Navarro',
            'state_id' => '14',
            'number' =>  '015',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ayotlán',
            'state_id' => '14',
            'number' =>  '016',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ayutla',
            'state_id' => '14',
            'number' =>  '017',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'La Barca',
            'state_id' => '14',
            'number' =>  '018',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Bolaños',
            'state_id' => '14',
            'number' =>  '019',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cabo Corrientes',
            'state_id' => '14',
            'number' =>  '020',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Casimiro Castillo',
            'state_id' => '14',
            'number' =>  '021',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cihuatlán',
            'state_id' => '14',
            'number' =>  '022',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zapotlán el Grande',
            'state_id' => '14',
            'number' =>  '023',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cocula',
            'state_id' => '14',
            'number' =>  '024',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Colotlán',
            'state_id' => '14',
            'number' =>  '025',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Concepción de Buenos Aires',
            'state_id' => '14',
            'number' =>  '026',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cuautitlán de García Barragán',
            'state_id' => '14',
            'number' =>  '027',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cuautla',
            'state_id' => '14',
            'number' =>  '028',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cuquío',
            'state_id' => '14',
            'number' =>  '029',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chapala',
            'state_id' => '14',
            'number' =>  '030',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chimaltitán',
            'state_id' => '14',
            'number' =>  '031',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chiquilistlán',
            'state_id' => '14',
            'number' =>  '032',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Degollado',
            'state_id' => '14',
            'number' =>  '033',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ejutla',
            'state_id' => '14',
            'number' =>  '034',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Encarnación de Díaz',
            'state_id' => '14',
            'number' =>  '035',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Etzatlán',
            'state_id' => '14',
            'number' =>  '036',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'El Grullo',
            'state_id' => '14',
            'number' =>  '037',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Guachinango',
            'state_id' => '14',
            'number' =>  '038',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Guadalajara',
            'state_id' => '14',
            'number' =>  '039',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Hostotipaquillo',
            'state_id' => '14',
            'number' =>  '040',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huejúcar',
            'state_id' => '14',
            'number' =>  '041',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huejuquilla el Alto',
            'state_id' => '14',
            'number' =>  '042',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'La Huerta',
            'state_id' => '14',
            'number' =>  '043',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ixtlahuacán de los Membrillos',
            'state_id' => '14',
            'number' =>  '044',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ixtlahuacán del Río',
            'state_id' => '14',
            'number' =>  '045',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jalostotitlán',
            'state_id' => '14',
            'number' =>  '046',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jamay',
            'state_id' => '14',
            'number' =>  '047',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jesús María',
            'state_id' => '14',
            'number' =>  '048',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jilotlán de los Dolores',
            'state_id' => '14',
            'number' =>  '049',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jocotepec',
            'state_id' => '14',
            'number' =>  '050',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Juanacatlán',
            'state_id' => '14',
            'number' =>  '051',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Juchitlán',
            'state_id' => '14',
            'number' =>  '052',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Lagos de Moreno',
            'state_id' => '14',
            'number' =>  '053',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'El Limón',
            'state_id' => '14',
            'number' =>  '054',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Magdalena',
            'state_id' => '14',
            'number' =>  '055',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María del Oro',
            'state_id' => '14',
            'number' =>  '056',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'La Manzanilla de la Paz',
            'state_id' => '14',
            'number' =>  '057',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mascota',
            'state_id' => '14',
            'number' =>  '058',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mazamitla',
            'state_id' => '14',
            'number' =>  '059',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mexticacán',
            'state_id' => '14',
            'number' =>  '060',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mezquitic',
            'state_id' => '14',
            'number' =>  '061',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mixtlán',
            'state_id' => '14',
            'number' =>  '062',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ocotlán',
            'state_id' => '14',
            'number' =>  '063',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ojuelos de Jalisco',
            'state_id' => '14',
            'number' =>  '064',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Pihuamo',
            'state_id' => '14',
            'number' =>  '065',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Poncitlán',
            'state_id' => '14',
            'number' =>  '066',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Puerto Vallarta',
            'state_id' => '14',
            'number' =>  '067',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villa Purificación',
            'state_id' => '14',
            'number' =>  '068',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Quitupan',
            'state_id' => '14',
            'number' =>  '069',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'El Salto',
            'state_id' => '14',
            'number' =>  '070',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Cristóbal de la Barranca',
            'state_id' => '14',
            'number' =>  '071',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Diego de Alejandría',
            'state_id' => '14',
            'number' =>  '072',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan de los Lagos',
            'state_id' => '14',
            'number' =>  '073',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Julián',
            'state_id' => '14',
            'number' =>  '074',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Marcos',
            'state_id' => '14',
            'number' =>  '075',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Martín de Bolaños',
            'state_id' => '14',
            'number' =>  '076',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Martín Hidalgo',
            'state_id' => '14',
            'number' =>  '077',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Miguel el Alto',
            'state_id' => '14',
            'number' =>  '078',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Gómez Farías',
            'state_id' => '14',
            'number' =>  '079',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Sebastián del Oeste',
            'state_id' => '14',
            'number' =>  '080',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María de los Ángeles',
            'state_id' => '14',
            'number' =>  '081',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Sayula',
            'state_id' => '14',
            'number' =>  '082',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tala',
            'state_id' => '14',
            'number' =>  '083',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Talpa de Allende',
            'state_id' => '14',
            'number' =>  '084',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tamazula de Gordiano',
            'state_id' => '14',
            'number' =>  '085',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tapalpa',
            'state_id' => '14',
            'number' =>  '086',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tecalitlán',
            'state_id' => '14',
            'number' =>  '087',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tecolotlán',
            'state_id' => '14',
            'number' =>  '088',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Techaluta de Montenegro',
            'state_id' => '14',
            'number' =>  '089',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tenamaxtlán',
            'state_id' => '14',
            'number' =>  '090',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Teocaltiche',
            'state_id' => '14',
            'number' =>  '091',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Teocuitatlán de Corona',
            'state_id' => '14',
            'number' =>  '092',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tepatitlán de Morelos',
            'state_id' => '14',
            'number' =>  '093',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tequila',
            'state_id' => '14',
            'number' =>  '094',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Teuchitlán',
            'state_id' => '14',
            'number' =>  '095',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tizapán el Alto',
            'state_id' => '14',
            'number' =>  '096',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlajomulco de Zúñiga',
            'state_id' => '14',
            'number' =>  '097',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Tlaquepaque',
            'state_id' => '14',
            'number' =>  '098',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tolimán',
            'state_id' => '14',
            'number' =>  '099',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tomatlán',
            'state_id' => '14',
            'number' =>  '100',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tonalá',
            'state_id' => '14',
            'number' =>  '101',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tonaya',
            'state_id' => '14',
            'number' =>  '102',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tonila',
            'state_id' => '14',
            'number' =>  '103',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Totatiche',
            'state_id' => '14',
            'number' =>  '104',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tototlán',
            'state_id' => '14',
            'number' =>  '105',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tuxcacuesco',
            'state_id' => '14',
            'number' =>  '106',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tuxcueca',
            'state_id' => '14',
            'number' =>  '107',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tuxpan',
            'state_id' => '14',
            'number' =>  '108',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Unión de San Antonio',
            'state_id' => '14',
            'number' =>  '109',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Unión de Tula',
            'state_id' => '14',
            'number' =>  '110',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Valle de Guadalupe',
            'state_id' => '14',
            'number' =>  '111',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Valle de Juárez',
            'state_id' => '14',
            'number' =>  '112',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Gabriel',
            'state_id' => '14',
            'number' =>  '113',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villa Corona',
            'state_id' => '14',
            'number' =>  '114',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villa Guerrero',
            'state_id' => '14',
            'number' =>  '115',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villa Hidalgo',
            'state_id' => '14',
            'number' =>  '116',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cañadas de Obregón',
            'state_id' => '14',
            'number' =>  '117',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Yahualica de González Gallo',
            'state_id' => '14',
            'number' =>  '118',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zacoalco de Torres',
            'state_id' => '14',
            'number' =>  '119',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zapopan',
            'state_id' => '14',
            'number' =>  '120',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zapotiltic',
            'state_id' => '14',
            'number' =>  '121',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zapotitlán de Vadillo',
            'state_id' => '14',
            'number' =>  '122',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zapotlán del Rey',
            'state_id' => '14',
            'number' =>  '123',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zapotlanejo',
            'state_id' => '14',
            'number' =>  '124',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Ignacio Cerro Gordo',
            'state_id' => '14',
            'number' =>  '125',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Acambay de Ruíz Castañeda',
            'state_id' => '15',
            'number' =>  '001',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Acolman',
            'state_id' => '15',
            'number' =>  '002',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Aculco',
            'state_id' => '15',
            'number' =>  '003',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Almoloya de Alquisiras',
            'state_id' => '15',
            'number' =>  '004',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Almoloya de Juárez',
            'state_id' => '15',
            'number' =>  '005',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Almoloya del Río',
            'state_id' => '15',
            'number' =>  '006',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Amanalco',
            'state_id' => '15',
            'number' =>  '007',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Amatepec',
            'state_id' => '15',
            'number' =>  '008',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Amecameca',
            'state_id' => '15',
            'number' =>  '009',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Apaxco',
            'state_id' => '15',
            'number' =>  '010',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Atenco',
            'state_id' => '15',
            'number' =>  '011',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Atizapán',
            'state_id' => '15',
            'number' =>  '012',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Atizapán de Zaragoza',
            'state_id' => '15',
            'number' =>  '013',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Atlacomulco',
            'state_id' => '15',
            'number' =>  '014',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Atlautla',
            'state_id' => '15',
            'number' =>  '015',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Axapusco',
            'state_id' => '15',
            'number' =>  '016',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ayapango',
            'state_id' => '15',
            'number' =>  '017',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Calimaya',
            'state_id' => '15',
            'number' =>  '018',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Capulhuac',
            'state_id' => '15',
            'number' =>  '019',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Coacalco de Berriozábal',
            'state_id' => '15',
            'number' =>  '020',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Coatepec Harinas',
            'state_id' => '15',
            'number' =>  '021',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cocotitlán',
            'state_id' => '15',
            'number' =>  '022',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Coyotepec',
            'state_id' => '15',
            'number' =>  '023',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cuautitlán',
            'state_id' => '15',
            'number' =>  '024',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chalco',
            'state_id' => '15',
            'number' =>  '025',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chapa de Mota',
            'state_id' => '15',
            'number' =>  '026',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chapultepec',
            'state_id' => '15',
            'number' =>  '027',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chiautla',
            'state_id' => '15',
            'number' =>  '028',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chicoloapan',
            'state_id' => '15',
            'number' =>  '029',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chiconcuac',
            'state_id' => '15',
            'number' =>  '030',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chimalhuacán',
            'state_id' => '15',
            'number' =>  '031',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Donato Guerra',
            'state_id' => '15',
            'number' =>  '032',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ecatepec de Morelos',
            'state_id' => '15',
            'number' =>  '033',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ecatzingo',
            'state_id' => '15',
            'number' =>  '034',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huehuetoca',
            'state_id' => '15',
            'number' =>  '035',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Hueypoxtla',
            'state_id' => '15',
            'number' =>  '036',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huixquilucan',
            'state_id' => '15',
            'number' =>  '037',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Isidro Fabela',
            'state_id' => '15',
            'number' =>  '038',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ixtapaluca',
            'state_id' => '15',
            'number' =>  '039',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ixtapan de la Sal',
            'state_id' => '15',
            'number' =>  '040',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ixtapan del Oro',
            'state_id' => '15',
            'number' =>  '041',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ixtlahuaca',
            'state_id' => '15',
            'number' =>  '042',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Xalatlaco',
            'state_id' => '15',
            'number' =>  '043',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jaltenco',
            'state_id' => '15',
            'number' =>  '044',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jilotepec',
            'state_id' => '15',
            'number' =>  '045',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jilotzingo',
            'state_id' => '15',
            'number' =>  '046',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jiquipilco',
            'state_id' => '15',
            'number' =>  '047',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jocotitlán',
            'state_id' => '15',
            'number' =>  '048',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Joquicingo',
            'state_id' => '15',
            'number' =>  '049',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Juchitepec',
            'state_id' => '15',
            'number' =>  '050',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Lerma',
            'state_id' => '15',
            'number' =>  '051',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Malinalco',
            'state_id' => '15',
            'number' =>  '052',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Melchor Ocampo',
            'state_id' => '15',
            'number' =>  '053',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Metepec',
            'state_id' => '15',
            'number' =>  '054',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mexicaltzingo',
            'state_id' => '15',
            'number' =>  '055',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Morelos',
            'state_id' => '15',
            'number' =>  '056',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Naucalpan de Juárez',
            'state_id' => '15',
            'number' =>  '057',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Nezahualcóyotl',
            'state_id' => '15',
            'number' =>  '058',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Nextlalpan',
            'state_id' => '15',
            'number' =>  '059',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Nicolás Romero',
            'state_id' => '15',
            'number' =>  '060',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Nopaltepec',
            'state_id' => '15',
            'number' =>  '061',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ocoyoacac',
            'state_id' => '15',
            'number' =>  '062',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ocuilan',
            'state_id' => '15',
            'number' =>  '063',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'El Oro',
            'state_id' => '15',
            'number' =>  '064',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Otumba',
            'state_id' => '15',
            'number' =>  '065',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Otzoloapan',
            'state_id' => '15',
            'number' =>  '066',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Otzolotepec',
            'state_id' => '15',
            'number' =>  '067',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ozumba',
            'state_id' => '15',
            'number' =>  '068',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Papalotla',
            'state_id' => '15',
            'number' =>  '069',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'La Paz',
            'state_id' => '15',
            'number' =>  '070',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Polotitlán',
            'state_id' => '15',
            'number' =>  '071',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Rayón',
            'state_id' => '15',
            'number' =>  '072',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Antonio la Isla',
            'state_id' => '15',
            'number' =>  '073',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Felipe del Progreso',
            'state_id' => '15',
            'number' =>  '074',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Martín de las Pirámides',
            'state_id' => '15',
            'number' =>  '075',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Mateo Atenco',
            'state_id' => '15',
            'number' =>  '076',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Simón de Guerrero',
            'state_id' => '15',
            'number' =>  '077',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santo Tomás',
            'state_id' => '15',
            'number' =>  '078',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Soyaniquilpan de Juárez',
            'state_id' => '15',
            'number' =>  '079',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Sultepec',
            'state_id' => '15',
            'number' =>  '080',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tecámac',
            'state_id' => '15',
            'number' =>  '081',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tejupilco',
            'state_id' => '15',
            'number' =>  '082',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Temamatla',
            'state_id' => '15',
            'number' =>  '083',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Temascalapa',
            'state_id' => '15',
            'number' =>  '084',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Temascalcingo',
            'state_id' => '15',
            'number' =>  '085',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Temascaltepec',
            'state_id' => '15',
            'number' =>  '086',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Temoaya',
            'state_id' => '15',
            'number' =>  '087',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tenancingo',
            'state_id' => '15',
            'number' =>  '088',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tenango del Aire',
            'state_id' => '15',
            'number' =>  '089',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tenango del Valle',
            'state_id' => '15',
            'number' =>  '090',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Teoloyucan',
            'state_id' => '15',
            'number' =>  '091',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Teotihuacán',
            'state_id' => '15',
            'number' =>  '092',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tepetlaoxtoc',
            'state_id' => '15',
            'number' =>  '093',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tepetlixpa',
            'state_id' => '15',
            'number' =>  '094',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tepotzotlán',
            'state_id' => '15',
            'number' =>  '095',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tequixquiac',
            'state_id' => '15',
            'number' =>  '096',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Texcaltitlán',
            'state_id' => '15',
            'number' =>  '097',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Texcalyacac',
            'state_id' => '15',
            'number' =>  '098',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Texcoco',
            'state_id' => '15',
            'number' =>  '099',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tezoyuca',
            'state_id' => '15',
            'number' =>  '100',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tianguistenco',
            'state_id' => '15',
            'number' =>  '101',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Timilpan',
            'state_id' => '15',
            'number' =>  '102',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlalmanalco',
            'state_id' => '15',
            'number' =>  '103',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlalnepantla de Baz',
            'state_id' => '15',
            'number' =>  '104',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlatlaya',
            'state_id' => '15',
            'number' =>  '105',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Toluca',
            'state_id' => '15',
            'number' =>  '106',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tonatico',
            'state_id' => '15',
            'number' =>  '107',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tultepec',
            'state_id' => '15',
            'number' =>  '108',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tultitlán',
            'state_id' => '15',
            'number' =>  '109',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Valle de Bravo',
            'state_id' => '15',
            'number' =>  '110',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villa de Allende',
            'state_id' => '15',
            'number' =>  '111',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villa del Carbón',
            'state_id' => '15',
            'number' =>  '112',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villa Guerrero',
            'state_id' => '15',
            'number' =>  '113',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villa Victoria',
            'state_id' => '15',
            'number' =>  '114',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Xonacatlán',
            'state_id' => '15',
            'number' =>  '115',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zacazonapan',
            'state_id' => '15',
            'number' =>  '116',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zacualpan',
            'state_id' => '15',
            'number' =>  '117',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zinacantepec',
            'state_id' => '15',
            'number' =>  '118',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zumpahuacán',
            'state_id' => '15',
            'number' =>  '119',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zumpango',
            'state_id' => '15',
            'number' =>  '120',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cuautitlán Izcalli',
            'state_id' => '15',
            'number' =>  '121',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Valle de Chalco Solidaridad',
            'state_id' => '15',
            'number' =>  '122',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Luvianos',
            'state_id' => '15',
            'number' =>  '123',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San José del Rincón',
            'state_id' => '15',
            'number' =>  '124',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tonanitla',
            'state_id' => '15',
            'number' =>  '125',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Acuitzio',
            'state_id' => '16',
            'number' =>  '001',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Aguililla',
            'state_id' => '16',
            'number' =>  '002',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Álvaro Obregón',
            'state_id' => '16',
            'number' =>  '003',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Angamacutiro',
            'state_id' => '16',
            'number' =>  '004',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Angangueo',
            'state_id' => '16',
            'number' =>  '005',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Apatzingán',
            'state_id' => '16',
            'number' =>  '006',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Aporo',
            'state_id' => '16',
            'number' =>  '007',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Aquila',
            'state_id' => '16',
            'number' =>  '008',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ario',
            'state_id' => '16',
            'number' =>  '009',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Arteaga',
            'state_id' => '16',
            'number' =>  '010',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Briseñas',
            'state_id' => '16',
            'number' =>  '011',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Buenavista',
            'state_id' => '16',
            'number' =>  '012',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Carácuaro',
            'state_id' => '16',
            'number' =>  '013',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Coahuayana',
            'state_id' => '16',
            'number' =>  '014',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Coalcomán de Vázquez Pallares',
            'state_id' => '16',
            'number' =>  '015',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Coeneo',
            'state_id' => '16',
            'number' =>  '016',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Contepec',
            'state_id' => '16',
            'number' =>  '017',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Copándaro',
            'state_id' => '16',
            'number' =>  '018',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cotija',
            'state_id' => '16',
            'number' =>  '019',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cuitzeo',
            'state_id' => '16',
            'number' =>  '020',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Charapan',
            'state_id' => '16',
            'number' =>  '021',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Charo',
            'state_id' => '16',
            'number' =>  '022',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chavinda',
            'state_id' => '16',
            'number' =>  '023',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cherán',
            'state_id' => '16',
            'number' =>  '024',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chilchota',
            'state_id' => '16',
            'number' =>  '025',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chinicuila',
            'state_id' => '16',
            'number' =>  '026',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chucándiro',
            'state_id' => '16',
            'number' =>  '027',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Churintzio',
            'state_id' => '16',
            'number' =>  '028',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Churumuco',
            'state_id' => '16',
            'number' =>  '029',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ecuandureo',
            'state_id' => '16',
            'number' =>  '030',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Epitacio Huerta',
            'state_id' => '16',
            'number' =>  '031',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Erongarícuaro',
            'state_id' => '16',
            'number' =>  '032',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Gabriel Zamora',
            'state_id' => '16',
            'number' =>  '033',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Hidalgo',
            'state_id' => '16',
            'number' =>  '034',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'La Huacana',
            'state_id' => '16',
            'number' =>  '035',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huandacareo',
            'state_id' => '16',
            'number' =>  '036',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huaniqueo',
            'state_id' => '16',
            'number' =>  '037',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huetamo',
            'state_id' => '16',
            'number' =>  '038',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huiramba',
            'state_id' => '16',
            'number' =>  '039',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Indaparapeo',
            'state_id' => '16',
            'number' =>  '040',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Irimbo',
            'state_id' => '16',
            'number' =>  '041',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ixtlán',
            'state_id' => '16',
            'number' =>  '042',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jacona',
            'state_id' => '16',
            'number' =>  '043',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jiménez',
            'state_id' => '16',
            'number' =>  '044',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jiquilpan',
            'state_id' => '16',
            'number' =>  '045',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Juárez',
            'state_id' => '16',
            'number' =>  '046',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jungapeo',
            'state_id' => '16',
            'number' =>  '047',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Lagunillas',
            'state_id' => '16',
            'number' =>  '048',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Madero',
            'state_id' => '16',
            'number' =>  '049',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Maravatío',
            'state_id' => '16',
            'number' =>  '050',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Marcos Castellanos',
            'state_id' => '16',
            'number' =>  '051',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Lázaro Cárdenas',
            'state_id' => '16',
            'number' =>  '052',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Morelia',
            'state_id' => '16',
            'number' =>  '053',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Morelos',
            'state_id' => '16',
            'number' =>  '054',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Múgica',
            'state_id' => '16',
            'number' =>  '055',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Nahuatzen',
            'state_id' => '16',
            'number' =>  '056',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Nocupétaro',
            'state_id' => '16',
            'number' =>  '057',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Nuevo Parangaricutiro',
            'state_id' => '16',
            'number' =>  '058',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Nuevo Urecho',
            'state_id' => '16',
            'number' =>  '059',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Numarán',
            'state_id' => '16',
            'number' =>  '060',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ocampo',
            'state_id' => '16',
            'number' =>  '061',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Pajacuarán',
            'state_id' => '16',
            'number' =>  '062',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Panindícuaro',
            'state_id' => '16',
            'number' =>  '063',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Parácuaro',
            'state_id' => '16',
            'number' =>  '064',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Paracho',
            'state_id' => '16',
            'number' =>  '065',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Pátzcuaro',
            'state_id' => '16',
            'number' =>  '066',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Penjamillo',
            'state_id' => '16',
            'number' =>  '067',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Peribán',
            'state_id' => '16',
            'number' =>  '068',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'La Piedad',
            'state_id' => '16',
            'number' =>  '069',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Purépero',
            'state_id' => '16',
            'number' =>  '070',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Puruándiro',
            'state_id' => '16',
            'number' =>  '071',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Queréndaro',
            'state_id' => '16',
            'number' =>  '072',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Quiroga',
            'state_id' => '16',
            'number' =>  '073',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cojumatlán de Régules',
            'state_id' => '16',
            'number' =>  '074',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Los Reyes',
            'state_id' => '16',
            'number' =>  '075',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Sahuayo',
            'state_id' => '16',
            'number' =>  '076',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Lucas',
            'state_id' => '16',
            'number' =>  '077',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Ana Maya',
            'state_id' => '16',
            'number' =>  '078',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Salvador Escalante',
            'state_id' => '16',
            'number' =>  '079',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Senguio',
            'state_id' => '16',
            'number' =>  '080',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Susupuato',
            'state_id' => '16',
            'number' =>  '081',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tacámbaro',
            'state_id' => '16',
            'number' =>  '082',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tancítaro',
            'state_id' => '16',
            'number' =>  '083',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tangamandapio',
            'state_id' => '16',
            'number' =>  '084',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tangancícuaro',
            'state_id' => '16',
            'number' =>  '085',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tanhuato',
            'state_id' => '16',
            'number' =>  '086',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Taretan',
            'state_id' => '16',
            'number' =>  '087',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tarímbaro',
            'state_id' => '16',
            'number' =>  '088',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tepalcatepec',
            'state_id' => '16',
            'number' =>  '089',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tingambato',
            'state_id' => '16',
            'number' =>  '090',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tingüindín',
            'state_id' => '16',
            'number' =>  '091',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tiquicheo de Nicolás Romero',
            'state_id' => '16',
            'number' =>  '092',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlalpujahua',
            'state_id' => '16',
            'number' =>  '093',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlazazalca',
            'state_id' => '16',
            'number' =>  '094',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tocumbo',
            'state_id' => '16',
            'number' =>  '095',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tumbiscatío',
            'state_id' => '16',
            'number' =>  '096',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Turicato',
            'state_id' => '16',
            'number' =>  '097',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tuxpan',
            'state_id' => '16',
            'number' =>  '098',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tuzantla',
            'state_id' => '16',
            'number' =>  '099',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tzintzuntzan',
            'state_id' => '16',
            'number' =>  '100',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tzitzio',
            'state_id' => '16',
            'number' =>  '101',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Uruapan',
            'state_id' => '16',
            'number' =>  '102',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Venustiano Carranza',
            'state_id' => '16',
            'number' =>  '103',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villamar',
            'state_id' => '16',
            'number' =>  '104',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Vista Hermosa',
            'state_id' => '16',
            'number' =>  '105',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Yurécuaro',
            'state_id' => '16',
            'number' =>  '106',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zacapu',
            'state_id' => '16',
            'number' =>  '107',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zamora',
            'state_id' => '16',
            'number' =>  '108',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zináparo',
            'state_id' => '16',
            'number' =>  '109',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zinapécuaro',
            'state_id' => '16',
            'number' =>  '110',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ziracuaretiro',
            'state_id' => '16',
            'number' =>  '111',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zitácuaro',
            'state_id' => '16',
            'number' =>  '112',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'José Sixto Verduzco',
            'state_id' => '16',
            'number' =>  '113',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Amacuzac',
            'state_id' => '17',
            'number' =>  '001',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Atlatlahucan',
            'state_id' => '17',
            'number' =>  '002',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Axochiapan',
            'state_id' => '17',
            'number' =>  '003',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ayala',
            'state_id' => '17',
            'number' =>  '004',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Coatlán del Río',
            'state_id' => '17',
            'number' =>  '005',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cuautla',
            'state_id' => '17',
            'number' =>  '006',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cuernavaca',
            'state_id' => '17',
            'number' =>  '007',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Emiliano Zapata',
            'state_id' => '17',
            'number' =>  '008',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huitzilac',
            'state_id' => '17',
            'number' =>  '009',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jantetelco',
            'state_id' => '17',
            'number' =>  '010',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jiutepec',
            'state_id' => '17',
            'number' =>  '011',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jojutla',
            'state_id' => '17',
            'number' =>  '012',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jonacatepec',
            'state_id' => '17',
            'number' =>  '013',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mazatepec',
            'state_id' => '17',
            'number' =>  '014',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Miacatlán',
            'state_id' => '17',
            'number' =>  '015',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ocuituco',
            'state_id' => '17',
            'number' =>  '016',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Puente de Ixtla',
            'state_id' => '17',
            'number' =>  '017',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Temixco',
            'state_id' => '17',
            'number' =>  '018',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tepalcingo',
            'state_id' => '17',
            'number' =>  '019',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tepoztlán',
            'state_id' => '17',
            'number' =>  '020',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tetecala',
            'state_id' => '17',
            'number' =>  '021',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tetela del Volcán',
            'state_id' => '17',
            'number' =>  '022',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlalnepantla',
            'state_id' => '17',
            'number' =>  '023',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlaltizapán de Zapata',
            'state_id' => '17',
            'number' =>  '024',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlaquiltenango',
            'state_id' => '17',
            'number' =>  '025',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlayacapan',
            'state_id' => '17',
            'number' =>  '026',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Totolapan',
            'state_id' => '17',
            'number' =>  '027',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Xochitepec',
            'state_id' => '17',
            'number' =>  '028',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Yautepec',
            'state_id' => '17',
            'number' =>  '029',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Yecapixtla',
            'state_id' => '17',
            'number' =>  '030',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zacatepec',
            'state_id' => '17',
            'number' =>  '031',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zacualpan de Amilpas',
            'state_id' => '17',
            'number' =>  '032',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Temoac',
            'state_id' => '17',
            'number' =>  '033',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Acaponeta',
            'state_id' => '18',
            'number' =>  '001',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ahuacatlán',
            'state_id' => '18',
            'number' =>  '002',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Amatlán de Cañas',
            'state_id' => '18',
            'number' =>  '003',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Compostela',
            'state_id' => '18',
            'number' =>  '004',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huajicori',
            'state_id' => '18',
            'number' =>  '005',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ixtlán del Río',
            'state_id' => '18',
            'number' =>  '006',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jala',
            'state_id' => '18',
            'number' =>  '007',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Xalisco',
            'state_id' => '18',
            'number' =>  '008',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Del Nayar',
            'state_id' => '18',
            'number' =>  '009',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Rosamorada',
            'state_id' => '18',
            'number' =>  '010',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ruíz',
            'state_id' => '18',
            'number' =>  '011',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Blas',
            'state_id' => '18',
            'number' =>  '012',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Lagunillas',
            'state_id' => '18',
            'number' =>  '013',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María del Oro',
            'state_id' => '18',
            'number' =>  '014',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Ixcuintla',
            'state_id' => '18',
            'number' =>  '015',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tecuala',
            'state_id' => '18',
            'number' =>  '016',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tepic',
            'state_id' => '18',
            'number' =>  '017',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tuxpan',
            'state_id' => '18',
            'number' =>  '018',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'La Yesca',
            'state_id' => '18',
            'number' =>  '019',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Bahía de Banderas',
            'state_id' => '18',
            'number' =>  '020',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Abasolo',
            'state_id' => '19',
            'number' =>  '001',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Agualeguas',
            'state_id' => '19',
            'number' =>  '002',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Los Aldamas',
            'state_id' => '19',
            'number' =>  '003',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Allende',
            'state_id' => '19',
            'number' =>  '004',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Anáhuac',
            'state_id' => '19',
            'number' =>  '005',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Apodaca',
            'state_id' => '19',
            'number' =>  '006',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Aramberri',
            'state_id' => '19',
            'number' =>  '007',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Bustamante',
            'state_id' => '19',
            'number' =>  '008',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cadereyta Jiménez',
            'state_id' => '19',
            'number' =>  '009',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'El Carmen',
            'state_id' => '19',
            'number' =>  '010',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cerralvo',
            'state_id' => '19',
            'number' =>  '011',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ciénega de Flores',
            'state_id' => '19',
            'number' =>  '012',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'China',
            'state_id' => '19',
            'number' =>  '013',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Doctor Arroyo',
            'state_id' => '19',
            'number' =>  '014',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Doctor Coss',
            'state_id' => '19',
            'number' =>  '015',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Doctor González',
            'state_id' => '19',
            'number' =>  '016',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Galeana',
            'state_id' => '19',
            'number' =>  '017',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'García',
            'state_id' => '19',
            'number' =>  '018',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Garza García',
            'state_id' => '19',
            'number' =>  '019',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'General Bravo',
            'state_id' => '19',
            'number' =>  '020',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'General Escobedo',
            'state_id' => '19',
            'number' =>  '021',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'General Terán',
            'state_id' => '19',
            'number' =>  '022',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'General Treviño',
            'state_id' => '19',
            'number' =>  '023',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'General Zaragoza',
            'state_id' => '19',
            'number' =>  '024',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'General Zuazua',
            'state_id' => '19',
            'number' =>  '025',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Guadalupe',
            'state_id' => '19',
            'number' =>  '026',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Los Herreras',
            'state_id' => '19',
            'number' =>  '027',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Higueras',
            'state_id' => '19',
            'number' =>  '028',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Hualahuises',
            'state_id' => '19',
            'number' =>  '029',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Iturbide',
            'state_id' => '19',
            'number' =>  '030',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Juárez',
            'state_id' => '19',
            'number' =>  '031',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Lampazos de Naranjo',
            'state_id' => '19',
            'number' =>  '032',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Linares',
            'state_id' => '19',
            'number' =>  '033',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Marín',
            'state_id' => '19',
            'number' =>  '034',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Melchor Ocampo',
            'state_id' => '19',
            'number' =>  '035',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mier y Noriega',
            'state_id' => '19',
            'number' =>  '036',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mina',
            'state_id' => '19',
            'number' =>  '037',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Montemorelos',
            'state_id' => '19',
            'number' =>  '038',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Monterrey',
            'state_id' => '19',
            'number' =>  '039',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Parás',
            'state_id' => '19',
            'number' =>  '040',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Pesquería',
            'state_id' => '19',
            'number' =>  '041',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Los Ramones',
            'state_id' => '19',
            'number' =>  '042',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Rayones',
            'state_id' => '19',
            'number' =>  '043',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Sabinas Hidalgo',
            'state_id' => '19',
            'number' =>  '044',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Salinas Victoria',
            'state_id' => '19',
            'number' =>  '045',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Nicolás de los Garza',
            'state_id' => '19',
            'number' =>  '046',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Hidalgo',
            'state_id' => '19',
            'number' =>  '047',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Catarina',
            'state_id' => '19',
            'number' =>  '048',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago',
            'state_id' => '19',
            'number' =>  '049',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Vallecillo',
            'state_id' => '19',
            'number' =>  '050',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villaldama',
            'state_id' => '19',
            'number' =>  '051',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Abejones',
            'state_id' => '20',
            'number' =>  '001',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Acatlán de Pérez Figueroa',
            'state_id' => '20',
            'number' =>  '002',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Asunción Cacalotepec',
            'state_id' => '20',
            'number' =>  '003',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Asunción Cuyotepeji',
            'state_id' => '20',
            'number' =>  '004',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Asunción Ixtaltepec',
            'state_id' => '20',
            'number' =>  '005',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Asunción Nochixtlán',
            'state_id' => '20',
            'number' =>  '006',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Asunción Ocotlán',
            'state_id' => '20',
            'number' =>  '007',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Asunción Tlacolulita',
            'state_id' => '20',
            'number' =>  '008',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ayotzintepec',
            'state_id' => '20',
            'number' =>  '009',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'El Barrio de la Soledad',
            'state_id' => '20',
            'number' =>  '010',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Calihualá',
            'state_id' => '20',
            'number' =>  '011',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Candelaria Loxicha',
            'state_id' => '20',
            'number' =>  '012',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ciénega de Zimatlán',
            'state_id' => '20',
            'number' =>  '013',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ciudad Ixtepec',
            'state_id' => '20',
            'number' =>  '014',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Coatecas Altas',
            'state_id' => '20',
            'number' =>  '015',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Coicoyán de las Flores',
            'state_id' => '20',
            'number' =>  '016',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'La Compañía',
            'state_id' => '20',
            'number' =>  '017',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Concepción Buenavista',
            'state_id' => '20',
            'number' =>  '018',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Concepción Pápalo',
            'state_id' => '20',
            'number' =>  '019',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Constancia del Rosario',
            'state_id' => '20',
            'number' =>  '020',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cosolapa',
            'state_id' => '20',
            'number' =>  '021',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cosoltepec',
            'state_id' => '20',
            'number' =>  '022',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cuilápam de Guerrero',
            'state_id' => '20',
            'number' =>  '023',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cuyamecalco Villa de Zaragoza',
            'state_id' => '20',
            'number' =>  '024',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chahuites',
            'state_id' => '20',
            'number' =>  '025',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chalcatongo de Hidalgo',
            'state_id' => '20',
            'number' =>  '026',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chiquihuitlán de Benito Juárez',
            'state_id' => '20',
            'number' =>  '027',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Heroica Ciudad de Ejutla de Crespo',
            'state_id' => '20',
            'number' =>  '028',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Eloxochitlán de Flores Magón',
            'state_id' => '20',
            'number' =>  '029',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'El Espinal',
            'state_id' => '20',
            'number' =>  '030',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tamazulápam del Espíritu Santo',
            'state_id' => '20',
            'number' =>  '031',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Fresnillo de Trujano',
            'state_id' => '20',
            'number' =>  '032',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Guadalupe Etla',
            'state_id' => '20',
            'number' =>  '033',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Guadalupe de Ramírez',
            'state_id' => '20',
            'number' =>  '034',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Guelatao de Juárez',
            'state_id' => '20',
            'number' =>  '035',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Guevea de Humboldt',
            'state_id' => '20',
            'number' =>  '036',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mesones Hidalgo',
            'state_id' => '20',
            'number' =>  '037',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villa Hidalgo',
            'state_id' => '20',
            'number' =>  '038',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Heroica Ciudad de Huajuapan de León',
            'state_id' => '20',
            'number' =>  '039',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huautepec',
            'state_id' => '20',
            'number' =>  '040',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huautla de Jiménez',
            'state_id' => '20',
            'number' =>  '041',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ixtlán de Juárez',
            'state_id' => '20',
            'number' =>  '042',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Heroica Ciudad de Juchitán de Zaragoza',
            'state_id' => '20',
            'number' =>  '043',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Loma Bonita',
            'state_id' => '20',
            'number' =>  '044',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Magdalena Apasco',
            'state_id' => '20',
            'number' =>  '045',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Magdalena Jaltepec',
            'state_id' => '20',
            'number' =>  '046',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Magdalena Jicotlán',
            'state_id' => '20',
            'number' =>  '047',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Magdalena Mixtepec',
            'state_id' => '20',
            'number' =>  '048',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Magdalena Ocotlán',
            'state_id' => '20',
            'number' =>  '049',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Magdalena Peñasco',
            'state_id' => '20',
            'number' =>  '050',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Magdalena Teitipac',
            'state_id' => '20',
            'number' =>  '051',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Magdalena Tequisistlán',
            'state_id' => '20',
            'number' =>  '052',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Magdalena Tlacotepec',
            'state_id' => '20',
            'number' =>  '053',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Magdalena Zahuatlán',
            'state_id' => '20',
            'number' =>  '054',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mariscala de Juárez',
            'state_id' => '20',
            'number' =>  '055',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mártires de Tacubaya',
            'state_id' => '20',
            'number' =>  '056',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Matías Romero Avendaño',
            'state_id' => '20',
            'number' =>  '057',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mazatlán Villa de Flores',
            'state_id' => '20',
            'number' =>  '058',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Miahuatlán de Porfirio Díaz',
            'state_id' => '20',
            'number' =>  '059',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mixistlán de la Reforma',
            'state_id' => '20',
            'number' =>  '060',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Monjas',
            'state_id' => '20',
            'number' =>  '061',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Natividad',
            'state_id' => '20',
            'number' =>  '062',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Nazareno Etla',
            'state_id' => '20',
            'number' =>  '063',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Nejapa de Madero',
            'state_id' => '20',
            'number' =>  '064',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ixpantepec Nieves',
            'state_id' => '20',
            'number' =>  '065',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Niltepec',
            'state_id' => '20',
            'number' =>  '066',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Oaxaca de Juárez',
            'state_id' => '20',
            'number' =>  '067',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ocotlán de Morelos',
            'state_id' => '20',
            'number' =>  '068',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'La Pe',
            'state_id' => '20',
            'number' =>  '069',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Pinotepa de Don Luis',
            'state_id' => '20',
            'number' =>  '070',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Pluma Hidalgo',
            'state_id' => '20',
            'number' =>  '071',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San José del Progreso',
            'state_id' => '20',
            'number' =>  '072',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Putla Villa de Guerrero',
            'state_id' => '20',
            'number' =>  '073',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Catarina Quioquitani',
            'state_id' => '20',
            'number' =>  '074',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Reforma de Pineda',
            'state_id' => '20',
            'number' =>  '075',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'La Reforma',
            'state_id' => '20',
            'number' =>  '076',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Reyes Etla',
            'state_id' => '20',
            'number' =>  '077',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Rojas de Cuauhtémoc',
            'state_id' => '20',
            'number' =>  '078',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Salina Cruz',
            'state_id' => '20',
            'number' =>  '079',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Agustín Amatengo',
            'state_id' => '20',
            'number' =>  '080',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Agustín Atenango',
            'state_id' => '20',
            'number' =>  '081',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Agustín Chayuco',
            'state_id' => '20',
            'number' =>  '082',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Agustín de las Juntas',
            'state_id' => '20',
            'number' =>  '083',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Agustín Etla',
            'state_id' => '20',
            'number' =>  '084',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Agustín Loxicha',
            'state_id' => '20',
            'number' =>  '085',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Agustín Tlacotepec',
            'state_id' => '20',
            'number' =>  '086',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Agustín Yatareni',
            'state_id' => '20',
            'number' =>  '087',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Andrés Cabecera Nueva',
            'state_id' => '20',
            'number' =>  '088',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Andrés Dinicuiti',
            'state_id' => '20',
            'number' =>  '089',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Andrés Huaxpaltepec',
            'state_id' => '20',
            'number' =>  '090',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Andrés Huayápam',
            'state_id' => '20',
            'number' =>  '091',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Andrés Ixtlahuaca',
            'state_id' => '20',
            'number' =>  '092',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Andrés Lagunas',
            'state_id' => '20',
            'number' =>  '093',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Andrés Nuxiño',
            'state_id' => '20',
            'number' =>  '094',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Andrés Paxtlán',
            'state_id' => '20',
            'number' =>  '095',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Andrés Sinaxtla',
            'state_id' => '20',
            'number' =>  '096',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Andrés Solaga',
            'state_id' => '20',
            'number' =>  '097',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Andrés Teotilálpam',
            'state_id' => '20',
            'number' =>  '098',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Andrés Tepetlapa',
            'state_id' => '20',
            'number' =>  '099',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Andrés Yaá',
            'state_id' => '20',
            'number' =>  '100',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Andrés Zabache',
            'state_id' => '20',
            'number' =>  '101',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Andrés Zautla',
            'state_id' => '20',
            'number' =>  '102',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Antonino Castillo Velasco',
            'state_id' => '20',
            'number' =>  '103',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Antonino el Alto',
            'state_id' => '20',
            'number' =>  '104',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Antonino Monte Verde',
            'state_id' => '20',
            'number' =>  '105',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Antonio Acutla',
            'state_id' => '20',
            'number' =>  '106',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Antonio de la Cal',
            'state_id' => '20',
            'number' =>  '107',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Antonio Huitepec',
            'state_id' => '20',
            'number' =>  '108',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Antonio Nanahuatípam',
            'state_id' => '20',
            'number' =>  '109',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Antonio Sinicahua',
            'state_id' => '20',
            'number' =>  '110',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Antonio Tepetlapa',
            'state_id' => '20',
            'number' =>  '111',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Baltazar Chichicápam',
            'state_id' => '20',
            'number' =>  '112',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Baltazar Loxicha',
            'state_id' => '20',
            'number' =>  '113',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Baltazar Yatzachi el Bajo',
            'state_id' => '20',
            'number' =>  '114',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Bartolo Coyotepec',
            'state_id' => '20',
            'number' =>  '115',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Bartolomé Ayautla',
            'state_id' => '20',
            'number' =>  '116',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Bartolomé Loxicha',
            'state_id' => '20',
            'number' =>  '117',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Bartolomé Quialana',
            'state_id' => '20',
            'number' =>  '118',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Bartolomé Yucuañe',
            'state_id' => '20',
            'number' =>  '119',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Bartolomé Zoogocho',
            'state_id' => '20',
            'number' =>  '120',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Bartolo Soyaltepec',
            'state_id' => '20',
            'number' =>  '121',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Bartolo Yautepec',
            'state_id' => '20',
            'number' =>  '122',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Bernardo Mixtepec',
            'state_id' => '20',
            'number' =>  '123',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Blas Atempa',
            'state_id' => '20',
            'number' =>  '124',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Carlos Yautepec',
            'state_id' => '20',
            'number' =>  '125',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Cristóbal Amatlán',
            'state_id' => '20',
            'number' =>  '126',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Cristóbal Amoltepec',
            'state_id' => '20',
            'number' =>  '127',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Cristóbal Lachirioag',
            'state_id' => '20',
            'number' =>  '128',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Cristóbal Suchixtlahuaca',
            'state_id' => '20',
            'number' =>  '129',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Dionisio del Mar',
            'state_id' => '20',
            'number' =>  '130',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Dionisio Ocotepec',
            'state_id' => '20',
            'number' =>  '131',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Dionisio Ocotlán',
            'state_id' => '20',
            'number' =>  '132',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Esteban Atatlahuca',
            'state_id' => '20',
            'number' =>  '133',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Felipe Jalapa de Díaz',
            'state_id' => '20',
            'number' =>  '134',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Felipe Tejalápam',
            'state_id' => '20',
            'number' =>  '135',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Felipe Usila',
            'state_id' => '20',
            'number' =>  '136',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Francisco Cahuacuá',
            'state_id' => '20',
            'number' =>  '137',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Francisco Cajonos',
            'state_id' => '20',
            'number' =>  '138',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Francisco Chapulapa',
            'state_id' => '20',
            'number' =>  '139',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Francisco Chindúa',
            'state_id' => '20',
            'number' =>  '140',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Francisco del Mar',
            'state_id' => '20',
            'number' =>  '141',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Francisco Huehuetlán',
            'state_id' => '20',
            'number' =>  '142',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Francisco Ixhuatán',
            'state_id' => '20',
            'number' =>  '143',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Francisco Jaltepetongo',
            'state_id' => '20',
            'number' =>  '144',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Francisco Lachigoló',
            'state_id' => '20',
            'number' =>  '145',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Francisco Logueche',
            'state_id' => '20',
            'number' =>  '146',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Francisco Nuxaño',
            'state_id' => '20',
            'number' =>  '147',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Francisco Ozolotepec',
            'state_id' => '20',
            'number' =>  '148',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Francisco Sola',
            'state_id' => '20',
            'number' =>  '149',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Francisco Telixtlahuaca',
            'state_id' => '20',
            'number' =>  '150',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Francisco Teopan',
            'state_id' => '20',
            'number' =>  '151',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Francisco Tlapancingo',
            'state_id' => '20',
            'number' =>  '152',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Gabriel Mixtepec',
            'state_id' => '20',
            'number' =>  '153',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Ildefonso Amatlán',
            'state_id' => '20',
            'number' =>  '154',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Ildefonso Sola',
            'state_id' => '20',
            'number' =>  '155',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Ildefonso Villa Alta',
            'state_id' => '20',
            'number' =>  '156',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Jacinto Amilpas',
            'state_id' => '20',
            'number' =>  '157',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Jacinto Tlacotepec',
            'state_id' => '20',
            'number' =>  '158',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Jerónimo Coatlán',
            'state_id' => '20',
            'number' =>  '159',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Jerónimo Silacayoapilla',
            'state_id' => '20',
            'number' =>  '160',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Jerónimo Sosola',
            'state_id' => '20',
            'number' =>  '161',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Jerónimo Taviche',
            'state_id' => '20',
            'number' =>  '162',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Jerónimo Tecóatl',
            'state_id' => '20',
            'number' =>  '163',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Jorge Nuchita',
            'state_id' => '20',
            'number' =>  '164',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San José Ayuquila',
            'state_id' => '20',
            'number' =>  '165',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San José Chiltepec',
            'state_id' => '20',
            'number' =>  '166',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San José del Peñasco',
            'state_id' => '20',
            'number' =>  '167',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San José Estancia Grande',
            'state_id' => '20',
            'number' =>  '168',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San José Independencia',
            'state_id' => '20',
            'number' =>  '169',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San José Lachiguiri',
            'state_id' => '20',
            'number' =>  '170',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San José Tenango',
            'state_id' => '20',
            'number' =>  '171',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Achiutla',
            'state_id' => '20',
            'number' =>  '172',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Atepec',
            'state_id' => '20',
            'number' =>  '173',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ánimas Trujano',
            'state_id' => '20',
            'number' =>  '174',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Bautista Atatlahuca',
            'state_id' => '20',
            'number' =>  '175',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Bautista Coixtlahuaca',
            'state_id' => '20',
            'number' =>  '176',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Bautista Cuicatlán',
            'state_id' => '20',
            'number' =>  '177',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Bautista Guelache',
            'state_id' => '20',
            'number' =>  '178',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Bautista Jayacatlán',
            'state_id' => '20',
            'number' =>  '179',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Bautista Lo de Soto',
            'state_id' => '20',
            'number' =>  '180',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Bautista Suchitepec',
            'state_id' => '20',
            'number' =>  '181',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Bautista Tlacoatzintepec',
            'state_id' => '20',
            'number' =>  '182',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Bautista Tlachichilco',
            'state_id' => '20',
            'number' =>  '183',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Bautista Tuxtepec',
            'state_id' => '20',
            'number' =>  '184',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Cacahuatepec',
            'state_id' => '20',
            'number' =>  '185',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Cieneguilla',
            'state_id' => '20',
            'number' =>  '186',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Coatzóspam',
            'state_id' => '20',
            'number' =>  '187',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Colorado',
            'state_id' => '20',
            'number' =>  '188',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Comaltepec',
            'state_id' => '20',
            'number' =>  '189',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Cotzocón',
            'state_id' => '20',
            'number' =>  '190',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Chicomezúchil',
            'state_id' => '20',
            'number' =>  '191',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Chilateca',
            'state_id' => '20',
            'number' =>  '192',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan del Estado',
            'state_id' => '20',
            'number' =>  '193',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan del Río',
            'state_id' => '20',
            'number' =>  '194',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Diuxi',
            'state_id' => '20',
            'number' =>  '195',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Evangelista Analco',
            'state_id' => '20',
            'number' =>  '196',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Guelavía',
            'state_id' => '20',
            'number' =>  '197',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Guichicovi',
            'state_id' => '20',
            'number' =>  '198',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Ihualtepec',
            'state_id' => '20',
            'number' =>  '199',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Juquila Mixes',
            'state_id' => '20',
            'number' =>  '200',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Juquila Vijanos',
            'state_id' => '20',
            'number' =>  '201',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Lachao',
            'state_id' => '20',
            'number' =>  '202',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Lachigalla',
            'state_id' => '20',
            'number' =>  '203',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Lajarcia',
            'state_id' => '20',
            'number' =>  '204',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Lalana',
            'state_id' => '20',
            'number' =>  '205',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan de los Cués',
            'state_id' => '20',
            'number' =>  '206',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Mazatlán',
            'state_id' => '20',
            'number' =>  '207',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Mixtepec',
            'state_id' => '20',
            'number' =>  '208',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Mixtepec',
            'state_id' => '20',
            'number' =>  '209',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Ñumí',
            'state_id' => '20',
            'number' =>  '210',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Ozolotepec',
            'state_id' => '20',
            'number' =>  '211',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Petlapa',
            'state_id' => '20',
            'number' =>  '212',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Quiahije',
            'state_id' => '20',
            'number' =>  '213',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Quiotepec',
            'state_id' => '20',
            'number' =>  '214',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Sayultepec',
            'state_id' => '20',
            'number' =>  '215',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Tabaá',
            'state_id' => '20',
            'number' =>  '216',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Tamazola',
            'state_id' => '20',
            'number' =>  '217',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Teita',
            'state_id' => '20',
            'number' =>  '218',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Teitipac',
            'state_id' => '20',
            'number' =>  '219',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Tepeuxila',
            'state_id' => '20',
            'number' =>  '220',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Teposcolula',
            'state_id' => '20',
            'number' =>  '221',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Yaeé',
            'state_id' => '20',
            'number' =>  '222',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Yatzona',
            'state_id' => '20',
            'number' =>  '223',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Yucuita',
            'state_id' => '20',
            'number' =>  '224',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Lorenzo',
            'state_id' => '20',
            'number' =>  '225',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Lorenzo Albarradas',
            'state_id' => '20',
            'number' =>  '226',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Lorenzo Cacaotepec',
            'state_id' => '20',
            'number' =>  '227',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Lorenzo Cuaunecuiltitla',
            'state_id' => '20',
            'number' =>  '228',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Lorenzo Texmelúcan',
            'state_id' => '20',
            'number' =>  '229',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Lorenzo Victoria',
            'state_id' => '20',
            'number' =>  '230',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Lucas Camotlán',
            'state_id' => '20',
            'number' =>  '231',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Lucas Ojitlán',
            'state_id' => '20',
            'number' =>  '232',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Lucas Quiaviní',
            'state_id' => '20',
            'number' =>  '233',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Lucas Zoquiápam',
            'state_id' => '20',
            'number' =>  '234',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Luis Amatlán',
            'state_id' => '20',
            'number' =>  '235',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Marcial Ozolotepec',
            'state_id' => '20',
            'number' =>  '236',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Marcos Arteaga',
            'state_id' => '20',
            'number' =>  '237',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Martín de los Cansecos',
            'state_id' => '20',
            'number' =>  '238',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Martín Huamelúlpam',
            'state_id' => '20',
            'number' =>  '239',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Martín Itunyoso',
            'state_id' => '20',
            'number' =>  '240',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Martín Lachilá',
            'state_id' => '20',
            'number' =>  '241',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Martín Peras',
            'state_id' => '20',
            'number' =>  '242',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Martín Tilcajete',
            'state_id' => '20',
            'number' =>  '243',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Martín Toxpalan',
            'state_id' => '20',
            'number' =>  '244',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Martín Zacatepec',
            'state_id' => '20',
            'number' =>  '245',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Mateo Cajonos',
            'state_id' => '20',
            'number' =>  '246',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Capulálpam de Méndez',
            'state_id' => '20',
            'number' =>  '247',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Mateo del Mar',
            'state_id' => '20',
            'number' =>  '248',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Mateo Yoloxochitlán',
            'state_id' => '20',
            'number' =>  '249',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Mateo Etlatongo',
            'state_id' => '20',
            'number' =>  '250',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Mateo Nejápam',
            'state_id' => '20',
            'number' =>  '251',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Mateo Peñasco',
            'state_id' => '20',
            'number' =>  '252',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Mateo Piñas',
            'state_id' => '20',
            'number' =>  '253',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Mateo Río Hondo',
            'state_id' => '20',
            'number' =>  '254',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Mateo Sindihui',
            'state_id' => '20',
            'number' =>  '255',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Mateo Tlapiltepec',
            'state_id' => '20',
            'number' =>  '256',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Melchor Betaza',
            'state_id' => '20',
            'number' =>  '257',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Miguel Achiutla',
            'state_id' => '20',
            'number' =>  '258',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Miguel Ahuehuetitlán',
            'state_id' => '20',
            'number' =>  '259',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Miguel Aloápam',
            'state_id' => '20',
            'number' =>  '260',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Miguel Amatitlán',
            'state_id' => '20',
            'number' =>  '261',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Miguel Amatlán',
            'state_id' => '20',
            'number' =>  '262',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Miguel Coatlán',
            'state_id' => '20',
            'number' =>  '263',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Miguel Chicahua',
            'state_id' => '20',
            'number' =>  '264',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Miguel Chimalapa',
            'state_id' => '20',
            'number' =>  '265',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Miguel del Puerto',
            'state_id' => '20',
            'number' =>  '266',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Miguel del Río',
            'state_id' => '20',
            'number' =>  '267',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Miguel Ejutla',
            'state_id' => '20',
            'number' =>  '268',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Miguel el Grande',
            'state_id' => '20',
            'number' =>  '269',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Miguel Huautla',
            'state_id' => '20',
            'number' =>  '270',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Miguel Mixtepec',
            'state_id' => '20',
            'number' =>  '271',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Miguel Panixtlahuaca',
            'state_id' => '20',
            'number' =>  '272',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Miguel Peras',
            'state_id' => '20',
            'number' =>  '273',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Miguel Piedras',
            'state_id' => '20',
            'number' =>  '274',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Miguel Quetzaltepec',
            'state_id' => '20',
            'number' =>  '275',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Miguel Santa Flor',
            'state_id' => '20',
            'number' =>  '276',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villa Sola de Vega',
            'state_id' => '20',
            'number' =>  '277',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Miguel Soyaltepec',
            'state_id' => '20',
            'number' =>  '278',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Miguel Suchixtepec',
            'state_id' => '20',
            'number' =>  '279',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villa Talea de Castro',
            'state_id' => '20',
            'number' =>  '280',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Miguel Tecomatlán',
            'state_id' => '20',
            'number' =>  '281',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Miguel Tenango',
            'state_id' => '20',
            'number' =>  '282',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Miguel Tequixtepec',
            'state_id' => '20',
            'number' =>  '283',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Miguel Tilquiápam',
            'state_id' => '20',
            'number' =>  '284',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Miguel Tlacamama',
            'state_id' => '20',
            'number' =>  '285',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Miguel Tlacotepec',
            'state_id' => '20',
            'number' =>  '286',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Miguel Tulancingo',
            'state_id' => '20',
            'number' =>  '287',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Miguel Yotao',
            'state_id' => '20',
            'number' =>  '288',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Nicolás',
            'state_id' => '20',
            'number' =>  '289',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Nicolás Hidalgo',
            'state_id' => '20',
            'number' =>  '290',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pablo Coatlán',
            'state_id' => '20',
            'number' =>  '291',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pablo Cuatro Venados',
            'state_id' => '20',
            'number' =>  '292',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pablo Etla',
            'state_id' => '20',
            'number' =>  '293',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pablo Huitzo',
            'state_id' => '20',
            'number' =>  '294',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pablo Huixtepec',
            'state_id' => '20',
            'number' =>  '295',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pablo Macuiltianguis',
            'state_id' => '20',
            'number' =>  '296',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pablo Tijaltepec',
            'state_id' => '20',
            'number' =>  '297',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pablo Villa de Mitla',
            'state_id' => '20',
            'number' =>  '298',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pablo Yaganiza',
            'state_id' => '20',
            'number' =>  '299',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Amuzgos',
            'state_id' => '20',
            'number' =>  '300',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Apóstol',
            'state_id' => '20',
            'number' =>  '301',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Atoyac',
            'state_id' => '20',
            'number' =>  '302',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Cajonos',
            'state_id' => '20',
            'number' =>  '303',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Coxcaltepec Cántaros',
            'state_id' => '20',
            'number' =>  '304',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Comitancillo',
            'state_id' => '20',
            'number' =>  '305',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro el Alto',
            'state_id' => '20',
            'number' =>  '306',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Huamelula',
            'state_id' => '20',
            'number' =>  '307',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Huilotepec',
            'state_id' => '20',
            'number' =>  '308',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Ixcatlán',
            'state_id' => '20',
            'number' =>  '309',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Ixtlahuaca',
            'state_id' => '20',
            'number' =>  '310',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Jaltepetongo',
            'state_id' => '20',
            'number' =>  '311',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Jicayán',
            'state_id' => '20',
            'number' =>  '312',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Jocotipac',
            'state_id' => '20',
            'number' =>  '313',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Juchatengo',
            'state_id' => '20',
            'number' =>  '314',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Mártir',
            'state_id' => '20',
            'number' =>  '315',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Mártir Quiechapa',
            'state_id' => '20',
            'number' =>  '316',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Mártir Yucuxaco',
            'state_id' => '20',
            'number' =>  '317',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Mixtepec',
            'state_id' => '20',
            'number' =>  '318',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Mixtepec',
            'state_id' => '20',
            'number' =>  '319',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Molinos',
            'state_id' => '20',
            'number' =>  '320',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Nopala',
            'state_id' => '20',
            'number' =>  '321',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Ocopetatillo',
            'state_id' => '20',
            'number' =>  '322',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Ocotepec',
            'state_id' => '20',
            'number' =>  '323',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Pochutla',
            'state_id' => '20',
            'number' =>  '324',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Quiatoni',
            'state_id' => '20',
            'number' =>  '325',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Sochiápam',
            'state_id' => '20',
            'number' =>  '326',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Tapanatepec',
            'state_id' => '20',
            'number' =>  '327',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Taviche',
            'state_id' => '20',
            'number' =>  '328',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Teozacoalco',
            'state_id' => '20',
            'number' =>  '329',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Teutila',
            'state_id' => '20',
            'number' =>  '330',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Tidaá',
            'state_id' => '20',
            'number' =>  '331',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Topiltepec',
            'state_id' => '20',
            'number' =>  '332',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Totolápam',
            'state_id' => '20',
            'number' =>  '333',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villa de Tututepec de Melchor Ocampo',
            'state_id' => '20',
            'number' =>  '334',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Yaneri',
            'state_id' => '20',
            'number' =>  '335',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Yólox',
            'state_id' => '20',
            'number' =>  '336',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro y San Pablo Ayutla',
            'state_id' => '20',
            'number' =>  '337',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villa de Etla',
            'state_id' => '20',
            'number' =>  '338',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro y San Pablo Teposcolula',
            'state_id' => '20',
            'number' =>  '339',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro y San Pablo Tequixtepec',
            'state_id' => '20',
            'number' =>  '340',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Yucunama',
            'state_id' => '20',
            'number' =>  '341',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Raymundo Jalpan',
            'state_id' => '20',
            'number' =>  '342',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Sebastián Abasolo',
            'state_id' => '20',
            'number' =>  '343',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Sebastián Coatlán',
            'state_id' => '20',
            'number' =>  '344',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Sebastián Ixcapa',
            'state_id' => '20',
            'number' =>  '345',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Sebastián Nicananduta',
            'state_id' => '20',
            'number' =>  '346',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Sebastián Río Hondo',
            'state_id' => '20',
            'number' =>  '347',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Sebastián Tecomaxtlahuaca',
            'state_id' => '20',
            'number' =>  '348',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Sebastián Teitipac',
            'state_id' => '20',
            'number' =>  '349',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Sebastián Tutla',
            'state_id' => '20',
            'number' =>  '350',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Simón Almolongas',
            'state_id' => '20',
            'number' =>  '351',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Simón Zahuatlán',
            'state_id' => '20',
            'number' =>  '352',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Ana',
            'state_id' => '20',
            'number' =>  '353',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Ana Ateixtlahuaca',
            'state_id' => '20',
            'number' =>  '354',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Ana Cuauhtémoc',
            'state_id' => '20',
            'number' =>  '355',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Ana del Valle',
            'state_id' => '20',
            'number' =>  '356',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Ana Tavela',
            'state_id' => '20',
            'number' =>  '357',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Ana Tlapacoyan',
            'state_id' => '20',
            'number' =>  '358',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Ana Yareni',
            'state_id' => '20',
            'number' =>  '359',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Ana Zegache',
            'state_id' => '20',
            'number' =>  '360',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Catalina Quierí',
            'state_id' => '20',
            'number' =>  '361',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Catarina Cuixtla',
            'state_id' => '20',
            'number' =>  '362',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Catarina Ixtepeji',
            'state_id' => '20',
            'number' =>  '363',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Catarina Juquila',
            'state_id' => '20',
            'number' =>  '364',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Catarina Lachatao',
            'state_id' => '20',
            'number' =>  '365',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Catarina Loxicha',
            'state_id' => '20',
            'number' =>  '366',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Catarina Mechoacán',
            'state_id' => '20',
            'number' =>  '367',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Catarina Minas',
            'state_id' => '20',
            'number' =>  '368',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Catarina Quiané',
            'state_id' => '20',
            'number' =>  '369',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Catarina Tayata',
            'state_id' => '20',
            'number' =>  '370',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Catarina Ticuá',
            'state_id' => '20',
            'number' =>  '371',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Catarina Yosonotú',
            'state_id' => '20',
            'number' =>  '372',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Catarina Zapoquila',
            'state_id' => '20',
            'number' =>  '373',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Cruz Acatepec',
            'state_id' => '20',
            'number' =>  '374',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Cruz Amilpas',
            'state_id' => '20',
            'number' =>  '375',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Cruz de Bravo',
            'state_id' => '20',
            'number' =>  '376',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Cruz Itundujia',
            'state_id' => '20',
            'number' =>  '377',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Cruz Mixtepec',
            'state_id' => '20',
            'number' =>  '378',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Cruz Nundaco',
            'state_id' => '20',
            'number' =>  '379',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Cruz Papalutla',
            'state_id' => '20',
            'number' =>  '380',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Cruz Tacache de Mina',
            'state_id' => '20',
            'number' =>  '381',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Cruz Tacahua',
            'state_id' => '20',
            'number' =>  '382',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Cruz Tayata',
            'state_id' => '20',
            'number' =>  '383',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Cruz Xitla',
            'state_id' => '20',
            'number' =>  '384',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Cruz Xoxocotlán',
            'state_id' => '20',
            'number' =>  '385',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Cruz Zenzontepec',
            'state_id' => '20',
            'number' =>  '386',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Gertrudis',
            'state_id' => '20',
            'number' =>  '387',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Inés del Monte',
            'state_id' => '20',
            'number' =>  '388',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Inés Yatzeche',
            'state_id' => '20',
            'number' =>  '389',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Lucía del Camino',
            'state_id' => '20',
            'number' =>  '390',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Lucía Miahuatlán',
            'state_id' => '20',
            'number' =>  '391',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Lucía Monteverde',
            'state_id' => '20',
            'number' =>  '392',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Lucía Ocotlán',
            'state_id' => '20',
            'number' =>  '393',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Alotepec',
            'state_id' => '20',
            'number' =>  '394',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Apazco',
            'state_id' => '20',
            'number' =>  '395',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María la Asunción',
            'state_id' => '20',
            'number' =>  '396',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Heroica Ciudad de Tlaxiaco',
            'state_id' => '20',
            'number' =>  '397',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ayoquezco de Aldama',
            'state_id' => '20',
            'number' =>  '398',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Atzompa',
            'state_id' => '20',
            'number' =>  '399',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Camotlán',
            'state_id' => '20',
            'number' =>  '400',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Colotepec',
            'state_id' => '20',
            'number' =>  '401',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Cortijo',
            'state_id' => '20',
            'number' =>  '402',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Coyotepec',
            'state_id' => '20',
            'number' =>  '403',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Chachoápam',
            'state_id' => '20',
            'number' =>  '404',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villa de Chilapa de Díaz',
            'state_id' => '20',
            'number' =>  '405',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Chilchotla',
            'state_id' => '20',
            'number' =>  '406',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Chimalapa',
            'state_id' => '20',
            'number' =>  '407',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María del Rosario',
            'state_id' => '20',
            'number' =>  '408',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María del Tule',
            'state_id' => '20',
            'number' =>  '409',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Ecatepec',
            'state_id' => '20',
            'number' =>  '410',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Guelacé',
            'state_id' => '20',
            'number' =>  '411',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Guienagati',
            'state_id' => '20',
            'number' =>  '412',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Huatulco',
            'state_id' => '20',
            'number' =>  '413',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Huazolotitlán',
            'state_id' => '20',
            'number' =>  '414',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Ipalapa',
            'state_id' => '20',
            'number' =>  '415',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Ixcatlán',
            'state_id' => '20',
            'number' =>  '416',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Jacatepec',
            'state_id' => '20',
            'number' =>  '417',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Jalapa del Marqués',
            'state_id' => '20',
            'number' =>  '418',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Jaltianguis',
            'state_id' => '20',
            'number' =>  '419',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Lachixío',
            'state_id' => '20',
            'number' =>  '420',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Mixtequilla',
            'state_id' => '20',
            'number' =>  '421',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Nativitas',
            'state_id' => '20',
            'number' =>  '422',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Nduayaco',
            'state_id' => '20',
            'number' =>  '423',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Ozolotepec',
            'state_id' => '20',
            'number' =>  '424',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Pápalo',
            'state_id' => '20',
            'number' =>  '425',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Peñoles',
            'state_id' => '20',
            'number' =>  '426',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Petapa',
            'state_id' => '20',
            'number' =>  '427',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Quiegolani',
            'state_id' => '20',
            'number' =>  '428',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Sola',
            'state_id' => '20',
            'number' =>  '429',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Tataltepec',
            'state_id' => '20',
            'number' =>  '430',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Tecomavaca',
            'state_id' => '20',
            'number' =>  '431',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Temaxcalapa',
            'state_id' => '20',
            'number' =>  '432',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Temaxcaltepec',
            'state_id' => '20',
            'number' =>  '433',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Teopoxco',
            'state_id' => '20',
            'number' =>  '434',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Tepantlali',
            'state_id' => '20',
            'number' =>  '435',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Texcatitlán',
            'state_id' => '20',
            'number' =>  '436',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Tlahuitoltepec',
            'state_id' => '20',
            'number' =>  '437',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Tlalixtac',
            'state_id' => '20',
            'number' =>  '438',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Tonameca',
            'state_id' => '20',
            'number' =>  '439',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Totolapilla',
            'state_id' => '20',
            'number' =>  '440',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Xadani',
            'state_id' => '20',
            'number' =>  '441',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Yalina',
            'state_id' => '20',
            'number' =>  '442',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Yavesía',
            'state_id' => '20',
            'number' =>  '443',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Yolotepec',
            'state_id' => '20',
            'number' =>  '444',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Yosoyúa',
            'state_id' => '20',
            'number' =>  '445',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Yucuhiti',
            'state_id' => '20',
            'number' =>  '446',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Zacatepec',
            'state_id' => '20',
            'number' =>  '447',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Zaniza',
            'state_id' => '20',
            'number' =>  '448',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María Zoquitlán',
            'state_id' => '20',
            'number' =>  '449',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Amoltepec',
            'state_id' => '20',
            'number' =>  '450',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Apoala',
            'state_id' => '20',
            'number' =>  '451',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Apóstol',
            'state_id' => '20',
            'number' =>  '452',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Astata',
            'state_id' => '20',
            'number' =>  '453',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Atitlán',
            'state_id' => '20',
            'number' =>  '454',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Ayuquililla',
            'state_id' => '20',
            'number' =>  '455',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Cacaloxtepec',
            'state_id' => '20',
            'number' =>  '456',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Camotlán',
            'state_id' => '20',
            'number' =>  '457',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Comaltepec',
            'state_id' => '20',
            'number' =>  '458',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Chazumba',
            'state_id' => '20',
            'number' =>  '459',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Choápam',
            'state_id' => '20',
            'number' =>  '460',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago del Río',
            'state_id' => '20',
            'number' =>  '461',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Huajolotitlán',
            'state_id' => '20',
            'number' =>  '462',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Huauclilla',
            'state_id' => '20',
            'number' =>  '463',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Ihuitlán Plumas',
            'state_id' => '20',
            'number' =>  '464',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Ixcuintepec',
            'state_id' => '20',
            'number' =>  '465',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Ixtayutla',
            'state_id' => '20',
            'number' =>  '466',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Jamiltepec',
            'state_id' => '20',
            'number' =>  '467',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Jocotepec',
            'state_id' => '20',
            'number' =>  '468',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Juxtlahuaca',
            'state_id' => '20',
            'number' =>  '469',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Lachiguiri',
            'state_id' => '20',
            'number' =>  '470',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Lalopa',
            'state_id' => '20',
            'number' =>  '471',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Laollaga',
            'state_id' => '20',
            'number' =>  '472',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Laxopa',
            'state_id' => '20',
            'number' =>  '473',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Llano Grande',
            'state_id' => '20',
            'number' =>  '474',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Matatlán',
            'state_id' => '20',
            'number' =>  '475',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Miltepec',
            'state_id' => '20',
            'number' =>  '476',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Minas',
            'state_id' => '20',
            'number' =>  '477',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Nacaltepec',
            'state_id' => '20',
            'number' =>  '478',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Nejapilla',
            'state_id' => '20',
            'number' =>  '479',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Nundiche',
            'state_id' => '20',
            'number' =>  '480',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Nuyoó',
            'state_id' => '20',
            'number' =>  '481',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Pinotepa Nacional',
            'state_id' => '20',
            'number' =>  '482',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Suchilquitongo',
            'state_id' => '20',
            'number' =>  '483',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Tamazola',
            'state_id' => '20',
            'number' =>  '484',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Tapextla',
            'state_id' => '20',
            'number' =>  '485',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villa Tejúpam de la Unión',
            'state_id' => '20',
            'number' =>  '486',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Tenango',
            'state_id' => '20',
            'number' =>  '487',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Tepetlapa',
            'state_id' => '20',
            'number' =>  '488',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Tetepec',
            'state_id' => '20',
            'number' =>  '489',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Texcalcingo',
            'state_id' => '20',
            'number' =>  '490',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Textitlán',
            'state_id' => '20',
            'number' =>  '491',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Tilantongo',
            'state_id' => '20',
            'number' =>  '492',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Tillo',
            'state_id' => '20',
            'number' =>  '493',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Tlazoyaltepec',
            'state_id' => '20',
            'number' =>  '494',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Xanica',
            'state_id' => '20',
            'number' =>  '495',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Xiacuí',
            'state_id' => '20',
            'number' =>  '496',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Yaitepec',
            'state_id' => '20',
            'number' =>  '497',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Yaveo',
            'state_id' => '20',
            'number' =>  '498',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Yolomécatl',
            'state_id' => '20',
            'number' =>  '499',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Yosondúa',
            'state_id' => '20',
            'number' =>  '500',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Yucuyachi',
            'state_id' => '20',
            'number' =>  '501',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Zacatepec',
            'state_id' => '20',
            'number' =>  '502',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Zoochila',
            'state_id' => '20',
            'number' =>  '503',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Nuevo Zoquiápam',
            'state_id' => '20',
            'number' =>  '504',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santo Domingo Ingenio',
            'state_id' => '20',
            'number' =>  '505',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santo Domingo Albarradas',
            'state_id' => '20',
            'number' =>  '506',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santo Domingo Armenta',
            'state_id' => '20',
            'number' =>  '507',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santo Domingo Chihuitán',
            'state_id' => '20',
            'number' =>  '508',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santo Domingo de Morelos',
            'state_id' => '20',
            'number' =>  '509',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santo Domingo Ixcatlán',
            'state_id' => '20',
            'number' =>  '510',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santo Domingo Nuxaá',
            'state_id' => '20',
            'number' =>  '511',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santo Domingo Ozolotepec',
            'state_id' => '20',
            'number' =>  '512',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santo Domingo Petapa',
            'state_id' => '20',
            'number' =>  '513',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santo Domingo Roayaga',
            'state_id' => '20',
            'number' =>  '514',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santo Domingo Tehuantepec',
            'state_id' => '20',
            'number' =>  '515',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santo Domingo Teojomulco',
            'state_id' => '20',
            'number' =>  '516',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santo Domingo Tepuxtepec',
            'state_id' => '20',
            'number' =>  '517',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santo Domingo Tlatayápam',
            'state_id' => '20',
            'number' =>  '518',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santo Domingo Tomaltepec',
            'state_id' => '20',
            'number' =>  '519',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santo Domingo Tonalá',
            'state_id' => '20',
            'number' =>  '520',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santo Domingo Tonaltepec',
            'state_id' => '20',
            'number' =>  '521',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santo Domingo Xagacía',
            'state_id' => '20',
            'number' =>  '522',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santo Domingo Yanhuitlán',
            'state_id' => '20',
            'number' =>  '523',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santo Domingo Yodohino',
            'state_id' => '20',
            'number' =>  '524',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santo Domingo Zanatepec',
            'state_id' => '20',
            'number' =>  '525',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santos Reyes Nopala',
            'state_id' => '20',
            'number' =>  '526',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santos Reyes Pápalo',
            'state_id' => '20',
            'number' =>  '527',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santos Reyes Tepejillo',
            'state_id' => '20',
            'number' =>  '528',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santos Reyes Yucuná',
            'state_id' => '20',
            'number' =>  '529',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santo Tomás Jalieza',
            'state_id' => '20',
            'number' =>  '530',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santo Tomás Mazaltepec',
            'state_id' => '20',
            'number' =>  '531',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santo Tomás Ocotepec',
            'state_id' => '20',
            'number' =>  '532',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santo Tomás Tamazulapan',
            'state_id' => '20',
            'number' =>  '533',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Vicente Coatlán',
            'state_id' => '20',
            'number' =>  '534',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Vicente Lachixío',
            'state_id' => '20',
            'number' =>  '535',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Vicente Nuñú',
            'state_id' => '20',
            'number' =>  '536',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Silacayoápam',
            'state_id' => '20',
            'number' =>  '537',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Sitio de Xitlapehua',
            'state_id' => '20',
            'number' =>  '538',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Soledad Etla',
            'state_id' => '20',
            'number' =>  '539',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villa de Tamazulápam del Progreso',
            'state_id' => '20',
            'number' =>  '540',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tanetze de Zaragoza',
            'state_id' => '20',
            'number' =>  '541',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Taniche',
            'state_id' => '20',
            'number' =>  '542',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tataltepec de Valdés',
            'state_id' => '20',
            'number' =>  '543',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Teococuilco de Marcos Pérez',
            'state_id' => '20',
            'number' =>  '544',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Teotitlán de Flores Magón',
            'state_id' => '20',
            'number' =>  '545',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Teotitlán del Valle',
            'state_id' => '20',
            'number' =>  '546',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Teotongo',
            'state_id' => '20',
            'number' =>  '547',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tepelmeme Villa de Morelos',
            'state_id' => '20',
            'number' =>  '548',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Heroica Villa Tezoatlán de Segura y Luna. Cuna de la Independencia de Oaxaca',
            'state_id' => '20',
            'number' =>  '549',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Jerónimo Tlacochahuaya',
            'state_id' => '20',
            'number' =>  '550',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlacolula de Matamoros',
            'state_id' => '20',
            'number' =>  '551',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlacotepec Plumas',
            'state_id' => '20',
            'number' =>  '552',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlalixtac de Cabrera',
            'state_id' => '20',
            'number' =>  '553',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Totontepec Villa de Morelos',
            'state_id' => '20',
            'number' =>  '554',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Trinidad Zaachila',
            'state_id' => '20',
            'number' =>  '555',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'La Trinidad Vista Hermosa',
            'state_id' => '20',
            'number' =>  '556',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Unión Hidalgo',
            'state_id' => '20',
            'number' =>  '557',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Valerio Trujano',
            'state_id' => '20',
            'number' =>  '558',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Bautista Valle Nacional',
            'state_id' => '20',
            'number' =>  '559',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villa Díaz Ordaz',
            'state_id' => '20',
            'number' =>  '560',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Yaxe',
            'state_id' => '20',
            'number' =>  '561',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Magdalena Yodocono de Porfirio Díaz',
            'state_id' => '20',
            'number' =>  '562',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Yogana',
            'state_id' => '20',
            'number' =>  '563',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Yutanduchi de Guerrero',
            'state_id' => '20',
            'number' =>  '564',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villa de Zaachila',
            'state_id' => '20',
            'number' =>  '565',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Mateo Yucutindoo',
            'state_id' => '20',
            'number' =>  '566',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zapotitlán Lagunas',
            'state_id' => '20',
            'number' =>  '567',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zapotitlán Palmas',
            'state_id' => '20',
            'number' =>  '568',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Inés de Zaragoza',
            'state_id' => '20',
            'number' =>  '569',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zimatlán de Álvarez',
            'state_id' => '20',
            'number' =>  '570',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Acajete',
            'state_id' => '21',
            'number' =>  '001',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Acateno',
            'state_id' => '21',
            'number' =>  '002',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Acatlán',
            'state_id' => '21',
            'number' =>  '003',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Acatzingo',
            'state_id' => '21',
            'number' =>  '004',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Acteopan',
            'state_id' => '21',
            'number' =>  '005',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ahuacatlán',
            'state_id' => '21',
            'number' =>  '006',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ahuatlán',
            'state_id' => '21',
            'number' =>  '007',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ahuazotepec',
            'state_id' => '21',
            'number' =>  '008',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ahuehuetitla',
            'state_id' => '21',
            'number' =>  '009',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ajalpan',
            'state_id' => '21',
            'number' =>  '010',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Albino Zertuche',
            'state_id' => '21',
            'number' =>  '011',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Aljojuca',
            'state_id' => '21',
            'number' =>  '012',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Altepexi',
            'state_id' => '21',
            'number' =>  '013',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Amixtlán',
            'state_id' => '21',
            'number' =>  '014',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Amozoc',
            'state_id' => '21',
            'number' =>  '015',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Aquixtla',
            'state_id' => '21',
            'number' =>  '016',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Atempan',
            'state_id' => '21',
            'number' =>  '017',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Atexcal',
            'state_id' => '21',
            'number' =>  '018',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Atlixco',
            'state_id' => '21',
            'number' =>  '019',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Atoyatempan',
            'state_id' => '21',
            'number' =>  '020',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Atzala',
            'state_id' => '21',
            'number' =>  '021',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Atzitzihuacán',
            'state_id' => '21',
            'number' =>  '022',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Atzitzintla',
            'state_id' => '21',
            'number' =>  '023',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Axutla',
            'state_id' => '21',
            'number' =>  '024',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ayotoxco de Guerrero',
            'state_id' => '21',
            'number' =>  '025',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Calpan',
            'state_id' => '21',
            'number' =>  '026',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Caltepec',
            'state_id' => '21',
            'number' =>  '027',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Camocuautla',
            'state_id' => '21',
            'number' =>  '028',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Caxhuacan',
            'state_id' => '21',
            'number' =>  '029',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Coatepec',
            'state_id' => '21',
            'number' =>  '030',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Coatzingo',
            'state_id' => '21',
            'number' =>  '031',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cohetzala',
            'state_id' => '21',
            'number' =>  '032',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cohuecan',
            'state_id' => '21',
            'number' =>  '033',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Coronango',
            'state_id' => '21',
            'number' =>  '034',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Coxcatlán',
            'state_id' => '21',
            'number' =>  '035',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Coyomeapan',
            'state_id' => '21',
            'number' =>  '036',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Coyotepec',
            'state_id' => '21',
            'number' =>  '037',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cuapiaxtla de Madero',
            'state_id' => '21',
            'number' =>  '038',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cuautempan',
            'state_id' => '21',
            'number' =>  '039',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cuautinchán',
            'state_id' => '21',
            'number' =>  '040',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cuautlancingo',
            'state_id' => '21',
            'number' =>  '041',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cuayuca de Andrade',
            'state_id' => '21',
            'number' =>  '042',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cuetzalan del Progreso',
            'state_id' => '21',
            'number' =>  '043',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cuyoaco',
            'state_id' => '21',
            'number' =>  '044',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chalchicomula de Sesma',
            'state_id' => '21',
            'number' =>  '045',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chapulco',
            'state_id' => '21',
            'number' =>  '046',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chiautla',
            'state_id' => '21',
            'number' =>  '047',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chiautzingo',
            'state_id' => '21',
            'number' =>  '048',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chiconcuautla',
            'state_id' => '21',
            'number' =>  '049',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chichiquila',
            'state_id' => '21',
            'number' =>  '050',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chietla',
            'state_id' => '21',
            'number' =>  '051',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chigmecatitlán',
            'state_id' => '21',
            'number' =>  '052',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chignahuapan',
            'state_id' => '21',
            'number' =>  '053',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chignautla',
            'state_id' => '21',
            'number' =>  '054',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chila',
            'state_id' => '21',
            'number' =>  '055',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chila de la Sal',
            'state_id' => '21',
            'number' =>  '056',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Honey',
            'state_id' => '21',
            'number' =>  '057',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chilchotla',
            'state_id' => '21',
            'number' =>  '058',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chinantla',
            'state_id' => '21',
            'number' =>  '059',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Domingo Arenas',
            'state_id' => '21',
            'number' =>  '060',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Eloxochitlán',
            'state_id' => '21',
            'number' =>  '061',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Epatlán',
            'state_id' => '21',
            'number' =>  '062',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Esperanza',
            'state_id' => '21',
            'number' =>  '063',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Francisco Z. Mena',
            'state_id' => '21',
            'number' =>  '064',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'General Felipe Ángeles',
            'state_id' => '21',
            'number' =>  '065',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Guadalupe',
            'state_id' => '21',
            'number' =>  '066',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Guadalupe Victoria',
            'state_id' => '21',
            'number' =>  '067',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Hermenegildo Galeana',
            'state_id' => '21',
            'number' =>  '068',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huaquechula',
            'state_id' => '21',
            'number' =>  '069',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huatlatlauca',
            'state_id' => '21',
            'number' =>  '070',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huauchinango',
            'state_id' => '21',
            'number' =>  '071',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huehuetla',
            'state_id' => '21',
            'number' =>  '072',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huehuetlán el Chico',
            'state_id' => '21',
            'number' =>  '073',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huejotzingo',
            'state_id' => '21',
            'number' =>  '074',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Hueyapan',
            'state_id' => '21',
            'number' =>  '075',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Hueytamalco',
            'state_id' => '21',
            'number' =>  '076',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Hueytlalpan',
            'state_id' => '21',
            'number' =>  '077',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huitzilan de Serdán',
            'state_id' => '21',
            'number' =>  '078',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huitziltepec',
            'state_id' => '21',
            'number' =>  '079',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Atlequizayan',
            'state_id' => '21',
            'number' =>  '080',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ixcamilpa de Guerrero',
            'state_id' => '21',
            'number' =>  '081',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ixcaquixtla',
            'state_id' => '21',
            'number' =>  '082',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ixtacamaxtitlán',
            'state_id' => '21',
            'number' =>  '083',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ixtepec',
            'state_id' => '21',
            'number' =>  '084',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Izúcar de Matamoros',
            'state_id' => '21',
            'number' =>  '085',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jalpan',
            'state_id' => '21',
            'number' =>  '086',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jolalpan',
            'state_id' => '21',
            'number' =>  '087',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jonotla',
            'state_id' => '21',
            'number' =>  '088',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jopala',
            'state_id' => '21',
            'number' =>  '089',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Juan C. Bonilla',
            'state_id' => '21',
            'number' =>  '090',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Juan Galindo',
            'state_id' => '21',
            'number' =>  '091',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Juan N. Méndez',
            'state_id' => '21',
            'number' =>  '092',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Lafragua',
            'state_id' => '21',
            'number' =>  '093',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Libres',
            'state_id' => '21',
            'number' =>  '094',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'La Magdalena Tlatlauquitepec',
            'state_id' => '21',
            'number' =>  '095',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mazapiltepec de Juárez',
            'state_id' => '21',
            'number' =>  '096',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mixtla',
            'state_id' => '21',
            'number' =>  '097',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Molcaxac',
            'state_id' => '21',
            'number' =>  '098',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cañada Morelos',
            'state_id' => '21',
            'number' =>  '099',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Naupan',
            'state_id' => '21',
            'number' =>  '100',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Nauzontla',
            'state_id' => '21',
            'number' =>  '101',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Nealtican',
            'state_id' => '21',
            'number' =>  '102',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Nicolás Bravo',
            'state_id' => '21',
            'number' =>  '103',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Nopalucan',
            'state_id' => '21',
            'number' =>  '104',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ocotepec',
            'state_id' => '21',
            'number' =>  '105',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ocoyucan',
            'state_id' => '21',
            'number' =>  '106',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Olintla',
            'state_id' => '21',
            'number' =>  '107',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Oriental',
            'state_id' => '21',
            'number' =>  '108',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Pahuatlán',
            'state_id' => '21',
            'number' =>  '109',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Palmar de Bravo',
            'state_id' => '21',
            'number' =>  '110',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Pantepec',
            'state_id' => '21',
            'number' =>  '111',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Petlalcingo',
            'state_id' => '21',
            'number' =>  '112',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Piaxtla',
            'state_id' => '21',
            'number' =>  '113',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Puebla',
            'state_id' => '21',
            'number' =>  '114',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Quecholac',
            'state_id' => '21',
            'number' =>  '115',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Quimixtlán',
            'state_id' => '21',
            'number' =>  '116',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Rafael Lara Grajales',
            'state_id' => '21',
            'number' =>  '117',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Los Reyes de Juárez',
            'state_id' => '21',
            'number' =>  '118',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Andrés Cholula',
            'state_id' => '21',
            'number' =>  '119',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Antonio Cañada',
            'state_id' => '21',
            'number' =>  '120',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Diego la Mesa Tochimiltzingo',
            'state_id' => '21',
            'number' =>  '121',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Felipe Teotlalcingo',
            'state_id' => '21',
            'number' =>  '122',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Felipe Tepatlán',
            'state_id' => '21',
            'number' =>  '123',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Gabriel Chilac',
            'state_id' => '21',
            'number' =>  '124',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Gregorio Atzompa',
            'state_id' => '21',
            'number' =>  '125',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Jerónimo Tecuanipan',
            'state_id' => '21',
            'number' =>  '126',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Jerónimo Xayacatlán',
            'state_id' => '21',
            'number' =>  '127',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San José Chiapa',
            'state_id' => '21',
            'number' =>  '128',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San José Miahuatlán',
            'state_id' => '21',
            'number' =>  '129',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Atenco',
            'state_id' => '21',
            'number' =>  '130',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Atzompa',
            'state_id' => '21',
            'number' =>  '131',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Martín Texmelucan',
            'state_id' => '21',
            'number' =>  '132',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Martín Totoltepec',
            'state_id' => '21',
            'number' =>  '133',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Matías Tlalancaleca',
            'state_id' => '21',
            'number' =>  '134',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Miguel Ixitlán',
            'state_id' => '21',
            'number' =>  '135',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Miguel Xoxtla',
            'state_id' => '21',
            'number' =>  '136',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Nicolás Buenos Aires',
            'state_id' => '21',
            'number' =>  '137',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Nicolás de los Ranchos',
            'state_id' => '21',
            'number' =>  '138',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pablo Anicano',
            'state_id' => '21',
            'number' =>  '139',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Cholula',
            'state_id' => '21',
            'number' =>  '140',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro Yeloixtlahuaca',
            'state_id' => '21',
            'number' =>  '141',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Salvador el Seco',
            'state_id' => '21',
            'number' =>  '142',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Salvador el Verde',
            'state_id' => '21',
            'number' =>  '143',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Salvador Huixcolotla',
            'state_id' => '21',
            'number' =>  '144',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Sebastián Tlacotepec',
            'state_id' => '21',
            'number' =>  '145',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Catarina Tlaltempan',
            'state_id' => '21',
            'number' =>  '146',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Inés Ahuatempan',
            'state_id' => '21',
            'number' =>  '147',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Isabel Cholula',
            'state_id' => '21',
            'number' =>  '148',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Miahuatlán',
            'state_id' => '21',
            'number' =>  '149',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huehuetlán el Grande',
            'state_id' => '21',
            'number' =>  '150',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santo Tomás Hueyotlipan',
            'state_id' => '21',
            'number' =>  '151',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Soltepec',
            'state_id' => '21',
            'number' =>  '152',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tecali de Herrera',
            'state_id' => '21',
            'number' =>  '153',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tecamachalco',
            'state_id' => '21',
            'number' =>  '154',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tecomatlán',
            'state_id' => '21',
            'number' =>  '155',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tehuacán',
            'state_id' => '21',
            'number' =>  '156',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tehuitzingo',
            'state_id' => '21',
            'number' =>  '157',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tenampulco',
            'state_id' => '21',
            'number' =>  '158',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Teopantlán',
            'state_id' => '21',
            'number' =>  '159',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Teotlalco',
            'state_id' => '21',
            'number' =>  '160',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tepanco de López',
            'state_id' => '21',
            'number' =>  '161',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tepango de Rodríguez',
            'state_id' => '21',
            'number' =>  '162',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tepatlaxco de Hidalgo',
            'state_id' => '21',
            'number' =>  '163',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tepeaca',
            'state_id' => '21',
            'number' =>  '164',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tepemaxalco',
            'state_id' => '21',
            'number' =>  '165',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tepeojuma',
            'state_id' => '21',
            'number' =>  '166',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tepetzintla',
            'state_id' => '21',
            'number' =>  '167',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tepexco',
            'state_id' => '21',
            'number' =>  '168',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tepexi de Rodríguez',
            'state_id' => '21',
            'number' =>  '169',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tepeyahualco',
            'state_id' => '21',
            'number' =>  '170',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tepeyahualco de Cuauhtémoc',
            'state_id' => '21',
            'number' =>  '171',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tetela de Ocampo',
            'state_id' => '21',
            'number' =>  '172',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Teteles de Avila Castillo',
            'state_id' => '21',
            'number' =>  '173',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Teziutlán',
            'state_id' => '21',
            'number' =>  '174',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tianguismanalco',
            'state_id' => '21',
            'number' =>  '175',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tilapa',
            'state_id' => '21',
            'number' =>  '176',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlacotepec de Benito Juárez',
            'state_id' => '21',
            'number' =>  '177',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlacuilotepec',
            'state_id' => '21',
            'number' =>  '178',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlachichuca',
            'state_id' => '21',
            'number' =>  '179',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlahuapan',
            'state_id' => '21',
            'number' =>  '180',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlaltenango',
            'state_id' => '21',
            'number' =>  '181',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlanepantla',
            'state_id' => '21',
            'number' =>  '182',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlaola',
            'state_id' => '21',
            'number' =>  '183',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlapacoya',
            'state_id' => '21',
            'number' =>  '184',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlapanalá',
            'state_id' => '21',
            'number' =>  '185',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlatlauquitepec',
            'state_id' => '21',
            'number' =>  '186',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlaxco',
            'state_id' => '21',
            'number' =>  '187',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tochimilco',
            'state_id' => '21',
            'number' =>  '188',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tochtepec',
            'state_id' => '21',
            'number' =>  '189',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Totoltepec de Guerrero',
            'state_id' => '21',
            'number' =>  '190',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tulcingo',
            'state_id' => '21',
            'number' =>  '191',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tuzamapan de Galeana',
            'state_id' => '21',
            'number' =>  '192',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tzicatlacoyan',
            'state_id' => '21',
            'number' =>  '193',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Venustiano Carranza',
            'state_id' => '21',
            'number' =>  '194',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Vicente Guerrero',
            'state_id' => '21',
            'number' =>  '195',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Xayacatlán de Bravo',
            'state_id' => '21',
            'number' =>  '196',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Xicotepec',
            'state_id' => '21',
            'number' =>  '197',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Xicotlán',
            'state_id' => '21',
            'number' =>  '198',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Xiutetelco',
            'state_id' => '21',
            'number' =>  '199',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Xochiapulco',
            'state_id' => '21',
            'number' =>  '200',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Xochiltepec',
            'state_id' => '21',
            'number' =>  '201',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Xochitlán de Vicente Suárez',
            'state_id' => '21',
            'number' =>  '202',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Xochitlán Todos Santos',
            'state_id' => '21',
            'number' =>  '203',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Yaonáhuac',
            'state_id' => '21',
            'number' =>  '204',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Yehualtepec',
            'state_id' => '21',
            'number' =>  '205',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zacapala',
            'state_id' => '21',
            'number' =>  '206',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zacapoaxtla',
            'state_id' => '21',
            'number' =>  '207',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zacatlán',
            'state_id' => '21',
            'number' =>  '208',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zapotitlán',
            'state_id' => '21',
            'number' =>  '209',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zapotitlán de Méndez',
            'state_id' => '21',
            'number' =>  '210',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zaragoza',
            'state_id' => '21',
            'number' =>  '211',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zautla',
            'state_id' => '21',
            'number' =>  '212',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zihuateutla',
            'state_id' => '21',
            'number' =>  '213',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zinacatepec',
            'state_id' => '21',
            'number' =>  '214',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zongozotla',
            'state_id' => '21',
            'number' =>  '215',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zoquiapan',
            'state_id' => '21',
            'number' =>  '216',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zoquitlán',
            'state_id' => '21',
            'number' =>  '217',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Amealco de Bonfil',
            'state_id' => '22',
            'number' =>  '001',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Pinal de Amoles',
            'state_id' => '22',
            'number' =>  '002',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Arroyo Seco',
            'state_id' => '22',
            'number' =>  '003',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cadereyta de Montes',
            'state_id' => '22',
            'number' =>  '004',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Colón',
            'state_id' => '22',
            'number' =>  '005',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Corregidora',
            'state_id' => '22',
            'number' =>  '006',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ezequiel Montes',
            'state_id' => '22',
            'number' =>  '007',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huimilpan',
            'state_id' => '22',
            'number' =>  '008',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jalpan de Serra',
            'state_id' => '22',
            'number' =>  '009',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Landa de Matamoros',
            'state_id' => '22',
            'number' =>  '010',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'El Marqués',
            'state_id' => '22',
            'number' =>  '011',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Pedro Escobedo',
            'state_id' => '22',
            'number' =>  '012',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Peñamiller',
            'state_id' => '22',
            'number' =>  '013',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Querétaro',
            'state_id' => '22',
            'number' =>  '014',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Joaquín',
            'state_id' => '22',
            'number' =>  '015',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan del Río',
            'state_id' => '22',
            'number' =>  '016',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tequisquiapan',
            'state_id' => '22',
            'number' =>  '017',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tolimán',
            'state_id' => '22',
            'number' =>  '018',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cozumel',
            'state_id' => '23',
            'number' =>  '001',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Felipe Carrillo Puerto',
            'state_id' => '23',
            'number' =>  '002',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Isla Mujeres',
            'state_id' => '23',
            'number' =>  '003',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Othón P. Blanco',
            'state_id' => '23',
            'number' =>  '004',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Benito Juárez',
            'state_id' => '23',
            'number' =>  '005',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'José María Morelos',
            'state_id' => '23',
            'number' =>  '006',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Lázaro Cárdenas',
            'state_id' => '23',
            'number' =>  '007',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Solidaridad',
            'state_id' => '23',
            'number' =>  '008',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tulum',
            'state_id' => '23',
            'number' =>  '009',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Bacalar',
            'state_id' => '23',
            'number' =>  '010',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ahualulco',
            'state_id' => '24',
            'number' =>  '001',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Alaquines',
            'state_id' => '24',
            'number' =>  '002',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Aquismón',
            'state_id' => '24',
            'number' =>  '003',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Armadillo de los Infante',
            'state_id' => '24',
            'number' =>  '004',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cárdenas',
            'state_id' => '24',
            'number' =>  '005',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Catorce',
            'state_id' => '24',
            'number' =>  '006',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cedral',
            'state_id' => '24',
            'number' =>  '007',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cerritos',
            'state_id' => '24',
            'number' =>  '008',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cerro de San Pedro',
            'state_id' => '24',
            'number' =>  '009',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ciudad del Maíz',
            'state_id' => '24',
            'number' =>  '010',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ciudad Fernández',
            'state_id' => '24',
            'number' =>  '011',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tancanhuitz',
            'state_id' => '24',
            'number' =>  '012',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ciudad Valles',
            'state_id' => '24',
            'number' =>  '013',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Coxcatlán',
            'state_id' => '24',
            'number' =>  '014',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Charcas',
            'state_id' => '24',
            'number' =>  '015',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ebano',
            'state_id' => '24',
            'number' =>  '016',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Guadalcázar',
            'state_id' => '24',
            'number' =>  '017',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huehuetlán',
            'state_id' => '24',
            'number' =>  '018',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Lagunillas',
            'state_id' => '24',
            'number' =>  '019',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Matehuala',
            'state_id' => '24',
            'number' =>  '020',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mexquitic de Carmona',
            'state_id' => '24',
            'number' =>  '021',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Moctezuma',
            'state_id' => '24',
            'number' =>  '022',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Rayón',
            'state_id' => '24',
            'number' =>  '023',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Rioverde',
            'state_id' => '24',
            'number' =>  '024',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Salinas',
            'state_id' => '24',
            'number' =>  '025',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Antonio',
            'state_id' => '24',
            'number' =>  '026',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Ciro de Acosta',
            'state_id' => '24',
            'number' =>  '027',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Luis Potosí',
            'state_id' => '24',
            'number' =>  '028',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Martín Chalchicuautla',
            'state_id' => '24',
            'number' =>  '029',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Nicolás Tolentino',
            'state_id' => '24',
            'number' =>  '030',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Catarina',
            'state_id' => '24',
            'number' =>  '031',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María del Río',
            'state_id' => '24',
            'number' =>  '032',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santo Domingo',
            'state_id' => '24',
            'number' =>  '033',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Vicente Tancuayalab',
            'state_id' => '24',
            'number' =>  '034',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Soledad de Graciano Sánchez',
            'state_id' => '24',
            'number' =>  '035',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tamasopo',
            'state_id' => '24',
            'number' =>  '036',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tamazunchale',
            'state_id' => '24',
            'number' =>  '037',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tampacán',
            'state_id' => '24',
            'number' =>  '038',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tampamolón Corona',
            'state_id' => '24',
            'number' =>  '039',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tamuín',
            'state_id' => '24',
            'number' =>  '040',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tanlajás',
            'state_id' => '24',
            'number' =>  '041',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tanquián de Escobedo',
            'state_id' => '24',
            'number' =>  '042',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tierra Nueva',
            'state_id' => '24',
            'number' =>  '043',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Vanegas',
            'state_id' => '24',
            'number' =>  '044',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Venado',
            'state_id' => '24',
            'number' =>  '045',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villa de Arriaga',
            'state_id' => '24',
            'number' =>  '046',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villa de Guadalupe',
            'state_id' => '24',
            'number' =>  '047',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villa de la Paz',
            'state_id' => '24',
            'number' =>  '048',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villa de Ramos',
            'state_id' => '24',
            'number' =>  '049',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villa de Reyes',
            'state_id' => '24',
            'number' =>  '050',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villa Hidalgo',
            'state_id' => '24',
            'number' =>  '051',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villa Juárez',
            'state_id' => '24',
            'number' =>  '052',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Axtla de Terrazas',
            'state_id' => '24',
            'number' =>  '053',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Xilitla',
            'state_id' => '24',
            'number' =>  '054',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zaragoza',
            'state_id' => '24',
            'number' =>  '055',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villa de Arista',
            'state_id' => '24',
            'number' =>  '056',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Matlapa',
            'state_id' => '24',
            'number' =>  '057',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'El Naranjo',
            'state_id' => '24',
            'number' =>  '058',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ahome',
            'state_id' => '25',
            'number' =>  '001',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Angostura',
            'state_id' => '25',
            'number' =>  '002',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Badiraguato',
            'state_id' => '25',
            'number' =>  '003',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Concordia',
            'state_id' => '25',
            'number' =>  '004',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cosalá',
            'state_id' => '25',
            'number' =>  '005',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Culiacán',
            'state_id' => '25',
            'number' =>  '006',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Choix',
            'state_id' => '25',
            'number' =>  '007',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Elota',
            'state_id' => '25',
            'number' =>  '008',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Escuinapa',
            'state_id' => '25',
            'number' =>  '009',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'El Fuerte',
            'state_id' => '25',
            'number' =>  '010',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Guasave',
            'state_id' => '25',
            'number' =>  '011',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mazatlán',
            'state_id' => '25',
            'number' =>  '012',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mocorito',
            'state_id' => '25',
            'number' =>  '013',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Rosario',
            'state_id' => '25',
            'number' =>  '014',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Salvador Alvarado',
            'state_id' => '25',
            'number' =>  '015',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Ignacio',
            'state_id' => '25',
            'number' =>  '016',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Sinaloa',
            'state_id' => '25',
            'number' =>  '017',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Navolato',
            'state_id' => '25',
            'number' =>  '018',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Aconchi',
            'state_id' => '26',
            'number' =>  '001',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Agua Prieta',
            'state_id' => '26',
            'number' =>  '002',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Alamos',
            'state_id' => '26',
            'number' =>  '003',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Altar',
            'state_id' => '26',
            'number' =>  '004',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Arivechi',
            'state_id' => '26',
            'number' =>  '005',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Arizpe',
            'state_id' => '26',
            'number' =>  '006',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Atil',
            'state_id' => '26',
            'number' =>  '007',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Bacadéhuachi',
            'state_id' => '26',
            'number' =>  '008',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Bacanora',
            'state_id' => '26',
            'number' =>  '009',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Bacerac',
            'state_id' => '26',
            'number' =>  '010',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Bacoachi',
            'state_id' => '26',
            'number' =>  '011',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Bácum',
            'state_id' => '26',
            'number' =>  '012',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Banámichi',
            'state_id' => '26',
            'number' =>  '013',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Baviácora',
            'state_id' => '26',
            'number' =>  '014',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Bavispe',
            'state_id' => '26',
            'number' =>  '015',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Benjamín Hill',
            'state_id' => '26',
            'number' =>  '016',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Caborca',
            'state_id' => '26',
            'number' =>  '017',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cajeme',
            'state_id' => '26',
            'number' =>  '018',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cananea',
            'state_id' => '26',
            'number' =>  '019',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Carbó',
            'state_id' => '26',
            'number' =>  '020',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'La Colorada',
            'state_id' => '26',
            'number' =>  '021',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cucurpe',
            'state_id' => '26',
            'number' =>  '022',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cumpas',
            'state_id' => '26',
            'number' =>  '023',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Divisaderos',
            'state_id' => '26',
            'number' =>  '024',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Empalme',
            'state_id' => '26',
            'number' =>  '025',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Etchojoa',
            'state_id' => '26',
            'number' =>  '026',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Fronteras',
            'state_id' => '26',
            'number' =>  '027',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Granados',
            'state_id' => '26',
            'number' =>  '028',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Guaymas',
            'state_id' => '26',
            'number' =>  '029',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Hermosillo',
            'state_id' => '26',
            'number' =>  '030',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huachinera',
            'state_id' => '26',
            'number' =>  '031',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huásabas',
            'state_id' => '26',
            'number' =>  '032',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huatabampo',
            'state_id' => '26',
            'number' =>  '033',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huépac',
            'state_id' => '26',
            'number' =>  '034',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Imuris',
            'state_id' => '26',
            'number' =>  '035',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Magdalena',
            'state_id' => '26',
            'number' =>  '036',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mazatán',
            'state_id' => '26',
            'number' =>  '037',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Moctezuma',
            'state_id' => '26',
            'number' =>  '038',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Naco',
            'state_id' => '26',
            'number' =>  '039',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Nácori Chico',
            'state_id' => '26',
            'number' =>  '040',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Nacozari de García',
            'state_id' => '26',
            'number' =>  '041',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Navojoa',
            'state_id' => '26',
            'number' =>  '042',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Nogales',
            'state_id' => '26',
            'number' =>  '043',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Onavas',
            'state_id' => '26',
            'number' =>  '044',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Opodepe',
            'state_id' => '26',
            'number' =>  '045',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Oquitoa',
            'state_id' => '26',
            'number' =>  '046',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Pitiquito',
            'state_id' => '26',
            'number' =>  '047',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Puerto Peñasco',
            'state_id' => '26',
            'number' =>  '048',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Quiriego',
            'state_id' => '26',
            'number' =>  '049',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Rayón',
            'state_id' => '26',
            'number' =>  '050',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Rosario',
            'state_id' => '26',
            'number' =>  '051',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Sahuaripa',
            'state_id' => '26',
            'number' =>  '052',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Felipe de Jesús',
            'state_id' => '26',
            'number' =>  '053',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Javier',
            'state_id' => '26',
            'number' =>  '054',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Luis Río Colorado',
            'state_id' => '26',
            'number' =>  '055',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Miguel de Horcasitas',
            'state_id' => '26',
            'number' =>  '056',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pedro de la Cueva',
            'state_id' => '26',
            'number' =>  '057',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Ana',
            'state_id' => '26',
            'number' =>  '058',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Cruz',
            'state_id' => '26',
            'number' =>  '059',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Sáric',
            'state_id' => '26',
            'number' =>  '060',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Soyopa',
            'state_id' => '26',
            'number' =>  '061',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Suaqui Grande',
            'state_id' => '26',
            'number' =>  '062',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tepache',
            'state_id' => '26',
            'number' =>  '063',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Trincheras',
            'state_id' => '26',
            'number' =>  '064',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tubutama',
            'state_id' => '26',
            'number' =>  '065',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ures',
            'state_id' => '26',
            'number' =>  '066',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villa Hidalgo',
            'state_id' => '26',
            'number' =>  '067',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villa Pesqueira',
            'state_id' => '26',
            'number' =>  '068',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Yécora',
            'state_id' => '26',
            'number' =>  '069',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'General Plutarco Elías Calles',
            'state_id' => '26',
            'number' =>  '070',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Benito Juárez',
            'state_id' => '26',
            'number' =>  '071',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Ignacio Río Muerto',
            'state_id' => '26',
            'number' =>  '072',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Balancán',
            'state_id' => '27',
            'number' =>  '001',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cárdenas',
            'state_id' => '27',
            'number' =>  '002',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Centla',
            'state_id' => '27',
            'number' =>  '003',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Centro',
            'state_id' => '27',
            'number' =>  '004',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Comalcalco',
            'state_id' => '27',
            'number' =>  '005',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cunduacán',
            'state_id' => '27',
            'number' =>  '006',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Emiliano Zapata',
            'state_id' => '27',
            'number' =>  '007',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huimanguillo',
            'state_id' => '27',
            'number' =>  '008',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jalapa',
            'state_id' => '27',
            'number' =>  '009',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jalpa de Méndez',
            'state_id' => '27',
            'number' =>  '010',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jonuta',
            'state_id' => '27',
            'number' =>  '011',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Macuspana',
            'state_id' => '27',
            'number' =>  '012',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Nacajuca',
            'state_id' => '27',
            'number' =>  '013',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Paraíso',
            'state_id' => '27',
            'number' =>  '014',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tacotalpa',
            'state_id' => '27',
            'number' =>  '015',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Teapa',
            'state_id' => '27',
            'number' =>  '016',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tenosique',
            'state_id' => '27',
            'number' =>  '017',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Abasolo',
            'state_id' => '28',
            'number' =>  '001',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Aldama',
            'state_id' => '28',
            'number' =>  '002',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Altamira',
            'state_id' => '28',
            'number' =>  '003',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Antiguo Morelos',
            'state_id' => '28',
            'number' =>  '004',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Burgos',
            'state_id' => '28',
            'number' =>  '005',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Bustamante',
            'state_id' => '28',
            'number' =>  '006',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Camargo',
            'state_id' => '28',
            'number' =>  '007',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Casas',
            'state_id' => '28',
            'number' =>  '008',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ciudad Madero',
            'state_id' => '28',
            'number' =>  '009',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cruillas',
            'state_id' => '28',
            'number' =>  '010',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Gómez Farías',
            'state_id' => '28',
            'number' =>  '011',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'González',
            'state_id' => '28',
            'number' =>  '012',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Güémez',
            'state_id' => '28',
            'number' =>  '013',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Guerrero',
            'state_id' => '28',
            'number' =>  '014',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Gustavo Díaz Ordaz',
            'state_id' => '28',
            'number' =>  '015',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Hidalgo',
            'state_id' => '28',
            'number' =>  '016',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jaumave',
            'state_id' => '28',
            'number' =>  '017',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jiménez',
            'state_id' => '28',
            'number' =>  '018',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Llera',
            'state_id' => '28',
            'number' =>  '019',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mainero',
            'state_id' => '28',
            'number' =>  '020',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'El Mante',
            'state_id' => '28',
            'number' =>  '021',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Matamoros',
            'state_id' => '28',
            'number' =>  '022',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Méndez',
            'state_id' => '28',
            'number' =>  '023',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mier',
            'state_id' => '28',
            'number' =>  '024',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Miguel Alemán',
            'state_id' => '28',
            'number' =>  '025',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Miquihuana',
            'state_id' => '28',
            'number' =>  '026',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Nuevo Laredo',
            'state_id' => '28',
            'number' =>  '027',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Nuevo Morelos',
            'state_id' => '28',
            'number' =>  '028',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ocampo',
            'state_id' => '28',
            'number' =>  '029',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Padilla',
            'state_id' => '28',
            'number' =>  '030',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Palmillas',
            'state_id' => '28',
            'number' =>  '031',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Reynosa',
            'state_id' => '28',
            'number' =>  '032',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Río Bravo',
            'state_id' => '28',
            'number' =>  '033',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Carlos',
            'state_id' => '28',
            'number' =>  '034',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Fernando',
            'state_id' => '28',
            'number' =>  '035',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Nicolás',
            'state_id' => '28',
            'number' =>  '036',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Soto la Marina',
            'state_id' => '28',
            'number' =>  '037',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tampico',
            'state_id' => '28',
            'number' =>  '038',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tula',
            'state_id' => '28',
            'number' =>  '039',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Valle Hermoso',
            'state_id' => '28',
            'number' =>  '040',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Victoria',
            'state_id' => '28',
            'number' =>  '041',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villagrán',
            'state_id' => '28',
            'number' =>  '042',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Xicoténcatl',
            'state_id' => '28',
            'number' =>  '043',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Amaxac de Guerrero',
            'state_id' => '29',
            'number' =>  '001',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Apetatitlán de Antonio Carvajal',
            'state_id' => '29',
            'number' =>  '002',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Atlangatepec',
            'state_id' => '29',
            'number' =>  '003',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Atltzayanca',
            'state_id' => '29',
            'number' =>  '004',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Apizaco',
            'state_id' => '29',
            'number' =>  '005',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Calpulalpan',
            'state_id' => '29',
            'number' =>  '006',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'El Carmen Tequexquitla',
            'state_id' => '29',
            'number' =>  '007',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cuapiaxtla',
            'state_id' => '29',
            'number' =>  '008',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cuaxomulco',
            'state_id' => '29',
            'number' =>  '009',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chiautempan',
            'state_id' => '29',
            'number' =>  '010',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Muñoz de Domingo Arenas',
            'state_id' => '29',
            'number' =>  '011',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Españita',
            'state_id' => '29',
            'number' =>  '012',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huamantla',
            'state_id' => '29',
            'number' =>  '013',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Hueyotlipan',
            'state_id' => '29',
            'number' =>  '014',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ixtacuixtla de Mariano Matamoros',
            'state_id' => '29',
            'number' =>  '015',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ixtenco',
            'state_id' => '29',
            'number' =>  '016',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mazatecochco de José María Morelos',
            'state_id' => '29',
            'number' =>  '017',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Contla de Juan Cuamatzi',
            'state_id' => '29',
            'number' =>  '018',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tepetitla de Lardizábal',
            'state_id' => '29',
            'number' =>  '019',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Sanctórum de Lázaro Cárdenas',
            'state_id' => '29',
            'number' =>  '020',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Nanacamilpa de Mariano Arista',
            'state_id' => '29',
            'number' =>  '021',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Acuamanala de Miguel Hidalgo',
            'state_id' => '29',
            'number' =>  '022',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Natívitas',
            'state_id' => '29',
            'number' =>  '023',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Panotla',
            'state_id' => '29',
            'number' =>  '024',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Pablo del Monte',
            'state_id' => '29',
            'number' =>  '025',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Cruz Tlaxcala',
            'state_id' => '29',
            'number' =>  '026',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tenancingo',
            'state_id' => '29',
            'number' =>  '027',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Teolocholco',
            'state_id' => '29',
            'number' =>  '028',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tepeyanco',
            'state_id' => '29',
            'number' =>  '029',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Terrenate',
            'state_id' => '29',
            'number' =>  '030',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tetla de la Solidaridad',
            'state_id' => '29',
            'number' =>  '031',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tetlatlahuca',
            'state_id' => '29',
            'number' =>  '032',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlaxcala',
            'state_id' => '29',
            'number' =>  '033',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlaxco',
            'state_id' => '29',
            'number' =>  '034',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tocatlán',
            'state_id' => '29',
            'number' =>  '035',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Totolac',
            'state_id' => '29',
            'number' =>  '036',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ziltlaltépec de Trinidad Sánchez Santos',
            'state_id' => '29',
            'number' =>  '037',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tzompantepec',
            'state_id' => '29',
            'number' =>  '038',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Xaloztoc',
            'state_id' => '29',
            'number' =>  '039',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Xaltocan',
            'state_id' => '29',
            'number' =>  '040',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Papalotla de Xicohténcatl',
            'state_id' => '29',
            'number' =>  '041',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Xicohtzinco',
            'state_id' => '29',
            'number' =>  '042',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Yauhquemehcan',
            'state_id' => '29',
            'number' =>  '043',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zacatelco',
            'state_id' => '29',
            'number' =>  '044',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Benito Juárez',
            'state_id' => '29',
            'number' =>  '045',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Emiliano Zapata',
            'state_id' => '29',
            'number' =>  '046',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Lázaro Cárdenas',
            'state_id' => '29',
            'number' =>  '047',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'La Magdalena Tlaltelulco',
            'state_id' => '29',
            'number' =>  '048',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Damián Texóloc',
            'state_id' => '29',
            'number' =>  '049',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Francisco Tetlanohcan',
            'state_id' => '29',
            'number' =>  '050',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Jerónimo Zacualpan',
            'state_id' => '29',
            'number' =>  '051',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San José Teacalco',
            'state_id' => '29',
            'number' =>  '052',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Huactzinco',
            'state_id' => '29',
            'number' =>  '053',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Lorenzo Axocomanitla',
            'state_id' => '29',
            'number' =>  '054',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Lucas Tecopilco',
            'state_id' => '29',
            'number' =>  '055',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Ana Nopalucan',
            'state_id' => '29',
            'number' =>  '056',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Apolonia Teacalco',
            'state_id' => '29',
            'number' =>  '057',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Catarina Ayometla',
            'state_id' => '29',
            'number' =>  '058',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Cruz Quilehtla',
            'state_id' => '29',
            'number' =>  '059',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Isabel Xiloxoxtla',
            'state_id' => '29',
            'number' =>  '060',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Acajete',
            'state_id' => '30',
            'number' =>  '001',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Acatlán',
            'state_id' => '30',
            'number' =>  '002',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Acayucan',
            'state_id' => '30',
            'number' =>  '003',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Actopan',
            'state_id' => '30',
            'number' =>  '004',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Acula',
            'state_id' => '30',
            'number' =>  '005',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Acultzingo',
            'state_id' => '30',
            'number' =>  '006',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Camarón de Tejeda',
            'state_id' => '30',
            'number' =>  '007',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Alpatláhuac',
            'state_id' => '30',
            'number' =>  '008',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Alto Lucero de Gutiérrez Barrios',
            'state_id' => '30',
            'number' =>  '009',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Altotonga',
            'state_id' => '30',
            'number' =>  '010',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Alvarado',
            'state_id' => '30',
            'number' =>  '011',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Amatitlán',
            'state_id' => '30',
            'number' =>  '012',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Naranjos Amatlán',
            'state_id' => '30',
            'number' =>  '013',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Amatlán de los Reyes',
            'state_id' => '30',
            'number' =>  '014',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Angel R. Cabada',
            'state_id' => '30',
            'number' =>  '015',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'La Antigua',
            'state_id' => '30',
            'number' =>  '016',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Apazapan',
            'state_id' => '30',
            'number' =>  '017',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Aquila',
            'state_id' => '30',
            'number' =>  '018',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Astacinga',
            'state_id' => '30',
            'number' =>  '019',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Atlahuilco',
            'state_id' => '30',
            'number' =>  '020',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Atoyac',
            'state_id' => '30',
            'number' =>  '021',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Atzacan',
            'state_id' => '30',
            'number' =>  '022',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Atzalan',
            'state_id' => '30',
            'number' =>  '023',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlaltetela',
            'state_id' => '30',
            'number' =>  '024',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ayahualulco',
            'state_id' => '30',
            'number' =>  '025',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Banderilla',
            'state_id' => '30',
            'number' =>  '026',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Benito Juárez',
            'state_id' => '30',
            'number' =>  '027',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Boca del Río',
            'state_id' => '30',
            'number' =>  '028',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Calcahualco',
            'state_id' => '30',
            'number' =>  '029',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Camerino Z. Mendoza',
            'state_id' => '30',
            'number' =>  '030',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Carrillo Puerto',
            'state_id' => '30',
            'number' =>  '031',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Catemaco',
            'state_id' => '30',
            'number' =>  '032',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cazones de Herrera',
            'state_id' => '30',
            'number' =>  '033',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cerro Azul',
            'state_id' => '30',
            'number' =>  '034',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Citlaltépetl',
            'state_id' => '30',
            'number' =>  '035',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Coacoatzintla',
            'state_id' => '30',
            'number' =>  '036',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Coahuitlán',
            'state_id' => '30',
            'number' =>  '037',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Coatepec',
            'state_id' => '30',
            'number' =>  '038',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Coatzacoalcos',
            'state_id' => '30',
            'number' =>  '039',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Coatzintla',
            'state_id' => '30',
            'number' =>  '040',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Coetzala',
            'state_id' => '30',
            'number' =>  '041',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Colipa',
            'state_id' => '30',
            'number' =>  '042',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Comapa',
            'state_id' => '30',
            'number' =>  '043',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Córdoba',
            'state_id' => '30',
            'number' =>  '044',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cosamaloapan de Carpio',
            'state_id' => '30',
            'number' =>  '045',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cosautlán de Carvajal',
            'state_id' => '30',
            'number' =>  '046',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Coscomatepec',
            'state_id' => '30',
            'number' =>  '047',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cosoleacaque',
            'state_id' => '30',
            'number' =>  '048',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cotaxtla',
            'state_id' => '30',
            'number' =>  '049',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Coxquihui',
            'state_id' => '30',
            'number' =>  '050',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Coyutla',
            'state_id' => '30',
            'number' =>  '051',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cuichapa',
            'state_id' => '30',
            'number' =>  '052',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cuitláhuac',
            'state_id' => '30',
            'number' =>  '053',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chacaltianguis',
            'state_id' => '30',
            'number' =>  '054',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chalma',
            'state_id' => '30',
            'number' =>  '055',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chiconamel',
            'state_id' => '30',
            'number' =>  '056',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chiconquiaco',
            'state_id' => '30',
            'number' =>  '057',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chicontepec',
            'state_id' => '30',
            'number' =>  '058',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chinameca',
            'state_id' => '30',
            'number' =>  '059',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chinampa de Gorostiza',
            'state_id' => '30',
            'number' =>  '060',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Las Choapas',
            'state_id' => '30',
            'number' =>  '061',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chocamán',
            'state_id' => '30',
            'number' =>  '062',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chontla',
            'state_id' => '30',
            'number' =>  '063',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chumatlán',
            'state_id' => '30',
            'number' =>  '064',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Emiliano Zapata',
            'state_id' => '30',
            'number' =>  '065',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Espinal',
            'state_id' => '30',
            'number' =>  '066',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Filomeno Mata',
            'state_id' => '30',
            'number' =>  '067',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Fortín',
            'state_id' => '30',
            'number' =>  '068',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Gutiérrez Zamora',
            'state_id' => '30',
            'number' =>  '069',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Hidalgotitlán',
            'state_id' => '30',
            'number' =>  '070',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huatusco',
            'state_id' => '30',
            'number' =>  '071',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huayacocotla',
            'state_id' => '30',
            'number' =>  '072',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Hueyapan de Ocampo',
            'state_id' => '30',
            'number' =>  '073',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huiloapan de Cuauhtémoc',
            'state_id' => '30',
            'number' =>  '074',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ignacio de la Llave',
            'state_id' => '30',
            'number' =>  '075',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ilamatlán',
            'state_id' => '30',
            'number' =>  '076',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Isla',
            'state_id' => '30',
            'number' =>  '077',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ixcatepec',
            'state_id' => '30',
            'number' =>  '078',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ixhuacán de los Reyes',
            'state_id' => '30',
            'number' =>  '079',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ixhuatlán del Café',
            'state_id' => '30',
            'number' =>  '080',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ixhuatlancillo',
            'state_id' => '30',
            'number' =>  '081',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ixhuatlán del Sureste',
            'state_id' => '30',
            'number' =>  '082',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ixhuatlán de Madero',
            'state_id' => '30',
            'number' =>  '083',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ixmatlahuacan',
            'state_id' => '30',
            'number' =>  '084',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ixtaczoquitlán',
            'state_id' => '30',
            'number' =>  '085',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jalacingo',
            'state_id' => '30',
            'number' =>  '086',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Xalapa',
            'state_id' => '30',
            'number' =>  '087',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jalcomulco',
            'state_id' => '30',
            'number' =>  '088',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jáltipan',
            'state_id' => '30',
            'number' =>  '089',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jamapa',
            'state_id' => '30',
            'number' =>  '090',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jesús Carranza',
            'state_id' => '30',
            'number' =>  '091',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Xico',
            'state_id' => '30',
            'number' =>  '092',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jilotepec',
            'state_id' => '30',
            'number' =>  '093',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Juan Rodríguez Clara',
            'state_id' => '30',
            'number' =>  '094',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Juchique de Ferrer',
            'state_id' => '30',
            'number' =>  '095',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Landero y Coss',
            'state_id' => '30',
            'number' =>  '096',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Lerdo de Tejada',
            'state_id' => '30',
            'number' =>  '097',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Magdalena',
            'state_id' => '30',
            'number' =>  '098',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Maltrata',
            'state_id' => '30',
            'number' =>  '099',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Manlio Fabio Altamirano',
            'state_id' => '30',
            'number' =>  '100',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mariano Escobedo',
            'state_id' => '30',
            'number' =>  '101',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Martínez de la Torre',
            'state_id' => '30',
            'number' =>  '102',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mecatlán',
            'state_id' => '30',
            'number' =>  '103',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mecayapan',
            'state_id' => '30',
            'number' =>  '104',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Medellín de Bravo',
            'state_id' => '30',
            'number' =>  '105',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Miahuatlán',
            'state_id' => '30',
            'number' =>  '106',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Las Minas',
            'state_id' => '30',
            'number' =>  '107',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Minatitlán',
            'state_id' => '30',
            'number' =>  '108',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Misantla',
            'state_id' => '30',
            'number' =>  '109',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mixtla de Altamirano',
            'state_id' => '30',
            'number' =>  '110',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Moloacán',
            'state_id' => '30',
            'number' =>  '111',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Naolinco',
            'state_id' => '30',
            'number' =>  '112',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Naranjal',
            'state_id' => '30',
            'number' =>  '113',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Nautla',
            'state_id' => '30',
            'number' =>  '114',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Nogales',
            'state_id' => '30',
            'number' =>  '115',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Oluta',
            'state_id' => '30',
            'number' =>  '116',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Omealca',
            'state_id' => '30',
            'number' =>  '117',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Orizaba',
            'state_id' => '30',
            'number' =>  '118',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Otatitlán',
            'state_id' => '30',
            'number' =>  '119',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Oteapan',
            'state_id' => '30',
            'number' =>  '120',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ozuluama de Mascareñas',
            'state_id' => '30',
            'number' =>  '121',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Pajapan',
            'state_id' => '30',
            'number' =>  '122',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Pánuco',
            'state_id' => '30',
            'number' =>  '123',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Papantla',
            'state_id' => '30',
            'number' =>  '124',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Paso del Macho',
            'state_id' => '30',
            'number' =>  '125',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Paso de Ovejas',
            'state_id' => '30',
            'number' =>  '126',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'La Perla',
            'state_id' => '30',
            'number' =>  '127',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Perote',
            'state_id' => '30',
            'number' =>  '128',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Platón Sánchez',
            'state_id' => '30',
            'number' =>  '129',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Playa Vicente',
            'state_id' => '30',
            'number' =>  '130',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Poza Rica de Hidalgo',
            'state_id' => '30',
            'number' =>  '131',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Las Vigas de Ramírez',
            'state_id' => '30',
            'number' =>  '132',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Pueblo Viejo',
            'state_id' => '30',
            'number' =>  '133',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Puente Nacional',
            'state_id' => '30',
            'number' =>  '134',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Rafael Delgado',
            'state_id' => '30',
            'number' =>  '135',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Rafael Lucio',
            'state_id' => '30',
            'number' =>  '136',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Los Reyes',
            'state_id' => '30',
            'number' =>  '137',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Río Blanco',
            'state_id' => '30',
            'number' =>  '138',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Saltabarranca',
            'state_id' => '30',
            'number' =>  '139',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Andrés Tenejapan',
            'state_id' => '30',
            'number' =>  '140',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Andrés Tuxtla',
            'state_id' => '30',
            'number' =>  '141',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Juan Evangelista',
            'state_id' => '30',
            'number' =>  '142',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Tuxtla',
            'state_id' => '30',
            'number' =>  '143',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Sayula de Alemán',
            'state_id' => '30',
            'number' =>  '144',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Soconusco',
            'state_id' => '30',
            'number' =>  '145',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Sochiapa',
            'state_id' => '30',
            'number' =>  '146',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Soledad Atzompa',
            'state_id' => '30',
            'number' =>  '147',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Soledad de Doblado',
            'state_id' => '30',
            'number' =>  '148',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Soteapan',
            'state_id' => '30',
            'number' =>  '149',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tamalín',
            'state_id' => '30',
            'number' =>  '150',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tamiahua',
            'state_id' => '30',
            'number' =>  '151',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tampico Alto',
            'state_id' => '30',
            'number' =>  '152',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tancoco',
            'state_id' => '30',
            'number' =>  '153',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tantima',
            'state_id' => '30',
            'number' =>  '154',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tantoyuca',
            'state_id' => '30',
            'number' =>  '155',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tatatila',
            'state_id' => '30',
            'number' =>  '156',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Castillo de Teayo',
            'state_id' => '30',
            'number' =>  '157',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tecolutla',
            'state_id' => '30',
            'number' =>  '158',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tehuipango',
            'state_id' => '30',
            'number' =>  '159',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Álamo Temapache',
            'state_id' => '30',
            'number' =>  '160',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tempoal',
            'state_id' => '30',
            'number' =>  '161',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tenampa',
            'state_id' => '30',
            'number' =>  '162',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tenochtitlán',
            'state_id' => '30',
            'number' =>  '163',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Teocelo',
            'state_id' => '30',
            'number' =>  '164',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tepatlaxco',
            'state_id' => '30',
            'number' =>  '165',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tepetlán',
            'state_id' => '30',
            'number' =>  '166',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tepetzintla',
            'state_id' => '30',
            'number' =>  '167',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tequila',
            'state_id' => '30',
            'number' =>  '168',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'José Azueta',
            'state_id' => '30',
            'number' =>  '169',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Texcatepec',
            'state_id' => '30',
            'number' =>  '170',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Texhuacán',
            'state_id' => '30',
            'number' =>  '171',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Texistepec',
            'state_id' => '30',
            'number' =>  '172',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tezonapa',
            'state_id' => '30',
            'number' =>  '173',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tierra Blanca',
            'state_id' => '30',
            'number' =>  '174',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tihuatlán',
            'state_id' => '30',
            'number' =>  '175',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlacojalpan',
            'state_id' => '30',
            'number' =>  '176',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlacolulan',
            'state_id' => '30',
            'number' =>  '177',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlacotalpan',
            'state_id' => '30',
            'number' =>  '178',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlacotepec de Mejía',
            'state_id' => '30',
            'number' =>  '179',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlachichilco',
            'state_id' => '30',
            'number' =>  '180',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlalixcoyan',
            'state_id' => '30',
            'number' =>  '181',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlalnelhuayocan',
            'state_id' => '30',
            'number' =>  '182',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlapacoyan',
            'state_id' => '30',
            'number' =>  '183',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlaquilpa',
            'state_id' => '30',
            'number' =>  '184',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlilapan',
            'state_id' => '30',
            'number' =>  '185',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tomatlán',
            'state_id' => '30',
            'number' =>  '186',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tonayán',
            'state_id' => '30',
            'number' =>  '187',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Totutla',
            'state_id' => '30',
            'number' =>  '188',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tuxpan',
            'state_id' => '30',
            'number' =>  '189',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tuxtilla',
            'state_id' => '30',
            'number' =>  '190',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ursulo Galván',
            'state_id' => '30',
            'number' =>  '191',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Vega de Alatorre',
            'state_id' => '30',
            'number' =>  '192',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Veracruz',
            'state_id' => '30',
            'number' =>  '193',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villa Aldama',
            'state_id' => '30',
            'number' =>  '194',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Xoxocotla',
            'state_id' => '30',
            'number' =>  '195',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Yanga',
            'state_id' => '30',
            'number' =>  '196',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Yecuatla',
            'state_id' => '30',
            'number' =>  '197',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zacualpan',
            'state_id' => '30',
            'number' =>  '198',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zaragoza',
            'state_id' => '30',
            'number' =>  '199',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zentla',
            'state_id' => '30',
            'number' =>  '200',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zongolica',
            'state_id' => '30',
            'number' =>  '201',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zontecomatlán de López y Fuentes',
            'state_id' => '30',
            'number' =>  '202',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zozocolco de Hidalgo',
            'state_id' => '30',
            'number' =>  '203',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Agua Dulce',
            'state_id' => '30',
            'number' =>  '204',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'El Higo',
            'state_id' => '30',
            'number' =>  '205',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Nanchital de Lázaro Cárdenas del Río',
            'state_id' => '30',
            'number' =>  '206',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tres Valles',
            'state_id' => '30',
            'number' =>  '207',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Carlos A. Carrillo',
            'state_id' => '30',
            'number' =>  '208',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tatahuicapan de Juárez',
            'state_id' => '30',
            'number' =>  '209',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Uxpanapa',
            'state_id' => '30',
            'number' =>  '210',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Rafael',
            'state_id' => '30',
            'number' =>  '211',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santiago Sochiapan',
            'state_id' => '30',
            'number' =>  '212',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Abalá',
            'state_id' => '31',
            'number' =>  '001',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Acanceh',
            'state_id' => '31',
            'number' =>  '002',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Akil',
            'state_id' => '31',
            'number' =>  '003',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Baca',
            'state_id' => '31',
            'number' =>  '004',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Bokobá',
            'state_id' => '31',
            'number' =>  '005',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Buctzotz',
            'state_id' => '31',
            'number' =>  '006',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cacalchén',
            'state_id' => '31',
            'number' =>  '007',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Calotmul',
            'state_id' => '31',
            'number' =>  '008',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cansahcab',
            'state_id' => '31',
            'number' =>  '009',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cantamayec',
            'state_id' => '31',
            'number' =>  '010',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Celestún',
            'state_id' => '31',
            'number' =>  '011',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cenotillo',
            'state_id' => '31',
            'number' =>  '012',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Conkal',
            'state_id' => '31',
            'number' =>  '013',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cuncunul',
            'state_id' => '31',
            'number' =>  '014',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cuzamá',
            'state_id' => '31',
            'number' =>  '015',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chacsinkín',
            'state_id' => '31',
            'number' =>  '016',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chankom',
            'state_id' => '31',
            'number' =>  '017',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chapab',
            'state_id' => '31',
            'number' =>  '018',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chemax',
            'state_id' => '31',
            'number' =>  '019',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chicxulub Pueblo',
            'state_id' => '31',
            'number' =>  '020',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chichimilá',
            'state_id' => '31',
            'number' =>  '021',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chikindzonot',
            'state_id' => '31',
            'number' =>  '022',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chocholá',
            'state_id' => '31',
            'number' =>  '023',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chumayel',
            'state_id' => '31',
            'number' =>  '024',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Dzán',
            'state_id' => '31',
            'number' =>  '025',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Dzemul',
            'state_id' => '31',
            'number' =>  '026',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Dzidzantún',
            'state_id' => '31',
            'number' =>  '027',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Dzilam de Bravo',
            'state_id' => '31',
            'number' =>  '028',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Dzilam González',
            'state_id' => '31',
            'number' =>  '029',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Dzitás',
            'state_id' => '31',
            'number' =>  '030',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Dzoncauich',
            'state_id' => '31',
            'number' =>  '031',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Espita',
            'state_id' => '31',
            'number' =>  '032',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Halachó',
            'state_id' => '31',
            'number' =>  '033',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Hocabá',
            'state_id' => '31',
            'number' =>  '034',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Hoctún',
            'state_id' => '31',
            'number' =>  '035',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Homún',
            'state_id' => '31',
            'number' =>  '036',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huhí',
            'state_id' => '31',
            'number' =>  '037',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Hunucmá',
            'state_id' => '31',
            'number' =>  '038',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ixil',
            'state_id' => '31',
            'number' =>  '039',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Izamal',
            'state_id' => '31',
            'number' =>  '040',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Kanasín',
            'state_id' => '31',
            'number' =>  '041',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Kantunil',
            'state_id' => '31',
            'number' =>  '042',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Kaua',
            'state_id' => '31',
            'number' =>  '043',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Kinchil',
            'state_id' => '31',
            'number' =>  '044',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Kopomá',
            'state_id' => '31',
            'number' =>  '045',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mama',
            'state_id' => '31',
            'number' =>  '046',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Maní',
            'state_id' => '31',
            'number' =>  '047',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Maxcanú',
            'state_id' => '31',
            'number' =>  '048',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mayapán',
            'state_id' => '31',
            'number' =>  '049',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mérida',
            'state_id' => '31',
            'number' =>  '050',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mocochá',
            'state_id' => '31',
            'number' =>  '051',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Motul',
            'state_id' => '31',
            'number' =>  '052',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Muna',
            'state_id' => '31',
            'number' =>  '053',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Muxupip',
            'state_id' => '31',
            'number' =>  '054',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Opichén',
            'state_id' => '31',
            'number' =>  '055',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Oxkutzcab',
            'state_id' => '31',
            'number' =>  '056',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Panabá',
            'state_id' => '31',
            'number' =>  '057',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Peto',
            'state_id' => '31',
            'number' =>  '058',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Progreso',
            'state_id' => '31',
            'number' =>  '059',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Quintana Roo',
            'state_id' => '31',
            'number' =>  '060',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Río Lagartos',
            'state_id' => '31',
            'number' =>  '061',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Sacalum',
            'state_id' => '31',
            'number' =>  '062',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Samahil',
            'state_id' => '31',
            'number' =>  '063',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Sanahcat',
            'state_id' => '31',
            'number' =>  '064',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'San Felipe',
            'state_id' => '31',
            'number' =>  '065',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa Elena',
            'state_id' => '31',
            'number' =>  '066',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Seyé',
            'state_id' => '31',
            'number' =>  '067',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Sinanché',
            'state_id' => '31',
            'number' =>  '068',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Sotuta',
            'state_id' => '31',
            'number' =>  '069',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Sucilá',
            'state_id' => '31',
            'number' =>  '070',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Sudzal',
            'state_id' => '31',
            'number' =>  '071',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Suma',
            'state_id' => '31',
            'number' =>  '072',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tahdziú',
            'state_id' => '31',
            'number' =>  '073',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tahmek',
            'state_id' => '31',
            'number' =>  '074',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Teabo',
            'state_id' => '31',
            'number' =>  '075',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tecoh',
            'state_id' => '31',
            'number' =>  '076',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tekal de Venegas',
            'state_id' => '31',
            'number' =>  '077',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tekantó',
            'state_id' => '31',
            'number' =>  '078',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tekax',
            'state_id' => '31',
            'number' =>  '079',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tekit',
            'state_id' => '31',
            'number' =>  '080',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tekom',
            'state_id' => '31',
            'number' =>  '081',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Telchac Pueblo',
            'state_id' => '31',
            'number' =>  '082',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Telchac Puerto',
            'state_id' => '31',
            'number' =>  '083',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Temax',
            'state_id' => '31',
            'number' =>  '084',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Temozón',
            'state_id' => '31',
            'number' =>  '085',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tepakán',
            'state_id' => '31',
            'number' =>  '086',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tetiz',
            'state_id' => '31',
            'number' =>  '087',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Teya',
            'state_id' => '31',
            'number' =>  '088',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ticul',
            'state_id' => '31',
            'number' =>  '089',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Timucuy',
            'state_id' => '31',
            'number' =>  '090',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tinum',
            'state_id' => '31',
            'number' =>  '091',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tixcacalcupul',
            'state_id' => '31',
            'number' =>  '092',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tixkokob',
            'state_id' => '31',
            'number' =>  '093',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tixmehuac',
            'state_id' => '31',
            'number' =>  '094',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tixpéhual',
            'state_id' => '31',
            'number' =>  '095',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tizimín',
            'state_id' => '31',
            'number' =>  '096',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tunkás',
            'state_id' => '31',
            'number' =>  '097',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tzucacab',
            'state_id' => '31',
            'number' =>  '098',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Uayma',
            'state_id' => '31',
            'number' =>  '099',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ucú',
            'state_id' => '31',
            'number' =>  '100',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Umán',
            'state_id' => '31',
            'number' =>  '101',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Valladolid',
            'state_id' => '31',
            'number' =>  '102',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Xocchel',
            'state_id' => '31',
            'number' =>  '103',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Yaxcabá',
            'state_id' => '31',
            'number' =>  '104',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Yaxkukul',
            'state_id' => '31',
            'number' =>  '105',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Yobaín',
            'state_id' => '31',
            'number' =>  '106',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Apozol',
            'state_id' => '32',
            'number' =>  '001',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Apulco',
            'state_id' => '32',
            'number' =>  '002',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Atolinga',
            'state_id' => '32',
            'number' =>  '003',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Benito Juárez',
            'state_id' => '32',
            'number' =>  '004',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Calera',
            'state_id' => '32',
            'number' =>  '005',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cañitas de Felipe Pescador',
            'state_id' => '32',
            'number' =>  '006',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Concepción del Oro',
            'state_id' => '32',
            'number' =>  '007',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Cuauhtémoc',
            'state_id' => '32',
            'number' =>  '008',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Chalchihuites',
            'state_id' => '32',
            'number' =>  '009',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Fresnillo',
            'state_id' => '32',
            'number' =>  '010',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Trinidad García de la Cadena',
            'state_id' => '32',
            'number' =>  '011',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Genaro Codina',
            'state_id' => '32',
            'number' =>  '012',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'General Enrique Estrada',
            'state_id' => '32',
            'number' =>  '013',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'General Francisco R. Murguía',
            'state_id' => '32',
            'number' =>  '014',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'El Plateado de Joaquín Amaro',
            'state_id' => '32',
            'number' =>  '015',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'General Pánfilo Natera',
            'state_id' => '32',
            'number' =>  '016',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Guadalupe',
            'state_id' => '32',
            'number' =>  '017',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Huanusco',
            'state_id' => '32',
            'number' =>  '018',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jalpa',
            'state_id' => '32',
            'number' =>  '019',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jerez',
            'state_id' => '32',
            'number' =>  '020',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Jiménez del Teul',
            'state_id' => '32',
            'number' =>  '021',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Juan Aldama',
            'state_id' => '32',
            'number' =>  '022',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Juchipila',
            'state_id' => '32',
            'number' =>  '023',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Loreto',
            'state_id' => '32',
            'number' =>  '024',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Luis Moya',
            'state_id' => '32',
            'number' =>  '025',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mazapil',
            'state_id' => '32',
            'number' =>  '026',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Melchor Ocampo',
            'state_id' => '32',
            'number' =>  '027',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Mezquital del Oro',
            'state_id' => '32',
            'number' =>  '028',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Miguel Auza',
            'state_id' => '32',
            'number' =>  '029',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Momax',
            'state_id' => '32',
            'number' =>  '030',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Monte Escobedo',
            'state_id' => '32',
            'number' =>  '031',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Morelos',
            'state_id' => '32',
            'number' =>  '032',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Moyahua de Estrada',
            'state_id' => '32',
            'number' =>  '033',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Nochistlán de Mejía',
            'state_id' => '32',
            'number' =>  '034',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Noria de Ángeles',
            'state_id' => '32',
            'number' =>  '035',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Ojocaliente',
            'state_id' => '32',
            'number' =>  '036',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Pánuco',
            'state_id' => '32',
            'number' =>  '037',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Pinos',
            'state_id' => '32',
            'number' =>  '038',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Río Grande',
            'state_id' => '32',
            'number' =>  '039',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Sain Alto',
            'state_id' => '32',
            'number' =>  '040',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'El Salvador',
            'state_id' => '32',
            'number' =>  '041',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Sombrerete',
            'state_id' => '32',
            'number' =>  '042',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Susticacán',
            'state_id' => '32',
            'number' =>  '043',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tabasco',
            'state_id' => '32',
            'number' =>  '044',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tepechitlán',
            'state_id' => '32',
            'number' =>  '045',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tepetongo',
            'state_id' => '32',
            'number' =>  '046',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Teúl de González Ortega',
            'state_id' => '32',
            'number' =>  '047',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Tlaltenango de Sánchez Román',
            'state_id' => '32',
            'number' =>  '048',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Valparaíso',
            'state_id' => '32',
            'number' =>  '049',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Vetagrande',
            'state_id' => '32',
            'number' =>  '050',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villa de Cos',
            'state_id' => '32',
            'number' =>  '051',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villa García',
            'state_id' => '32',
            'number' =>  '052',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villa González Ortega',
            'state_id' => '32',
            'number' =>  '053',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villa Hidalgo',
            'state_id' => '32',
            'number' =>  '054',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Villanueva',
            'state_id' => '32',
            'number' =>  '055',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Zacatecas',
            'state_id' => '32',
            'number' =>  '056',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Trancoso',
            'state_id' => '32',
            'number' =>  '057',
        ]);
        factory(Municipality::class)->create([
            'name' =>  'Santa María de la Paz',
            'state_id' => '32',
            'number' =>  '058',
        ]);
    }
}

