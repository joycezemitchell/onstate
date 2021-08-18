<?php
require_once 'schema.php';
require_once 'utils.php';
require_once 'grabcollections.php';
require_once 'grabproducts.php';
require_once 'graborders.php';

// Add Schema
new Schema();

// Grab all collections
debug(str_repeat("-=", 50));
new GrabCollection();

// Grab all products
debug(str_repeat("-=", 50));
new GrabProducts();

// Grab all orders
debug(str_repeat("-=", 50));
new GrabOrders();

