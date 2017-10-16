# Coding Test

Demo app for exercise 1.


###Few assumptions and consideration
* For simplicity there is no any validity checks on input data, no dependency injection or routing. For the same reason there is no transformation of original JSON entries.
* All data is stored in the original json files.


## Installation

Demo app requires PHP-7.1, ``bcmath`` and ``composer``.

Checkout project, then ``cd`` into project root directory and do ``composer install``

## Testing

### Testing web interface
Execute following commands to run the demo web server:
```
cd web
php -S localhost:8000
```

Then send POST requests to ``http://localhost:8000/index.php`` with JSON-encoded order as request body.

For example this command should reply with discount on two free switches.
```
curl -H "Content-Type: application/json" -X POST \
-d '{"id":"2","customer-id":"2","items":[{"product-id":"B102","quantity":"13","unit-price":"4.99","total": "24.95"}],"total":"24.95"}' \
 http://localhost:8000/index.php
```
### Unit testing

Run ``php vendor/bin/phpunit`` in project root.

## Extending
To add a new Discount calculator create a new class in ``src/Service/Discountcalculator`` implementing ``CalculatorInterface`` and name ending with ``Calculator``. For example ``NewCustomers10pctCalculator``.

Every Calculator must return order of execution in `getPriority()` method. All calculators are run based on this value until first non-zero discount match or until all calculators will fail.