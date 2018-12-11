<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserTableSeeder::class);

        // Connect to production database
     $live_database = DB::connection('mysql');

     // Get table data from production
     

//if ($this->command->confirm('Records Transfered To History,Do you wish to delete all old data ?')) {

            foreach($live_database->table('terminalscores')->where('SchoolCode',auth()->user()->SchoolCode)->get() as $data){

        // Save data to staging database - default db connection
        DB::table('previousScores')->insert((array) $data);

    DB::table('terminalscores')->where('SchoolCode',auth()->user()->SchoolCode)->delete();

      // $output = new \Symfony\Component\Console\Output\ConsoleOutput(2);
      //   $output->writeln("Seeding table with file");

    }

          //  $this->command->line("Data cleared, starting from blank database.");
 //}



    $live_database = DB::connection('mysql');

     // Get table data from production
     foreach($live_database->table('studentperformances')->where('SchoolCode',auth()->user()->SchoolCode)->get() as $data){

        // Save data to staging database - default db connection
        DB::table('previousStudentperformances')->insert((array) $data);  

        DB::table('studentperformances')->where('SchoolCode',auth()->user()->SchoolCode)->delete(); 

    }


        

    $live_database = DB::connection('mysql');

     // Get table data from production
     foreach($live_database->table('students')->where('SchoolCode',auth()->user()->SchoolCode)->get() as $data){

        // Save data to staging database - default db connection
        DB::table('previousStudentsReccords')->insert((array) $data);
    }

    
    

    }
}
