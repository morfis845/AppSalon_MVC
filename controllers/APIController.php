<?php
namespace Controllers;

use Model\Meeting;
use Model\MeetingService;
use Model\Service;

class APIController{
    public static function index(){
        $services = Service::getAll();
        echo json_encode($services);
    }
    public static function save(){
        $meeting = new Meeting($_POST);
        $result = $meeting->save();

        $id = $result['id'];

        $idServices = explode(",", $_POST['services']);
        foreach($idServices as $idService){
            $args = [
                'meetingId' => $id,
                'serviceId' => $idService
            ];
            $meetingService = new MeetingService($args);
            $meetingService->save();
        }
        echo json_encode(['result' => $result]);
    }
    public static function delete(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $meeting = Meeting::find($id);
            $meeting->delete();

            header('Location:'. $_SERVER['HTTP_REFERER']);
        }
    }
}