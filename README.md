# php-js-loader (php5)
This project was created specifically for LAMP, LEMP, WAMP, ... stack developers, to simplify the modularization of an MVC project. On a Node, Ruby, or Django backend, one can easily "lazy load" dependencies, though this task can be quite gruesome and hacky on a PHP platform. Take for example the current directory tree,

```
app/
----- shared/
---------- sidebar/
--------------- sidebarDirective.js
--------------- sidebarView.html
---------- article/
--------------- articleDirective.js
--------------- articleView.html
----- components/
---------- home/
--------------- homeController.js
--------------- homeService.js
--------------- homeView.html
---------- blog/
--------------- blogController.js
--------------- blogService.js
--------------- blogView.html
----- app.module.js
----- app.routes.js
assets/
----- img/
----- css/
----- js/
----- libs/
index.html
```
Logically, to get this model to work properly, one would need to include **every** single javascript document within the project. As can be imagined, this could easily become messy and a nightmare to manage,
```html
<head>
  <script src=".../controller1.js"></script>
  <script src=".../controller2.js"></script>
  <script src=".../controller3.js"></script>
  <script src=".../directive1.js"></script>
  <script src=".../directive2.js"></script>
  <script src=".../directive3.js"></script>
  <script src=".../utility1.js"></script>
  <script src=".../utility2.js"></script>
  <script src=".../utility3.js"></script>
</head>
```
Regarding the function of this project, it will read for your necessary javascript documents, crunch them all together, and pack your code using ParseMaster (ported to php by Nicolas Martin). The "loader" module reads for javascript documents to import via a main json configuration document structured like so,
```json
{
"Libraries": {
		"enabled": true,
		"local": false,
		"list": [
			{
				"name": "Angular",
				"enabled": true,
				"source": "https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.4.4/angular.min.js"
			}
		]
	},
	"Initialize": {
		"enabled": true,
		"local": true,
		"list": [
			{
				"name": "Module",
				"enabled": true,
				"source": "/app/app.module.js"
			}
		]
	},
	"Controllers": {
		"enabled": true,
		"local": true,
		"list": [
			{
				"name": "About",
				"enabled": false,
				"source": "/app/components/about/controller.js"
			}
		]
	}
}
```
The "loader" module can be used be executing,
```
http://.../server/?module=loader&resource=scripts
```
It will automatically rewrite the mime type of the output to be usable in standard context.
