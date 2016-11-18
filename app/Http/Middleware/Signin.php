<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\DB;
use Closure;

class Signin
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
      if(($request->no_key!="on" && $request->tfa=="") || !(array_search($request->stuNbr,DB::table("students")->pluck("studentID"))))
      {
        return $next($request);
      }
      $expectedKey = DB::table("students AS a")
        ->join("users AS b","a.teacher","=","b.name")->where("a.studentID",$request->stuNbr)->pluck("tfa_key")[0];
      
      $dt = new \DateTime();
      $updateRequest = ["timeIn"=>$dt->getTimestamp()];
      if(($request->no_key == "on" && $expectedKey != $request->tfa))
      {
        $updateRequest["unconfirmed"] = true;
      }
        DB::table("studentTimeTable AS a")
          ->join(DB::raw("(SELECT studentID, MAX(timeOut) max_time FROM studentTimeTable GROUP BY studentID) `b`"), "a.studentID","=","b.studentID")
          ->where("timeOut",DB::raw("`max_time`"))
          ->where("a.studentID", (int)$request->stuNbr)
          ->update($updateRequest); 
        return $next($request);
    }
}
