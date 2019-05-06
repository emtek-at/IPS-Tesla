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
        if (array_key_exists('result',$Data)) {
            return $Data['result'];
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
        if (array_key_exists('result',$Data)) {
            return $Data['result'];
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
        if (array_key_exists('result',$Data)) {
            return $Data['result'];
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
        if (array_key_exists('result',$Data)) {
            return $Data['result'];
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
        if (array_key_exists('result',$Data)) {
            return $Data['result'];
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
        if (array_key_exists('result',$Data)) {
            return $Data['result'];
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
        if (array_key_exists('result',$Data)) {
            return $Data['result'];
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
        if (array_key_exists('result',$Data)) {
            return $Data['result'];
        } else {
            return false;
        }
    }
}

?>