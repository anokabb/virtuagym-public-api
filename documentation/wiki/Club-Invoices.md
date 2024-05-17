# Invoices
This API allows to create invoices for members belonging to a club.  
Every invoice created has a structure in the form of a parent (the main invoice) with child(ren) (the row(s) of the invoice).

|Method|URL|Info|URL-params|
|---|---|---|---|
|POST|/api/v1/club/`<club_id>`/invoices/|Allows for creation of a new invoice|api_key, club_secret|
|GET|/api/v1/club/`<club_id>`/invoices/`<invoice_id>`/|Returns invoice corresponding to `<invoice_id>`|api_key, club_secret, page (1,2,3 etc.)|
## PARENT INVOICE STRUCTURE

|Field|Type|Optional|Information|
|---|---|---|---|
|guid|string|no|the guid of the invoice|
|id|int|yes|the id of the invoice (0 if the invoice is a concept)|
|contract_id|int|yes|the connected contract id (if the invoice is relative to a contract)|
|retail_product_id|int|yes|the connected product id (if the invoice is relative to a product)|
|member_id|int|yes|the connected member id|
|business_guid|string|yes|the guid of the optional business connected to the invoice|
|invoice_text_guid|string|yes|the guid of the optional invoice text|
|club_id|int|no|the club id of the invoice|
|name|string|no|a literal name of the invoice|
|desc|string|yes|a literal description of the invoice|
|price|float|no|the total price of the invoice|
|price_ex_vat|float|no|the total price of the invoice without the VAT|
|currency|string|no|the currency code of the invoice|
|payment_method|string|yes|the preferred payment method of the invoice|
|paid|bool|no|true if the invoice has been paid|
|paid_status|int|yes|the status code of the invoice (0 open, 1 pending, 2 paid)|
|amount_due|int|false|the amount due of the invoice|
|is_offer|bool|yes|true if the invoice is an offer invoice|
|is_temporary|bool|yes|true if the invoice is temporary|
|is_sent|bool|yes|true if the invoice has been sent|
|is_concept|bool|yes|true if the invoice is a concept|
|deleted|bool|no|true if the invoice has been deleted|
|timestamp|int|false|the timestamp (date) of the invoice|
|timestamp_paid|int|yes|the timestamp of the successful payment of the invoice|
|timestamp_edit|int|no|timestamp of the last edit of the invoice|
|timestamp_created|int|no|timestamp of the creation of the invoice|
|rows|array|no|the rows of this invoice (children invoices)|

## CHILD INVOICE STRUCTURE

|Field|Type|Optional|Information|
|---|---|---|---|
|guid|string|no|the guid of the invoice|
|contract_id|int|yes|the connected contract id (if the invoice is relative to a contract)|
|retail_product_id|int|yes|the connected product id (if the invoice is relative to a product)|
|product_name|string|no|a literal name of the invoice|
|product_desc|string|yes|a literal description of the invoice|
|product_count|int|no|the amount of the products|
|price|float|no|the total price of the invoice|
|price_ex_vat|float|no|the total price of the invoice without the VAT|
|vat|float|no|the total price of the invoice without the VAT|
|currency|string|no|the currency code of the invoice|
|payment_method|string|yes|the preferred payment method of the invoice|
|is_concept|bool|yes|true if the invoice is a concept|
|deleted|bool|no|true if the invoice has been deleted|
|income_category|string|yes|the income category of the invoice|
|position|int|yes|the position of this child in the invoice parent|
|origin|string|yes|the origin of the child invoice|
|timestamp|int|false|the timestamp (date) of the invoice|
|timestamp_paid|int|yes|the timestamp of the successful payment of the invoice|
|timestamp_edit|int|no|timestamp of the last edit of the invoice|
|timestamp_created|int|no|timestamp of the creation of the invoice|
|club_tax_id|int|no|the id of the club tax|
|club_tax_name|string|no|the readable name of the club tax|
|club_tax_perc|float|no|the percentage of the club tax|

## GET Example

```json
{
    "status": {
        "statuscode": 200,
        "statusmessage": "Everything OK",
        "result_count": 19,
        "timestamp": 1509114233601
    },
    "result": {
        "guid": "982cdf0dca599cb31f968c59c8a525a16b84",
        "contract_id": 13,
        "member_id": 123456,
        "sales_user_id": 123556,
        "club_id": 8633,
        "name": "Great club onbeperkt 12 mnd (2017-10-25 - 2017-11-24), Studentenkorting 10.00- discount",
        "desc": " ",
        "price": 115,
        "price_ex_vat": 95.05,
        "currency": "EUR",
        "payment_method": "directdebit_NL",
        "paid": false,
        "amount_due": 115,
        "is_concept": true,
        "deleted": false,
        "timestamp": 1509055200,
        "timestamp_edit": 1508194553,
        "timestamp_created": 1508194553,
        "rows": [
            {
                "guid": "b60fa881f2333se18520ff5dd076bd354854",
                "contract_id": 1252,
                "product_name": "High discount",
                "product_count": 1,
                "price": -10,
                "price_ex_vat": -8.26,
                "vat": -1.74,
                "currency": "EUR",
                "payment_method": "directdebit_NL",
                "start_period": "2017-10-25",
                "is_concept": true,
                "deleted": false,
                "income_category": "other",
                "position": 2,
                "timestamp": 1509055200,
                "timestamp_edit": 1508194553,
                "timestamp_created": 1508194553,
                "club_tax_id": 1,
                "club_tax_name": "BTW 21%",
                "club_tax_perc": 21
            },
            {
                "guid": "f539168a0ee8b0b44c55e87f91d62fca1422",
                "contract_id": 1,
                "sales_user_id": 123456,
                "product_name": "Very cool product",
                "product_count": 1,
                "price": 125,
                "price_ex_vat": 103.31,
                "vat": 21.69,
                "currency": "EUR",
                "payment_method": "directdebit_NL",
                "start_period": "2017-10-25",
                "end_period": "2017-11-24",
                "is_concept": true,
                "deleted": false,
                "income_category": "other",
                "position": 1,
                "timestamp": 1509055200,
                "timestamp_edit": 1508194553,
                "timestamp_created": 1508194553,
                "club_tax_id": 1,
                "club_tax_name": "BTW 21%",
                "club_tax_perc": 21
            }
        ]
    }
}
```

