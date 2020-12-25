<?php
class planFX
{
    public $api_server = 'https://api.planfix.ru/xml/';
    public $api_key = '6c7c7be26c25aaa7b67a0d538d899f1c';
    public $api_secret = '523e109934f51b6af56e0433074cc8cb';
    public $api_token = '551804bdcdab76da99bb570834620545';

    public function __construct()
    {
    }

    public function getUIK($uik)
    {
        //QWEB199
        $requestXml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><request method="contact.getList"><filters><filter><type>4101</type><field>14926</field><operator>equal</operator><value>'.$uik.'</value></filter></filters></request>');
        return $this->curlEditor($requestXml);
    }

    public function getTask($uid)
    {
        //QWEB199
        $requestXml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><request method="task.getList"><account></account><sid></sid><user><id></id></user><owner><id></id></owner> <parent><id></id></parent><status></status><pageCurrent></pageCurrent><pageSize></pageSize><filters><filter><type>1</type><operator>equal</operator><value>'.$uid.'</value></filter></filters></request>');
        return $this->curlEditor($requestXml);
    }

    public function updateTask($tid)
    {
        $requestXml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><request method="task.changeStatus"><account></account><sid></sid><task><id>'.$tid.'</id></task><status>103</status></request>');
        return $this->curlEditor($requestXml);
    }

    public function addTaskToKontactById($uid)
    {
        $requestXml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><request method="task.add"><account></account><sid></sid><task><template>1270242</template><title>9oweb тестирует создание задач</title><description>Тестируем создание задач</description><importance>AVERAGE</importance><status>1</status><statusSet>15944</statusSet><checkResult>1</checkResult><owner><id>'.$uid.'</id></owner><parent><id>0</id></parent><project><id>0</id></project><client><id>'.$uid.'</id></client><workers><users><id>616378</id></users><groups><id></id></groups></workers></task></request>');
        return $this->curlEditor($requestXml);
    }

    public function curlEditor($requestXml)
    {
        $requestXml->account = 'amanbolkz';
        $requestXml->pageCurrent = 1;
        $ch = curl_init($this->api_server);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // не выводи ответ на stdout
        curl_setopt($ch, CURLOPT_HEADER, 1);   // получаем заголовки
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, $this->api_key . ':' . $this->api_token);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $requestXml->asXML());
        $response = curl_exec($ch);
        $error = curl_error($ch);
        $header_size = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $responseBody = substr($response, $header_size);
        curl_close($ch);
        $temp=trim($responseBody);
        $xml    = simplexml_load_string($temp);
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);
        return $array;
    }
}

class reactionUI extends PDO
{
    // Глобальные переменные
	public $user;
	public $iduser;
	public $idmsg;
	public $dt;
	public $ms;
	public $access;
	public $url;
	public $menu1;
    public $menu2;
    public $planFX;
    public $uik;
    public $chatID;

	// Создадим конструктор ебаный Лего
	public function __construct($unm, $uid, $idmsg, $dt, $ms, $chatID, $file = 'my_setting.ini')
    {
        // парсим файл подключения
        if (!$settings = parse_ini_file($file, TRUE)) throw new exception('Unable11 to open ' . $file . '.');
        // Создаем подключение к БД
        $dns = $settings['database']['driver'].':host=' . $settings['database']['host'].((!empty($settings['database']['port'])) ? (';port=' . $settings['database']['port']) : '').';dbname='.$settings['database']['schema'];
        parent::__construct($dns, $settings['database']['username'], $settings['database']['password']);
        // Объявляем глобальные переменные
        $this->access=0;
        $this->url='https://api.telegram.org/bot1059041833:AAHi7sjrHjDh97eWhF266jTvlkua3glSJ90/sendMessage';
        $this->urldoc='https://api.telegram.org/bot1059041833:AAHi7sjrHjDh97eWhF266jTvlkua3glSJ90/sendDocument';
        $this->menu1=[["Выдать"],["Выход"]];
        $this->menu2=[["Выход"]];
        $this->user=$unm;
        $this->iduser=$uid;
        $this->idmsg=$idmsg;
        $this->dt=$dt;
        $this->ms=$ms;
        $this->chatID=$chatID;
        $this->planFX=new planFX();
        // Проверка на пользователя. Оставь надежду всяк сюда входящий
        if ($this->ms=='777') $this->access=1;
    }

    // Взять id авторизации
	function getAuth()
    {
        $id=$this->iduser;
        $stmt = $this->query("SELECT * FROM auth where iduser=$id and active=1 and dt> NOW() - INTERVAL 6 MINUTE");
        $row = $stmt->fetch();
        $str=$row['id'];
        return $str;
    }

    // Взять id contack
    function getKontactID()
    {
        $id=$this->iduser;
        $stmt = $this->query("SELECT * FROM auth where iduser=$id and active=1 and dt> NOW() - INTERVAL 6 MINUTE");
        $row = $stmt->fetch();
        $str=$row['uik'];
        return $str;
    }

    function getAllFields()
    {
        $id=$this->iduser;
        $stmt = $this->query("SELECT * FROM auth where iduser=$id and active=1 and dt> NOW() - INTERVAL 6 MINUTE");
        $row = $stmt->fetch();
        return $row;
    }

    function DeleteAuth()
    {
        $sql = "delete from auth where id=".$this->getAuth();
        $query = $this->prepare($sql);
        $query->execute();
    }

