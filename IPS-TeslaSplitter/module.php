<?php

declare(strict_types=1);

class TeslaSplitter extends IPSModule
{
    private $base_url = 'https://owner-api.teslamotors.com/api/1';
    private $token_url = 'https://owner-api.teslamotors.com/oauth/token';

    public function Create()
    {
        //Never delete this line!
        parent::Create();

        $this->RegisterPropertyString('EMail', '');
        $this->RegisterPropertyString('Password', '');

        $this->RegisterPropertyString('Client_ID', '');
        $this->RegisterPropertyString('Client_Secret', '');

        $this->RegisterPropertyInteger('Interval', 5);
        $this->RegisterPropertyString('Vehicles', 0);

        $this->RegisterAttributeString('Token', '');
        $this->RegisterAttributeString('TokenExpires', '');
    }

    public function ApplyChanges()
    {

        //Never delete this line!
        parent::ApplyChanges();
    }

    public function GetConfigurationForm()
    {
        //$Form = json_decode(file_get_contents(__DIR__ . '/form.json'), true);
        $Form = array();

        $Form['elements'][0]['type'] = 'ValidationTextBox';
        $Form['elements'][0]['name'] = 'EMail';
        $Form['elements'][0]['caption'] = 'E-Mail';

        $Form['elements'][1]['type'] = 'PasswordTextBox';
        $Form['elements'][1]['name'] = 'Password';
        $Form['elements'][1]['caption'] = 'Password';

        $Form['elements'][2]['type'] = 'ValidationTextBox';
        $Form['elements'][2]['name'] = 'Client_ID';
        $Form['elements'][2]['caption'] = 'Client ID';

        $Form['elements'][3]['type'] = 'ValidationTextBox';
        $Form['elements'][3]['name'] = 'Client_Secret';
        $Form['elements'][3]['caption'] = 'Client Secret';

        $EMail = $this->ReadPropertyString('EMail');
        $Password = $this->ReadPropertyString('Password');
        $Client_ID = $this->ReadPropertyString('Client_ID');
        $Client_Secret = $this->ReadPropertyString('Client_Secret');

        $FormElementCount = 4;
        if ($EMail || $Password || $Client_ID || $Client_Secret != '') {
            $Vehicles = $this->getVehicles();
            if ($Vehicles['count'] > 0) {
                $Form['elements'][$FormElementCount]['type'] = 'Select';
                $Form['elements'][$FormElementCount]['name'] = 'Vehicles';
                $Form['elements'][$FormElementCount]['caption'] = 'Vehicles';
                $selectOptions[0]['caption'] = $this->Translate('Please select a car!');
                $selectOptions[0]['value'] = '0';
                $optionsElementCount = 1;
                foreach ($Vehicles['response'] as $Vehicle) {
                    $selectOptions[$optionsElementCount]['caption'] = $Vehicle['display_name'];
                    $selectOptions[$optionsElementCount]['value'] = strval($Vehicle['id_s']);
                    $this->SendDebug('Form', $Vehicle['id'], 0);
                    $optionsElementCount++;
                }
                $Form['elements'][$FormElementCount]['options'] = $selectOptions;
            }
        }
        return json_encode($Form);
    }

