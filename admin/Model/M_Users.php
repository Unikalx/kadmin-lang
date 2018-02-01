<?php
include_once('Model/MSQL.php');

//
// Менеджер пользователей
//
class M_Users
{
    private static $instance;    // экземпляр класса
    private $msql;                // драйвер БД
    private $sid;                // идентификатор текущей сессии
    private $uid;                // идентификатор текущего пользователя

    //
    // Получение экземпляра класса
    // результат	- экземпляр класса MSQL
    //
    public static function Instance()
    {
        if (self::$instance == null)
            self::$instance = new M_Users();

        return self::$instance;
    }

    //
    // Конструктор
    //
    public function __construct()
    {
        $this->msql = MSQL::Instance();
        $this->sid = null;
        $this->uid = null;
    }

    //
    // Очистка неиспользуемых сессий
    //
    public function ClearSessions()
    {
        $min = date('Y-m-d H:i:s', time() - 60 * 60);
        $t = "time_last < '%s'";
        $where = sprintf($t, $min);
        $this->msql->Delete('sessions', $where);
    }

    //
    // Додання нового користувача
    // $login 		- логин
    // $password 	- пароль
    // результат	- true или false
    //
    public function addNewUser($login, $password, $status)
    {
        if ($_SESSION['authorize']['status'] == 1) {
            $pass = self::getPassword($password);
            $insert['password'] = $pass;
            $insert['login'] = $login;
            $insert['status'] = $status;

            return $add_user = $this->msql->Insert('users', $insert);
        }
    }
//
    // Авторизация
    // $login 		- логин
    // $password 	- пароль
    // $remember 	- нужно ли запомнить в куках
    // результат	- true или false
    //
    public function Login($login, $password, $remember = false)
    {
        // вытаскиваем пользователя из БД
        $user = $this->GetByLogin($login);

        if ($remember) {
            $remember = true;
        }
        if ($user == null) {
            return false;
        }

        $id_user = $user['id_user'];


        // проверяем пароль
        if ($user['password'] != md5($password))
            return false;

        // запоминаем имя и md5(пароль)
        if ($remember) {
            $expire = time() + 3600 * 24 * 60;
            setcookie('authorize', $login, $expire);
            setcookie('password', md5($password), $expire);
        }
        // открываем сессию и запоминаем SID

        $this->sid = $this->OpenSession($id_user);
        return true;
    }

    //
    // Выход
    //
    public function Logout()
    {
        setcookie('authorize', '', time() - 1);
        setcookie('password', '', time() - 1);
        unset($_COOKIE['authorize']);
        unset($_COOKIE['password']);
        unset($_SESSION['authorize']);
        $this->sid = null;
        $this->uid = null;
    }


    //
    // Перевірка чи користувач авторизований
    //
    public function ifLogin()
    {
        if (!isset($_SESSION['authorize']) && !isset($_COOKIE['authorize'])) {
            header('Location: /admin/login');
        } elseif ($_SESSION['id_user'] == '' && !empty($_COOKIE['authorize'])) {

            $last_login = self::Get_last_login($_COOKIE['authorize']);
            $_SESSION['authorize']['last_login'] = $last_login['last_login'];
            $_SESSION['authorize']['last_activity'] = $last_login['last_activity'];
            $_SESSION['authorize']['id_user'] = $last_login['id_user'];
            $_SESSION['authorize']['status'] = $last_login['status'];
        }
    }



    //
    // Получение пользователя
    // $id_user		- если не указан, брать текущего
    // результат	- объект пользователя
    //
    public function Get($id_user = null)
    {

        // Если id_user не указан, берем его по текущей сессии.
        if ($id_user == null) {
            $id_user = $this->GetUid();
        }

        if ($id_user == null) {
            return null;
        }
        // А теперь просто возвращаем пользователя по id_user.
        $t = "SELECT * FROM users WHERE id_user = '%d'";
        $query = sprintf($t, $id_user);
        $result = $this->msql->Select_string($query);

        return $result;
    }

    //
    // Получает пользователя по логину
    //
    public function GetByLogin($login)
    {
        $t = "SELECT * FROM users WHERE login = '%s'";
        $query = sprintf($t, $login);
        $result = $this->msql->Select_string($query);
        return $result;
    }


