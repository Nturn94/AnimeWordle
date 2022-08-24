@extends('master')  
@section('content') 

<!-- This page scrapes urls from a website and then scrapes those urls for names and more urls (images). This page creates a giant object called, "Postvalue". -->

<?php 
        use GuzzleHttp\Exception\ClientException;
        require 'C:\wamp64\www\scraper\vendor\autoload.php';
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
        $request = new \GuzzleHttp\Psr7\Request('GET', $url);
        $promise = $client->sendAsync($request)->then(function ($response) {
            global $output2;
            $output3 = array();
            $output = array();
            $output2 = array();
            $outputimages = array();
            $combine = array();
            $counter = 0;
            $new = (string)($response->getBody()->getContents());
            preg_match_all("|<\s*h[4](?:.*)>(.*)</\s*h|Ui", $new, $matches, PREG_OFFSET_CAPTURE);
            foreach($matches as $match){
                    $matchesParse = $matches[1];
                    foreach($matchesParse as $matcho){
                        $matcho = implode($matcho);
                        $matchoo = explode(',', $matcho);
                        foreach($matchoo as $link) {
                            if ($counter < 10){
                                $newvar= substr($link, 0, -5);
                                array_push($output2, $newvar);
                                $counter++;
                            }
                        }
                    }
                }
        });
        $promise->wait();

        global $output2;
        global $carz;
        global $postvalue;
        global $newnewnewz;
        global $efg;
        unset($newnewnewz);
        $newnewnewz = array();
        $carz = array();
        echo count($output2);
        foreach ($output2 as $l){
            $abcde = "";
            $abcde = $l;
            $a = new SimpleXMLElement($l);
            $b =  $a["href"];
            $xxxx = "https://fancaps.net/$b";
            $efg = strip_tags($abcde);
            $request = new \GuzzleHttp\Psr7\Request('GET', $xxxx);
            $promises = $client->sendAsync($request)->then(function ($response) {
                global $efg;
                global $carz;
                global $newnewnewz;
                $outputimages2 = array();
                $new2 = (string)($response->getBody()->getContents());
                libxml_use_internal_errors(true);
                $dom = new DOMDocument();
                $dom->loadHTML($new2);
                $imgs = $dom->getElementsByTagName('img');
                foreach($imgs as $img) {
                    $src = $img->getAttribute('src'); 
                    array_push($outputimages2, $src);
                }   
                $newnewnewz = array ($efg, $outputimages2[2], $outputimages2[3],  $outputimages2[4], $outputimages2[5],  $outputimages2[6], $outputimages2[7]);
                array_push($carz, $newnewnewz);
        });
        $promises->wait();
        $postvalue = serialize($carz);
    }
?>
<?php
function debug_to_console($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}
?>
<div class="container">;
    <?php global $postvalue ?>
    <form method="post" action="{{route('scrape.create')}}"
        enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="result" value="{{$postvalue}}">
        <div class="post_button">
            <button type="submit" class="btn btn-success">Add</button>
        </div>
    </form>
</div>
@stop