<?php

namespace App\Http\Controllers;

use App\Poll;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class pollController extends Controller
{
    private $browsers=array('Please choose your favorite browser','Chrome','FireFox','Internet Explorer','Konqueror','Lynx','Opera','Safari');
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // 1=Chrome, 2=FireFox, 3=Internet Explorer, 4=Konqueror, 5=Lynx, 6=Opera, 7=Safari
        $browsers=$this->browsers;
        return view('poll.index',compact('browsers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputData=$request->all();
        $user_browser=get_browser($_SERVER['HTTP_USER_AGENT'])->browser;
        //Get the browser code that the user is using
        $user_browser_array=preg_grep('/'.$user_browser.'/i',$this->browsers);
        reset($user_browser_array);
        $user_browser_code=key($user_browser_array);
        //add it to the input values
        $inputData['user_browser_code']=is_null($user_browser_code)? 0 :$user_browser_code;
        if(Poll::where('email',$inputData['email'])->exists()){
            //your email exist, update the record
            unset($inputData['_token']);
            Poll::where('email',$inputData['email'])->update($inputData);
            //Get the id and fetch the record by id
            $poll_id=Poll::where('email',$inputData['email'])->pluck('id');
            $poll=Poll::find($poll_id);
        }else{
            $poll=Poll::create($inputData);
        }
        //Take the record, pass it to email view and send the email.
        Mail::send('email.submitted',['poll'=>$poll,'browsers'=>$this->browsers],function($mail) use($poll){
            $mail->from('DoNotReply@yoursite.com','Poll acknowledgement');
            $mail->to($poll->email,$poll->name);
            $mail->subject('Your vote');
        });
        return redirect()->to('/Stat');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getstat(){
        $totalvotes=Poll::count();
        $browsers=$this->browsers;
        //get the number of records for each browser, make a loop and save them to hits array
        $hits=array();
        for( $i=1;$i<8;$i++){
            $hits[$browsers[$i]]=array('votes'=>Poll::where('favorite_browser_code',$i)->count(),'votesPercent'=>round((Poll::where('favorite_browser_code',$i)->count())/$totalvotes*100,2));
        }
        //fetch all the records
        $allVotes=Poll::orderBy('favorite_browser_code')->orderBy('updated_at','desc')->get();
        return view('poll.results',compact(['hits','allVotes','browsers']));
    }


}
