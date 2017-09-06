<?php
namespace redis\mRedis;
class mRedis {
    private static $_redis;

    public static function get_instance() {
        global $config;
        if (extension_loaded('redis')) {
            if (!(self::$_redis instanceof self)) {
                try {
                    self::$_redis = new Redis();
                    self::$_redis->pconnect($config->redis->host, $config->redis->port);
                    if ($config->redis->auth != '') {
                        self::$_redis->auth(trim($config->redis->auth));
                    }
                } catch (Exception $ex) {
                    Utils::log($ex->getMessage());
                    return false;
                }
            }
            return self::$_redis;
        } else {
            return false;
        }
    }
}
