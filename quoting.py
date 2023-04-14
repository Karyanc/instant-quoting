import requests
import json

auth = {
    "Authorization": "Zoho-oauthtoken " + "YOUR_AUTH_TOKEN_HERE"
}

url = "https://www.zohoapis.eu/crm/v2/{module}?criteria={criteria}".format(module="Module_Name", criteria="criteria")
response = requests.get(url, headers=auth)
data = json.loads(response.text)

lead_data = {
    "First_Name": "John",
    "Last_Name": "Wick",
    "Email": "johnwick@gmail.com"
}

quotes = []
for record in data["data"]:
    quote_data = {
        "Provider": record["Provider"],
        "Price": record["Price"],
        "Details": record["Details"]
    }
    if (quote_data["Details"]["Property_Type"] == lead_data["Property_Type"] and
        quote_data["Details"]["Loan_Type"] == lead_data["Loan_Type"] and
        quote_data["Details"]["Loan_Amount"] == lead_data["Loan_Amount"]):
        quotes.append(quote_data)
quotes = sorted(quotes, key=lambda x: x["Price"])[:4]

url = "https://www.zohoapis.com/crm/v2/{module}/{id}/actions/send_mail".format(module="Leads", id="LEAD_ID")
payload = {
    "data": [
        {
            "to": {
                "leads": [
                    {
                        "id": "LEAD_ID"
                    }
                ]
            },
            "template_id": "TEMPLATE_ID",
            "from": {
                "id": "FROM_USER_ID"
            },
            "subject": "Your Quotes",
            "mail_content": [
                {
                    "value": "Here are your quotes:"
                },
                {
                    "value": quotes[0]["Provider"] + ": " + str(quotes[0]["Price"])
                }
            ]
        }
    ]

}