<?php

require 'vendor/autoload.php';

OnnxRuntime\Vendor::check();

$model = new OnnxRuntime\Model('w2v-bert-uk-v2.1_onnx-gpu_op20_fp32/model.onnx');

print_r($model->metadata());

print_r($model->inputs());
print_r($model->outputs());
