# Club Event Participants
This resource acts as a relation between events in a schedule and the members of a club. In essence, it represents the booking of an event.

|Method|URL|Info|URL-params|
|---|---|---|---|
|GET|/api/v1/club/`<club_id>`/eventparticipants/|Returns event participants of a club, based on queries supplied|api_key, club_secret, sync_from (timestamp in milliseconds), timestamp_start (timestamp in milliseconds), timestamp_end (timestamp in milliseconds), event_id, fill_guestname|
|GET|/api/v1/club/`<club_id>`/eventparticipants/`<event_participant_id>`/|Returns event participants corresponding to `<event_participant_id>` of the club|api_key, club_secret, sync_from (timestamp in milliseconds), fill_guestname|
|POST|/api/v1/club/`<club_id>`/eventparticipants/|Allows for creation of a new event participant i.e. creation of booking in an event|api_key, club_secret|
|PUT|/api/v1/club/`<club_id>`/eventparticipants/|Allows for modifying attributes in existing event participant instances|api_key, club_secret|
|DELETE|/api/v1/club/`<club_id>`/eventparticipants/`<event_participant_id>`/|Deletes the event participant i.e. cancellation of booking in an event|api_key, club_secret|

## STRUCTURE

|Field|Type|Values|Information|
|---|---|---|---|
|event_participant_id|int| |The unique identifier of the event participant|
|event_id|int| |The unique identifier of the event|
|member_id|int| |The unique identifier of the member who is a participant in the event|
|email_address|string| |The e-mail address of the member who is a participant in the event|
|user_name|string| |The name of the guest if the parameter fill_guestname is set to 1 |
|notes|string| |Notes accompanying the event participant instance (cannot be more than 255 characters)|
|present|boolean| |Indication of whether the member was present in the event|
|absence_reason|string| |String explaining why the member was not present|
|has_paid|boolean| |Indication of whether the member paid for the event|
|ticket_printed|boolean|true, false|Indication of whether the ticket was printed for the event participation|
|timestamp_edit|int| |Timestamp when the resource was last modified/created|

## GET Example

Send a GET request to `https://api.virtuagym.com/api/v1/club/<club_id>/eventparticipants?api_key=<api_key>&club_secret=<club_secret>&event_id=<event_id>&sync_from=<sync_from>`

The response is a paginated resulted of all the participants in the event specified in `<event_id>`. 

If `<event_id>` is not specified then all participants in the events starting between `<timestamp_start>` and `<timestamp_end>` are returned.

`<timestamp_start>` and `<timestamp_end>` are **optional** and if left unspecified, the time-frame is assumed to be 
(today - 1 month) and (today + 1 month) respectively.

For example:

`http://api.virtuagym.com/api/v1/club/<club_id>/eventparticipants&api_key=<api_key>&club_secret=<club_secret>&timestamp_start=1535328000&timestamp_end=1535356900`

will return the event participants of events starting between 1535328000 and 1535356900

`http://api.virtuagym.com/api/v1/club/<club_id>/eventparticipants&api_key=<api_key>&club_secret=<club_secret>&timestamp_start=1535328000`

will return the event participants of events starting between 1535328000 and 1535328000 + 1 month

`http://api.virtuagym.com/api/v1/club/<club_id>/eventparticipants&api_key=<api_key>&club_secret=<club_secret>`

will return the event participants of events starting between (today - 1month) and (today + 1month)

Example response:

```json
{
  "status": {
    "statuscode": 200,
    "statusmessage": "Everything OK",
    "result_count": 3,
    "timestamp": 1456504491946,
    "results_remaining": 0
  },
  "result": [
    {
      "event_participant_id": 49977,
      "event_id": "1977058374-54d4cab74fd424-52808265",
      "member_id": 1233,
      "email_address": "example1@digifit.eu",
      "notes": "",
      "present": true,
      "absence_reason": "",
      "has_paid": true,
      "ticket_printed": false,
      "timestamp_edit": 1234567
    },
    {
      "event_participant_id": 49978,
      "event_id": "1977058374-54d4cab74fd424-52808265",
      "member_id": 1234,
      "email_address": "example2@digifit.eu",
      "notes": "",
      "present": true,
      "absence_reason": "",
      "has_paid": true,
      "ticket_printed": false,
      "timestamp_edit": 1234567
    },
    {
      "event_participant_id": 49980,
      "event_id": "1977058374-54d4cab74fd424-52808265",
      "member_id": 1235,
      "email_address": "example3@digifit.eu",
      "notes": "",
      "present": true,
      "absence_reason": "",
      "has_paid": true,
      "ticket_printed": false,
      "timestamp_edit": 1234567
    }
  ]
}
```


