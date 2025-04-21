# PHPy test

Just a research to check [PHPy][1] with some models.

## Build an image

```bash
# my clone has changes in Dockerfile that install some additional packages
git clone https://github.com/egorsmkv/phpy

cd phpy

podman build -t phpy .
```

## Run container and execute commands inside

```bash
podman run -it --rm -v ./app:/app -w /app phpy bash

git clone w2v-bert-uk-v2.1_onnx-gpu_op20_fp32

pip install librosa transformers
php composer.phar install

php speech_to_text_w2v2.php
```

[1]: https://github.com/swoole/phpy
