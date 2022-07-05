<?php

namespace App\Http\Controllers;


use Illuminate\Database\Eloquent\Model;
use App\Models\Anime;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;
use DateTime;






use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {

    }

    public function Autocomplete(Request $request)
    {
        $data = Anime::select("name")
                    ->where('name', 'LIKE', '%'. $request->get('query'). '%')
                    ->get();
     
        return response()->json($data);
    }


    public function viewImage(){
        $startday = new DateTime('2022-06-08');
        $today = new DateTime();
        $days  = $today->diff($startday)->format('%a')+4;


        $sql = "select * from postanime";
        $animes = DB::select($sql); 
        // $jj = $animes[0];
        return view('Image.view_image')->with("animes", $animes)->with("days", $days);
    }

    public function Scrape(){

        return view('Image.view_scrape');
    }

    public function Guess(Request $request){

        $dayno = 0;
        $guessno = 0;
        $consec = 0;
        $win = 0;
        $fail = 0;
        $days = $request->days;

        
        if(!isset($_COOKIE["dayno"])) {
            setcookie("dayno", $days,  "/");
            setcookie("guessno", $guessno,  "/");
            setcookie("consec", $consec,  "/");
            setcookie("win", $win,  "/");
            setcookie("fail", $fail,  "/");
        }
        if($_COOKIE["dayno"] != $days) {
            setcookie("dayno", $days,  "/");
            setcookie("guessno", $guessno,  "/");
            setcookie("win", $win,  "/");
            setcookie("fail", $fail,  "/");
        }
        $input = $request->guess;
        // $input = $_POST['guess'];
        $answer = strtolower($request->animu);
        $input = strtolower($input);
        // $answer = strtolower($_POST['animu']);
        $guessno = $_COOKIE["guessno"] + 1;

        setcookie("guessno", $guessno, "/");
    
        if($input == $answer){
            $consec = $_COOKIE["consec"] + 1;
            setcookie("consec", $consec,  "/");
            $win = 1;
            setcookie("win", $win, "/");

    
        }
        elseif($_COOKIE["guessno"] >5){
            $consec = 0;
            setcookie("consec", $consec,  "/");
            $fail = 1;
            setcookie("fail", $fail, "/");
        }

        return redirect('/');
    }

    public function Postanimezz(Request $request){
        // dd("hello");
        // $array = unserialize($_POST['result']);
        $array = unserialize($_POST['result']);
        // dd($array);
        for($ii = 1; $ii<10; $ii++){
            
            $temp = $array[$ii][0];
            $query = "select * from postanime where name = \"". $temp. "\"";
            $tempa = DB::select($query);
            // dd($tempa);
            if(!$tempa){

                // $anime = DB::table('postanime')->insertGetId(array(
                //     'id' => 
                //     'name'      => $array[$ii][0],
                //     'image'     => $array[$ii][1],
                //     'image2'      => $array[$ii][2]));

                if($array[$ii][0]){
                    $anime = new Anime();
                    $anime->name = strip_tags($array[$ii][0]);
                    $anime->image = $array[$ii][1];
                    $anime->image2 = $array[$ii][2];
                    $anime->image3 = $array[$ii][3];
                    $anime->image4 = $array[$ii][4];
                    $anime->image5 = $array[$ii][5];
                    $anime->image6 = $array[$ii][6];
                    $anime->save();

                }
                


            }

        }
        return view('Image.view_scrape');
        // return redirect('/');
    }
}

