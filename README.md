This testwork yii2 extension. When this extension is used,
a promo module with crud and rest api controllers will append to web app.

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Just add

```
"sablerom/yii2-promo": "*"
```
to the require section of your `composer.json` file and run

```
$ composer update
```

Migration
-----

After the extension has been installed, start the migration:

```
$ ./yii migrate
```

After that you can test the module through the browser and through the api requests.


Web Browser Testing
-----

Just open your installed yii2 application at route `/promo` and follow the instructions.


Rest Api Testing
-----

Use curl or any request service, such as Postman, to make api requests with different methods and parameters.

Entry point:

```
http:/your-app.com/promo/api
```

You must use the authorization header of the form: 

```
Authorization: Bearer <token>
```

For testing try tokens `adminToken`, `demoToken` and `disabled` token. Also use the header for json content ( `Content-Type` and `Accept` ). You can receive or change promo codes for both id and code.

Example for getting some promo code by id:

```
$ curl -i -H "Content-Type:application/json" -H "Authorization: Bearer adminToken" "http://localhost/promo/api/1"
```

Example for updating some promo code data by code:

```
$ curl -i -H "Content-Type:application/json" -H "Authorization: Bearer adminToken" -X PUT \
-d '{"zoneName":"Minsk"}' "http://localhost/promo/api/test"
```

For more information about api actions check the [Yii2 RESTful Web Services Guide](http://www.yiiframework.com/doc-2.0/guide-rest-quick-start.html)