<?php
use CRM_Disschedrem_ExtensionUtil as E;

class CRM_Disschedrem_Page_ScheduledRemindersDashboard extends CRM_Core_Page {

  public function run() {
    CRM_Utils_System::setTitle(E::ts('Scheduled Reminders Dashboard'));

    $dao = $this->getStats();
    $this->assign('rows', $dao);

    $dao = $this->getErrors();
    $this->assign('errors', $dao);

    parent::run();
  }

  private function getStats() {
    $sql = "
      select
        e.id,
        e.start_date event_date,
        e.title event_name,
        s.title reminder_title,
        sum(if(al.is_error=0,1,0)) num_successful,
        sum(if(al.is_error=1,1,0)) num_with_error
      from
        civicrm_action_schedule s
      inner join
        civicrm_event e on e.id = s.entity_value
      left outer join
        civicrm_action_log al on al.action_schedule_id = s.id
      where
        e.start_date between date_add(now(), INTERVAL -21 DAY) and date_add(now(), INTERVAL 11 DAY)
      group BY
        e.id, s.id
      order by
        e.start_date desc
    ";

    $dao = CRM_Core_DAO::executeQuery($sql);
    return $dao->fetchAll();
  }

  function getErrors() {
    $sql = "
      select
        l.action_date_time,
        c.display_name,
        e.email,
        l.message
      from
        civicrm_action_log l
      inner join
        civicrm_contact c on l.contact_id = c.id
      left outer join
        civicrm_email e on e.contact_id  = c.id and e.is_primary  = 1
      where
        l.is_error = 1
      order by
        l.action_date_time desc
      limit 0,100
    ";

    $dao = CRM_Core_DAO::executeQuery($sql);
    return $dao->fetchAll();
  }

}
