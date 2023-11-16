#!/bin/bash

curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.5/install.sh | bash && . ~/.nvm/nvm.sh && nvm install --lts

npm install

npm run build