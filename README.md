# eu.businessandcode.disschedrem

This extension contains the API System.disableafterstart

## What
It wil disable scheduled reminders:
* that are connected to events
* and triggered before the start date of an event
* and the start date is in the past

## Why
A "feature" in CiviCRM is that these scheduled reminders are still triggered even though the start date is in the past.

