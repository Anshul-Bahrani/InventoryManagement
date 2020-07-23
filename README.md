# InventoryManagement - Easy ERP
### This project was solely made in PHP for backend ###
---

## About
- All In one place for your all Transactions including sales/purchaces/products/customers/employees, manage all these things at ease and get all the reports generated right at
your dashboard.

---

### Manage ###

- These include the CRUD Operations for all the different things menthioned above.
- Add Products/Customers/Employees with forms and/or manage them.
- Delete something bymistakely?SoftDeletes got you covered.(Which also helps in data analytics in big companies)

---

### Reports ###

- First reports gives you an complete overview of your sales v/s purchase monthvise using barchart from chart.js
- Second gives you the value of your inventory according to the price you decided for each products differentiated by categories using piechart from chart.js

---

### Invoice ###

- Invoices are generated and stored in the database for sales/purchase and are shown to you in a printable format.(Work in progress using stripe api).
- Once a sale or a purchase has been done..payments are done using stripe and the correspondint invoices are generated(Work in progress).

---

### Helper ###

- Everything is routed through one page and dispached to different locations then.. i.e.  routing.php(Related to web.php and controller in laravel)
- Everything is loaded in the server at boot time using init.php which inturn uses requirements.php to initialize all objects and dependancy classes in a proper manner.(Related to Laravel).
- Constants are defined in constants.php file which can be used anywhere in the project.(Related to constants in .env file in laravel)

---

### config.ini ###
- Same as .env in laravel which includes the port, mail, app-name, database details.

---

### classes ###
- This is the heart of the application
- Includes helper classes such as DatabaseHelper and DependancyInjector whose work is self-explanatory.
- Along with that other classes which are related to specific workload in the application(Related to models in laravel).

---

### assets/js ###
- Includes all the js files categoriezed by their pages properly.

---

### Views ###
- Containes includes which includes navbar and sidebar kind of things and page-level includes such as scripts related to specific pages.

---

All in all understanding of the working of the application as well the file structure is not difficult and for starting the application..type the following command in your cmd/git_bash
with SERVER(e.g. localhost) being the servername and PORT(e.g. 9090) being the port you like and specified in config file:
php -S SERVER:PORT
