<?php
function get_bdayQuotes(){
    include '../mysqli_connect.php';
    $url = "https://www.shutterfly.com/ideas/happy-birthday-quotes/";
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 5);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_AUTOREFERER, true);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
    $data = curl_exec($curl);
    curl_close($curl);
    if ($data) {
        $dom = new DOMDocument(); 
        @$dom->loadHTML($data);
        $xpath = new DOMXPath($dom);
        $elements = $xpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), 'entry-content')]");
         foreach ($elements as $quotesUi) {
            if ($quotesUi->getElementsByTagName('ul')) {
                $movieDialogue = $quotesUi->getElementsByTagName('li');
                foreach ($movieDialogue as $quotesLi) {
                    if(!$quotesLi->getElementsByTagName('a')['length']){
                        $insertQuery = "INSERT INTO bday_quotes_scraping (quotes) VALUES('".$quotesLi->nodeValue."')";
                        $insertResult = mysqli_query($mysqliCon, $insertQuery);
                    }
                }
            }

         }
    }

}
get_bdayQuotes();
print_r("Data Added in Database");
?>