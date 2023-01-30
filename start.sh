#!/bin/bash

npm run watch &
php bin/console server:run 0.0.0.0:8000
