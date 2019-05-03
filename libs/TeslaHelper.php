<?php

trait TeslaHelper {

    protected function createChargingVariables() {
        $this->RegisterVariableBoolean('battery_heater_on','Battery Heater On','~Switch');
        $this->RegisterVariableInteger('battery_level','Battery Level');
        $this->RegisterVariableFloat('battery_range','Battery Range');
        $this->RegisterVariableInteger('charge_current_request','Charge Current Request');
        $this->RegisterVariableInteger('charge_current_request_max','Charge Current Request Max');
        $this->RegisterVariableBoolean('charge_enable_request','Charge Enable Request', '~Switch');
        $this->RegisterVariableFloat('charge_energy_added','Charge Energy Added');
        $this->RegisterVariableInteger('charge_limit_soc','Charge Limit Soc');
        $this->RegisterVariableInteger('charge_limit_soc_max','Charge Limit Soc Max');
        $this->RegisterVariableInteger('charge_limit_soc_min','Charge Limit Soc Min');
        $this->RegisterVariableInteger('charge_limit_soc_std','Charge Limit Soc Std');
        $this->RegisterVariableFloat('charge_miles_added_ideal','Charge Miles Added Ideal');
        $this->RegisterVariableFloat('charge_miles_added_rated','Charge Miles Added Rated');
        $this->RegisterVariableBoolean('charge_port_cold_weather_mode','Charge Port Cold Weather Mode', '~Switch');
        $this->RegisterVariableBoolean('charge_port_door_open','Charge Port Door Open', '~Switch');
        $this->RegisterVariableString('charge_port_latch','Charge Port Latch');
        $this->RegisterVariableFloat('charge_rate','Charge Rate');
        $this->RegisterVariableBoolean('charge_to_max_range','Charge To Max Range');
        $this->RegisterVariableInteger('charger_actual_current','Charger Actual Current');
        $this->RegisterVariableString('charger_phases','Charger Phases');
        $this->RegisterVariableInteger('charger_pilot_current','Charger PPilot Current');
        $this->RegisterVariableInteger('charger_power','ChargerPower');
        $this->RegisterVariableInteger('charger_voltage','Charger Voltage');
        $this->RegisterVariableString('charging_state','Charging State');
        $this->RegisterVariableString('conn_charge_cable','Conn Charge Cable');
        $this->RegisterVariableFloat('est_battery_range','Est Battery Range');
        $this->RegisterVariableString('fast_charger_brand','Fast Charger Brand');
        $this->RegisterVariableBoolean('fast_charger_present','Fast Charger Present');
        $this->RegisterVariableString('fast_charger_type','Fast Charger Type');
        $this->RegisterVariableFloat('ideal_battery_range','Ideal Battery Range');
        $this->RegisterVariableBoolean('managed_charging_active','Managed Charging Active');
        $this->RegisterVariableString('managed_charging_start_time','Managed Charging Start Time');
        $this->RegisterVariableBoolean('managed_charging_user_canceled','Managed Charging User Canceled');
        $this->RegisterVariableInteger('max_range_charge_counter','Max Range Charge Counter');
        $this->RegisterVariableBoolean('not_enough_power_to_heat','Not Enough Power To Heat');
        $this->RegisterVariableBoolean('scheduled_charging_pending','Scheduled Charging Pending');
        $this->RegisterVariableString('scheduled_charging_start_time','Scheduled Charging Start Time');
        $this->RegisterVariableFloat('time_to_full_charge','Time To Full Charge');
        $this->RegisterVariableInteger('timestamp','Timestamp');
        $this->RegisterVariableBoolean('trip_charging','Trip Charging');
        $this->RegisterVariableInteger('usable_battery_level','Usable Battery Level');
        $this->RegisterVariableString('user_charge_enable_request','User Charge Enable Request');
    }

