<?php
/**
 * SDaiLover Open Source & Software Development
 *
 * @fullname  : Stephanus Bagus Saputra,
 *              ( 戴 Dai 偉 Wie 峯 Funk )
 * @email     : wiefunk@stephanusdai.web.id
 * @contact   : https://t.me/wiefunkdai
 * @support   : https://opencollective.com/wiefunkdai
 * @link      : https://www.sdailover.web.id,
 *              https://www.stephanusdai.web.id
 * @license   : https://www.sdailover.web.id/license/
 * @copyright : (c) 2023 StephanusDai Developer. All rights reserved.
 * This software using Laravel Framework has released under the terms of the MIT License.
 */

defined('FACEBOOK_CLIENT_ID') or define('FACEBOOK_CLIENT_ID', 'YOUR CLIENT ID');
defined('FACEBOOK_CLIENT_SECRET') or define('FACEBOOK_CLIENT_SECRET', 'YOUR CLIENT SECRET');
defined('FACEBOOK_CLIENT_REDIRECT_URI') or define('FACEBOOK_CLIENT_REDIRECT_URI', 'YOUR CALLBACK URL');
defined('FACEBOOK_GRAPH_API_VERSION') or define('FACEBOOK_GRAPH_API_VERSION', 'YOUR GRAPH API');

class FacebookService
{
    private static $facebookClient;

    public static function oauth2Client()
    {
        if (self::$facebookClient===null) {
            $facebook = new \League\OAuth2\Client\Provider\Facebook([
                'clientId'          => FACEBOOK_CLIENT_ID,
                'clientSecret'      => FACEBOOK_CLIENT_SECRET,
                'redirectUri'       => FACEBOOK_CLIENT_REDIRECT_URI,
                'graphApiVersion'   => FACEBOOK_GRAPH_API_VERSION
            ]);
            self::$facebookClient = $facebook;
        }
        return self::$facebookClient;
    }

    public static function closeClient()
    {
        unset($_SESSION['oauth.facebook.oauth2state']);
        unset($_SESSION['oauth.facebook.access_token']);
        self::$facebookClient=null;
    }
}