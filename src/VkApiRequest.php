<?php

class VkApiRequest {

    private $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function setToken(string $token): void {
        $this->user->token = $token;
    }

    public function call(string $url) {
        $sendRequest = json_decode(
            (function_exists('curl_init')) ? self::curl_post($url) : file_get_contents($url),
            true
        );

        if (isset($sendRequest['error'])) {
            echo ("*******\n#{$sendRequest['error']['error_code']}, {$sendRequest['error']['error_msg']}\n*******\n");
        } else return (isset($sendRequest['response'])) ? $sendRequest['response'] : $sendRequest;
    }

    public function api(string $method, array $params = []) {
        return $this->call(self::http_build_query($method, http_build_query([
            'v' => $this->user->v,
            'access_token' => $this->user->token
        ] + $params)));
    }

    private static function http_build_query(string $method, string $params) {
        return "https://api.vk.com/method/{$method}?{$params}";
    }

    private static function curl_post(string $url) {
        if (!function_exists('curl_init')) return false;
        $param = parse_url($url);
        if ($curl = curl_init()) {
            curl_setopt($curl, CURLOPT_URL, $param['scheme'] . '://' . $param['host'] . $param['path']);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $param['query']);
            curl_setopt($curl, CURLOPT_TIMEOUT, 20);
            $out = curl_exec($curl);
            curl_close($curl);

            return $out;
        }

        return false;
    }
}
