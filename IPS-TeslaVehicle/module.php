<?php

declare(strict_types=1);
require_once __DIR__ . '/../libs/TeslaHelper.php';

class TeslaVehicle extends IPSModule
{
    use TeslaHelper;
    public function Create()
    {
        //Never delete this line!
        parent::Create();

        $this->ConnectParent('{0DE3226B-E63E-87DD-7D2F-46C1A17866D9}');

        $this->RegisterPropertyInteger('Interval',60);

        $this->RegisterVariableInteger('api_version', $this->Translate('API Version'));
        $this->RegisterVariableString('autopark_state_v2', $this->Translate('Autopark State V2'));
        $this->RegisterVariableString('autopark_style', $this->Translate('Autopark Style'));
        $this->RegisterVariableBoolean('calendar_supported', $this->Translate('Calendar Supported'));
        $this->RegisterVariableString('car_version', $this->Translate('Car Version'));
        $this->RegisterVariableInteger('center_display_state', $this->Translate('Center Display State'));
        $this->RegisterVariableInteger('df', $this->Translate('DF'));
        $this->RegisterVariableInteger('dr', $this->Translate('DR'));
        $this->RegisterVariableInteger('ft', $this->Translate('FT'));
        $this->RegisterVariableBoolean('homelink_nearby', $this->Translate('Homelink Nearby'));
        $this->RegisterVariableBoolean('is_user_present', $this->Translate('Is User Present'));

        $this->RegisterVariableString('last_autopark_error', $this->Translate('Last Autopark Error'));
        $this->RegisterVariableBoolean('locked', $this->Translate('Locked'));
        $this->RegisterVariableBoolean('media_state_remote_control_enabled', $this->Translate('Media State Remote Control Enabled'));

        $this->RegisterVariableBoolean('notifications_supported', $this->Translate('Notifications Supported'));
        $this->RegisterVariableFloat('odometer', $this->Translate('Odometer'));
        $this->RegisterVariableBoolean('parsed_calendar_supported', $this->Translate('Parsed Calendar Supported'));
        $this->RegisterVariableInteger('pf', $this->Translate('PF'));
        $this->RegisterVariableInteger('pr', $this->Translate('PR'));
        $this->RegisterVariableBoolean('remote_start', $this->Translate('Remote Start'));
        $this->RegisterVariableBoolean('remote_start_enabled', $this->Translate('Remote Start Enabled'));
        $this->RegisterVariableBoolean('remote_start_supported', $this->Translate('Remote Start Supported'));
        $this->RegisterVariableInteger('rt', $this->Translate('RT'));
        $this->RegisterVariableBoolean('sentry_mode', $this->Translate('Sentry Mode'));
        $this->RegisterVariableInteger('software_update_expected_duration_sec', $this->Translate('Software Update Expected Duration Sec'));
        $this->RegisterVariableString('software_update_status', $this->Translate('Software Update Status'));

        //Speed Limit JSON
        $this->RegisterVariableBoolean('speed_limit_mode_active', $this->Translate('Speed Limit Mode Active'));
        $this->RegisterVariableFloat('speed_limit_mode_current_limit_mph', $this->Translate('Speed Limit Mode Current Limit Mph'));
        $this->RegisterVariableInteger('speed_limit_mode_max_limit_mph', $this->Translate('Speed Limit Mode Max Limit Mph'));
        $this->RegisterVariableInteger('speed_limit_mode_min_limit_mph', $this->Translate('Speed Limit Mode Min Limit Mph'));
        $this->RegisterVariableBoolean('speed_limit_mode_pin_code_set', $this->Translate('Speed Limit Mode Pin Code Set'));

        $this->RegisterVariableInteger('sun_roof_percent_open', $this->Translate('Sun Roof Percent Open'));
        $this->RegisterVariableString('sun_roof_state', $this->Translate('Sun Roof State'));
        $this->RegisterVariableInteger('timestamp', $this->Translate('Timestamp'));
        $this->RegisterVariableBoolean('valet_mode', $this->Translate('Valet Mode'));
        $this->RegisterVariableBoolean('valet_pin_needed', $this->Translate('Valet Pin Needed'));
        $this->RegisterVariableString('vehicle_name', $this->Translate('Vehicle Name'));

        $this->RegisterTimer('Tesla_UpdateVehicle', 0, 'Tesla_FetchData($_IPS[\'TARGET\']);');
    }

    public function Destroy()
    {
        $this->UnregisterTimer('Tesla_UpdateVehicle');
    }

    public function ApplyChanges()
    {

        //Never delete this line!
        parent::ApplyChanges();
    }

    public function FetchData()
    {
        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'VehicleState';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;

        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data), true);

        if (!$Data) {
            return false;
        }

        foreach ($Data['response'] as $key => $Value) {
            switch ($key) {
                case 'speed_limit_mode':
                    $SpeedLimitMode = $Value;
                    foreach ($SpeedLimitMode as $SpeedLimitKey => $SpeedLimitValue) {
                        $this->SetValue('speed_limit_mode_' . $SpeedLimitKey, $SpeedLimitValue);
                    }
                    break;
                case 'software_update':
                    $SoftwareUpdate = $Value;
                    foreach ($SoftwareUpdate as $SoftwareUpdateKey => $SoftwareUpdateValue) {
                        $this->SetValue('software_update_' . $SoftwareUpdateKey, $SoftwareUpdateValue);
                    }
                    break;
                case 'media_state':
                    $MediaState = $Value;
                    foreach ($MediaState as $MediaStateeKey => $MediaStateValue) {
                        $this->SetValue('media_state_' . $MediaStateeKey, $MediaStateValue);
                    }
                    break;
                default:
                    $this->SendDebug(__FUNCTION__ . ' ' . $key, $key, 0);
                    $this->SetValue($key, $Value);
            }
        }
    }
}
