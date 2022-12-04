import requests

payload = {
    'inUserName': 'username',
    'inUserPass': 'password'
}

request.post('localhost/database/register.php', data=payload)
