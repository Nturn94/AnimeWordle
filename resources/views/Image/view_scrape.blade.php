@extends('master')  
@section('content') 

<?php 

// ini_set('display_errors', 1);
// error_reporting(E_ALL);
        use GuzzleHttp\Exception\ClientException;
        require 'C:\wamp64\www\blank\vendor\autoload.php';

        $client = new GuzzleHttp\Client([
            'base_uri' => 'http://127.0.0.1:8001/'
        ]);
        
        $pageno = rand(1,22);
        echo '<br> This is page No.', $pageno, "<br>";
        if ($pageno === 1){
            $url = "https://fancaps.net/anime/popular.php";
        }
        else{
            $pagenothree = strval($pageno);
            $url = "https://fancaps.net/anime/popular.php?paging&page={$pagenothree}";
        }
        
        // echo "<br> $url </br>";
        
        $request = new \GuzzleHttp\Psr7\Request('GET', $url);
        
        $promise = $client->sendAsync($request)->then(function ($response) {
            
            // $output = [];
            global $output2;
            $output3 = array();
            $output = array();
            $output2 = array();
            $outputimages = array();
            $combine = array();
            $counter = 0;
        
            $new = (string)($response->getBody()->getContents());
        
            preg_match_all("|<\s*h[4](?:.*)>(.*)</\s*h|Ui", $new, $matches, PREG_OFFSET_CAPTURE);
        
        
            // libxml_use_internal_errors(true);
            // $dom = new DOMDocument();
            // $dom->loadHTML($new);
            // $imgs = $dom->getElementsByTagName('img');
            // foreach($imgs as $img) {
            //     $src = $img->getAttribute('src'); 
            //     // echo $src;
            //     array_push($outputimages, $src);
            // }   
            // foreach($outputimages as $image){
            //     // echo '<img src=', $image, '>';
            // }
            
            // print_r ($matches);
        
            foreach($matches as $match){
                
                    // print_r ($matches);
                    $matchesParse = $matches[1];
                    // print_r ($matchesParse);
                    foreach($matchesParse as $matcho){
        
                        
                        // print_r($matcho[0]);
                        $matcho = implode($matcho);
        
                        $matchoo = explode(',', $matcho);
        
                        foreach($matchoo as $link) {
                            if ($counter < 10){
                                // $link = strip_tags($link, '<a href>');
                                // echo '<li>', substr($link, 0, -5), '</li>';
                                $newvar= substr($link, 0, -5);
                                // $newvar .= ", ";
                                array_push($output2, $newvar);
                                $counter++;
                            }
        
        
        
                        }
         
        
                    }
                    
                }


                

        


        
        });
        $promise->wait();
        // dd("123");
        global $output2;
        global $carz;
        global $postvalue;
        global $newnewnewz;
        global $efg;

        unset($newnewnewz);
        // unset($efg);
        $newnewnewz = array();

        
        $carz = array();
        
        
        echo count($output2);
        foreach ($output2 as $l){
            // dd($l);
            $abcde = "";
            $abcde = $l;
            // dd($abcde);
                
            $a = new SimpleXMLElement($l);
            $b =  $a['href'];
            // echo $b;
            $xxxx = "https://fancaps.net/$b";
            // dd("$xxxx");
            $efg = strip_tags($abcde);


            
            // dd($abcde);
            $request = new \GuzzleHttp\Psr7\Request('GET', $xxxx);
            
    
            $promises = $client->sendAsync($request)->then(function ($response) {
                global $efg;
                global $carz;
                global $newnewnewz;
                // $lmk = $efg;
                
            // $output = [];

                $outputimages2 = array();
            
                $new2 = (string)($response->getBody()->getContents());
            
            
                libxml_use_internal_errors(true);
                $dom = new DOMDocument();
                $dom->loadHTML($new2);
                $imgs = $dom->getElementsByTagName('img');
                foreach($imgs as $img) {
                    $src = $img->getAttribute('src'); 
                    // echo $src;
                    array_push($outputimages2, $src);
                }   
                foreach($outputimages2 as $image){
                    // echo '<img src=', $image, '>';
                    // echo "hello";
                }



                $newnewnewz = array ($efg, $outputimages2[2], $outputimages2[3],  $outputimages2[4], $outputimages2[5],  $outputimages2[6], $outputimages2[7]);

                array_push($carz, $newnewnewz);



                            

                
                
                
                // print_r($cars);

                //strip tag of output2, create append array of arrays.... (numerical function)

        
        });
        $promises->wait();
        $postvalue = serialize($carz);
        // dd($postvalue);
        
    }
    // print_r($output2);


    
?>


<div class="container">;
    <?php global $postvalue ?>
    <form method="post" action="{{route('anime.store')}}"
        enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="result" value="{{$postvalue}}">
        <div class="post_button">
            <button type="submit" class="btn btn-success">Add</button>
        </div>
    </form>
</div>


@stop