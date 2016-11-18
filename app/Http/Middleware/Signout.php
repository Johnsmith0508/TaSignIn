<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\DB;
use Closure;

class Signout
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $teachers = DB::table('users')->pluck('name');
        $teacherExists = false;  
      foreach($teachers as $teacher){
          if($teacher == $request->tchr) $teacherExists=true;
        }
      if(!$teacherExists) return $next($request);
      $dt = new \DateTime();
      DB::table('studentTimeTable')->insert(["studentID" => $request->stuNbr , "timeOut" => $dt->getTimestamp()]);
      //if student is not in 'students' table already
      if(!DB::table('students')->where('studentID','=',(int)$request->stuNbr)->get()){
         DB::table('students')->insert(['studentID' => (int)$request->stuNbr , 'teacher' => $request->tchr]);
      }
      return $next($request);
    }
}
//DB::raw('UPDATE studentTimeTable a INNER JOIN ( SELECT studentID, MAX(timeOut) max_time FROM studentTimeTable GROUP BY studentID) b ON a.studentID = b.studentID WHERE a.studentID = "78" AND timeOut = max_time SET timeIn = ' . new \DateTime->getTimestamp() . ';'
        #UPDATE studentTimeTable a INNER JOIN ( SELECT studentID, MAX(timeOut) max_time FROM studentTimeTable GROUP BY studentID) b ON a.studentID = b.studentID WHERE a.studentID = '78' AND timeOut = max_time SET;    
//db->query("SELECT * FROM table WHERE name ='%1'" , $name);
/*asd*/
//DB::table("studentTimeTable")->where("studentId", "=", $request->stuNbr)->