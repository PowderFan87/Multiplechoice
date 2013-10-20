<?php
class App_Web_Security
{
    private $_objUser = NULL;

    /**
     * Return if current session has a loggedin value
     *
     * @return boolean
     */
    public static function isAuthenticated() {
        return isset($_SESSION['loggedin']);
    }

    /**
     * inverse function to isAuthenticated
     *
     * @return boolean
     */
    public static function notAuthenticated() {
        return !isset($_SESSION['loggedin']);
    }

    /**
     * Try to find and loggin user by username and password
     *
     * @param string $strUsername
     * @param string $strPassword
     * @return boolean
     */
    public static function tryLogin($strName) {
        $objUser = viewBackenduser::getUserbystrname($strName);

        if($objUser instanceof App_Data_Backenduser) {
            $_SESSION['loggedin'] = $objUser->getUID();

            return true;
        }

        return false;
    }

    /**
     * Check in init if we have a logged in value in session and try to load
     * user from DB
     *
     */
    public function __construct() {
        if(isset($_SESSION['loggedin'])) {
            $this->_objUser = viewBackenduser::getBypk($_SESSION['loggedin']);
        }
    }

    /**
     * Make an I check to prevent session hijacking
     *
     * @return boolean
     */
    public function doIpcheck() {
        if((isset($_SESSION['IP']) && $_SESSION['IP'] !== $_SERVER['REMOTE_ADDR']) ||
           (isset($_SESSION['IP_FORW']) && $_SESSION['IP_FORW'] !== $_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return false;
        }

        return true;
    }

    /**
     * Destroy current session by resetting session array and make cookie invalid
     *
     * @throws App_Web_Security_Exception
     */
    public function doDestroysession() {
        $_SESSION = array();

        if (ini_get('session.use_cookies')) {
            $arrParams = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $arrParams['path'], $arrParams['domain'],
                $arrParams['secure'], $arrParams['httponly']
            );
        }

        session_destroy();

        unset($this->_objUser);
    }

    /**
     * Return AR-Class instance of current loggedin user
     *
     * @return App_Data_User
     */
    public function getObjuser() {
        return $this->_objUser;
    }
}