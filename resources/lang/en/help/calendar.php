<?php

$__app_name = config('app.name');

$__month_calendar_image = asset("img/help/calendar/month_calendar.png");

$__calendar_screen_image = asset("img/help/calendar/calendar_screen.png");

$__day_calendar_image = asset("img/help/calendar/day_calendar.png");

$__calendar_event_image = asset("img/help/calendar/calendar_event.png");

return [
    'calendar' => 'Calendar',
    'introduction' => <<<EOT
<p>Life is busy: work, school, sports, hobbies, business trips. It can be hard to keep track of everything going on in our world. And as a family grows, organizing and tracking your families activities gets even more complex.</p>
<div class="image-container">
    <img src="{$__calendar_screen_image}" alt="Screenshot of the monthly calendar view with the selected days details shown. One all-day event and one scheduled event are listed for the selected day.">
</div>
<p>The Family Calendar in {$__app_name} is designed to organize your family's activities in one place while allowing you to do that in the simplest way possible.</p>
EOT
    ,
    'month-view' => 'Monthly Calendar View',
    'month-view-details' => <<<EOT
<div class="image-container">
    <img src="{$__month_calendar_image}" alt="Screenshot of the monthly calendar view. All days in the month are shown with an indicator for the days that an event is scheduled.">
</div>
<p>The Calendar is displayed one month at a time. Days which have an event scheduled are indicated with <span class="fa fa-circle"></span>; the current day is highlighted in blue.</p>
<p>You can navigate between months using the <button class="btn btn-sm btn-secondary"><span class="fa fa-chevron-left"></span></button> and <button class="btn btn-sm btn-secondary"><span class="fa fa-chevron-right"></span></button> buttons. You can return the view to the current day at anytime with the <button class="btn btn-outline-secondary btn-sm"><span class="fa fa-calendar"></span> Today</button> button.</p>
<p>Selecting a day on the calendar will load that day's details in the day view pane next to (or below) the calendar.</p>
EOT
    ,
    'day-view' => 'Daily Details View',
    'day-view-details' => <<<EOT
<div class="image-container">
    <img src="{$__day_calendar_image}" alt="Screenshot of the selected day's detail view. One all-day event and one scheduled event are listed for the selected day.">
</div>
<p>The daily detail view shows the selected date along with any scheduled events for that date. All day events are highlighted and presented with the <span class="fa fa-calendar"></span> icon. Scheduled events are presented with the <span class="fa fa-clock-o"></span> icon.</p>
<p>Navigate between days using the <button class="btn btn-sm btn-secondary"><span class="fa fa-chevron-left"></span></button> and <button class="btn btn-sm btn-secondary"><span class="fa fa-chevron-right"></span></button> buttons.</p>
<p>Select one of the listed events to edit it's details. Use the <button class="btn btn-primary btn-sm"><span class="fa fa-calendar-plus-o"></span></button> button to create a new event.</p>
EOT
    ,
    'events' => 'Events',
    'events-details' => <<<EOT
<p>{$__app_name} supports 2 kinds of events:</p>
<dl>
    <dt>All-day Events</dt>
    <dd>- Events that last the entire day (vacation days, birthdays, anniversaries, etc)</dd>
    <dt>Scheduled Events</dt>
    <dd>- Events that have a specific start time (a basketball game that begins at 10:00 am or dentist appointment at 2:00 pm)</dd>
</dl>
EOT
    ,
    'create-edit-events' => 'Creating and Editing Events',
    'create-edit-events-details' => <<<EOT
<p>Events in {$__app_name} are designed to be as simple as possible. Simply provide the name of the event and it's date, specify either that it's an all-day event or provide the time the event begins, provide additional details if neeeded and click save.</p>
<div class="image-container">
    <img src="{$__calendar_event_image}" alt="Screenshot of the event edit form. There are fields for the event's title, date, time, whether it's an all-day event, and additional details.">
</div>
<div class="note">
    <p>An event can be deleted by choosing that option from the page menu, but beware: once an event is deleted, it's gone for good.</p>
</div>
EOT
    ,
];
