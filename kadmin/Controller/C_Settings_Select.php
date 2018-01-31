<?php
//include_once('Model/M_Settings.php');
include_once('Controller/C_Base.php');

class C_Settings_Select extends C_Base
{
    public $Sections = array();
    public $HasSubsec = array();

    // конструктор
    function __construct()
    {
        $this->table = $_GET['t'];
    }

    protected function OnInput(){
        parent::OnInput();

        //берем экземпляр класа M_Users
        $users = M_Users::Instance();

        $object = Model::Instance();

            if ($_SESSION['authorize']['status'] != 1) {
                header('Location: /kadmin');
            }

        if($this->IsPost()) {}

        $this->Sections = $object->Array_clean("SELECT s.id, sT.name 
                                                       FROM `sections` as s 
                                                       JOIN sectionsTranslate as sT on s.id = sT.id_section 
                                                       WHERE s.landing = 1 AND lang='".ADMIN_LANG."'
                                                       GROUP by sT.id_section");

        $this->HasSubsec = $object->Array_clean("SELECT s.id, sT.name 
                                                       FROM `sections` as s 
                                                       JOIN sectionsTranslate as sT on s.id = sT.id_section 
                                                       WHERE s.has_subsect = 1 AND lang='".ADMIN_LANG."'
                                                       GROUP by sT.id_section");
//        $this->HasSubsec = $object->Array_where('sections', "WHERE `has_subsect`='1'");

    }

    // виртуальный генератор HTML
    protected function OnOutput()
    {

        $this->content = $this->View('View/v_'.$this->table.'_select.php',
            array(
                'sections'=>$this->Sections,
                'subSections'=>$this->HasSubsec
            ));
        parent::OnOutput();
    }
}