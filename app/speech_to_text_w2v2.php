<?php

/*

pip install librosa transformers
php composer.phar install

git clone w2v-bert-uk-v2.1_onnx-gpu_op20_fp32

*/

require 'vendor/autoload.php';

OnnxRuntime\Vendor::check();

$operator = PyCore::import("operator");
$builtins = PyCore::import("builtins");

$numpy = PyCore::import('numpy');

$librosa = PyCore::import('librosa');

$Wav2Vec2BertProcessor = PyCore::import('transformers')->Wav2Vec2BertProcessor;
$processor = $Wav2Vec2BertProcessor->from_pretrained("Yehor/w2v-bert-uk-v2.1");

function extract_samples($wav_file) {
    global $librosa, $numpy;

    $outputs = $librosa->load($wav_file, sr: 16_000, mono: true);

    echo "Sample rate: " . $outputs[1] . "\n";

    $expanded = $numpy->expand_dims($outputs[0], axis: 0);
    echo $expanded->shape . "\n";

    return $expanded;
}

function extract_features($inputs) {
    global $processor;

    $inputs = $processor($inputs, sampling_rate: 16000)->input_features;

    return $inputs;
}

function decode_logits($outputs) {
    global $processor, $numpy;

    $predicted_ids = $numpy->argmax($outputs[0], axis: -1);
    $predictions = $processor->decode($predicted_ids->squeeze()->tolist());

    return $predictions;
}

$samples = extract_samples('test.wav');
$features = extract_features($samples);

echo $features->shape . "\n";

$as_list = PyCore::scalar($features->tolist());

$asr_model = new OnnxRuntime\Model('w2v-bert-uk-v2.1_onnx-gpu_op20_fp32/model.onnx');

$predictions = $asr_model->predict(['input_features' => $as_list]);
$decoded = decode_logits($predictions['logits']);

echo "Decoded: " . $decoded . "\n";
