<?php

class VkApiRequest {

    public static $token;
    public static $v;

    public function __construct(string $token, $v = 5.126) {
        if (strlen($token) < 1) exit('Where is my token?');

        self::$token = $token;
        self::$v = $v;
    }

    public function call(string $url) {
        $sendRequest = json_decode(
            (function_exists('curl_init')) ? self::curl_post($url) : file_get_contents($url),
            true
        );

        if (isset($sendRequest['error'])) {
            echo ('\n*******\n' . var_dump($sendRequest['error']) . '\n*******');
        } else return (isset($sendRequest['response'])) ? $sendRequest['response'] : $sendRequest;
    }

    public function api(string $method, array $params = []) {
        return $this->call(self::http_build_query($method, [
            'v' => self::$v,
            'access_token' => self::$token
        ] + $params));
    }

    private static function http_build_query($method, $params = '') {
        return 'https://api.vk.com/method/{$method}?{$params}';
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