## POST Example
**POST Fields**

|Field|Optional|Comment|
|---|---|---|
|event_id|no|Event must belong to club|
|member_id|no|Member must belong to club|
|notes|yes|Cannot be more than 255 characters|
|send_email|yes|Either `'true'` or `'false'`. If not specified then default is `'false'`|

Send a POST request to `https://api.virtuagym.com/api/v1/club/<club_id>/eventparticipants?api_key=<api_key>&club_secret=<club_secret>` with the following JSON.

```json
{
"member_id" : 12345,
"event_id" : "1125559680-54d4cadf992ff6-77810154",
"send_email" : true
}
```

**POST RESPONSE**
```json
{
  "status": {
    "statuscode": 200,
    "statusmessage": "Everything OK",
    "result_count": 1,
    "timestamp": 1456505217423,
    "results_remaining": 0
  },
  "result":
    {
      "member_id": 12345,
      "event_id": "1125559680-54d4cadf992ff6-77810154",
      "event_participant_id": 50794,
      "message": "Added member to event"
    }
}
```

This allows for the member with `member_id` `12345` to be booked in the corresponding event with `event_id` `1125559680-54d4cadf992ff6-77810154`. If `send_email` is set to true then the corresponding member will get an e-mail when the booking was successfully made.
NOTE: It is important to store the response `event_participant_id` as it is useful for a number of purposes.

## PUT Example
**PUTFields**

|Field|Optional|Comment|
|---|---|---|
|event_participant_id|no|Event participant must belong to club|
|ticket_printed|no||

Send a PUT request to `https://api.virtuagym.com/api/v1/club/<club_id>/eventparticipants?api_key=<api_key>&club_secret=<club_secret>` with the following JSON.

```json
{
"event_participant_id" : 50797,
"ticket_printed" : true
}
```

**PUT RESPONSE**
```json
{
  "status": {
    "statuscode": 200,
    "statusmessage": "Everything OK",
    "result_count": 1,
    "timestamp": 1456505342997,
    "results_remaining": 0
  },
  "result":
    {
      "message": "ticket_printed now set to true"
    }
}
```

This allows updating for the event participant resource with `event_participant_id` `50797` indicating that the ticket has been printed. At the moment, only the `ticket_printed` is allowed to be updated and therefore is always required in the PUT request body.

## DELETE Example
Send a DELETE request to `https://api.virtuagym.com/api/v1/club/<club_id>/eventparticipants/<event_participant_id>?api_key=<api_key>&club_secret=<club_secret>`

**DELETE Response**
```json
{
  "status": {
    "statuscode": 200,
    "statusmessage": "Everything OK",
    "result_count": 1,
    "timestamp": 1456505412906,
    "results_remaining": 0
  },
  "result":
    {
      "message": "Successfully removed"
    }
}
```

This deletes the event participant resource corresponding to `event_participant_id`. In essence, allows canceling the booking for the event participant.

## Possible error codes and messages

|Statuscode|Message|Request|
|---|---|---|
|432|You do not have enough credits to complete the booking|POST|
|420|member_id must be passed|POST|
|420|event_id must be passed|POST|
|420|event not found|POST|
|430|Event can not be booked|POST|
|430|Could not make a reservation for the class. Class is full.|POST|
|420|no member found in club 123|POST & PUT|
|420|no active event found in club 123|POST & PUT|
|420|notes cannot be > 255 characters|POST|
|420|no active event participant found|PUT & DELETE|
|420|event_participant_id must be passed in DELETE request|DELETE|