<?php


namespace Source\App;


use Source\Core\Controller;
use Source\Core\Db;
use Source\Models\Patient;
use Source\Support\Uploader;

class Web extends Controller
{

    private $db;

    public function __construct()
    {
        $this->db = new Db();
        parent::__construct(__DIR__ . "/../../themes/patientControl/", "php");
    }


    /*
     *  GET
     */
    public function home()
    {
        $patient = new Patient();
        echo $this->view->render("home", [
            "title" => "Home",
            "patients" => $patient,
        ]);
    }


    public function listAll()
    {
        $patient = new Patient();

        echo $this->view->render("list-all", [
            "title" => "Listagem De Pacientes",
            "patients" => $patient->all()
        ]);
    }

    public function listAppointmentDone()
    {
        $patient = new Patient();
        echo $this->view->render("list-appointmentDone", [
                "title" => "Consultas Feitas",
                "patients" => $patient->findAllWithAppointmentDone()
            ]
        );
    }

    public function listWithoutAppointmentDone()
    {
        $patient = new Patient();
        echo $this->view->render("list-withouAppointmentDone", [
                "title" => "Consultas Não Feitas",
                "patients" => $patient->findAllWithoutAppointmentDone()
            ]
        );
    }

    public function formPage()
    {
        $patient = new Patient();
        echo $this->view->render("register", [
            "title" => "Registro De Paciente",
            "message" => "",
            "patient" => $patient
        ]);
    }

    public function patient(array $data)
    {
        $patients = new Patient();
        $patientID = $data['id'];
        $patient = $patients->findById($patientID);

        echo $this->view->render("patient-page", [
            "title" => "Paciente {$patient->name}",
            "patient" => $patient,
        ]);
    }

    /**
     * POST
     */
    public function register()
    {
        $patient = new Patient();
        $uploader = new Uploader();
        $data = filter_input_array(INPUT_POST,
            FILTER_SANITIZE_STRIPPED);

        $image = $_FILES['image'];
        $uploader->uploadImage($data, $image, "name");
        $patient->boostrap($data['name'], $data['age'], $data['email'], $data['symptoms'], $uploader->fileName());
        $patient->save();
        $message = $patient->message();
        echo $this->view->render("register", [
            "title" => "Registro De Paciente",
            "message" => $message,
            "patient" => $patient,
        ]);
    }

    /**
     * PUT
     */
    public function appointment(array $data)
    {
        $id = $data['id'];
        $patient = (new Patient())->findById($id);
        $patient->appointment = 1;
        $patient->save();
        redirect("/listagem");
    }
}