    //
    // Получение id текущего пользователя
    // результат	- UID
    //
    public function GetUid()
    {

        // Проверка кеша.
        if ($this->uid != null)
            return $this->uid;

        // Берем по текущей сессии.
        $sid = $this->GetSid();

        if ($sid == null)
            return null;


        $t = "SELECT id_user FROM users WHERE login = '%s'";
        $query = sprintf($t, $_COOKIE['login']);

        $result = $this->msql->Select_string($query);

        // Если сессию не нашли - значит пользователь не авторизован.
        if (count($result) == 0)
            return null;

        // Если нашли - запоминм ее.
        $this->uid = $id_user = ($result['id_user']) ? $result['id_user'] : $_SESSION['authorize']['id_user'];
        return $this->uid;
    }

    //
    // Функция возвращает идентификатор текущей сессии
    // результат	- SID
    //
    private function GetSid()
    {
        // Проверка кеша.
        if ($this->sid != null)
            return $this->sid;

        // Ищем SID в сессии.
        $sid = $_SESSION['authorize']['sid'];

        // Нет сессии? Ищем логин и md5(пароль) в куках.
        // Т.е. пробуем переподключиться.
        if ($sid == null && isset($_COOKIE['authorize'])) {
            $user = $this->GetByLogin($_COOKIE['authorize']);

            if ($user != null && $user['password'] == $_COOKIE['password']) {
                $sid = $this->OpenSession($user['id_user']);

                $last_login = $this->Get_last_login($_COOKIE['login']);
                $_SESSION['authorize']['last_login'] = $last_login['last_login'];
                $_SESSION['authorize']['last_activity'] = $last_login['last_activity'];
                $_SESSION['authorize']['id_user'] = $last_login['id_user'];

                $this->LastLoginUpdate($_COOKIE['login']);
            }
        }

        // Запоминаем в кеш.
        if ($sid != null)
            $this->sid = $sid;

        // Возвращаем, наконец, SID.
        return $sid;
    }

    //
    // Открытие новой сессии
    //
    //
    private function OpenSession($id_user)
    {
        // генерируем SID
        $sid = $this->GenerateStr(10);

        // регистрируем сессию в PHP
        $_SESSION['authorize']['sid'] = $sid;

        // возвращаем SID
        return $sid;
    }

    //
    // Генерация случайной последовательности
    // $length 		- ее длина
    // результат	- случайная строка
    //
    private function GenerateStr($length = 10)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;

        while (strlen($code) < $length)
            $code .= $chars[mt_rand(0, $clen)];

        return $code;
    }

    public function Get_last_login($login)
    {
        // запрос к базе :
        $query = "SELECT * FROM users WHERE login = '$login'";

        return $this->msql->Select_string($query);
    }

    public function LastLoginUpdate($login)
    {
        // отправка запроса изменений :
        $object = array();
        $object['last_login'] = date("Y-m-d H:i:s");
        $object['last_activity'] = date("Y-m-d H:i:s");

        $t = "login = '%s'";
        $where = sprintf($t, $login);

        $this->msql->Update('users', $object, $where);
    }

    public function getAllUsers()
    {
        // запрос к базе :
        $query = "SELECT * FROM users ";
        return $this->msql->Select($query);
    }

    public function UpdatePass($login, $pass)
    {
        if ($_SESSION['authorize']['status'] == 1) {
            $object['password'] = self::getPassword($pass);

            $t = "login = '%s'";
            $where = sprintf($t, $login);

            $this->msql->Update('users', $object, $where);
        }
    }

    public static function getPassword($pass)
    {
        return md5($pass);
    }

    // Функція надсилання повідомлення
    public static function sendMessage($email, $subject, $message)
    {
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        // noreply@xi-digital.com
        $headers .= 'From: noreply@korzun.com.ua' . "\r\n";
        $headers .= "Reply-To: i@korzun.com.ua\r\n";
        return mail($email, $subject, $message, $headers);
    }

    // Отримати массив emails  підпищиків
    /*
     * $subscrs_id - масив id-шніків
    */
    public function getSubscrEmails($subscrs_id)
    {
        $t = "SELECT email FROM subscribers WHERE id IN (%s)";
        $query = sprintf($t, implode(',', $subscrs_id));
        $emails_tmp = $this->msql->Select($query);
        $emails = array();
        foreach ($emails_tmp as $user) {
            array_push($emails, $user['email']);
        }
        return $emails;
    }

    // Надіслати повідомлення підпищикам
    public static function sendMessageToSubscr($emails, $subject, $message)
    {
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
        // noreply@xi-digital.com
        $headers .= 'From: ' . SITE_NAME . "\r\n";
        $headers .= "Reply-To: " . SITE_NAME . "\r\n";
        foreach ($emails as $email) {
            mail($email, $subject, $message, $headers);
        }
        return true;
    }
}
