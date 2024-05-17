# Club Events
This resource allows for retrieving events of a club.

|Method|URL|Info|URL-params|
|---|---|---|---|
|GET|/api/v1/club/`<club_id>`/events/|Returns events of the club based on queries supplied|api_key, club_secret, sync_from (timestamp in milliseconds), timestamp_start (milliseconds, optional), timestamp_end (milliseconds, optional), member_id (optional), schedule_id (optional)|
|GET|/api/v1/club/`<club_id>`/events/`<event_id>`/|Returns event corresponding to `<event_id>` of the club|api_key, club_secret, sync_from (timestamp in milliseconds)|

## STRUCTURE

|Field|Type|Values|Information|
|---|---|---|---|
|event_id|int| |The unique identifier of the event|
|schedule_id|int| |The schedule to which the event belongs  to|
|start|datetime| |The datetime when the event starts. The timezone corresponds to that of the club timezone|
|end|datetime| |The datetime when the event ends. The timezone corresponds to that of the club timezone|
|title|string| |The name of the event in the default club language|
|activity_id|int| |Reference to an [[Activity Definition]]|
|employee_note|string| |Any enclosing note to the employee about the event|
|club_id|int| |The id of the club|
|instructor_id|int| |The id of the instructor|
|attendees|int| |The number of active participants in the event|
|max_places|int| |The number of maximum possible participants in the event|
|bookable|int|1-true, 0-false|Flag indicating whether event is bookable|
|cancel_before_duration|int| |Timestamp before till which event can be cancelled|
|booking_in_advance_duration|datetime duration|4 days|Timestamp before till which event can be booked|
|canceled|boolean| |Flag indicating whether event was cancelled|
|language|string|en, nl, fr, etc.|Shorthand representation of the language of the event|
|presence_saved|boolean|true, false|Confirms if client is present in an event. When this is true then the club event participants information is reliable. Double checked by the instructor.|

## GET Example

For instance, you wish to retrieve events booked by a member in a given time period then you specify the range in `timestamp_start` and `timestamp_end` and the member himself in `member_id`.

Send a GET request to `https://api.virtuagym.com/api/v1/club/<club_id>/events?api_key=<api_key>&club_secret=<club_secret>&schedule_id=<schedule_id>&timestamp_start=1456876800&timestamp_end=1456963200&member_id=<memeber_id>&sync_from=<sync_from>`

The response is a paginated result of all the events that suit the specified query parameters.

```json
{
  "status": {
    "statuscode": 200,
    "statusmessage": "Everything OK",
    "result_count": 2,
    "timestamp": 1456502760803,
    "results_remaining": 0
  },
  "result": [
    {
      "event_id": "1945791969-54d4caf4db7821-10175268",
      "schedule_id": 1,
      "start": "2016-03-02 17:00:00",
      "end": "2016-03-02 18:00:00",
      "title": "Ski Fit",
      "employee_note": "",
      "club_id": 377,
      "activity_id": 448,
      "instructor_id": 0,
      "attendees": 0,
      "max_places": 25,
      "bookable": 1,
      "cancel_before_duration": 0,
      "booking_in_advance_duration": "1 months",
      "canceled": false,
      "presence_saved": false,
      "language": ""
    },
    {
      "event_id": "1086269400-54d4caa151b066-64525389",
      "schedule_id": 1,
      "start": "2016-03-02 09:00:00",
      "end": "2016-03-02 10:00:00",
      "title": "WOW!",
      "employee_note": "this is a note",
      "club_id": 377,
      "activity_id": 5191,
      "instructor_id": 1294792,
      "attendees": 0,
      "max_places": 1,
      "bookable": 1,
      "cancel_before_duration": 7200,
      "booking_in_advance_duration": "1 months",
      "canceled": false,
      "presence_saved": false,
      "language": ""
    }
  ]
}
```


## PUT Example
**NOT IMPLEMENTED YET**

## Possible error codes and messages

|Statuscode|Message|Description|
|---|---|---|
|420|timestamp_start must be >= 0|timestamp_start cannot be negative|
|420|timestamp_start too large|timestamp_start cannot be extremely large values|

