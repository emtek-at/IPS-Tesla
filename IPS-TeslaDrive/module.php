<?
declare(strict_types=1);

class TeslaDrive extends IPSModule
{
    public function Create()
    {
        //Never delete this line!
        parent::Create();

        $this->ConnectParent('{0DE3226B-E63E-87DD-7D2F-46C1A17866D9}');

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

    public function ApplyChanges(){

        //Never delete this line!
        parent::ApplyChanges();
    }

    public function FetchData() {

        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';
        $Data['Buffer'] = 'DriveState';

        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data),true);

        foreach ($Data['response'] as $key => $Value ) {
            $this->SetValue($key,$Value);
        }
    }
}

?>