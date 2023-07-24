<?php
namespace TigerHeck\MsGraph;

use Illuminate\Support\Facades\Http;
use TigerHeck\MsGraph\Models\MsGraphToken;

class MsGraphService {
    
    private $http;

    /**
     * Set the base url that all API requests use.
     * @var string
     */
    protected static $baseUrl = 'https://graph.microsoft.com/v1.0/';

    public function __construct()
    {
        $this->http = $this->http();
    }

    public function http(){
        $accessToken = $this->getAccessToken();
        return Http::withToken($accessToken)->baseUrl(self::$baseUrl);
    }

    private function getAccessToken($token_type = 'Bearer') {
        $model = MsGraphToken::where('token_type', 'Bearer')->whereRaw("TIME_TO_SEC(TIMEDIFF(CURRENT_TIMESTAMP, created_at)) < expires_in")->first();
        if(!$model) {
            $model = $this->generateAccessToken();
        }
        if($model && $model instanceof MsGraphToken) {
            return $model->access_token;
        }
        
        return false;
    }

    public function generateAccessToken() {
        $response = Http::asForm()->post(config('msgraph.urlAccessToken'),[
            "client_id"     =>  config('msgraph.clientId'),
            "scope"         =>  config('msgraph.scopes'),
            "client_secret" =>  config('msgraph.clientSecret'),
            "grant_type"    =>  config('msgraph.grant_type'),
        ]);
        $data = $response->json();
        if($response->successful()) {
            return $this->storeAccessToken( $data );
        }
        if(isset($data['error_description']) && is_string($data['error_description'])) {            
            throw new \Exception($data['error_description']);
        }
        return $data;
    }

    private function storeAccessToken($data) {
        return MsGraphToken::create($data);
    }

    public function get($endpoint = '/', $data = '', $access_by = null) {
        return self::responseCollection( $this->http->get($endpoint, $data), $access_by);
    }

    public function post($endpoint = '/', $data = [], $access_by = null) {
        return self::responseCollection( $this->http->post($endpoint, $data), $access_by);
    }

    public function put($endpoint = '/', $data = [], $access_by = null) {
        return self::responseCollection( $this->http->put($endpoint, $data), $access_by);
    }

    public function patch($endpoint = '/', $data = [], $access_by = null) {
        return self::responseCollection( $this->http->patch($endpoint, $data), $access_by);
    }

    public function delete($endpoint = '/', $data = [], $access_by = null) {
        return self::responseCollection( $this->http->delete($endpoint, $data), $access_by);
    }

    private function responseCollection($response, $access_by) {
        if($response->successful()) {
            $data = $response->json($access_by);
            return collect($data);
        }
        return $response->json();
    }
}