    protected function createClimateVariables() {
        $this->RegisterVariableBoolean('battery_heater','Battery Heater');
        $this->RegisterVariableBoolean('battery_heater_no_power','Battery Heater no Power');
        $this->RegisterVariableString('climate_keeper_mode','Climate Keeper Mode');
        $this->RegisterVariableFloat('driver_temp_setting','Driver Temp Setting');
        $this->RegisterVariableInteger('fan_status','Fan Status');
        $this->RegisterVariableString('inside_temp','Inside Temp');
        $this->RegisterVariableString('is_auto_conditioning_on','Is Auto Conditioning on');
        $this->RegisterVariableBoolean('is_climate_on','Is Climate on');
        $this->RegisterVariableBoolean('is_front_defroster_on','Is Front Defroster on');
        $this->RegisterVariableBoolean('is_preconditioning','Is Preconditioning');
        $this->RegisterVariableBoolean('is_rear_defroster_on','Is Rear Defroster on');
        $this->RegisterVariableString('left_temp_direction','Left Temp Direction');
        $this->RegisterVariableFloat('max_avail_temp','Max Avail Temp');
        $this->RegisterVariableFloat('min_avail_temp','Min Avail Temp');
        $this->RegisterVariableString('outside_temp','outside_temp');
        $this->RegisterVariableFloat('passenger_temp_setting','Passenger Temp Setting');
        $this->RegisterVariableBoolean('remote_heater_control_enabled','Remote Heater Control Enabled');
        $this->RegisterVariableString('right_temp_direction','Right Temp Direction');
        $this->RegisterVariableInteger('seat_heater_left','Seat Heater Left');
        $this->RegisterVariableInteger('seat_heater_rear_center','Seat Heater Rear Center');
        $this->RegisterVariableInteger('seat_heater_rear_left','Seat Heater Rear Left');
        $this->RegisterVariableInteger('seat_heater_rear_left_back','Seat Heater Rear Left Back');
        $this->RegisterVariableInteger('seat_heater_rear_right','Seat Heater Rear Right');
        $this->RegisterVariableInteger('seat_heater_rear_right_back','Seat Heater Rear Right Back');
        $this->RegisterVariableInteger('seat_heater_right','Seat Heater Right');
        $this->RegisterVariableBoolean('side_mirror_heaters','Side Mirror Heaters');
        $this->RegisterVariableBoolean('smart_preconditioning','Smart Preconditioning');
        $this->RegisterVariableBoolean('steering_wheel_heater','Steering Wheel Heater');
        $this->RegisterVariableInteger('timestamp','Timestamp');
        $this->RegisterVariableBoolean('wiper_blade_heater','Wiper Blade Heater');
    }

    protected function createDriveVariables() {
        $this->RegisterVariableString('gps_as_of','GPS as of');
        $this->RegisterVariableInteger('heading','Heading');
        $this->RegisterVariableString('latitude','Latitude');
        $this->RegisterVariableString('longitude','Longitude');
        $this->RegisterVariableString('native_latitude','Native Latitude');
        $this->RegisterVariableInteger('native_location_supported','Native Location Supported');
        $this->RegisterVariableString('native_longitude','Native Longitude');
        $this->RegisterVariableString('native_type','Native Type');
        $this->RegisterVariableInteger('power','Power');
        $this->RegisterVariableString('shift_state','Shift State');
        $this->RegisterVariableString('speed','Speed');
        $this->RegisterVariableString('timestamp','Timestamp');
    }

    protected function createGUISettingsVariables() {
        $this->RegisterVariableBoolean('gui_24_hour_time','GUI 24 Hour Time');
        $this->RegisterVariableString('gui_charge_rate_units','GUI Charge Rate Units');
        $this->RegisterVariableString('gui_distance_units','GUI Distance Units');
        $this->RegisterVariableString('gui_range_display','GUI Range Display');
        $this->RegisterVariableString('gui_temperature_units','GUI Temperature Units');
        $this->RegisterVariableString('timestamp','timestamp');
    }

    public function getVehicles() {
        $result = $this->sendRequest('/vehicles');
        return $result;
    }

    public function getVehicleData() {
        $result = $this->sendRequest('/vehicles/'.$this->ReadPropertyString('Vehicles').'/vehicle_data');
        IPS_LogMessage('Autos', print_r($result,1));
    }

    public function getChargeState() {
        return $this->sendRequest('/vehicles/'.$this->ReadPropertyString('Vehicles').'/data_request/charge_state');
    }

    public function getClimateState() {
        return $this->sendRequest('/vehicles/'.$this->ReadPropertyString('Vehicles').'/data_request/climate_state');
    }

