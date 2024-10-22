<?php
use CRM_Disschedrem_ExtensionUtil as E;

class CRM_Disschedrem_Page_ScheduledRemindersDashboard extends CRM_Core_Page {

  public function run() {
    CRM_Utils_System::setTitle(E::ts('Scheduled Reminders Dashboard'));

    $dao = $this->getStats();

    $this->assign('records', $dao);

    parent::run();
  }

  private function getStats() {
    $sql = "
      select
        e.id,
        e.start_date event_date,
        e.title_nl_NL event_name,
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
        e.start_date between date_add(now(), INTERVAL -21 DAY) and now()
      group BY
        e.id
      order by
        e.start_date desc
    ";

    return CRM_Core_DAO::executeQuery($sql);
  }

}
