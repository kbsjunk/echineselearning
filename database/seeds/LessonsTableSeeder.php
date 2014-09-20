<?php namespace Kitbs\Echineselearning\Database\Seeds;

use DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class LessonsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		DB::table('ecl_lessons')->truncate();

		$bookings = array(
			array('date'=>'2012-04-17','starttime'=>'21:00:00','timezone'=>'+10:00','teacher'=>'wendy','cancelled'=>0),
			array('date'=>'2012-04-25','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>'beverly','cancelled'=>0),
			array('date'=>'2012-04-23','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2012-04-18','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>1),
			array('date'=>'2012-04-11','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>'beverly','cancelled'=>1),
			array('date'=>'2012-04-17','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>'wendy','cancelled'=>0),
			array('date'=>'2012-04-10','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>1),
			array('date'=>'2012-04-09','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2012-04-03','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>'malia','cancelled'=>0),
			array('date'=>'2012-03-30','starttime'=>'19:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2012-03-28','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2012-03-26','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>1),
			array('date'=>'2012-03-07','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2012-03-12','starttime'=>'19:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2012-03-09','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2012-05-04','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2012-05-07','starttime'=>'19:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2012-05-09','starttime'=>'19:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>1),
			array('date'=>'2012-05-14','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>1),
			array('date'=>'2012-06-06','starttime'=>'19:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2012-06-08','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>1),
			array('date'=>'2012-06-10','starttime'=>'18:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2012-06-11','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2012-06-18','starttime'=>'19:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2012-06-20','starttime'=>'19:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2012-06-25','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2012-06-27','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>1),
			array('date'=>'2012-07-02','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2012-07-04','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2012-07-09','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2012-07-11','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2012-07-18','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2012-07-20','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>1),
			array('date'=>'2012-07-23','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2012-07-25','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2012-07-30','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2012-08-01','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2012-08-06','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2012-08-08','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2012-08-12','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2012-08-13','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2013-01-28','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2013-01-18','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2013-02-06','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>1),
			array('date'=>'2013-01-17','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>1),
			array('date'=>'2013-01-30','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>1),
			array('date'=>'2012-01-23','starttime'=>'19:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2013-02-25','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2013-02-04','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2013-02-20','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>1),
			array('date'=>'2013-03-04','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2013-03-13','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>1),
			array('date'=>'2013-02-19','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>'beverly','cancelled'=>0),
			array('date'=>'2013-03-30','starttime'=>'16:00:00','timezone'=>'+10:00','teacher'=>'delia','cancelled'=>0),
			array('date'=>'2013-04-02','starttime'=>'13:00:00','timezone'=>'+10:00','teacher'=>'lea','cancelled'=>0),
			array('date'=>'2013-04-09','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>'alisa','cancelled'=>0),
			array('date'=>'2013-04-15','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2013-04-22','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2013-04-29','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2013-05-06','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2013-05-13','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>1),
			array('date'=>'2013-05-17','starttime'=>'19:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2013-05-27','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2013-06-03','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2013-05-20','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2013-06-17','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>1),
			array('date'=>'2013-06-24','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2013-07-01','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2013-06-20','starttime'=>'21:00:00','timezone'=>'+10:00','teacher'=>'alina','cancelled'=>0),
			array('date'=>'2013-08-07','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>'georgiana','cancelled'=>0),
			array('date'=>'2013-08-12','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2013-08-19','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2013-09-02','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2013-09-09','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>1),
			array('date'=>'2013-09-26','starttime'=>'21:00:00','timezone'=>'+10:00','teacher'=>'alina','cancelled'=>0),
			array('date'=>'2013-09-30','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2013-10-10','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>'maddie','cancelled'=>0),
			array('date'=>'2013-10-16','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2013-10-24','starttime'=>'19:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>1),
			array('date'=>'2013-10-28','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2013-11-04','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2013-11-13','starttime'=>'19:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>1),
			array('date'=>'2013-11-20','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2013-11-25','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2013-12-04','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2013-12-09','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2014-01-03','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>1),
			array('date'=>'2014-01-06','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2014-01-13','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2014-01-20','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2014-01-29','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2014-02-07','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2014-02-10','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2014-02-17','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2014-02-26','starttime'=>'19:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2014-03-05','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2014-03-12','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>1),
			array('date'=>'2014-03-10','starttime'=>'19:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2014-03-26','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2014-04-02','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>1),
			array('date'=>'2014-04-16','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2014-04-23','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2014-05-12','starttime'=>'19:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2014-05-19','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2014-05-28','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2014-06-04','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>1),
			array('date'=>'2014-06-11','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>1),
			array('date'=>'2014-06-09','starttime'=>'18:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>1),
			array('date'=>'2014-06-16','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>1),
			array('date'=>'2014-06-23','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2014-06-30','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2014-07-07','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2014-07-14','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>1),
			array('date'=>'2014-07-21','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2014-07-28','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2014-08-04','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2014-08-11','starttime'=>'21:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2014-08-18','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2014-08-25','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2014-09-05','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2014-09-07','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>'Ruby','cancelled'=>0),
			array('date'=>'2014-09-18','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>'Helena','cancelled'=>1),
			array('date'=>'2014-09-22','starttime'=>'19:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2014-09-29','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0),
			array('date'=>'2014-10-10','starttime'=>'20:00:00','timezone'=>'+10:00','teacher'=>null,'cancelled'=>0)
			);

$now = new Carbon;

foreach($bookings as $lesson)
{

	// $datetime = strtotime($lesson['date'] . ' ' . $lesson['starttime'] . ''. $lesson['timezone']);

	$teacher = empty($lesson['teacher']) ? null : ucfirst($lesson['teacher']);

	DB::table('ecl_lessons')->insert([
		'lesson_at' => new Carbon($lesson['date'] . ' ' . $lesson['starttime'] . $lesson['timezone']),
		'teacher' => $teacher,
		'enabled' => !$lesson['cancelled'],
		'created_at' => $now,
		'updated_at' => $now,
		]);
}

}

}