## POST Example

To create an invoice, for the particular member of the specified club, perform a POST to the above mentioned URL, passing the required fields described below.

**POST Fields**

|Field|Type|Optional|Comment|
|---|---|---|---|
|member_id|int|no|id of member to whom the invoice is generated|
|rows|Array|no|an array of products containing various fields describing the product|
|payment_method|string|yes|the preferred payment method of the invoice. Possible values described below|

Each element in `rows` contains the following fields

|Field|Type|Optional|Comment|
|---|---|---|---|
|name|string|no|a literal name of the product|
|desc|string|yes|a literal description of the product|
|price|float|no|the price of the product INCLUDING VAT|
|amount|int|no|the amount of products|
|tax_id|int|no|the id of the club tax|

The allowed values for `payment_method` are:

|`payment_method`|
|---|
|'cash'|
|'card'|
|'directdebit_NL'|
|'bank_transfer'|
|'check'|
|'online'|

As an example, to create an invoice for the member with id 123, containing 1 Apple and 1 Pear,
send a POST request to `https://virtuagym.com/api/v1/club/<club_id>/invoices?api_key=<api_key>&club_secret=<club_secret>` with the following JSON.

```json
{
"member_id" : 123,
"payment_method": "card",
"rows": [
    {
        "name": "Apple",
        "desc": "This is an apple",
        "price": 1.50,
        "amount": 1,
        "tax_id": 0
    },
    {
        "name": "Pear",
        "desc": "This is a tasty pear",
        "price": 1,
        "amount": 1,
        "tax_id": 0
    }
   ]
}
```

**POST RESPONSE**
```json
{
  "status": {
    "statuscode": 200,
    "statusmessage": "Everything OK",
    "timestamp": 1465551775882
  },
  "result": {
    "guid": "8e65a06c-10d1-4056-8523-f03c58cf3ca4",
    "id": 1081,
    "member_id": 123,
    "club_id": 201,
    "name": "Apple, Pear",
    "price": 2.5,
    "price_ex_vat": 2.5,
    "currency": "EUR",
    "payment_method": "card",
    "paid": false,
    "amount_due": 2.5,
    "is_concept": false,
    "deleted": false,
    "timestamp": 1465551775,
    "timestamp_edit": 1465551775,
    "timestamp_created": 1465551775,
    "rows": [
      {
        "guid": "5e5d9ac8-2d7e-4d02-a2e0-e0f65c937e58",
        "product_name": "Pear",
        "product_desc": "This is a tasty pear",
        "product_count": 1,
        "price": 1,
        "price_ex_vat": 1,
        "vat": 0,
        "currency": "EUR",
        "payment_method": "card",
        "deleted": false,
        "income_category": "other",
        "position": 2,
        "origin": "api_created",
        "timestamp": 1465551775,
        "timestamp_edit": 1465551775,
        "timestamp_created": 1465551775,
        "club_tax_id": 0,
        "club_tax_name": "No tax",
        "club_tax_perc": 0
      },
      {
        "guid": "e2a7f7a1-7346-4e58-b5d0-dca5b260391e",
        "product_name": "Apple",
        "product_desc": "This is an apple",
        "product_count": 1,
        "price": 1.5,
        "price_ex_vat": 1.5,
        "vat": 0,
        "currency": "EUR",
        "payment_method": "card",
        "deleted": false,
        "income_category": "other",
        "position": 1,
        "origin": "api_created",
        "timestamp": 1465551775,
        "timestamp_edit": 1465551775,
        "timestamp_created": 1465551775,
        "club_tax_id": 0,
        "club_tax_name": "No tax",
        "club_tax_perc": 0
      }
    ]
  }
}
```



## Possible error codes and messages

|Statuscode|Message|Description|
|---|---|---|
|200|Everything OK|Everything proceeded according to the specifications|
|420|Parameter member_id is mandatory. Null or empty given.| No member_id or 0 is given in the JSON body|
|420|Invalid member id.| An invalid member_id is given in the JSON body|
|420|No member found in this club with id: XXX| The given member is not part of the specified club|
|420|Parameter rows is empty. At least 1 invoice row is mandatory.| An invalid rows number is given in the JSON body|
|420|Invalid payment method.| Unrecognized payment method given in the JSON body|
|420|A valid product name is mandatory.| The product name in the given invoice row is empty or missing|
|420|A valid product amount is mandatory.| The product amount in the given invoice row is empty, missing or invalid|
|420|A valid tax id parameter is mandatory.| The tax id in the given invoice row is empty, missing or invalid|
|420|Club tax not found| The tax id in the given invoice row is not valid for the specified club|
|420|Invoice guid not found| The invoice creation has failed|
|420|Invoice products not found| The invoices rows creation has failed|