    public function getDriveState() {
        return $this->sendRequest('/vehicles/'.$this->ReadPropertyString('Vehicles').'/data_request/drive_state');
    }

    public function getGUISettings() {
        return $this->sendRequest('/vehicles/'.$this->ReadPropertyString('Vehicles').'/data_request/gui_settings');
    }

}

trait TeslaConnect {

    private $base_url = 'https://owner-api.teslamotors.com/api/1';
    private $token_url = 'https://owner-api.teslamotors.com/oauth/token';

    private function FetchAccessToken()
    {

        $this->SendDebug("FetchAccessToken", "", 0);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->token_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Accept: application/json',
            'User-Agent: Mozilla/5.0 (Linux; Android 9.0.0; VS985 4G Build/LRX21Y; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/58.0.3029.83 Mobile Safari/537.36',
            'X-Tesla-User-Agent: TeslaApp/3.4.4-350/fad4a582e/android/9.0.0',
        ]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            'grant_type' => 'password',
            'client_id' => $this->ReadPropertyString('Client_ID'),
            'client_secret' => $this->ReadPropertyString('Client_Secret'),
            'email' => $this->ReadPropertyString("EMail"),
            'password' => $this->ReadPropertyString("Password"),
        ]));

        $apiResult = curl_exec($ch);

        if ($apiResult === false) {
            die('Curl-Fehler: ' . curl_error($ch));
        }

        $apiResultJson = json_decode($apiResult, true);
        curl_close($ch);
        $accessToken = $apiResultJson['access_token'];
        $TokenExpires = $apiResultJson['expires_in'];

        if($apiResultJson === null) {
            die("Invalid response while fetching access token!");
        }
        if (!isset($apiResultJson['token_type']) || $apiResultJson['token_type'] != "bearer") {
            die("Bearer Token expected");
        }

        $this->WriteAttributeString("Token", $accessToken);
        $this->WriteAttributeString("TokenExpires", $TokenExpires);
        return true;
    }

    protected function sendRequest(string $endpoint, array $params = [], string $method = 'GET') {

        $accessToken = $this->ReadAttributeString('Token');
        $tokenExpires = $this->ReadAttributeString('TokenExpires');

        if ($accessToken == "" || time() >= intval($tokenExpires)) {
            if ($this->FetchAccessToken()) {
                $accessToken = $this->ReadAttributeString('Token');
            }
        }

        $ch = curl_init();
        $this->SendDebug(__FUNCTION__.' URL',$this->base_url . $endpoint,0);
        curl_setopt($ch, CURLOPT_URL, $this->base_url . $endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Accept: application/json',
            'User-Agent: Mozilla/5.0 (Linux; Android 9.0.0; VS985 4G Build/LRX21Y; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/58.0.3029.83 Mobile Safari/537.36',
            'X-Tesla-User-Agent: TeslaApp/3.4.4-350/fad4a582e/android/9.0.0',
            'Authorization: Bearer ' . $accessToken,
        ]);

        if ($method == 'POST' || $method == 'PUT' || $method == 'DELETE') {
            if ($method == 'POST') {
                curl_setopt($ch, CURLOPT_POST, true);
            }
            if (in_array($method, ['PUT', 'DELETE'])) {
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
            }
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        }

        $apiResult = curl_exec($ch);
        $headerInfo = curl_getinfo($ch);
        $apiResultJson = json_decode($apiResult, true);
        curl_close($ch);

        $result = [];
        if ($apiResult === false) {
            $result['errorcode'] = 0;
            $result['errormessage'] = curl_error($ch);
            $this->SendDebug(__FUNCTION__.' Error',  $result['errorcode'].': '.$result['errormessage'],0 );
        }
        if (! in_array($headerInfo['http_code'], ['200', '201', '204'])) {
            $result['errorcode'] = $headerInfo['http_code'];
            if (isset($apiresult)) {
                $result['errormessage'] = $apiresult;
            }
            $this->SendDebug(__FUNCTION__.' Error',  $result['errorcode'].': '.$result['errormessage'],0 );
        }

        return $apiResultJson ?? $apiResult;
    }


}
