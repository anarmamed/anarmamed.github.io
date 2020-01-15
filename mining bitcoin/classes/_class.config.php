<?PHP
class config{

    public $HostDB = "localhost";
    public $UserDB = "flnrnzkh_1vv1";
    public $PassDB = "3J3h6L9h";
    public $BaseDB = "flnrnzkh_1vv1";
    
    public $SYSTEM_START_TIME = 1568707200;
    public $VAL = "RUB";
    public $VAL2 = "USD";
    
    # PAYEER настройки
    public $AccountNumber = 'P10';
    public $apiId = '657';
    public $apiKey = 'KdZGI';
    
    public $shopID = '65793';
    public $secretW = "6zEtQB";
    
    # Free-Kassa
        public $fk_merchant_id = '100'; //merchant_id ID
        public $fk_merchant_key = 'zqd26';
        public $fk_merchant_key2 = 'vkga';

    # Free-Kassa Пруд-Аква-Бухта
        public $fk_merchant_id_p = '143'; //merchant_id ID
        public $fk_merchant_key_p = '7tnu';
        public $fk_merchant_key2_p = '7tnua';

    # PAYEER настройки для серфинга
    public $AccountNumber_serf = 'P100';
    public $apiId_serf = '6579';
    public $apiKey_serf = 'KdZGIv';

    public $shopID_serf = '6634';
    public $secretW_serf = "lJuQfF";
    # Payeer настройки для Пятый лишний
    public $shopIDlot = '68999';
    public $secretWlot = "w1JSxb";

    # Payeer настройки для Пруда
    public $shopIDpond = 774;
    public $secretWpond = "TjNJ9Z";


    # PerfectMoney настройки
 	public $AccountNumberPM = "";  // Номер кошелька PerfectMoney
    public $StoreNameve       = "";    // StoreName  Название Store
    public $SecurtyWord        = "";  // SecurityWord Альтернативная фраза
    public $SecurtyWord_tele   = "";  // SecurityWord Альтернативная фраза
    public $merchantEmail   = "support@b1vv1.site";    // E-mail администратора
    public $PmId_sci       = "607"; // ID PerfectMoney на ввод на пополнения
    public $PmPass_sci     = "Mi@Nh%";  // Пароль от PerfectMoney на пополнения
    # Выплаты
    public $AutoPay    = "on";         	// Автовыплаты (on - включены; off - выключены)
    public $PmId       = "47";         // ID PerfectMoney на вывод
    public $PmPass     = "Mi@Nh";         // Пароль от PerfectMoney
    public $SaitUrl    = "https://www.1vv1.site"; // Сылка на сайт
    public $AccountPaymentPM = "U19"; // Кошелек с которого будут идти выплаты

    #SMTP
    public $SMTP_HOST = 'ssl://smtp.yandex.ru'; // SMTP сервер. Например ssl://smtp.yandex.ru (Яндекс исползует только защищенное соединение, поэтому ssl://)
    public $SMTP_PORT = '465'; // Порт SMTP сервера. Для яндекса 465
    public $SMTP_USER = 'support@1vv1.site'; // Имя пользователя для авторизации. Обычно это адрес Вашего почтового ящика
    public $SMTP_PASS = 'uYGj6R'; // Пароль Вашего почтового ящика
    public $SMTP_FROM = 'support@1vv1.site'; // Информация для заголовка письма "От кого".
    public $SMTP_PROJECT = '1vv1.site'; //Название проекта. Например PSWeb.ru
    public $SMTP_CHARSET = 'utf-8'; // Кодировка, в которой отправляются письма. Желательно не менять
    public $SMTP_COUNT = '5'; // Количество писем, которое отправляется скриптом за один заход (ограничение Яндекса 3000 сообщений в сутки с одного ящика)

     # paykassa_sci
    public $secretPayKass = "";
    public $idPayKass = "";

    # paykassa_API
    public $secretPayKey = "";
    public $apiPayId = "";
    
}
?>