    public function ForwardData($JSONString)
    {
        $this->SendDebug(__FUNCTION__, $JSONString, 0);
        $data = json_decode($JSONString);

        switch ($data->Buffer->Command) {
            case 'ChargingState':
                $result = $this->sendRequest('/vehicles/' . $this->ReadPropertyString('Vehicles') . '/data_request/charge_state');
                break;
            case 'ClimateState':
                $result = $this->sendRequest('/vehicles/' . $this->ReadPropertyString('Vehicles') . '/data_request/climate_state');
                break;
            case 'DriveState':
                $result = $this->sendRequest('/vehicles/' . $this->ReadPropertyString('Vehicles') . '/data_request/drive_state');
                break;
            case 'GUISettings':
                $result = $this->sendRequest('/vehicles/' . $this->ReadPropertyString('Vehicles') . '/data_request/gui_settings');
                break;
            case 'VehicleState':
                $result = $this->sendRequest('/vehicles/' . $this->ReadPropertyString('Vehicles') . '/data_request/vehicle_state');
                break;
            case 'VehicleConfig':
                $result = $this->sendRequest('/vehicles/' . $this->ReadPropertyString('Vehicles') . '/data_request/vehicle_config');
                break;
            case 'WakeUP':
                $result = $this->sendRequest('/vehicles/' . $this->ReadPropertyString('Vehicles') . '/wake_up', array(), 'POST');
                break;
            case 'HonkHorn':
                $result = $this->sendRequest('/vehicles/' . $this->ReadPropertyString('Vehicles') . '/command/honk_horn', array(), 'POST');
                break;
            case 'FlashLights':
                $result = $this->sendRequest('/vehicles/' . $this->ReadPropertyString('Vehicles') . '/command/flash_lights', array(), 'POST');
                break;
            case 'RemoteStartDrive':
                $result = $this->sendRequest('/vehicles/' . $this->ReadPropertyString('Vehicles') . '/command/remote_start_drive?password=' . $this->ReadPropertyString('Password'), array(), 'POST');
                break;
            case 'SpeedLimitSetLimit':
                $params = (array) $data->Buffer->Params;
                $result = $this->sendRequest('/vehicles/' . $this->ReadPropertyString('Vehicles') . '/command/speed_limit_set_limit', $params, 'POST');
                break;
            case 'SpeedLimitActivate':
                $params = (array) $data->Buffer->Params;
                $result = $this->sendRequest('/vehicles/' . $this->ReadPropertyString('Vehicles') . '/command/speed_limit_activate', $params, 'POST');
                break;
            case 'SpeedLimitDeactivate':
                $params = (array) $data->Buffer->Params;
                $result = $this->sendRequest('/vehicles/' . $this->ReadPropertyString('Vehicles') . '/command/speed_limit_deactivate', $params, 'POST');
                break;
            case 'SpeedLimitClearPin':
                $params = (array) $data->Buffer->Params;
                $result = $this->sendRequest('/vehicles/' . $this->ReadPropertyString('Vehicles') . '/command/speed_limit_clear_pin', $params, 'POST');
                break;
            case 'SetValetMode':
                $params = (array) $data->Buffer->Params;
                $result = $this->sendRequest('/vehicles/' . $this->ReadPropertyString('Vehicles') . '/command/set_valet_mode', $params, 'POST');
                break;
            case 'ResetValetPin':
                $result = $this->sendRequest('/vehicles/' . $this->ReadPropertyString('Vehicles') . '/command/reset_valet_pin', array(), 'POST');
                break;
            case 'SetSentryMode':
                $params = (array) $data->Buffer->Params;
                $result = $this->sendRequest('/vehicles/' . $this->ReadPropertyString('Vehicles') . '/command/set_sentry_mode', $params, 'POST');
                break;
            case 'DoorUnlock':
                $result = $this->sendRequest('/vehicles/' . $this->ReadPropertyString('Vehicles') . '/command/door_unlock', array(), 'POST');
                break;
            case 'DoorLock':
                $result = $this->sendRequest('/vehicles/' . $this->ReadPropertyString('Vehicles') . '/command/door_lock', array(), 'POST');
                break;
            case 'ActuateTrunk':
                $params = (array) $data->Buffer->Params;
                $result = $this->sendRequest('/vehicles/' . $this->ReadPropertyString('Vehicles') . '/command/actuate_trunk', array(), 'POST');
                break;
            case 'SunRoofControl':
                $params = (array) $data->Buffer->Params;
                $result = $this->sendRequest('/vehicles/' . $this->ReadPropertyString('Vehicles') . '/command/sun_roof_control', $params, 'POST');
                break;
            case 'ChargePortDoorOpen':
                $result = $this->sendRequest('/vehicles/' . $this->ReadPropertyString('Vehicles') . '/command/charge_port_door_open', array(), 'POST');
                break;
            case 'ChargePortDoorClose':
                $result = $this->sendRequest('/vehicles/' . $this->ReadPropertyString('Vehicles') . '/command/charge_port_door_close', array(), 'POST');
                break;
            case 'ChargeStart':
                $result = $this->sendRequest('/vehicles/' . $this->ReadPropertyString('Vehicles') . '/command/charge_start', array(), 'POST');
                break;
            case 'ChargeStop':
                $result = $this->sendRequest('/vehicles/' . $this->ReadPropertyString('Vehicles') . '/command/charge_stop', array(), 'POST');
                break;
            case 'ChargeStandard':
                $result = $this->sendRequest('/vehicles/' . $this->ReadPropertyString('Vehicles') . '/command/charge_standard', array(), 'POST');
                break;
            case 'ChargeMaxRange':
                $result = $this->sendRequest('/vehicles/' . $this->ReadPropertyString('Vehicles') . '/command/charge_max_range', array(), 'POST');
                break;
            case 'SetChargeLimit':
                $params = (array) $data->Buffer->Params;
                $result = $this->sendRequest('/vehicles/' . $this->ReadPropertyString('Vehicles') . '/command/set_charge_limit', $params, 'POST');
                break;
            case 'AutoConditioningStart':
                $result = $this->sendRequest('/vehicles/' . $this->ReadPropertyString('Vehicles') . '/command/auto_conditioning_start', array(), 'POST');
                break;
            case 'AutoConditioningStop':
                $result = $this->sendRequest('/vehicles/' . $this->ReadPropertyString('Vehicles') . '/command/auto_conditioning_stop', array(), 'POST');
                break;
            case 'SetTemps':
                $params = (array) $data->Buffer->Params;
                $result = $this->sendRequest('/vehicles/' . $this->ReadPropertyString('Vehicles') . '/command/set_temps', $params, 'POST');
                break;
            case 'RemoteSeatHeaterRequest':
                $params = (array) $data->Buffer->Params;
                $result = $this->sendRequest('/vehicles/' . $this->ReadPropertyString('Vehicles') . '/command/remote_seat_heater_request', $params, 'POST');
                break;
            case 'RemoteSteeringWheelHeaterRequest':
                $result = $this->sendRequest('/vehicles/' . $this->ReadPropertyString('Vehicles') . '/command/remote_steering_wheel_heater_request', array(), 'POST');
                break;
            case 'MediaTogglePlayback':
                $result = $this->sendRequest('/vehicles/' . $this->ReadPropertyString('Vehicles') . '/command/media_toggle_playback', array(), 'POST');
                break;
            case 'MediaNextTrack':
                $result = $this->sendRequest('/vehicles/' . $this->ReadPropertyString('Vehicles') . '/command/media_next_track', array(), 'POST');
                break;
            case 'MediaPrevTrack':
                $result = $this->sendRequest('/vehicles/' . $this->ReadPropertyString('Vehicles') . '/command/media_prev_track', array(), 'POST');
                break;
            case 'MediaNextFav':
                $result = $this->sendRequest('/vehicles/' . $this->ReadPropertyString('Vehicles') . '/command/media_next_fav', array(), 'POST');
                break;
            case 'MediaPrevFav':
                $result = $this->sendRequest('/vehicles/' . $this->ReadPropertyString('Vehicles') . '/command/media_prev_fav', array(), 'POST');
                break;
            case 'MediaVolumeUp':
                $result = $this->sendRequest('/vehicles/' . $this->ReadPropertyString('Vehicles') . '/command/media_volume_up', array(), 'POST');
                break;
            case 'MediaVolumeDown':
                $result = $this->sendRequest('/vehicles/' . $this->ReadPropertyString('Vehicles') . '/command/media_volume_down', array(), 'POST');
                break;
            default:
                $this->SendDebug(__FUNCTION__, $data->Buffer->Command, 0);
                break;
        }
        $this->SendDebug(__FUNCTION__, json_encode($result), 0);
        return json_encode($result);
    }

