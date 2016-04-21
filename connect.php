<?php
ini_set('display_errors', 'on');
class user{
    private $temp=null;
    function __construct(){
        $db='mysql:host=160.153.16.24;dbname=payponse_demo';
        $user='payponse_demo';
        $pass='$kN7s^b*5vu?';
        $this->temp=new PDO($db,$user,$pass);
    }

    public function getData(){
        $allData=$this->temp->prepare("select * from users");
        $allData->execute();
        $data=$allData->fetchAll(PDO::FETCH_ASSOC);
        return json_encode($data);
    }

    public function createNewUser($payponseId,$phoneNumber,$masterPassword,$password,$createdTime,$updateTime,$lastLoginTime,$status){
        $newUser=$this->temp->prepare("INSERT INTO users (payponse_id,phone_number,password,master_password,created_time,updated_time,last_login_time,status)
 VALUES (:paramPayponseId,:paramPhoneNumber,:paramPassword,:paramMasterPassword,:paramCreatedTime,:paramUpdateTime,:paramLastLoginTime,:paramStatus)");
        //$hashPassword=hash('sha512',$password,PASSWORD_DEFAULT);
        $newUser->bindParam(':paramPayponseId',$payponseId,PDO::PARAM_STR);
        $newUser->bindParam(':paramPhoneNumber',$phoneNumber,PDO::PARAM_STR);
        $newUser->bindParam(':paramPassword',$password,PDO::PARAM_STR);
        $newUser->bindParam(':paramCreatedTime',$createdTime,PDO::PARAM_INT);
        $newUser->bindParam(':paramUpdateTime',$updateTime,PDO::PARAM_INT);
        $newUser->bindParam(':paramLastLoginTime',$lastLoginTime,PDO::PARAM_INT);
        $newUser->bindParam(':paramStatus',$status,PDO::PARAM_INT);
        $newUser->bindParam(':paramMasterPassword',$masterPassword,PDO::PARAM_STR);
        $newUser->execute();
        $uidQuery=$this->temp->prepare("select uid from users where payponse_id=:paramPayponseId");
        $uidQuery->bindParam(':paramPayponseId',$payponseId,PDO::PARAM_STR);
        $uidQuery->execute();
        $uid=$uidQuery->fetchAll(PDO::FETCH_ASSOC);
        $result = array('isOK' => '1','user_id' => trim($uid[0]['uid']));
        echo json_encode($result);
    }

    public function createUserDetail($uid,$name,$surName,$email,$model,$carrier,$osType,$osVersion,$deviceToken,$updatedTime){
        $checkUser=$this->temp->prepare("select * from users where uid=:paramUid");
        $checkUser->bindParam(':paramUid',$uid,PDO::PARAM_INT);
        $checkUser->execute();
        $userCount=$checkUser->rowCount();

        if($userCount==1){
            echo 'girdi';
            $newUser=$this->temp->prepare("INSERT INTO user_details (uid,name,surname,email,model,carrier,os_type,os_version,device_token,updated_time)
            VALUES (:paramUid,:paramName,:paramSurname,:paramEmail,:paramModel,:paramCarrier,:paramOsType,:paramOsVersion,:paramDevideToken,:paramUpdatedTime)");
            $newUser->bindParam('paramUid',$uid,PDO::PARAM_INT);
            $newUser->bindParam('paramName',$name,PDO::PARAM_STR);
            $newUser->bindParam('paramSurname',$surName,PDO::PARAM_STR);
            $newUser->bindParam('paramEmail',$email,PDO::PARAM_STR);
            $newUser->bindParam('paramModel',$model,PDO::PARAM_STR);
            $newUser->bindParam('paramCarrier',$carrier,PDO::PARAM_STR);
            $newUser->bindParam('paramOsType',$osType,PDO::PARAM_STR);
            $newUser->bindParam('paramOsVersion',$osVersion,PDO::PARAM_STR);
            $newUser->bindParam('paramDevideToken',$deviceToken,PDO::PARAM_STR);
            $newUser->bindParam('paramUpdatedTime',$updatedTime,PDO::PARAM_INT);
            $newUser->execute();
            $array  = array('isOK' =>'1');
            echo json_encode($array);
        }
    }

    public function checkPhoneNumber($phoneNumber){
        $phoneQuery=$this->temp->prepare("select phone_number from users where phone_number=:paramPhoneNumber ");
        $phoneQuery->bindParam(':paramPhoneNumber',$phoneNumber,PDO::PARAM_STR);
        $phoneQuery->execute();
        $phone=$phoneQuery->fetchAll(PDO::FETCH_ASSOC);
        if($phone[0] != "")
            echo "true";
        else
            echo "false";
    }

    public function checkUser($phoneNumber,$password){
        $userQuery=$this->temp->prepare("select uid from users where phone_number=:paramPhoneNumber and password=:paramPassword ");
        $userQuery->bindParam(':paramPhoneNumber',$phoneNumber,PDO::PARAM_STR);
        $userQuery->bindParam(':paramPassword',$password,PDO::PARAM_STR);
        $userQuery->execute();
        $phone=$userQuery->fetchAll(PDO::FETCH_ASSOC);
        if($phone[0]['uid'] == ""){
            $array  = array('isOK' =>'0', 'error_message' => 'Boyle bir kullanici bulunmamaktadir.' );
            echo json_encode($array);
        }
        else{
            $array  = array('isOK' =>'1', 'user_id' => $phone[0]['uid'] );
            echo json_encode($array);
        }
    }

        public function addCrediCart($payponseId,$name,$surname,$card_number,$expired_date,$use_count,$created_time,$update_time,$status){
        $newUser=$this->temp->prepare("INSERT INTO credit_cards (payponse_id,name,surname,card_number,expired_date,use_count,created_time,updated_time,status) VALUES (:paramPayponseId,:paramName,:paramSurname,:paramCardNumber,:paramExpiredDate,:paramUseCount,:paramCreatedTime,:paramUpdateTime,:paramStatus)");
        $newUser->bindParam(':paramPayponseId',$payponseId,PDO::PARAM_STR);
        $newUser->bindParam(':paramName',$name,PDO::PARAM_STR);
        $newUser->bindParam(':paramSurname',$surname,PDO::PARAM_STR);
        $newUser->bindParam(':paramCreatedTime',$created_time,PDO::PARAM_INT);
        $newUser->bindParam(':paramUpdateTime',$update_time,PDO::PARAM_INT);
        $newUser->bindParam(':paramStatus',$status,PDO::PARAM_INT);
        $newUser->bindParam(':paramCardNumber',$card_number,PDO::PARAM_STR);
        $newUser->bindParam(':paramExpiredDate',$expired_date,PDO::PARAM_STR);
        $newUser->bindParam(':paramUseCount',$use_count,PDO::PARAM_INT);
        $newUser->execute();
            $uidQuery=$this->temp->prepare("select cid from credit_cards where card_number=:paramCardNumber");
            $uidQuery->bindParam(':paramCardNumber',$card_number,PDO::PARAM_STR);
            $uidQuery->execute();
            $uid=$uidQuery->fetchAll(PDO::FETCH_ASSOC);
            $result = array('isOK' => '1','card_id' => trim($uid[0]['cid']));
            echo json_encode($result);

    }
//public function addCrediCart($payponseId){
//    $newUser=$this->temp->prepare("INSERT INTO credit_cards (payponse_id,name,surname,card_number,expired_date,user_count,created_time,updated_time,status)
// VALUES (:paramPayponseId,:paramName,:paramSurname,:paramCardNumber,:paramExpiredDate,:paramUseCount,:paramCreatedTime,:paramUpdateTime,:paramStatus)");
//    $newUser->bindParam(':paramPayponseId',$payponseId,PDO::PARAM_STR);
////        $newUser->bindParam(':paramName',$name,PDO::PARAM_STR);
////        $newUser->bindParam(':paramSurname',$surname,PDO::PARAM_STR);
////        $newUser->bindParam(':paramCreatedTime',$created_time,PDO::PARAM_INT);
////        $newUser->bindParam(':paramUpdateTime',$update_time,PDO::PARAM_INT);
////        $newUser->bindParam(':paramLastLoginTime',$lastLoginTime,PDO::PARAM_INT);
////        $newUser->bindParam(':paramStatus',$status,PDO::PARAM_INT);
////        $newUser->bindParam(':paramCardNumber',$card_number,PDO::PARAM_STR);
////        $newUser->bindParam(':paramExpiredDate',$expired_date,PDO::PARAM_STR);
////        $newUser->bindParam(':paramUseCount',$use_count,PDO::PARAM_INT);
//    $newUser->execute();
    function __destruct()
    {
      $this->temp=null;
    }
}
?>
