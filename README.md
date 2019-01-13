[![Codacy Badge](https://api.codacy.com/project/badge/Grade/41f04628e627468d8a161100edb5dbe3)](https://www.codacy.com/app/yohannzaoui/projet7-BileMo?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=yohannzaoui/projet7-BileMo&amp;utm_campaign=Badge_Grade)

# projet7 API BileMo
Developped with :
- Symfony Framework 4.2
- API PlatForm
- Lexik JWT
- Uuid

Install API:

- Download repository : https://github.com/yohannzaoui/projet7-BileMo/archive/master.zip

- Set your .env file with your database parameters :
example : DATABASE_URL=mysql://root@127.0.0.1:3306/bilemo

php bin/console doctrine:database:create 
php bin/console doctrine:schema:update --force

Configure authentication: 

- SSH keys and Security.yaml :

Generate the JWTAuthentication SSH keys 
mkdir config/jwt 
openssl genrsa -out config/jwt/private.pem -aes256 4096 
openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
For more informations:
https://github.com/lexik/LexikJWTAuthenticationBundle/blob/master/Resources/doc/index.md#configuration

