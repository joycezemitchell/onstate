John Mitchell Villanueva - OnSite Exam
==


Note
--
I have updated php/Dockerfile and removed all the Couchbase related packages/libraries.
 ```
libcouchbase-dev \
pecl bundle -d /usr/src/php/ext couchbase-2.6.2 && \
rm /usr/src/php/ext/couchbase-*.tgz && \
couchbase && \
```

I am getting this error with the orignal Dockerfile
![Alt text](https://github.com/joycezemitchell/onstate/blob/master/images/im1.jpg)

I have also add the following under docker-php-ext-install in PHP Docker file to be able to use MySqli for php database connection:

```
mysqli
```

Graphql does not seem to be working. I am getting an error when trying to run it in Postman.
![Alt text](https://github.com/joycezemitchell/onstate/blob/master/images/im2.jpg)


Creating a new page using /api/2021-07/pages.json does not seem to be working as well. The API credential might not have a permission to create a new page.
![Alt text](https://github.com/joycezemitchell/onstate/blob/master/images/im10.jpg)



Setup
--

1. Git clone this repo
2. Run
    ```
    docker-compose build
    ```
    
3. After the build has finished, run

    docker-compose up -d

Task 1
--

> You should use this app to download and store a sample of products, collections (Shopify's term for categories) and orders. You may store the downloaded resources in any way you see fit.


### Instructions
Open a browser and run http://localhost/index.php. You should see something like this in the screen:
![Alt text](https://github.com/joycezemitchell/onstate/blob/master/images/im3.JPG)

It will do the following:
1. Create a database 3 tables(collections, products and orders)
2. Import all collections from Shopify store
3. Import all products
4. Import all orders

Here are sample screenshots of the tables:

![Alt text](https://github.com/joycezemitchell/onstate/blob/master/images/im4.JPG)

![Alt text](https://github.com/joycezemitchell/onstate/blob/master/images/im5.jpg)

![Alt text](https://github.com/joycezemitchell/onstate/blob/master/images/im6.jpg)

Task 2
--

> You should then attempt to create a page in shopify using one of the APIs with the body content listing the collections you have retrieved as a list of links.


### Instructions
Open a browser and run http://localhost/createpage.php. You should see something like this in the screen:
![Alt text](https://github.com/joycezemitchell/onstate/blob/master/images/im7.jpg)

It will do the following:
1. Grab all collections from the database
2. Convert it into html page
3. Create a new landing page in Shopify store

Here is a sample screenshot:




