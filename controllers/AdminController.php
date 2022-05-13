<?php

namespace Controllers;

use Model\AdminMeeting;
use MVC\Router;

class AdminController
{
    public static function index(Router $router)
    {
        //session_start();
        $date = $_GET['date'] ?? date('Y-m-d');
        $dates = explode('-', $date);
        if(!checkdate($dates[1], $dates[2], $dates[0])){
            header('Location : /404');
        }
        isAdmin();
        $consult = "SELECT meeting.id, meeting.hour, CONCAT( users.name, ' ', users.lastName) as client, ";
        $consult .= " users.email, users.phone, services.name as service, services.price  ";
        $consult .= " FROM meeting  ";
        $consult .= " LEFT OUTER JOIN users ";
        $consult .= " ON meeting.userId=users.id  ";
        $consult .= " LEFT OUTER JOIN meeting_services ";
        $consult .= " ON meeting_services.meetingId=meeting.id ";
        $consult .= " LEFT OUTER JOIN services ";
        $consult .= " ON services.id=meeting_services.serviceId ";
        $consult .= " WHERE date =  '${date}' ";
        $meetings = AdminMeeting::SQL($consult);
        $router->render('admin/index', [
            'name' => $_SESSION['name'],
            'meetings' => $meetings,
            'date' => $date
        ]);
    }
}
