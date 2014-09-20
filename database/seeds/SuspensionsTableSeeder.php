<?php namespace Kitbs\Echineselearning\Database\Seeds;

use DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SuspensionsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$suspensions = array(
			array('start_at'=>'2012-05-08','end_at'=>'2012-05-29'),
			array('start_at'=>'2013-03-13','end_at'=>'2013-03-27'),
			array('start_at'=>'2013-07-08','end_at'=>'2013-07-24'),
			array('start_at'=>'2013-07-25','end_at'=>'2013-08-04'),
			array('start_at'=>'2013-08-25','end_at'=>'2013-08-31'),
			array('start_at'=>'2013-09-13','end_at'=>'2013-09-25'),
			array('start_at'=>'2013-11-07','end_at'=>'2013-11-19'),
			array('start_at'=>'2013-12-16','end_at'=>'2013-12-31'),
			array('start_at'=>'2014-03-30','end_at'=>'2014-04-13'),
			array('start_at'=>'2014-04-28','end_at'=>'2014-05-11'),
			array('start_at'=>'2014-06-02','end_at'=>'2014-06-08')
			);

		DB::table('ecl_suspensions')->truncate();

		$now = new Carbon;

		foreach ($suspensions as &$suspension) {
			$suspension['created_at'] = $now;
			$suspension['updated_at'] = $now;
		}

		DB::table('ecl_suspensions')->insert($suspensions);
	}

}
