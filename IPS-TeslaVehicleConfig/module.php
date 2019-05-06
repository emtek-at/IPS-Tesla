<?
declare(strict_types=1);

class TeslaVehicleConfig extends IPSModule
{
    public function Create()
    {
        //Never delete this line!
        parent::Create();

        $this->ConnectParent('{0DE3226B-E63E-87DD-7D2F-46C1A17866D9}');

        $this->RegisterVariableBoolean('can_accept_navigation_requests', 'Can Accept Navigation Requests');
        $this->RegisterVariableBoolean('can_actuate_trunks', 'Can Actuate Trunks');
        $this->RegisterVariableString('car_special_type', 'Car Special Type');
        $this->RegisterVariableString('car_type', 'Car Type');
        $this->RegisterVariableString('charge_port_type', 'Charge Port Type');
        $this->RegisterVariableBoolean('eu_vehicle', 'EU Vehicle');
        $this->RegisterVariableString('exterior_color', 'Exterior Color');
        $this->RegisterVariableBoolean('has_air_suspension', 'Has Air Suspension');
        $this->RegisterVariableBoolean('has_ludicrous_mode', 'Has Ludicrous Mode');
        $this->RegisterVariableInteger('key_version', 'Key Version');
        $this->RegisterVariableBoolean('motorized_charge_port', 'Motorized Charge Port');
        $this->RegisterVariableString('perf_config', 'Perf Config');
        $this->RegisterVariableBoolean('plg', 'PLG');
        $this->RegisterVariableInteger('rear_seat_heaters', 'Rear Seat Heaters');
        $this->RegisterVariableInteger('rear_seat_type', 'Rear Seat Type');
        $this->RegisterVariableBoolean('rhd', 'RHD');
        $this->RegisterVariableString('roof_color', 'Roof Color');
        $this->RegisterVariableInteger('seat_type', 'Seat type');
        $this->RegisterVariableString('spoiler_type', 'Spoiler Type');
        $this->RegisterVariableInteger('sun_roof_installed', 'Sun Roof Installed');
        $this->RegisterVariableString('third_row_seats', 'Third Row Seats');
        $this->RegisterVariableInteger('timestamp', 'Timestamp');
        $this->RegisterVariableString('trim_badging', 'Trim Badging');
        $this->RegisterVariableString('wheel_type', 'Wheel Type');
    }

    public function ApplyChanges(){

        //Never delete this line!
        parent::ApplyChanges();
    }

    public function FetchData() {

        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'VehicleConfig';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;
        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data),true);

        foreach ($Data['response'] as $key => $Value ) {
            $this->SendDebug(__FUNCTION__. ' '.$key,$key,0);
            $this->SetValue($key,$Value);
        }
    }
}

?>