<?
declare(strict_types=1);

class TeslaClimate extends IPSModule
{
    public function Create()
    {
        //Never delete this line!
        parent::Create();

        $this->ConnectParent('{0DE3226B-E63E-87DD-7D2F-46C1A17866D9}');

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

    public function ApplyChanges(){

        //Never delete this line!
        parent::ApplyChanges();
    }

    public function FetchData() {

        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';
        $Data['Buffer'] = 'ClimateState';

        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data),true);

        foreach ($Data['response'] as $key => $Value ) {
            $this->SetValue($key,$Value);
        }
    }
}

?>