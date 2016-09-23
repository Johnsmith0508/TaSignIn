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
