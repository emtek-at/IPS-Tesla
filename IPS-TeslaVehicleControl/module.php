<?
declare(strict_types=1);

class TeslaVehicleControl extends IPSModule
{
    public function Create()
    {
        //Never delete this line!
        parent::Create();

        $this->ConnectParent('{0DE3226B-E63E-87DD-7D2F-46C1A17866D9}');

    }

    public function ApplyChanges(){

        //Never delete this line!
        parent::ApplyChanges();
    }

    public function WakeUP() {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'WakeUP';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;

        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data),true);
        if (array_key_exists('result',$Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function HonkHorn() {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'HonkHorn';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data),true);
        if (array_key_exists('result',$Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function FlashLights() {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'FlashLights';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data),true);
        IPS_LogMessage(__FUNCTION__,print_r($Data,true));
        if (array_key_exists('result',$Data['response'])) {
            $this->SendDebug(__FUNCTION__,'true',0);
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function RemoteStartDrive() {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'RemoteStartDrive';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data),true);
        if (array_key_exists('result',$Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    //Speed Limit Functions
    public function SetSpeedLimit(int $value) {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'SpeedLimitSetLimit';
        $Buffer['Params'] = ['limit_mph' => $value];

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data),true);
        if (array_key_exists('result',$Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function ActivateSpeedLimit(int $value) {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'SpeedLimitActivate';
        $Buffer['Params'] = ['pin' => $value];

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data),true);
        if (array_key_exists('result',$Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function DeactivateSpeedLimit(int $value) {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'SpeedLimitDeactivate';
        $Buffer['Params'] = ['pin' => $value];

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data),true);
        if (array_key_exists('result',$Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function ClearPinSpeedLimit(int $value) {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'SpeedLimitClearPin';
        $Buffer['Params'] = ['pin' => $value];

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data),true);
        if (array_key_exists('result',$Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    //Valet Mode Function
    public function SetValetMode(int $pin, bool $value) {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'SetValetMode';
        $Buffer['Params'] = [
            'on' => $value,
            'password' => $pin
        ];

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data),true);
        if (array_key_exists('result',$Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function ResetValetPin() {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'ResetValetPin';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data),true);
        if (array_key_exists('result',$Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    //Senty Mode Function
    public function SetSentryMode(bool $value) {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'SetSentryMode';
        $Buffer['Params'] = ['on' => $value];

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data),true);
        if (array_key_exists('result',$Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    //Door Functions
    public function DoorUnlock() {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'DoorUnlock';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data),true);
        if (array_key_exists('result',$Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function DoorLock() {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'DoorLock';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data),true);
        if (array_key_exists('result',$Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    //Frunk/Trunk Functions
    //Value = rear or front
    public function ActuateTrunk(string $value) {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'ActuateTrunk';
        $Buffer['Params'] = ['which_trunk' => $value];

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data),true);
        if (array_key_exists('result',$Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    //Functions for Sunroof
    //$value vent or close
    public function SunRoofControl(string $value) {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'SunRoofControl';
        $Buffer['Params'] = ['state' => $value];

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data),true);
        if (array_key_exists('result',$Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    //Functions for Charging
    public function ChargePortDoorOpen() {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'ChargePortDoorOpen';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data),true);
        if (array_key_exists('result',$Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function ChargePortDoorClose() {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'ChargePortDoorClose';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data),true);
        if (array_key_exists('result',$Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function ChargeStart() {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'ChargeStart';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data),true);
        if (array_key_exists('result',$Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function ChargeStop() {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'ChargeStop';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data),true);
        if (array_key_exists('result',$Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function ChargePortStandard() {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'ChargeStandard';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data),true);
        if (array_key_exists('result',$Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function ChargeMaxRange() {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'ChargeMaxRange';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data),true);
        if (array_key_exists('result',$Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function SetChargeLimit(int $value) {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'SetChargeLimit';
        $Buffer['Params'] = ['percent' => $value];

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data),true);
        if (array_key_exists('result',$Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    //Climate Functions
    public function AutoConditioningStart() {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'AutoConditioningStart';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data),true);
        if (array_key_exists('result',$Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function AutoConditioningStop() {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'AutoConditioningStop';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data),true);
        if (array_key_exists('result',$Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function SetTemps(int $driver_temp, int $passenger_temp) {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'SetTemps';
        $Buffer['Params'] = [
            'driver_temp' => $driver_temp,
            'passenger_temp' => $passenger_temp
        ];

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data),true);
        if (array_key_exists('result',$Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function RemoteSeatHeaterRequest(int $heater, int $level) {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'RemoteSeatHeaterRequest';
        $Buffer['Params'] = [
            'heater' => $heater,
            'level' => $level
        ];

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data),true);
        if (array_key_exists('result',$Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function RemoteSteeringWheelHeaterRequest(bool $value) {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'RemoteSteeringWheelHeaterRequest';
        $Buffer['Params'] = ['on' => $value];

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data),true);
        if (array_key_exists('result',$Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    //Media Functions
    public function MediaTogglePlayback() {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'MediaTogglePlayback';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data),true);
        if (array_key_exists('result',$Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function MediaNextTrack() {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'MediaNextTrack';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data),true);
        if (array_key_exists('result',$Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function MediaPrevTrack() {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'MediaPrevTrack';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data),true);
        if (array_key_exists('result',$Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function MediaNextFav() {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'MediaNextFav';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data),true);
        if (array_key_exists('result',$Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function MediaPrevFav() {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'MediaPrevFav';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data),true);
        if (array_key_exists('result',$Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function MediaVolumeUp() {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'MediaVolumeUp';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data),true);
        if (array_key_exists('result',$Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function MediaVolumeDown() {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'MediaVolumeDown';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data),true);
        if (array_key_exists('result',$Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    /**TODO Navigation
     *
     *
     *
     *
     **/

    /**TODO Software Updates
     *
     *
     *
     *
     **/
}
?>