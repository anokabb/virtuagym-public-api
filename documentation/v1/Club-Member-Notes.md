# Club Member Notes
This resource allows to manipulate the notes assigned to a club member in their clients & staff page.


## Allowed Note Types
The following types of notes can be retrieved currently:

|Description|note_type|
|---|---|
|General Note|`general`|
|Coaching Note|`coaching`|
|Products Note|`products`|
|Invoices Note|`invoices`|
|Files Note|`files`|

## Supported Requests
|Method|URL|Info|URL-params|
|---|---|---|---|
|GET|/api/v1/club/`<club_id>`/notes/|Returns notes of members in    a club, based on queries supplied|api_key, club_secret, sync_from (timestamp in seconds), member_id, note_type|
|GET|/api/v1/club/`<club_id>`/notes/`<note_id>`/|Returns note corresponding to `<note_id>` of the club|api_key, club_secret, sync_from (timestamp in seconds)|
|POST|/api/v1/club/`<club_id>`/notes/|Allows for creation of a new note.|api_key, club_secret|
|PUT|/api/v1/club/`<club_id>`/notes/|Allows for modifying attributes in existing note instances|api_key, club_secret|
|DELETE|/api/v1/club/`<club_id>`/notes/`<note_id>`/|Deletes the note instance specified by `<note_id>`|api_key, club_secret|

## Structure

|Field|Type|Values|Information|
|---|---|---|---|
|note_id|int| |The unique identifier of the note|
|member_id|int| |The unique identifier of the member to whom the note was sent|
|timestamp|int| |The timestamp when the note was created|
|note_text|string| |The text of the actual note to send (cannot be more than 16777215 characters)|
|note_type|string|`general`, `coaching`, `products`, `invoices`, `files`|The type of the note.|
|from_user_avatar|string| |Avatar of user who wrote the note|
|from_user_name|string| |Name of user who wrote the note|
|deleted|bool|true, false|true if the note was deleted|

## GET Example

Send a GET request to `https://api.virtuagym.com/api/v1/club/<club_id>/notes?api_key=<api_key>&club_secret=<club_secret>&sync_from=<sync_from>&member_id=<member_id>&note_type=general`

The response is a paginated result of notes of `note_type=general` for the specified member `member_id`. If `member_id` is not specified then notes of all members are returned. The same goes for `note_type`.

```json
{
  "status": {
    "statuscode": 200,
    "statusmessage": "Everything OK",
    "result_count": 1,
    "timestamp": 1457519724674,
    "results_remaining": 0
  },
  "result": [
    {
      "note_id": 1278494,
      "member_id": 12345,
      "timestamp": 1456931653,
      "note_text": "1232445",
      "note_type": "general"
    }
  ]
}
```


## POST Example

**POST Fields**

|Field|Optional|Comment|
|---|---|---|
|member_id|no|Member must belong to club|
|member_from|no|Member must belong to the same club or superclub. The profile must also be activated|
|note_text|no|Not more than 16777215 characters|
|note_type|no|Can only be one of `general`, `coaching`, `products`, `invoices`, `files`|

Send a POST request to `https://api.virtuagym.com/api/v1/club/<club_id>/notes?api_key=<api_key>&club_secret=<club_secret>` with the following JSON.

```json
{
"member_from" : 321,
"member_id" : 12345,
"note_type" : "general",
"note_text" : "1232445"
}
```

**POST RESPONSE**
```json
{
  "status": {
    "statuscode": 200,
    "statusmessage": "Everything OK",
    "result_count": 3,
    "timestamp": 1457519825419
  },
  "result": {
    "member_id": 12345,
    "note_id": 1277494,
    "note": "POST note successful"
  }
}
```

This allows for sending a note to the member with `member_id` 12345. It is to be noted that all `member_id`, `note_type`, `member_from` and `note_text` must be specified for the POST request to be successful. We only allow for posting notes which are tabulated in the start of the

NOTE: It is important to store the response `note_id` as it is useful for a number of purposes.

## PUT Example
**PUT Fields**

|Field|Optional|Comment|
|---|---|---|
|note_id|no||
|note_text|yes (if note_type set)|Not more than 16777215 characters|
|note_type|yes (if note_text set)|Can only be one of `general`, `coaching`, `products`, `invoices`, `files`|

Send a PUT request to `https://api.virtuagym.com/api/v1/club/<club_id>/notes?api_key=<api_key>&club_secret=<club_secret>` with the following JSON.

```json
{
"note_id" : 1277494,
"note_type" : "general",
"note_text" : "abcde"
}
```

**PUT RESPONSE**
```json
{
  "status": {
    "statuscode": 200,
    "statusmessage": "Everything OK",
    "result_count": 2,
    "timestamp": 1457520508322
  },
  "result": {
    "note_id": 1277495,
    "note": "PUT note successful"
  }
}
```

This allows updating for the note with `note_id` `1277495` the `note_text`. Either `note_text` or `note_type` must be supplied in the PUT request.

## DELETE Example
Send a DELETE request to `https://api.virtuagym.com//api/v1/club/<club_id>/notes/<note_id>?api_key=<api_key>&club_secret=<club_secret>`

**DELETE Response**
```json
{
  "status": {
    "statuscode": 200,
    "statusmessage": "Everything OK",
    "result_count": 2,
    "timestamp": 1457520676734
  },
  "result": {
    "note_id": "1277495",
    "note": "DELETE note successful"
  }
}
```

This deletes the note corresponding to `note_id`.

## Possible error codes and messages

|Statuscode|Message|Request|
|---|---|---|
|420|note_type must be passed|GET, POST, PUT|
|420|note_type can only be one of general, coaching, products, invoices, files|GET, POST, PUT|
|420|member_id must be passed|GET, POST|
|420|member not found in club|GET, POST|
|420|member_from must be passed|POST|
|420|member_from must be int|POST|
|420|member_from does not have an activated profile|POST|
|420|member_from must belong to same club or super club|POST|
|420|note_text must be passed|POST, PUT|
|420|note_text too large, must be < than 16777215 chars|POST, PUT|
|420|error in making PUT request|PUT|
|420|note_id must be passed|PUT, DELETE|
|420|note with note_id `<note_id>` not found in club|PUT, DELETE|
|420|note_type or note_text must be passed in PUT request|PUT|
|420|error in making DELETE request|DELETE|