<?
declare(strict_types=1);
require_once __DIR__ . '/../libs/TeslaHelper.php';

class TeslaGUISettings extends IPSModule
{
    use TeslaConnect,
        TeslaHelper;
    public function Create()
    {
        //Never delete this line!
        parent::Create();

        $this->ConnectParent('{0DE3226B-E63E-87DD-7D2F-46C1A17866D9}');

        $this->createGUISettingsVariables();
    }

    public function ApplyChanges(){

        //Never delete this line!
        parent::ApplyChanges();
    }

    public function FetchData() {

        $Data['DataID'] = '{5147BF5F-95B4-BA79-CD98-F05D450F79CB}';
        $Data['Buffer'] = 'GUISettings';

        $Data = json_encode($Data);

        $Data = json_decode($this->SendDataToParent($Data),true);

        foreach ($Data['response'] as $key => $Value ) {
            $this->SetValue($key,$Value);
        }
    }
}

?>