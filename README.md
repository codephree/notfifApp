# notfifApp

NotfifApp is app that publish message to the [subscriber app](https://github.com/codephree/subscriberApp). The application is developed with laravel php framework.

## Installation

Clone the repository with command [repo](https://github.com/codephree/notfifApp).

```bash
git clone https://github.com/codephree/notfifApp
```
Create database.sqlite in database folder and run migration from the terminal

```bash
php artisan migrate
```
Then run serve to https://localhost:8000

```bash
php artisan serve
```


## Usage
Verify the deployment by navigating to your server address in
your preferred client.
```sh
  POST 'http://localhost:8000/subscribe/{topic1}'
  // body
 {
    //subscriber url, make sure the subscriber app is up and running
     url: "http://localhost/subscriber1"
  }
```

Verify the deployment by navigating to your server address in
your preferred client.
```sh
  POST 'http://localhost:8000/subscribe/{topic1}'
  // body
 {
    "message" : "Hello Agbalumo"
}