	function saveToBase($res)
    {
        $sql = "INSERT INTO test (text) VALUES ('$res')";
        $query = $this->prepare($sql);
        $query->execute();
    }

    function saveAuth()
    {
        $id_user = $this->iduser;
        $dt=$this->dt;
        $sql = "INSERT INTO auth (iduser, dt, active, uik, uikname, nameuser, telephone, status, email, taskID) VALUES ('$id_user', '$dt', 1, '','', '', '', '0', '', '')";
        $query = $this->prepare($sql);
        $query->execute();
    }

    function updateAuth($uik, $uikName, $Name, $phone, $status, $email, $taskID)
    {
        $id=$this->getAuth();
        $sql = "update auth set uik='$uik', uikname='$uikName', nameuser='$Name', telephone='$phone', status='$status', email='$email', taskID='$taskID'  where id=$id";
        $query = $this->prepare($sql);
        $query->execute();
    }

    function saveLog()
    {
        $id_message = $this->idmsg;
        $id_user = $this->iduser;
        $uname = $this->user;
        $date = $this->dt;
        $msg = $this->ms;
        $sql = "INSERT INTO lids (id_message, id_user, uname, date, msg) VALUES ($id_message, '$id_user', '$uname', '$date', '$msg')";
        $query = $this->prepare($sql);
        $query->execute();
    }

    function StartReaction()
    {
            if ((int)$this->getAuth()>0)
            {
                $this->saveLog();
                switch ($this->ms)
                {
                    case "Выдать":
                        $this->sendMessage('Набор выдан',$buttons = null);
                        $arr=$this->getAllFields();
                        $taskIDDD=$arr['taskID'];
                        $this->planFX->updateTask($taskIDDD);
                        $this->sendFile($arr['uikname'], $arr['nameuser'], $arr['telephone'], $arr['email'], $arr['status']);
                        //$this->planFX->addTaskToKontactById($this->getKontactID());
                        $this->DeleteAuth(); break;
                    case "Выход":
                        $this->sendMessage('Запрос откланен',$buttons = null);
                        $this->DeleteAuth(); break;
                    default:
                        {
                            $msx=$this->planFX->getUIK( $this->ms );//'QWEB199');
                            $ms=$msx['contacts']['@attributes']['totalCount'];
                            $userID=$msx['contacts']['contact']['userid'];
                            $uikName=$msx['contacts']['contact']['customData']['customValue']['text'];
                            $taskArray=$this->planFX->getTask($userID);
                            $this->saveToBase(print_r($taskArray));
                            $idTask=$taskArray["tasks"]["task"][0]["id"];
                            $taskStatus=$taskArray["tasks"]["task"][0]["status"];
                            switch ($taskStatus)
                            {
                                case 1: break;
                                case 2: break;
                                case 101: break;
                                case 102: break;
                                default:
                                    {
                                        $ms=0;
                                    }
                            }
                            if ($ms>0) {
                                $this->updateAuth($userID, $uikName, 'master', '7777', 'komunist', "t6767@mail.ru", $idTask);
                                $this->sendMessage('Да, УИК( '.$uikName.' ) существует, можно выдать набор', $buttons = null);
                                $this->sendMessage('Выдать набор?',$buttons = $this->menu1);
                            } else
                            {
                                $this->sendMessage($this->ms.' - УИК не существует. Попробуйте снова или нажмите кнопку выйти', $buttons = $this->menu2);
                            }
                        }
                }
            }
            else {
                if ($this->access==1) {
                    $this->saveLog();
                    $this->saveAuth();
                    $ms=print_r($this->planFX->getUIK('QWEB199tgr'), true);
                    $this->saveToBase($ms."_777777_");
                    $this->sendMessage($this->user . ' введите УИК ', $buttons = null);
                }
                else {
                    $this->sendMessage($this->user . ' бот не слушает ваши команды. Авторизуйтесь и выполните их снова', $buttons = null);
                }
            }
    }

    function sendMessage($message,$buttons = null) {
        $data = array(
            'text' => $message,
            'chat_id' => $this->iduser
        );

        if($buttons != null) {
            $data['reply_markup'] = [
                'keyboard' => $buttons,
                'resize_keyboard' => true,
                'one_time_keyboard' => true,
                'parse_mode' => 'HTML',
                'selective' => true
            ];
        } else {
        }
        $data_string = json_encode($data);
        $ch = curl_init($this->url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
        );
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    function sendFile($uik, $name, $telephone, $email, $status) {
        $file_url="https://amanbol.kz/api/exel.php?title=$uik&uik=$uik&name=$name&telephone=$telephone&email=$email&status=$status";
        $ch = curl_init($file_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $html = curl_exec($ch);
        curl_close($ch);
        file_put_contents(basename($file_url), $html);
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL =>  $this->urldoc.'?caption='.$uik.'&chat_id='.$this->chatID,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTPHEADER => [
                'Content-Type: multipart/form-data'
            ],
            CURLOPT_POST => true,
            CURLOPT_POSTFIELDS => [
                'document' => curl_file_create(basename($file_url), mime_content_type(basename($file_url)), "$uik.xlsx")
            ]
        ]);
        $data = curl_exec($curl);
        curl_close($curl);
        return $data;
    }
}
?>