<?php

namespace App\Http\Controllers;
use Illuminate\Database\Eloquent\Model;
use App\Models\Anime;
use Illuminate\Support\Facades\DB;
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
        // This function serves as an autocomplete for the input field
        $data = Anime::select("name")
                    ->where('name', 'LIKE', '%'. $request->get('query'). '%')
                    ->get();
        return response()->json($data);
    }
    public function gameView(){
        $startday = new DateTime('2022-06-08');
        $today = new DateTime();
        $days  = $today->diff($startday)->format('%a')+2;
        $sql = "select * from postanime";
        $animes = DB::select($sql); 
        return view('Game.view_game')->with("animes", $animes)->with("days", $days);
    }
    public function Scrape(){
        return view('Game.view_scrape');
    }
    public function Guess(Request $request){
        // An empty guess will be replaced with a "-"
        $input = $request->guess;
        if (empty($input)){
            $input = "-";
        }
        //This segment of code does a DB query to return the answer (Name of anime)
        $startday = new DateTime('2022-06-08');
        $today = new DateTime();
        $days  = $today->diff($startday)->format('%a')+2;
        $sql = "select * from postanime";
        $animes = DB::select($sql); 
        $id = ($animes[$days])->name;
        //Removing case sensitive answers
        $answer = strtolower($id);
        $input = strtolower($input);
        // Adding to the guess counter
        $guessno = $_COOKIE["guessno"] + 1;
        setcookie("guessno", $guessno, "/");
        // If correct, adds to streak and sets win flag
        if($input == $answer){
            $consec = $_COOKIE["consec"] + 1;
            setcookie("consec", $consec,  "/");
            $win = 1;
            setcookie("win", $win, "/");
        }
        //If guess number exceeds 6 (5) reset steak, and set fail flag
        $lose_checker = $_COOKIE["guessno"];
        if($lose_checker >5){
            $consec = 0;
            setcookie("consec", $consec,  "/");
            $fail = 1;
            setcookie("fail", $fail, "/");
        }
        // This code adds an emoji (cross) to an incorrect answer.
        if($input != $answer){
            $input .= "&#10060; ";
        }
        // I have a cookie called, "guesslist", which stores all previous answers. I add HTML tags to words within this cookie. Like new lines and classes.
        $add_tags_to_answer = "<p class='guesslisto'>" . $input . "</p>";
        if (isset($_COOKIE["guesslist"])){
            $guesslist = $_COOKIE["guesslist"];
            $guesslist .= " ";
            $guesslist .= $add_tags_to_answer;
            setcookie("guesslist", $guesslist,  "/");
        }elseif (empty($_COOKIE["guesslist"])){
            setcookie("guesslist", $add_tags_to_answer,  "/");
        }
        return redirect('/');
    }

    //This function checks if entry exists and if it doesn't, it adds a new entry.
    public function Postanime(Request $request){
        $array = unserialize($_POST['result']);
        for($ii = 1; $ii<10; $ii++){
            $temp = $array[$ii][0];
            $data = Anime::select("name")->where('name', $temp)->get();
            if(!$data){
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
        return view('Game.view_scrape');
    }
}
