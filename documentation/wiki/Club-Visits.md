# Club Visits
This resource allows to manipulate check-in and check-out actions of members in a club. The results of this can be viewed in the Visitor Registration app of Virtuagym.


## Supported Requests

|Method|URL|Info|URL-params|
|---|---|---|---|
|GET|/api/v1/club/`<club_id>`/visits|Returns visits versions based on queries supplied|api_key, club_secret, sync_from (timestamp in milliseconds), member_id|
|GET|/api/v1/club/`<club_id>`/visits/`<visit_id>`|Returns visit resource that corresponds to `<visit_id>`|api_key, club_secret|
|POST|/api/v1/club/`<club_id>`/visits|Allows for creating a new visit resource|api_key, club_secret|

## Structure

|Field|Type|Values|Information|
|---|---|---|---|
|id|int||The unique identifier of the visit|
|club_id|int||The id of the corresponding club|
|member_id|int||The id of the member who triggered the visit|
|check_in_timestamp|int||The timestamp (in ms) of the check-in|
|check_out_timestamp|int||The timestamp (in ms) of the check-out|
|status|string|`ok`, `warning`, `rejected`|A human readable status of the visit|
|status_message|string||Supplementary text of the visit|


## GET Example

Send a GET request to `https://virtuagym.com/api/v1/club/<club_id>/visits?api_key=<api_key>&club_secret=<club_secret>`

The response is a paginated result of all visits If you wish to retrieve for a specific member, then append the query parameter `member_id` parameter to the URL.

```json
{
  "status": {
    "statuscode": 200,
    "statusmessage": "Everything OK",
    "result_count": 2,
    "timestamp": 1481280570010,
    "results_remaining": 0
  },
  "result": [
    {
      "id": 580,
      "club_id": 377,
      "member_id": 77223,
      "check_in_timestamp": 1446026961732,
      "check_out_timestamp": 1481118168777,
      "status": "ok",
      "status_message": "Checked in @ GATE 3"
    },
    {
      "id": 581,
      "club_id": 377,
      "member_id": 77223,
      "check_in_timestamp": 1446027898895,
      "check_out_timestamp": 0,
      "status": "warning",
      "status_message": "Checked in @ GATE 15"
    },
  ]
}
```


## POST Example

**POST Fields**

|Field|Type|Values|Information|
|---|---|---|---|
|action|string|`check_in`, `check_out`|Specifies what the current visit corresponds, default is `check_in`|
|rfid_tag|string||Value of RFID tag as stored in Virtuagym, to ensure the correct value, refer to the [[Club Members]] API. Either this or `member_id` must be passed.|
|member_id|int||ID of the Member as stored in Virtuagym triggering the check-in. Either this or `rfid_tag` must be passed.|
|status|string|`ok`, `warning`, `rejected`|A human readable status of the visit|
|status_message|string||Supplementary text of the visit|

Send a POST request to `https://virtuagym.com/api/v1/club/<club_id>/visits?api_key=<api_key>&club_secret=<club_secret>` with the following JSON.

###Check In

First, we check-in the user as below:

```json
{
	"action": "check_in",
	"rfid_tag" : "<rfid_tag>",
	"status" : "ok",
	"status_message" : "CHECK-IN @ GATE 10"
}
```

which would return a response as below

```json
{
  "status": {
    "statuscode": 200,
    "statusmessage": "Everything OK",
    "result_count": 3,
    "timestamp": 1481281939479
  },
  "result": {
    "id": 794,
    "member_id": 77223,
    "message": "check in registered"
  }
}
```
It is possible to send with the request body the `check_in_timestamp` in the past

Note that the `check_in_timestamp` should be sent in milliseconds

###Check Out

Now, we trigger a `check_out` action for the previous `check_in`.

```json
{
	"action": "check_out",
	"rfid_tag" : "<rfid_tag>",
	"status" : "ok",
	"status_message" : "CHECK-OUT @ GATE 10"
}
```

which would return the response below

```json
{
  "status": {
    "statuscode": 200,
    "statusmessage": "Everything OK",
    "result_count": 3,
    "timestamp": 1481282193321
  },
  "result": {
    "id": 794,
    "member_id": 77223,
    "message": "check out registered"
  }
}
```

Note that the `id` of the visit of both `check_in` and `check_out` are the same as it is treated as a single visit resource.

**Notes** : 

* The `check_in_timestamp` and `check_out_timestamp` values are internally computed by Virtuagym based on the time when the API request was made.
* There can be any number of `check_in` actions without needing a corresponding `check_out` but a `check_out` must always have a previous `check_in`.

## Possible error codes and messages

|Statuscode|Request|Message|
|---|---|---|
|404|GET|member not found in club|
|400|POST|`action` must be one of `check_in` or `check_out`|
|400|POST|`status_message` too large, must be < than 255 chars|
|400|POST|`member_id` or `rfid_tag` must be passed in POST request|
|400|POST|`status` must be one of `ok`, `warning` or `rejected`|
|500|POST|there was an unexpected when trying to register the visit|
