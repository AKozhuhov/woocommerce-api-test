WooCommerce API Test

Create a WordPress plugin to add an API endpoint for recent orders placed with a WooCommerce store.

The API endpoint should accept one parameter - an integer for the number of recent orders. For example, passing "5" to the endpoint will return the 5 most recent orders (ordered from newest to oldest).

If no integer is passed to the endpoint, WordPress's default posts per page setting should be used to determine the number of orders.

The endpoint's response should be a JSON object containing the relevant number of WC_Order objects.

Tips:

There is a WooComerce way & pure PHP way to create an API, the WooCommerce way is the correct way for this test.
Orders in WooCommerce are a custom post type.
Non-functional requirements:

share you answer via a GitHub repo (public or private).
your code must conform to the WordPress Coding Standards.
using an object-oriented structure for your plugin will earn you bonus points.
