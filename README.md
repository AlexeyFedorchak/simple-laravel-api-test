## Steps to run API

Copy .env.example file:
```
cp .env.example .env
```

Copy .env.example.testing file (make sure you have correct DB configs.

Also please set in .env.testing QUEUE_CONNECTION=sync in order to run job synchronously 
to make sure that submissions records are successfully created. 

For this we can't rely on Queue:fake(), this won't run SubmissionStoreJob.

```
cp .env.example.testing .env.testing
```

Make sure you have PHP 8.2 or higher installed.

1. Install composer dependencies:
    ```
    composer install
    ```

2. Run tests:
    ```
    phpunit --filter=SubmissionStoreApiTest
    ```
