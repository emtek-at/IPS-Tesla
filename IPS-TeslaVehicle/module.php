<?php

declare(strict_types=1);

class TeslaVehicle extends IPSModule
{
    public function Create()
    {
        //Never delete this line!
        parent::Create();

        $this->ConnectParent('{0DE3226B-E63E-87DD-7D2F-46C1A17866D9}');

        $this->RegisterVariableInteger('api_version', 'API Version');
        $this->RegisterVariableString('autopark_state_v2', 'Autopark State V2');
        $this->RegisterVariableString('autopark_style', 'Autopark Style');
        $this->RegisterVariableBoolean('calendar_supported', 'Calendar Supported');
        $this->RegisterVariableString('car_version', 'Car Version');
        $this->RegisterVariableInteger('center_display_state', 'Center Display State');
        $this->RegisterVariableInteger('df', 'DF');
        $this->RegisterVariableInteger('dr', 'DR');
        $this->RegisterVariableInteger('ft', 'FT');
        $this->RegisterVariableBoolean('homelink_nearby', 'Homelink Nearby');
        $this->RegisterVariableBoolean('is_user_present', 'Is User Present');

        $this->RegisterVariableString('last_autopark_error', 'Last Autopark Error');
        $this->RegisterVariableBoolean('locked', 'Locked');
        $this->RegisterVariableBoolean('media_state_remote_control_enabled', 'Media State Remote Control Enabled');

        $this->RegisterVariableBoolean('notifications_supported', 'Notifications Supported');
        $this->RegisterVariableFloat('odometer', 'Odometer');
        $this->RegisterVariableBoolean('parsed_calendar_supported', 'Parsed Calendar Supported');
        $this->RegisterVariableInteger('pf', 'PF');
        $this->RegisterVariableInteger('pr', 'PR');
        $this->RegisterVariableBoolean('remote_start', 'Remote Start');
        $this->RegisterVariableBoolean('remote_start_enabled', 'Remote Start Enabled');
        $this->RegisterVariableBoolean('remote_start_supported', 'Remote Start Supported');
        $this->RegisterVariableInteger('rt', 'RT');
        $this->RegisterVariableBoolean('sentry_mode', 'Sentry Mode');
        $this->RegisterVariableInteger('software_update_expected_duration_sec', 'Software Update Expected Duration Sec');
        $this->RegisterVariableString('software_update_status', 'Software Update Status');

        //Speed Limit JSON
        $this->RegisterVariableBoolean('speed_limit_mode_active', 'Speed Limit Mode Active');
        $this->RegisterVariableFloat('speed_limit_mode_current_limit_mph', 'Speed Limit Mode Current Limit Mph');
        $this->RegisterVariableInteger('speed_limit_mode_max_limit_mph', 'Speed Limit Mode Max Limit Mph');
        $this->RegisterVariableInteger('speed_limit_mode_min_limit_mph', 'Speed Limit Mode Min Limit Mph');
        $this->RegisterVariableBoolean('speed_limit_mode_pin_code_set', 'Speed Limit Mode Pin Code Set');

        $this->RegisterVariableInteger('sun_roof_percent_open', 'Sun Roof Percent Open');
        $this->RegisterVariableString('sun_roof_state', 'Sun Roof State');
        $this->RegisterVariableInteger('timestamp', 'Timestamp');
        $this->RegisterVariableBoolean('valet_mode', 'Valet Mode');
        $this->RegisterVariableBoolean('valet_pin_needed', 'Valet Pin Needed');
        $this->RegisterVariableString('vehicle_name', 'Vehicle Name');
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
