# Bechmark Storage INTERNAL vs MOUNTED
Dummy application to compare the performance when using mounted vs unmounted volumes.


### Usage: 
```
    docker-compose up #Enjoy :) 
```

### MacBook Pro results:
Using a MacBook Pro 
+ Intel Core i7 2,5GHz 
+ 16GB 1600 DDR3
+ SSD 250GB
##### Docker for Mac
```
⇒  docker-compose up         
basic_1    | Elapsed time: 5.5694000720978s with internal storage.
mounted_1  | Elapsed time: 41.512300014496s with external storage.

```
##### Docker-machine  (4GB RAM, 2 vCPU)
```
⇒  docker-compose up          
basic_1    | Elapsed time: 5.4214000701904s with internal storage.
mounted_1  | Elapsed time: 16.526299953461s with external storage.

```
##### Docker-machine  with NFS activated(4GB RAM, 2 vCPU)
```
⇒  docker-compose up
basic_1    | Elapsed time: 5.458899974823s with internal storage.
mounted_1  | Elapsed time: 23.096600055695s with external storage.

```

### Linux results:
Using
+ Intel(R) Core(TM) i7-4790 CPU @ 3.60GHz
+ 16GB 1600 DDR3
+ SSD 250GB

#### Docker
```
⇒  docker-compose up 
basic_1    | Elapsed time: 1.9842998981476s with internal storage.
mounted_1  | Elapsed time: 3.0894999504089s with external storage.
```

### Window results:
Using
+ AMD Ryzen 5 3600XT 6-Core Processor 3.8GHz
+ 32GB 3200 DDR4
+ M.2 512GB

#### Docker (Running in Ubuntu with WSL 2)
```
$ docker-compose up
basic_1    | Elapsed time: 0.32800006866455s with internal storage.
mounted_1  | Elapsed time: 0.37349987030029s with mounted storage.
```

### What does this script do?:
* Foreach `THREAD`
    * It will iterate from 0 to `LIMIT` and do:
        - Generate a `random_bytes` string
        - Generate a IV for AES-256-CBC algorithm
        - Encrypt the UUID with AES-256-CBC and openssl
        - Store the result in a file
    * Delete the file

### Default config values:

* **100** threads
* **250** iterations