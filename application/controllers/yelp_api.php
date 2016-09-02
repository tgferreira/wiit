<?php

require_once('lib/OAuth.php');

$CONSUMER_KEY = 'cdofHM3BXPe1922hQ_oWLw';
$CONSUMER_SECRET = 'VEI9YUCSoBA5XuvdwJ9k6X93JZE';
$TOKEN = 'BZE60sg2490ZsPzHqGJBwL7eX7uYFX5T';
$TOKEN_SECRET = 'ABpoQUBqpZ4TbXAjxoyfx97dY7Q';

$API_HOST = 'api.yelp.com';
$DEFAULT_TERM = 'deltry';
$DEFAULT_LOCATION = 'Itajubá, MG';
$SEARCH_PATH = '/v2/search/';
$BUSINESS_PATH = '/v2/business/';



function request($host, $path) {

    $unsigned_url = "https://" . $host . $path;
    $token = new OAuthToken($GLOBALS['TOKEN'], $GLOBALS['TOKEN_SECRET']);
    $consumer = new OAuthConsumer($GLOBALS['CONSUMER_KEY'], $GLOBALS['CONSUMER_SECRET']);
    $signature_method = new OAuthSignatureMethod_HMAC_SHA1();

    $oauthrequest = OAuthRequest::from_consumer_and_token(
        $consumer, 
        $token, 
        'GET', 
        $unsigned_url
        );
    
    $oauthrequest->sign_request($signature_method, $consumer, $token);
    
    $signed_url = $oauthrequest->to_url();
    
    try {
        $ch = curl_init($signed_url);
        if (FALSE === $ch)
            throw new Exception('Failed to initialize');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $data = curl_exec($ch);

        if (FALSE === $data)
            throw new Exception(curl_error($ch), curl_errno($ch));
        $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        if (200 != $http_status)
            throw new Exception($data, $http_status);

        curl_close($ch);
    } catch(Exception $e) {
        trigger_error(sprintf(
            'Curl failed with error #%d: %s',
            $e->getCode(), $e->getMessage()),
        E_USER_ERROR);
    }
    
    return $data;
}

function search($term, $location, $offset) {
    $url_params = array();
    
    $url_params['term'] = $term ?: $GLOBALS['DEFAULT_TERM'];
    $url_params['location'] = $location?: $GLOBALS['DEFAULT_LOCATION'];
    $url_params['offset'] = $offset;
    $search_path = $GLOBALS['SEARCH_PATH'] . "?" . http_build_query($url_params);
    
    return request($GLOBALS['API_HOST'], $search_path);
}



function query_api($term, $location, $offset = '0') {
    $limit = null;
    $response = search($term, $location, $offset);
    return $response;
}

function howManyPages($total, $offset){
    $val = intval($total/20)+1;
    $realOffset = $offset+1;
    echo '<center>';
    echo '<h3> Pagina ' . $realOffset . 'de ' . $val . '</h3>'; 
    echo '</center>';
}
?>
