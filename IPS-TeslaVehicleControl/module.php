<?php

declare(strict_types=1);
require_once __DIR__ . '/../libs/TeslaHelper.php';

class TeslaVehicleControl extends IPSModule
{
    use TeslaHelper;

    public function Create()
    {
        //Never delete this line!
        parent::Create();

        $this->ConnectParent('{0DE3226B-E63E-87DD-7D2F-46C1A17866D9}');

        $this->RegisterVariablenProfiles();

        $this->RegisterVariableInteger('WakeUP', $this->Translate('Wake UP'), 'Tesla.WakeUP', 1);
        $this->EnableAction('WakeUP');

        $this->RegisterVariableInteger('Alerts', $this->Translate('Alerts'), 'Tesla.Alerts', 2);
        $this->EnableAction('Alerts');

        $this->RegisterVariableInteger('RemoteStartDrive', $this->Translate('Remote Start Drive'), 'Tesla.RemoteStartDrive', 3);
        $this->EnableAction('RemoteStartDrive');

        $this->RegisterVariableInteger('Doors', $this->Translate('Doors'), 'Tesla.Doors', 4);
        $this->EnableAction('Doors');

        $this->RegisterVariableInteger('Trunk', $this->Translate('Trunk'), 'Tesla.Trunk', 5);
        $this->EnableAction('Trunk');

        $this->RegisterVariableInteger('SunRoof', $this->Translate('Sun Roof'), 'Tesla.SunRoof', 6);
        $this->EnableAction('SunRoof');

        $this->RegisterVariableInteger('ChargePort', $this->Translate('Charge Port'), 'Tesla.ChargePort', 6);
        $this->EnableAction('ChargePort');

        $this->RegisterVariableInteger('ChargeControl', $this->Translate('Charge Control'), 'Tesla.ChargeControl', 7);
        $this->EnableAction('ChargeControl');

        $IDChargeLimit = $this->RegisterVariableString('ChargeLimit', $this->Translate('Charge Limit'), '', 8);
        IPS_SetIcon($IDChargeLimit, 'Battery');
        $this->EnableAction('ChargeLimit');

        $this->RegisterVariableInteger('ClimateAutoConditioning', $this->Translate('Climate Auto Conditioning'), 'Tesla.ClimateAutoConditioning', 9);
        $this->EnableAction('ClimateAutoConditioning');

        $this->RegisterVariableFloat('DriverTemp', $this->Translate('Driver Temperature'), '~Temperature', 10);
        $this->EnableAction('DriverTemp');

        $this->RegisterVariableFloat('PassengerTemp', $this->Translate('Passenger Temperature'), '~Temperature', 11);
        $this->EnableAction('PassengerTemp');

        $this->RegisterVariableInteger('SetTemperature', $this->Translate('Set Temperature'), 'Tesla.SetTemperature', 12);
        $this->EnableAction('SetTemperature');

        $this->RegisterVariableInteger('RemoteSeatHeaterHeater', $this->Translate('Remote Seat Heater Heater'), 'Tesla.RemoteSeatHeaterHeater', 13);
        $this->EnableAction('RemoteSeatHeaterHeater');

        $this->RegisterVariableInteger('RemoteSeatHeaterLevel', $this->Translate('Remote Seat Heater Level'), 'Tesla.RemoteSeatHeaterLevel', 14);
        $this->EnableAction('RemoteSeatHeaterLevel');

        $this->RegisterVariableInteger('SetRemoteSeatHeater', $this->Translate('Set Remote Seat Heater'), 'Tesla.SetRemoteSeatHeater', 15);
        $this->EnableAction('SetRemoteSeatHeater');

        $this->RegisterVariableBoolean('RemoteSteeringWheelHeater', $this->Translate('Remote Steering Wheel Heater'), 'Tesla.RemoteSteeringWheelHeater', 16);
        $this->EnableAction('RemoteSteeringWheelHeater');

        $this->RegisterVariableInteger('MediaPlayControl', $this->Translate('Media Play Control'), 'Tesla.MediaPlayControl', 17);
        $this->EnableAction('MediaPlayControl');

        $this->RegisterVariableInteger('MediaVolume', $this->Translate('Media Volume'), 'Tesla.MediaVolume', 18);
        $this->EnableAction('MediaVolume');
    }

    public function ApplyChanges()
    {

        //Never delete this line!
        parent::ApplyChanges();
    }

