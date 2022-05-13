<?php
namespace Model;

class MeetingService extends ActiveRecord{
    protected static $table = 'meeting_services';
    protected static $columnsDB = ['id','meetingId','serviceId'];

    public $id;
    public $meetingId;
    public $serviceId;

    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->meetingId = $args['meetingId'] ?? null;
        $this->serviceId = $args['serviceId'] ?? null;
    }
}