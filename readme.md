# Laravel MsGraph Wrapper

[![Latest Version on Packagist](https://img.shields.io/packagist/v/tigerheck/laravel-microsoft-graph.svg?style=flat-square)](https://packagist.org/packages/tigerheck/laravel-microsoft-graph)
[![Total Downloads](https://img.shields.io/packagist/dt/tigerheck/laravel-microsoft-graph.svg?style=flat-square)](https://packagist.org/packages/tigerheck/laravel-microsoft-graph)


**A Laravel wrapper for Microsoft Graph Rest APIs (Office365).**

## Install

Via Composer

``` bash
$ composer require tigerheck/laravel-microsoft-graph
```


## Configuration

Laravel MsGraph requires connection configuration. To get started, you'll need to publish all vendor assets:

```bash
$ php artisan vendor:publish --provider="TigerHeck\MsGraph\MsGraphServiceProvider"
```

## Enviroment Configuraiton
Add below variables to your enviroment configuraiton file: 
```bash
MSGRAPH_CLIENT_ID=
MSGRAPH_SECRET_ID=
MSGRAPH_TENANT_ID=
MSGRAPH_SCOPES=
MSGRAPH_OAUTH_URL=
MSGRAPH_GRANT_TYPE=
```
## Usage
See documention for params and others at [MsGraph docs](https://learn.microsoft.com/en-us/graph/auth-v2-service)
