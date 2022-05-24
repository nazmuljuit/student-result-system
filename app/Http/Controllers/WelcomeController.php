<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use DB;

class WelcomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function subject()
    {
        
        return view('subject');
        
    }
    public function subjectList()
    {
       $subjects = DB::table('subjects')->select('suid', 'su_name')->where(['status' => 1])->get(); 
     return json_encode($subjects);   
    }
 
    public function addSubject(Request $request)
    {
       $addsub = DB::table('subjects')->insert(
                  ['su_name' => $request['su_name']]
                  );
        
        return response($request);
    }

    public function deleteSubject($id)
    {
      $deSub =  DB::table('subjects')
            ->where('suid',$id)
            ->update(['status' => 0]);
      return response($deSub);      
    }

    public function addStudent(Request $request)
    {
       $addsub = DB::table('students')->insert(
                  ['st_name' => $request['student'],
                  'father' => $request['father'],
                  'mother' => $request['mother']]
                  );

        return response($request);
    }

     public function studentList()
    {
       $data['students'] = DB::table('students')->select('students.*')->get();
       $data['subjectCount'] = DB::table('subjects')
                               ->select(DB::raw('count(suid) as totalSubject'))
                               ->where('status',1)->get(); 
     return response($data);   
    }

    public function addMark(Request $request)
    {

      //$myrec = dd($request->all());
      $result = 0;
      $fail_subject_count = 0;
      for($i = 0;$i<count($request['subjects']);$i++)
      {
                 /*gpa set up*/
                if($request['subjects'][$i]['mark']<33)
                {
                  $gpa =  0;
                  $result = $result + $gpa;
                  $fail_subject_count = $fail_subject_count + 1;
                }
                elseif($request['subjects'][$i]['mark']>=33 && $request['subjects'][$i]['mark']<40)
                {
                  $gpa =  1;
                  $result = $result + $gpa;
                }
                elseif($request['subjects'][$i]['mark']>=40 && $request['subjects'][$i]['mark']<50)
                {
                  $gpa =  2;
                  $result = $result + $gpa;
                }
                elseif($request['subjects'][$i]['mark']>=50 && $request['subjects'][$i]['mark']<60)
                {
                  $gpa =  3;
                  $result = $result + $gpa;
                }
                elseif($request['subjects'][$i]['mark']>=60 && $request['subjects'][$i]['mark']<70)
                {
                  $gpa =  3.5;
                  $result = $result + $gpa;
                }
                elseif($request['subjects'][$i]['mark']>=70 && $request['subjects'][$i]['mark']<80)
                {
                  $gpa =  4;
                  $result = $result + $gpa;
                } 
                elseif($request['subjects'][$i]['mark']>=80)
                {
                  $gpa =  5;
                  $result = $result + $gpa;
                }       
                $addmark = DB::table('marks')->insert(
                          ['sid' => $request['student_id'],
                          'suid' => $request['subjects'][$i]['suid'],
                          'mark' => $request['subjects'][$i]['mark'],
                          'gpa'  => $gpa]
                          );
                $deSub =  DB::table('students')
                    ->where('sid',$request['student_id'])
                    ->update(['is_mark' => 1]);
          
      }
      /*create result*/
      if($fail_subject_count > 0)
      {
        $resultGpa = 0;
        $grade = "F";
      }
      else
      {
        $resultGpa = $result/count($request['subjects']);
        if($resultGpa>=1 && $resultGpa <2)
        {
          $grade = "D";
        }
        elseif($resultGpa>=2 && $resultGpa <3)
        {
          $grade = "C";
        }
        elseif($resultGpa>=3 && $resultGpa <3.5)
        {
          $grade = "B";
        }
        elseif($resultGpa>=3.5 && $resultGpa <4)
        {
          $grade = "A-";
        }
        elseif($resultGpa>=4 && $resultGpa <5)
        {
          $grade = "A";
        }
        elseif($resultGpa>=5)
        {
          $grade = "A+";
        }

      }
      /*Result can not be greater than 5*/
      if($resultGpa>5)
      {
        $resultGpa = floor($resultGpa);

      } 

      $result = DB::table('result')->insert(
                          ['student_id' => $request['student_id'],
                          'gpa' => $resultGpa,
                          'grade' => $grade,
                          'fail_subject_count'  => $fail_subject_count]
                          );

      return response($request);
    }

    public function markList()
    {

      $data['subjectList'] = DB::table('subjects')->where(['status' => 1])->get(); 
      $data['studentList'] = DB::table('students')->get(); 
      $studentMarks = DB::table('marks')->get(); 
      $result_query =  DB::table('result')->get();
                  
      // student marks refactor
      $studentMarkArray = [];
      
      foreach ($studentMarks as $v) {
         $studentMarkArray[$v->sid][$v->suid]  = $v;
         
      }
      $result = [];
      foreach ($result_query as $v) {
         
         $result[$v->student_id]  = $v;
      }

      $data['marks']    = $studentMarkArray;
      $data['result']    = $result;

            
     return response($data); 
     //return json_encode($marks); 
    }


    public function viewStudentResultById(Request $request)
    {
      $data['studentName'] = DB::table('students')->where(['sid'=>$request['student_id']])->get(); 
      $studentMarks = DB::table('marks')->where(['sid'=>$request['student_id']])->get(); 
      $result_query =  DB::table('result')->where(['student_id'=>$request['student_id']])->get();

      $studentMarkArray = [];
      
      foreach ($studentMarks as $v) {
         $studentMarkArray[$v->suid]  = $v;
         
      }

      $data['student_mark']    = $studentMarkArray;
      $data['student_result']    = $result_query;
      
            
     return response($data); 
    }

    /*Mark Input of all students*/
    public function addAllStudentMark(Request $request)
    {
      //dd($request['students']);exit();
      
      for($i = 0;$i < count($request['students']);$i++)
      {
      
        foreach ($request['students'][$i] as $isNumOfSub => $value) 
        {
          if(is_integer($isNumOfSub))
          {
            $result = 0;
            $fail_subject_count = 0;
            $numOfSub = $isNumOfSub;
            $marksData = $request['students'][$i];

             //var_dump($marksData);
         
             for($j = 0;$j < $numOfSub;$j++)
               {
                if(isset($marksData[$numOfSub][$j]) && !empty($marksData[$numOfSub][$j]))
                {
            
         
        
                 $subId = array_keys($marksData[$numOfSub][$j]);
                 //var_dump($subId);
                 $mark = $marksData[$numOfSub][$j][$subId[0]]['mark'];
                 /*gpa set up*/
                   if($mark<33)
                    {
                       $gpa =  0;
                      $result = $result + $gpa;
                      $fail_subject_count = $fail_subject_count + 1;
                      }
                      elseif($mark>=33 && $mark<40)
                      {
                        $gpa =  1;
                        $result = $result + $gpa;
                      }
                      elseif($mark>=40 && $mark<50)
                      {
                        $gpa =  2;
                        $result = $result + $gpa;
                      }
                      elseif($mark>=50 && $mark<60)
                      {
                        $gpa =  3;
                        $result = $result + $gpa;
                      }
                      elseif($mark>=60 && $mark<70)
                      {
                        $gpa =  3.5;
                        $result = $result + $gpa;
                      }
                      elseif($mark>=70 && $mark<80)
                      {
                        $gpa =  4;
                        $result = $result + $gpa;
                      } 
                      elseif($mark>=80)
                      {
                        $gpa =  5;
                        $result = $result + $gpa;
                      }  
                      
                      $addmark = DB::table('marks')->insert(
                                ['sid' => $marksData['sid'],
                                'suid' => $subId[0],
                                'mark' => $mark,
                                'gpa'  => $gpa]
                                );
         
           
                   }
                  //end conditon of is not empty
                }
       
               //end for loop of $j
               
                    /*create result*/
              if($fail_subject_count > 0)
              {
                $resultGpa = 0;
                $grade = "F";
              }
              else
              {
                $resultGpa = $result/$numOfSub;
                if($resultGpa>=1 && $resultGpa <2)
                {
                  $grade = "D";
                }
                elseif($resultGpa>=2 && $resultGpa <3)
                {
                  $grade = "C";
                }
                elseif($resultGpa>=3 && $resultGpa <3.5)
                {
                  $grade = "B";
                }
                elseif($resultGpa>=3.5 && $resultGpa <4)
                {
                  $grade = "A-";
                }
                elseif($resultGpa>=4 && $resultGpa <5)
                {
                  $grade = "A";
                }
                elseif($resultGpa>=5)
                {
                  $grade = "A+";
                }

              }
              /*Result can not be greater than 5*/
              if($resultGpa>5)
              {
                $resultGpa = floor($resultGpa);

              } 

              $result = DB::table('result')->insert(
                                  ['student_id' => $marksData['sid'],
                                  'gpa' => $resultGpa,
                                  'grade' => $grade,
                                  'fail_subject_count'  => $fail_subject_count]
                                  );





            }
            //end conditon
          }
        //end foreach loop
          
         
      }
      //end for loop of $i
             
      //return response();
    }
//end function
  

}
