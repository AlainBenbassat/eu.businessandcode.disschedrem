<?php

function _civicrm_api3_system_disableafterstart_spec(&$spec) {

}

function civicrm_api3_system_disableafterstart($params) {
  // disable all scheduled reminders with trigger BEFORE for events in the past
  $sql = "
    update
      civicrm_action_schedule s
    inner join
      civicrm_event e on s.entity_value = e.id
    set
      s.is_active = 0
    where
      s.is_active = 1
    and
      e.start_date < now()
    and
      s.start_action_condition = 'before'
    and
      s.start_action_date = 'start_date'
    and
      s.mapping_id = 3
  ";
  $dao = CRM_Core_DAO::executeQuery($sql);
  $msg = 'Number of scheduled reminders disabled: ' . $dao->affectedRows();
  return civicrm_api3_create_success($msg, $params, 'System', 'disableafterstart');
}
