# PHPy test

Just a research to check [PHPy][1] with some models.

## Usage

### Clone this repository

```bash
git clone https://github.com/egorsmkv/speech-to-text-using-php
cd speech-to-text-using-php
```

### Build an image

```bash
# my clone has changes in Dockerfile that install some additional packages
git clone https://github.com/egorsmkv/phpy

cd phpy

podman build -t phpy .
```

### Run container and Execute commands inside

```bash
podman run -it --rm -v ./app:/app -w /app phpy bash

# further commands are executed inside the container

git clone w2v-bert-uk-v2.1_onnx-gpu_op20_fp32

# install python dependencies
pip install librosa transformers

# install composer
php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
php composer-setup.php
php -r "unlink('composer-setup.php');"

# install php dependencies
php composer.phar install

# run the script
php speech_to_text_w2v2.php
```

[1]: https://github.com/swoole/phpy
