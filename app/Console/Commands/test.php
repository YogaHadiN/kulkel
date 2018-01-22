<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Perpus;

class test extends Command
{
    /**
     * The name and signature of the console command.
     *

class test extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

		$data = [
			[
				'pre' => 'asl',
				'ids' => [
					'12',
					'36',
					'57',
					'43',
					'17',
					'22',
					'28',
					'19',
					'33',
					'7',
					'29',
					'42',
					'10',
					'108',
					'25',
					'16',
					'15',
					'52',
					'14',
					'92',
					'95',
					'114',
					'148',
					'65',
					'78',
					'71',
					'69',
					'131',
					'124',
					'153',
					'66',
					'67',
					'152',
					'111',
					'139',
					'120',
					'99',
					'119',
					'87',
					'103',
					'129',
					'24',
					'83',
					'21',
					'135',
					'94',
					'134',
					'149',
					'150',
					'139',
					'133',
					'137',
					'45',
					'72',
					'70',
					'46',
					'105',
					'151',
					'74',
					'89',
					'104',
					'126',
					'61',
					'60',
					'63',
					'67',
					'118',
					'97',
					'81',
					'96',
					'62',
					'79',
					'155',
					'130',
					'75',
					'73',
					'121',
					'58',
					'154',
					'9',
					'100',
					'106',
					'84'
				]
			],
			[
				'pre' => 'du',
				'ids' =>[
					'68',
					'74',
					'70',
					'84',
					'161',
					'172',
					'170',
					'167',
					'168',
					'159',
					'142',
					'154',
					'150',
					'158',
					'171'
				]
			],
			[
				'pre' => 'ind-du',
				'ids' => [
					'46',
					'62',
					'65',
					'66',
					'54',
					'66',
					'53',
					'14',
					'40'
				]
			],
			[
				'pre' => 'ind-miko',
				'ids' => [6]
			],
			[
				'pre' => 'bdh',
				'ids' => [
					'1',
					'42',
					'51',
					'52'
				]
			],
			[
				'pre' => 'mh',
				'ids' => [ 30 ]
			],
			[
				'pre' => 'ped',
				'ids' => [
					'35',
					'36',
					'38',
					'32'
				]
			], 
			[
				'pre' => 'ALRG',
				'ids' => [
					'44',
					'27',
					'34',
					'28',
					'32'
				]
			],
			[
				'pre' => 'ind-ims',
				'ids' => [ 13 ]
			],
			[
				'pre' => 'ind-bdh',
				'ids' => [
					'20',
					'22',
					'11'
				]
			],
			[
				'pre' => 'ind-kosm',
				'ids' => [
					'30',
					'38',
					'40',
					'42',
					'36',
					'41',
					'10'
				]
			],
			[
				'pre' => 'ind-alrg',
				'ids' =>  [
					'17',
					'11',
					'14',
					'13'
				]
			],
			[
				'pre' => 'miko',
				'ids' => [
					'25',
					'29',
					'30',
					'27'
				]
			],
			[
				'pre' => 'pa',
				'ids' => [
					'1',
					'2',
					'3',
					'6'
				]
			],
			[
				'pre' => 'cosm',
				'ids' => [ 66 ]
			], 
			[
				'pre' => 'text',
				'ids' => [
					'51',
					'57',
					'59',
					'60',
					'67',
					'71',
					'72',
					'73',
					'74',
					'75'
				]
			], [
				'pre' => 'std',
				'ids' => [
					'54',
					'57',
					'58',
					'60'
				]
			]
		];

		$ketemu = [];
		$tidak_ketemu = [];
		$ids   = [];
		foreach ($data as $d) {
			foreach ($d['ids'] as $id) {
					/* return dd(Perpus::where('id', 'like', '%' . $d['pre'] . '%')->where('id', 'like', '%' . $id . '%')->get()); */
				try {
					$ketemu[] = Perpus::where('nomor_buku', 'like', '%' . $d['pre'] . '%')->where('nomor_buku', 'like', '%' . $id . '%')->first()->nama_buku;
					
				} catch (\Exception $e) {
					$tidak_ketemu[] = [
						'pre' => $d['pre'],
						'id' => $id
					];
				}
			}
		}
		return dd(
			[
				$ketemu,
				$tidak_ketemu
			]
		);


    }
}
