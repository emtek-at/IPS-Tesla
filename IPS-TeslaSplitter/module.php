<?
declare(strict_types=1);
require_once __DIR__ . '/../libs/TeslaHelper.php';

class TeslaSplitter extends IPSModule
{
    use TeslaConnect,
        TeslaHelper;
    public function Create()
    {
        //Never delete this line!
        parent::Create();

        $this->RegisterPropertyString("EMail", "");
        $this->RegisterPropertyString("Password", "");

        $this->RegisterPropertyString("Client_ID", "");
        $this->RegisterPropertyString("Client_Secret", "");

        $this->RegisterPropertyInteger("Interval", 5);
        $this->RegisterPropertyString("Vehicles",0);

        $this->RegisterAttributeString("Token", "");
        $this->RegisterAttributeString("TokenExpires", "");
    }

    public function ApplyChanges(){

        //Never delete this line!
        parent::ApplyChanges();
    }

    public function GetConfigurationForm() {
        $Form = json_decode(file_get_contents(__DIR__ . '/form.json'), true);

        $EMail = $this->ReadPropertyString("EMail");
        $Password = $this->ReadPropertyString("Password");
        $Client_ID = $this->ReadPropertyString("Client_ID");
        $Client_Secret = $this->ReadPropertyString("Client_Secret");

        $FormElementCount = 5;
        if ($EMail || $Password || $Client_ID ||$Client_Secret != '') {
            $Vehicles = $this->getVehicles();
            if ($Vehicles['count'] > 0) {
                $Form['elements'][$FormElementCount]['type'] = 'Select';
                $Form['elements'][$FormElementCount]['name'] = 'Vehicles';
                $Form['elements'][$FormElementCount]['caption'] = 'Vehicles';
                $selectOptions[0]['caption'] = 'Please select car!';
                $selectOptions[0]['value'] = '0';
                $optionsElementCount = 1;
                foreach ($Vehicles['response'] as $Vehicle) {
                    $selectOptions[$optionsElementCount]['caption'] = $Vehicle['display_name'];
                    $selectOptions[$optionsElementCount]['value'] = strval($Vehicle['id_s']);
                    $this->SendDebug('Form',$Vehicle['id'],0);
                    $optionsElementCount++;
                }
                $Form['elements'][$FormElementCount]['options'] = $selectOptions;
            }
        }
        return json_encode($Form);
    }

    public function ForwardData($JSONString)
    {
        $this->SendDebug(__FUNCTION__,$JSONString,0);
        $data = json_decode($JSONString);

        switch ($data->Buffer) {
            case 'ChargingState':
                $result = $this->getChargeState();
                break;
            case 'ClimateState':
                $result = $this->getClimateState();
                break;
            case 'DriveState':
                $result = $this->getDriveState();
                break;
            case 'GUISettings':
                $result = $this->getGUISettings();
                break;
            default:
                $this->SendDebug(__FUNCTION__, $data->Buffer, 0);
                break;
        }

        return json_encode($result);
    }
}

?>