<?
declare(strict_types=1);

class TeslaCharging extends IPSModule
{
    public function Create()
    {
        //Never delete this line!
        parent::Create();

        $this->ConnectParent('{0DE3226B-E63E-87DD-7D2F-46C1A17866D9}');

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

    public function ApplyChanges(){

        //Never delete this line!
        parent::ApplyChanges();
    }

    public function FetchData() {

        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';

        $Buffer['Command'] = 'ChargingState';
        $Buffer['Params'] = '';

        $Data['Buffer'] = $Buffer;

        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data),true);
        //$this->SendDebug(__FUNCTION__. ' Result', $result,0);
        foreach ($Data['response'] as $key => $Value ) {
            $this->SetValue($key,$Value);
        }

    }
}

?>