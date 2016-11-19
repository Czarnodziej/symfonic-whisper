symfony3-base
=============

Symfony 3 along with Fos User Bundle and AdminLte implemented.

- locale in route
- smoke tested
- basic views
- user manager for admins

TODO:
 - more tests

Gulp:
```
# prod env
gulp --prod
```


```
HTTPDUSER=`ps axo user,comm | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1`
# if this doesn't work, try adding `-n` option
sudo setfacl -R -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX var
sudo setfacl -dR -m u:"$HTTPDUSER":rwX -m u:`whoami`:rwX var

#load db structure
php bin/console doctrine:schema:update --force
#add admin:admin user
php bin/console doctrine:fixtures:load
```