    public function WakeUP()
    {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'WakeUP';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;

        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data), true);
        if (array_key_exists('result', $Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function HonkHorn()
    {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'HonkHorn';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data), true);
        if (array_key_exists('result', $Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function FlashLights()
    {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'FlashLights';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data), true);
        IPS_LogMessage(__FUNCTION__, print_r($Data, true));
        if (array_key_exists('result', $Data['response'])) {
            $this->SendDebug(__FUNCTION__, 'true', 0);
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function RemoteStartDrive()
    {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'RemoteStartDrive';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data), true);
        if (array_key_exists('result', $Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    //Speed Limit Functions
    public function SetSpeedLimit(int $value)
    {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'SpeedLimitSetLimit';
        $Buffer['Params'] = array('limit_mph' => $value);

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data), true);
        if (array_key_exists('result', $Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function ActivateSpeedLimit(int $value)
    {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'SpeedLimitActivate';
        $Buffer['Params'] = array('pin' => $value);

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data), true);
        if (array_key_exists('result', $Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function DeactivateSpeedLimit(int $value)
    {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'SpeedLimitDeactivate';
        $Buffer['Params'] = array('pin' => $value);

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data), true);
        if (array_key_exists('result', $Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function ClearPinSpeedLimit(int $value)
    {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'SpeedLimitClearPin';
        $Buffer['Params'] = array('pin' => $value);

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data), true);
        if (array_key_exists('result', $Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    //Valet Mode Function
    public function SetValetMode(int $pin, bool $value)
    {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'SetValetMode';
        $Buffer['Params'] = array(
            'on'       => $value,
            'password' => $pin
        );

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data), true);
        if (array_key_exists('result', $Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function ResetValetPin()
    {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'ResetValetPin';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data), true);
        if (array_key_exists('result', $Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    //Senty Mode Function
    public function SetSentryMode(bool $value)
    {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'SetSentryMode';
        $Buffer['Params'] = array('on' => $value);

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data), true);
        if (array_key_exists('result', $Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    //Door Functions
    public function DoorUnlock()
    {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'DoorUnlock';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data), true);
        if (array_key_exists('result', $Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function DoorLock()
    {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'DoorLock';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data), true);
        if (array_key_exists('result', $Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    //Frunk/Trunk Functions
    //Value = rear or front
    public function ActuateTrunk(string $value)
    {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'ActuateTrunk';
        $Buffer['Params'] = array('which_trunk' => $value);

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data), true);
        if (array_key_exists('result', $Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    //Functions for Sunroof
    //$value vent or close
    public function SunRoofControl(string $value)
    {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'SunRoofControl';
        $Buffer['Params'] = array('state' => $value);

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data), true);
        if (array_key_exists('result', $Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    //Functions for Charging
    public function ChargePortDoorOpen()
    {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'ChargePortDoorOpen';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data), true);
        if (array_key_exists('result', $Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function ChargePortDoorClose()
    {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'ChargePortDoorClose';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data), true);
        if (array_key_exists('result', $Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function ChargeStart()
    {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'ChargeStart';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data), true);
        if (array_key_exists('result', $Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function ChargeStop()
    {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'ChargeStop';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data), true);
        if (array_key_exists('result', $Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function ChargePortStandard()
    {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'ChargeStandard';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data), true);
        if (array_key_exists('result', $Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function ChargeMaxRange()
    {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'ChargeMaxRange';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data), true);
        if (array_key_exists('result', $Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function SetChargeLimit(int $value)
    {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'SetChargeLimit';
        $Buffer['Params'] = array('percent' => $value);

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data), true);
        if (array_key_exists('result', $Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    //Climate Functions
    public function AutoConditioningStart()
    {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'AutoConditioningStart';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data), true);
        if (array_key_exists('result', $Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function AutoConditioningStop()
    {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'AutoConditioningStop';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data), true);
        if (array_key_exists('result', $Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function SetTemps(float $driver_temp, float $passenger_temp)
    {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'SetTemps';
        $Buffer['Params'] = array(
            'driver_temp'    => $driver_temp,
            'passenger_temp' => $passenger_temp
        );

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data), true);
        if (array_key_exists('result', $Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function RemoteSeatHeaterRequest(int $heater, int $level)
    {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'RemoteSeatHeaterRequest';
        $Buffer['Params'] = array(
            'heater' => $heater,
            'level'  => $level
        );

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data), true);
        if (array_key_exists('result', $Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function RemoteSteeringWheelHeaterRequest(bool $value)
    {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'RemoteSteeringWheelHeaterRequest';
        $Buffer['Params'] = array('on' => $value);

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data), true);
        if (array_key_exists('result', $Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    //Media Functions
    public function MediaTogglePlayback()
    {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'MediaTogglePlayback';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data), true);
        if (array_key_exists('result', $Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function MediaNextTrack()
    {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'MediaNextTrack';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data), true);
        if (array_key_exists('result', $Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function MediaPrevTrack()
    {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'MediaPrevTrack';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data), true);
        if (array_key_exists('result', $Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function MediaNextFav()
    {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'MediaNextFav';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data), true);
        if (array_key_exists('result', $Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function MediaPrevFav()
    {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'MediaPrevFav';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data), true);
        if (array_key_exists('result', $Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function MediaVolumeUp()
    {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'MediaVolumeUp';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data), true);
        if (array_key_exists('result', $Data['response'])) {
            return $Data['response']['result'];
        } else {
            return false;
        }
    }

    public function MediaVolumeDown()
    {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'MediaVolumeDown';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data), true);
        if (array_key_exists('result', $Data['response'])) {
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

    public function RequestAction($Ident, $Value)
    {
        $this->SendDebug(__FUNCTION__ . ' Ident', $Ident, 0);
        $this->SendDebug(__FUNCTION__ . ' Value', $Value, 0);
        switch ($Ident) {
            case 'WakeUP':
                $this->WakeUP();
                break;
            case 'Alerts':
                switch ($Value) {
                    case 1:
                        $this->HonkHorn();
                        break;
                    case 2:
                        $this->FlashLights();
                        break;
                    default:
                        $this->SendDebug(__FUNCTION__ . ' ' . $Ident, 'Undefined Value ' . $Value, 0);
                        break;
                }
                break;
            case 'RemoteStartDrive':
                $this->RemoteStartDrive();
                break;
            case 'Doors':
                switch ($Value) {
                    case 1:
                        $this->DoorUnlock();
                        break;
                    case 2:
                        $this->DoorLock();
                        break;
                    default:
                        $this->SendDebug(__FUNCTION__ . ' ' . $Ident, 'Undefined Value ' . $Value, 0);
                        break;
                }
                break;
            case 'Trunk':
                switch ($Value) {
                    case 1:
                        $this->ActuateTrunk('rear');
                        break;
                    case 2:
                        $this->ActuateTrunk('front');
                        break;
                    default:
                        $this->SendDebug(__FUNCTION__ . ' ' . $Ident, 'Undefined Value ' . $Value, 0);
                        break;
                }
                break;
            case 'SunRoof':
                switch ($Value) {
                    case 1:
                        $this->SunRoofControl('vent');
                        break;
                    case 2:
                        $this->SunRoofControl('close');
                        break;
                    default:
                        $this->SendDebug(__FUNCTION__ . ' ' . $Ident, 'Undefined Value ' . $Value, 0);
                        break;
                }
                break;
            case 'ChargePort':
                switch ($Value) {
                    case 1:
                        $this->ChargePortDoorOpen();
                        break;
                    case 2:
                        $this->ChargePortDoorClose();
                        break;
                    default:
                        $this->SendDebug(__FUNCTION__ . ' ' . $Ident, 'Undefined Value ' . $Value, 0);
                        break;
                }
                break;
            case 'ChargeControl':
                switch ($Value) {
                    case 1:
                        $this->ChargeStart();
                        break;
                    case 2:
                        $this->ChargeStop();
                        break;
                    case 3:
                        $this->ChargePortStandard();
                        break;
                    case 4:
                        $this->ChargeMaxRange();
                        break;
                    default:
                        $this->SendDebug(__FUNCTION__ . ' ' . $Ident, 'Undefined Value ' . $Value, 0);
                        break;
                }
                break;
            case 'ChargeLimit':
                $this->SetChargeLimit(intval($Value));
                break;
            case 'ClimateAutoConditioning':
                switch ($Value) {
                    case 1:
                        $this->AutoConditioningStart();
                        break;
                    case 2:
                        $this->AutoConditioningStop();
                        break;
                    default:
                        $this->SendDebug(__FUNCTION__ . ' ' . $Ident, 'Undefined Value ' . $Value, 0);
                        break;
                }
                break;
            case 'DriverTemp':
                SetValue(IPS_GetObjectIDByIdent('DriverTemp', $this->InstanceID), floatval($Value));
                break;
            case 'PassengerTemp':
                SetValue(IPS_GetObjectIDByIdent('PassengerTemp', $this->InstanceID), floatval($Value));
                break;
            case 'SetTemperature':
                $driver_temp = floatval(GetValue(IPS_GetObjectIDByIdent('DriverTemp', $this->InstanceID)));
                $passenger_temp = floatval(GetValue(IPS_GetObjectIDByIdent('PassengerTemp', $this->InstanceID)));
                $this->SetTemps($driver_temp, $passenger_temp);
                break;
            case 'RemoteSeatHeaterHeater':
                SetValue(IPS_GetObjectIDByIdent('RemoteSeatHeaterHeater', $this->InstanceID), intval($Value));
                break;
            case 'RemoteSeatHeaterLevel':
                SetValue(IPS_GetObjectIDByIdent('RemoteSeatHeaterLevel', $this->InstanceID), intval($Value));
                break;
            case 'RemoteSeatHeater':
                $heater = intval(GetValue(IPS_GetObjectIDByIdent('RemoteSeatHeaterHeater', $this->InstanceID)));
                $level = intval(GetValue(IPS_GetObjectIDByIdent('RemoteSeatHeaterLevel', $this->InstanceID)));
                $this->RemoteSeatHeaterRequest($heater, $level);
                break;
            case 'RemoteSteeringWheelHeater':
                $this->RemoteSteeringWheelHeaterRequest($Value);
                break;
            case 'MediaPlayControl':
                switch ($Value) {
                    case 1:
                        $this->MediaTogglePlayback();
                        break;
                    case 2:
                        $this->MediaNextTrack();
                        break;
                    case 3:
                        $this->MediaPrevTrack();
                        break;
                    case 4:
                        $this->MediaNextFav();
                        break;
                    case 5:
                        $this->MediaPrevFav();
                        break;
                    default:
                        $this->SendDebug(__FUNCTION__ . ' ' . $Ident, 'Undefined Value ' . $Value, 0);
                        break;
                }
                break;
            case 'MediaVolume':
                switch ($Value) {
                    case 1:
                        $this->MediaVolumeUp();
                        break;
                    case 2:
                        $this->MediaVolumeDown();
                        break;
                    default:
                        $this->SendDebug(__FUNCTION__ . ' ' . $Ident, 'Undefined Value ' . $Value, 0);
                        break;
                }
                break;
            default:
                $this->SendDebug(__FUNCTION__, 'Undefined Ident', 0);
                break;
        }
    }

    private function RegisterVariablenProfiles()
    {
        //Profile for Alerts
        if (!IPS_VariableProfileExists('Tesla.Alert')) {
            $Associations = array();
            $Associations[] = array(1, $this->Translate('Honk Horn'), 'Speaker', 0xFF0000);
            $Associations[] = array(2, $this->Translate('Flash Lights'), 'Light', 0xFFFF00);
            $this->RegisterProfileIntegerEx('Tesla.Alerts', 'Alert', '', '', $Associations);
        }

        //Profile for Doors
        if (!IPS_VariableProfileExists('Tesla.Doors')) {
            $Associations = array();
            $Associations[] = array(1, $this->Translate('Unlock'), '', 0xFF0000);
            $Associations[] = array(2, $this->Translate('Lock'), '', 0x7CFC00);
            $this->RegisterProfileIntegerEx('Tesla.Doors', 'Lock', '', '', $Associations);
        }

        //Trunk
        if (!IPS_VariableProfileExists('Tesla.Trunk')) {
            $Associations = array();
            $Associations[] = array(1, $this->Translate('Rear'), '', -1);
            $Associations[] = array(2, $this->Translate('Front'), '', -1);
            $this->RegisterProfileIntegerEx('Tesla.Trunk', 'Information', '', '', $Associations);
        }

        //Profile for SunRoof
        if (!IPS_VariableProfileExists('Tesla.SunRoof')) {
            $Associations = array();
            $Associations[] = array(1, $this->Translate('Vent'), '', 0xFF0000);
            $Associations[] = array(2, $this->Translate('Close'), '', 0x7CFC00);
            $this->RegisterProfileIntegerEx('Tesla.SunRoof', 'Sun', '', '', $Associations);
        }

        //Profile for Charge Port
        if (!IPS_VariableProfileExists('Tesla.ChargePort')) {
            $Associations = array();
            $Associations[] = array(1, $this->Translate('Open'), '', 0xFF0000);
            $Associations[] = array(2, $this->Translate('Close'), '', 0x7CFC00);
            $this->RegisterProfileIntegerEx('Tesla.ChargePort', 'Lock', '', '', $Associations);
        }

        //Profile For Charge Control
        if (!IPS_VariableProfileExists('Tesla.ChargeControl')) {
            $Associations = array();
            $Associations[] = array(1, $this->Translate('Start'), '', -1);
            $Associations[] = array(2, $this->Translate('Stop'), '', -1);
            $Associations[] = array(3, $this->Translate('Standard'), '', -1);
            $Associations[] = array(4, $this->Translate('Max Range'), '', -1);
            $this->RegisterProfileIntegerEx('Tesla.ChargeControl', 'Battery', '', '', $Associations);
        }

        //Profile for Climate Auto Conditioning
        if (!IPS_VariableProfileExists('Tesla.ClimateAutoConditioning')) {
            $Associations = array();
            $Associations[] = array(1, $this->Translate('Start'), '', -1);
            $Associations[] = array(2, $this->Translate('Stop'), '', -1);
            $this->RegisterProfileIntegerEx('Tesla.ClimateAutoConditioning', 'Climate', '', '', $Associations);
        }

        //Profile for Climate Remote Seat Heater Heater
        if (!IPS_VariableProfileExists('Tesla.RemoteSeatHeaterHeater')) {
            $Associations = array();
            $Associations[] = array(1, $this->Translate('Driver'), '', -1);
            $Associations[] = array(2, $this->Translate('Passenger'), '', -1);
            $Associations[] = array(3, $this->Translate('Rear left'), '', -1);
            $Associations[] = array(4, $this->Translate('Rear center'), '', -1);
            $Associations[] = array(5, $this->Translate('Rear right'), '', -1);
            $this->RegisterProfileIntegerEx('Tesla.RemoteSeatHeaterHeater', 'Climate', '', '', $Associations);
        }

        //Profile for Climate Remote Seat Heater Level
        if (!IPS_VariableProfileExists('Tesla.RemoteSeatHeaterLevel')) {
            $this->RegisterProfileInteger('Tesla.RemoteSeatHeaterLevel', 'Climate', '', '', 0, 3, 1);
        }
        //Profile for Remote Seat Heater
        if (!IPS_VariableProfileExists('Tesla.SetRemoteSeatHeater')) {
            $Associations = array();
            $Associations[] = array(1, $this->Translate('Set Remote Seat Heater'), '', -1);
            $this->RegisterProfileIntegerEx('Tesla.SetRemoteSeatHeater', 'Temperature', '', '', $Associations);
        }

        //Profile for Climate Remote Steering Wheel Heater
        if (!IPS_VariableProfileExists('Tesla.RemoteSteeringWheelHeater')) {
            $this->RegisterProfileBooleanEx('Tesla.RemoteSteeringWheelHeater', 'Climate', '', '', array(
                array(false, 'Off',  '', -1),
                array(true, 'On',  '', -1),
            ));
        }

        //Profile for Media Playback
        if (!IPS_VariableProfileExists('Tesla.MediaPlayControl')) {
            $Associations = array();
            $Associations[] = array(1, $this->Translate('Toggle Playback'), '', -1);
            $Associations[] = array(2, $this->Translate('Next Track'), '', -1);
            $Associations[] = array(3, $this->Translate('Prev Track'), '', -1);
            $Associations[] = array(4, $this->Translate('Next Favorite'), '', -1);
            $Associations[] = array(5, $this->Translate('Prev Favorite'), '', -1);
            $this->RegisterProfileIntegerEx('Tesla.MediaPlayControl', 'Music', '', '', $Associations);
        }

        //Profile for Media Volume
        if (!IPS_VariableProfileExists('Tesla.MediaVolume')) {
            $Associations = array();
            $Associations[] = array(1, $this->Translate('Up'), '', -1);
            $Associations[] = array(2, $this->Translate('Down'), '', -1);
            $this->RegisterProfileIntegerEx('Tesla.MediaVolume', 'Speaker', '', '', $Associations);
        }

        //Profile for Set Temperature
        if (!IPS_VariableProfileExists('Tesla.SetTemperature')) {
            $Associations = array();
            $Associations[] = array(1, $this->Translate('Set Temperature'), '', -1);
            $this->RegisterProfileIntegerEx('Tesla.SetTemperature', 'Temperature', '', '', $Associations);
        }

        //Profile for WakeUP
        if (!IPS_VariableProfileExists('Tesla.WakeUP')) {
            $Associations = array();
            $Associations[] = array(1, $this->Translate('WakeUP'), '', -1);
            $this->RegisterProfileIntegerEx('Tesla.WakeUP', 'Clock', '', '', $Associations);
        }

        //Profile for Remote Start Drive
        if (!IPS_VariableProfileExists('Tesla.RemoteStartDrive')) {
            $Associations = array();
            $Associations[] = array(1, $this->Translate('Remote Start'), '', -1);
            $this->RegisterProfileIntegerEx('Tesla.RemoteStartDrive', 'Key', '', '', $Associations);
        }
    }
}