    private function getVehicles()
    {
        $result = $this->sendRequest('/vehicles');
        return $result;
    }

    private function FetchAccessToken()
    {
        $this->SendDebug('FetchAccessToken', '', 0);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->token_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Accept: application/json',
            'User-Agent: Mozilla/5.0 (Linux; Android 9.0.0; VS985 4G Build/LRX21Y; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/58.0.3029.83 Mobile Safari/537.36',
            'X-Tesla-User-Agent: TeslaApp/3.4.4-350/fad4a582e/android/9.0.0',
        ));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(array(
            'grant_type'    => 'password',
            'client_id'     => $this->ReadPropertyString('Client_ID'),
            'client_secret' => $this->ReadPropertyString('Client_Secret'),
            'email'         => $this->ReadPropertyString('EMail'),
            'password'      => $this->ReadPropertyString('Password'),
        )));

        $apiResult = curl_exec($ch);

        if ($apiResult === false) {
            die('Curl-Fehler: ' . curl_error($ch));
        }

        $apiResultJson = json_decode($apiResult, true);
        curl_close($ch);
        $accessToken = $apiResultJson['access_token'];
        $TokenExpires = $apiResultJson['expires_in'];

        if ($apiResultJson === null) {
            die('Invalid response while fetching access token!');
        }
        if (!isset($apiResultJson['token_type']) || $apiResultJson['token_type'] != 'bearer') {
            die('Bearer Token expected');
        }

        $this->WriteAttributeString('Token', $accessToken);
        $this->WriteAttributeString('TokenExpires', $TokenExpires);
        return true;
    }

    private function sendRequest(string $endpoint, array $params = array(), string $method = 'GET')
    {
        $accessToken = $this->ReadAttributeString('Token');
        $tokenExpires = $this->ReadAttributeString('TokenExpires');

        if ($accessToken == '' || time() >= intval($tokenExpires)) {
            if ($this->FetchAccessToken()) {
                $accessToken = $this->ReadAttributeString('Token');
            }
        }

        $ch = curl_init();
        $this->SendDebug(__FUNCTION__ . ' URL', $this->base_url . $endpoint, 0);
        curl_setopt($ch, CURLOPT_URL, $this->base_url . $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Accept: application/json',
            'User-Agent: Mozilla/5.0 (Linux; Android 9.0.0; VS985 4G Build/LRX21Y; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/58.0.3029.83 Mobile Safari/537.36',
            'X-Tesla-User-Agent: TeslaApp/3.4.4-350/fad4a582e/android/9.0.0',
            'Authorization: Bearer ' . $accessToken,
        ));

        if ($method == 'POST' || $method == 'PUT' || $method == 'DELETE') {
            if ($method == 'POST') {
                curl_setopt($ch, CURLOPT_POST, true);
            }
            if (in_array($method, array('PUT', 'DELETE'))) {
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            }
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        }

        $apiResult = curl_exec($ch);
        $headerInfo = curl_getinfo($ch);
        $apiResultJson = json_decode($apiResult, true);
        curl_close($ch);

        if (array_key_exists('error', $apiResultJson)) {
            $this->SendDebug(__FUNCTION__, $apiResultJson['error'], 0);
            if (fnmatch('*vehicle unavailable*', $apiResultJson['error'])) {
                IPS_LogMessage('Tesla', 'Vehicle unavailable');
                return false;
            }
        }

        $result = array();
        if ($apiResult === false) {
            $result['errorcode'] = 0;
            $result['errormessage'] = curl_error($ch);
            $this->SendDebug(__FUNCTION__ . ' Error', $result['errorcode'] . ': ' . $result['errormessage'], 0);
            return false;
        }
        if (!in_array($headerInfo['http_code'], array('200', '201', '204'))) {
            $result['errorcode'] = $headerInfo['http_code'];
            if (isset($apiresult)) {
                $result['errormessage'] = $apiresult;
            }
            $this->SendDebug(__FUNCTION__ . ' Error', $result['errorcode'], 0);
            return false;
        }

        return $apiResultJson ?? $apiResult;
    }
}
